<?php

namespace App\Http\Controllers;

use App\Models\PpdbApplication;
use App\Models\School;
use App\Models\SchoolHomepageSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PpdbAuthController extends Controller
{
    /**
     * Show the registration page (payment-first).
     * This replaces the old simple register form.
     */
    public function showRegisterForm(Request $request)
    {
        $school = $request->route('school');
        $schoolModel = School::where('type', School::resolveDbType($school))->firstOrFail();
        $homepage = SchoolHomepageSetting::where('school_id', $schoolModel->id)->first();

        $view = strtoupper($school) . '.ppdb.register';
        if (!view()->exists($view)) {
            $view = 'SMK.ppdb.register';
        }

        return view($view, compact('school', 'schoolModel', 'homepage'));
    }

    /**
     * Handle registration with payment-first flow.
     * Creates a PpdbApplication with payment proof.
     * unique_code is NOT generated here — admin must verify payment first.
     */
    public function register(Request $request)
    {
        $method = $request->input('payment_method', 'bank');

        $rules = [
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ];

        // TU method doesn't require proof upload
        if ($method !== 'tu') {
            $rules['payment_proof'] = 'required|file|mimes:jpg,jpeg,png,pdf|max:2048';
        }

        $validated = $request->validate($rules);

        $dbType = School::resolveDbType((string) $request->route('school'));
        $school = School::where('type', $dbType)->firstOrFail();

        // Create the application
        $application = new PpdbApplication();
        $application->school_id = $school->id;
        $application->full_name = $validated['full_name'];
        $application->phone = $validated['phone'];
        $application->password = bcrypt(uniqid('ppdb_', true)); // placeholder, never used for login
        $application->login_token = PpdbApplication::generateLoginToken(); // secure random token for auth
        $application->unique_code = null; // set by admin after payment is verified

        // Generate application ID with random hybrid format (2 digits + 2 letters)
        // Format: SPMB-YYYY-DDLL (where DD=digits, LL=letters)
        $year = date('Y');
        $prefix = 'SPMB-' . $year . '-';

        // Generate unique hybrid ID: 2 random digits + 2 random letters
        $application->application_id = $this->generateHybridApplicationId($school->id, $prefix);


        // Handle payment method and status
        $application->payment_method = $method;
        $application->payment_date = now();

        if ($method === 'tu') {
            // Bank teller payment — pending admin confirmation
            $application->status = 'pending';
            $history = [[
                'status' => 'registered_tu',
                'changed_at' => now()->toDateTimeString(),
                'note' => 'Pendaftar memilih bayar di TU. Menunggu konfirmasi admin.',
            ]];
            $application->status_history = $history;
        } else {
            // E-wallet or bank transfer — payment proof uploaded
            $application->status = 'payment_uploaded';

            if ($request->hasFile('payment_proof')) {
                $file = $request->file('payment_proof');
                $path = $file->store('ppdb/payments/' . $application->application_id, 'public');
                $application->payment_proof = $path;
            }

            $ewalletType = $request->input('ewallet_type');
            $methodLabel = match ($method) {
                'ewallet' => $ewalletType ?? 'E-Wallet',
                'bank' => 'Transfer Bank',
                default => ucfirst($method),
            };
            $application->payment_method = $methodLabel;

            $history = [[
                'status' => 'registered_payment_uploaded',
                'changed_at' => now()->toDateTimeString(),
                'note' => 'Bukti pembayaran diunggah via ' . $methodLabel . '. Menunggu verifikasi admin.',
            ]];
            $application->status_history = $history;
        }

        $application->last_registration_step = 'biodata';
        $application->save();

        // Flash registration details to session — applicant is NOT logged in yet
        session()->flash('ppdb_reg_data', [
            'application_id' => $application->application_id,
            'full_name'      => $application->full_name,
            'phone'          => $application->phone,
            'payment_method' => $application->payment_method,
        ]);

        return redirect()->route('ppdb.register.success', ['school' => $request->route('school')]);
    }

    /**
     * Show the registration success page.
     * Reads from session — unique_code is NOT shown here (pending admin verification).
     */
    public function registerSuccess(Request $request)
    {
        $regData = session('ppdb_reg_data');

        if (!$regData) {
            return redirect()->route('ppdb.register', ['school' => $request->route('school')]);
        }

        $school = $request->route('school');
        return view('partials.ppdb-register-success', compact('school', 'regData'));
    }

    /**
     * Show the "Cek Kode Unik" page where applicants retrieve their code
     * after admin verifies their payment.
     */
    public function showCheckCode(Request $request)
    {
        $school = $request->route('school');
        $response = response()->view('partials.ppdb-cek-kode', compact('school'));

        return $response
            ->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Thu, 01 Jan 1970 00:00:00 GMT');
    }

    /**
     * POST — look up an applicant's PPDB login ID by application ID and phone number.
     */
    public function checkCode(Request $request)
    {
        $request->validate([
            'application_id' => 'required|string|max:50',
            'phone' => 'required|string|max:30',
        ]);

        $dbType = School::resolveDbType((string) $request->route('school'));
        $schoolModel = School::where('type', $dbType)->firstOrFail();

        $applicationId = strtoupper(trim($request->application_id));
        $rawPhone = trim($request->phone);
        $digitsOnly = preg_replace('/\D/', '', $rawPhone);
        $last9 = substr($digitsOnly, -9);

        $application = PpdbApplication::where('school_id', $schoolModel->id)
            ->where('application_id', $applicationId)
            ->where(function ($q) use ($rawPhone, $last9) {
                $q->where('phone', $rawPhone)
                    ->orWhere('phone', 'LIKE', '%' . $last9);
            })
            ->first();

        if (! $application) {
            return back()->withErrors(['application_id' => 'ID Pendaftaran atau nomor WhatsApp tidak cocok dengan data pendaftaran.'])->withInput();
        }

        $school = $request->route('school');

        // Determine status based on unique_code and application status
        if ($application->unique_code) {
            // Has unique code → ready to use
            $viewStatus = 'found';
        } elseif (in_array($application->status, ['payment_confirmed', 'verified', 'accepted'])) {
            // Payment confirmed by admin, or application accepted/verified → show as confirmed
            $viewStatus = 'confirmed';
        } else {
            // Still pending (includes payment_uploaded which is unverified)
            $viewStatus = 'pending';
        }

        // Debug logging
        \Illuminate\Support\Facades\Log::info('Cek Kode Page - Status Check', [
            'application_id' => $application->application_id,
            'applicant_id' => $application->id,
            'db_status' => $application->status,
            'unique_code' => $application->unique_code ? 'present' : 'absent',
            'calculated_view_status' => $viewStatus,
            'school_id' => $application->school_id,
            'payment_method' => $application->payment_method,
        ]);

        $response = response()->view('partials.ppdb-cek-kode', [
            'school'          => $school,
            'status'          => $viewStatus,
            'unique_code'     => $application->unique_code,
            'application_id'  => $application->application_id,
            'full_name'       => $application->full_name,
            'payment_method'  => $application->payment_method,
            'db_status'       => $application->status,
        ]);

        return $response
            ->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Thu, 01 Jan 1970 00:00:00 GMT');
    }

    /**
     * Login using application ID (no password).
     * Only allow login if payment has been verified by admin.
     */
    public function login(Request $request)
    {
        $request->validate([
            'application_id' => 'required|string|max:50',
        ]);

        $applicationId = strtoupper(trim($request->application_id));

        $dbType = School::resolveDbType((string) $request->route('school'));
        $school = School::where('type', $dbType)->firstOrFail();

        $application = PpdbApplication::where('school_id', $school->id)
            ->where('application_id', $applicationId)
            ->first();

        if (!$application) {
            return back()->withErrors(['application_id' => 'ID Pendaftaran tidak ditemukan atau tidak valid. Pastikan Anda memasukkan ID dengan benar.']);
        }

        // CRITICAL: Only allow login if payment has been verified by admin
        if (!in_array($application->status, ['payment_confirmed', 'verified', 'accepted'])) {
            $errorMessage = match ($application->status) {
                'pending' => 'Pembayaran Anda belum diverifikasi admin. Silakan tunggu atau hubungi petugas TU.',
                'payment_uploaded' => 'Pembayaran Anda sedang diverifikasi oleh admin. Silakan coba lagi nanti.',
                'rejected' => 'Pendaftaran Anda telah ditolak. Hubungi admin untuk informasi lebih lanjut.',
                default => 'Status pendaftaran Anda tidak memungkinkan untuk login saat ini.',
            };
            return back()->withErrors(['application_id' => $errorMessage]);
        }

        Auth::guard('ppdb_applications')->login($application);

        // Redirect to last incomplete registration step if not done
        $nextStep = $application->last_registration_step;
        if (!$nextStep || $nextStep === 'biodata') {
            return redirect()->route('ppdb.biodata', ['school' => $request->route('school')]);
        }

        if ($nextStep === 'jurusan_berkas') {
            return redirect()->route('ppdb.berkas', ['school' => $request->route('school')]);
        }

        return redirect()->route('ppdb.dashboard', ['school' => $request->route('school')]);
    }


    public function logout(Request $request)
    {
        Auth::guard('ppdb_applications')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('school.ppdb', ['school' => $request->route('school')]);
    }

    public function dashboard(Request $request)
    {
        $application = Auth::guard('ppdb_applications')->user();

        if (!$application) {
            return redirect()->route('ppdb.login', ['school' => $request->route('school')]);
        }

        // Redirect to last incomplete registration step if not done
        $nextStep = $application->last_registration_step;
        if (!$nextStep) {
            $nextStep = 'biodata';
        }

        if ($nextStep && $nextStep !== 'done') {
            switch ($nextStep) {
                case 'jurusan_berkas':
                    return redirect()->route('ppdb.berkas', ['school' => $request->route('school')]);
                case 'biodata':
                    return redirect()->route('ppdb.biodata', ['school' => $request->route('school')]);
            }
        }

        $school = $request->route('school');
        $viewName = strtoupper($school) . '.ppdb.dashboard';
        if (!view()->exists($viewName)) {
            $viewName = 'SMK.ppdb.dashboard';
        }

        $schoolModel = School::resolveDbType($school);
        $schoolRecord = School::where('type', $schoolModel)->first();
        $waGroupLink = null;
        if ($schoolRecord) {
            $waGroupLink = \App\Models\PpdbManagementPhase::where('school_id', $schoolRecord->id)
                ->whereNotNull('wa_group_link')
                ->orderByDesc('start_date')
                ->value('wa_group_link');
        }

        return view($viewName, compact('application', 'school', 'waGroupLink'));
    }

    public function updateBiodata(Request $request)
    {
        /** @var \App\Models\PpdbApplication|null $application */
        $application = Auth::guard('ppdb_applications')->user();
        if (!$application) {
            return redirect()->route('ppdb.login', ['school' => $request->route('school')]);
        }
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'nisn' => 'nullable|string|max:20',
            'place_of_birth' => 'nullable|string|max:100',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string',
            'address' => 'nullable|string',
            'previous_school' => 'nullable|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'father_occupation' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'mother_occupation' => 'nullable|string|max:255',
            'parent_salary_range' => 'nullable|string|max:50',
        ]);
        foreach ($validated as $key => $value) {
            $application->$key = $value;
        }
        $application->last_registration_step = 'jurusan_berkas';
        $application->save();
        return redirect()->route('ppdb.berkas', ['school' => $request->route('school')])->with('success', 'Biodata berhasil diperbarui.');
    }

    public function updateBerkas(Request $request)
    {
        /** @var \App\Models\PpdbApplication|null $application */
        $application = Auth::guard('ppdb_applications')->user();
        if (!$application) {
            return redirect()->route('ppdb.login', ['school' => $request->route('school')]);
        }
        $schoolRoute = strtolower((string) $request->route('school'));
        $isSmk = in_array($schoolRoute, ['smk', 'smk-putra-pakuan'], true);
        $validated = $request->validate([
            'major_1' => $isSmk ? 'required|string|max:255' : 'nullable|string|max:255',
            'major_2' => 'nullable|string|max:255',
            'kk_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'ijazah_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'photo_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'akta_kelahiran_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'prestasi_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
        $application->major_1 = $validated['major_1'] ?? null;
        $application->major_2 = $validated['major_2'] ?? null;
        $fileFields = ['kk_file', 'ijazah_file', 'photo_file', 'akta_kelahiran_file', 'prestasi_file'];
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $path = $file->store('ppdb/' . $application->application_id, 'public');
                $application->$field = $path;
            }
        }
        // CRITICAL FIX: Do NOT reset status to 'pending'. The payment confirmation status must be preserved.
        // The registration step progression is tracked via last_registration_step, not status.
        // Status should remain as 'payment_confirmed' throughout the application process.
        $application->last_registration_step = 'done';
        $application->save();
        return redirect()->route('ppdb.dashboard', ['school' => $request->route('school')])->with('success', 'Berkas berhasil diunggah. Pendaftaran Anda telah lengkap.');
    }

    /**
     * Generate a unique hybrid application ID with format: 2 random digits + 2 random letters
     * Example: 47HK, 92BJ, 15KX
     * Ensures uniqueness per school per year
     */
    private function generateHybridApplicationId($schoolId, $prefix)
    {
        $year = date('Y');
        $maxAttempts = 100;
        $attempts = 0;

        do {
            // Generate 2 random digits (00-99)
            $digits = str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);

            // Generate 2 random letters (A-Z)
            $letters = chr(rand(65, 90)) . chr(rand(65, 90));

            $hybridSuffix = $digits . $letters;
            $generatedId = $prefix . $hybridSuffix;

            // Check if this ID already exists for this school in this year
            $exists = PpdbApplication::where('school_id', $schoolId)
                ->where('application_id', $generatedId)
                ->whereYear('created_at', $year)
                ->exists();

            if (!$exists) {
                return $generatedId;
            }

            $attempts++;
        } while ($attempts < $maxAttempts);

        // Fallback (should rarely happen): use a variant with timestamp
        $timestamp = substr(strval(microtime(false) * 10000), -4);
        return $prefix . $timestamp;
    }
}
