<?php

namespace App\Http\Controllers;

use App\Models\PpdbApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PpdbAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'application_id' => 'required|string',
            'date_of_birth' => 'required|date',
        ]);

        $application = PpdbApplication::where('application_id', $request->application_id)->first();

        if (!$application) {
            return back()->withErrors(['application_id' => 'ID Pendaftaran tidak ditemukan.']);
        }

        if (!$application->canLogin()) {
            return back()->withErrors(['application_id' => 'Akun Anda belum dapat diakses.']);
        }

        // Check date of birth
        $inputDob = date('dmY', strtotime($request->date_of_birth));
        if ($application->password !== $inputDob) {
            return back()->withErrors(['date_of_birth' => 'Tanggal lahir tidak sesuai.']);
        }

        // Custom authentication for PPDB
        Auth::guard('ppdb_applications')->login($application);

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

        $school = $request->route('school');
        return view('SMK.ppdb.dashboard', compact('application', 'school'));
    }

    public function updateBiodata(Request $request)
    {
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
        $application->save();
        return redirect()->route('ppdb.berkas', ['school' => $request->route('school')])->with('success', 'Biodata berhasil diperbarui.');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:ppdb_applications,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8',
        ]);
        $application = new PpdbApplication();
        $application->application_id = 'PPDB-' . date('Y') . '-' . strtoupper(substr(md5($validated['email']), 0, 6));
        $application->school_type = $request->route('school');
        $application->full_name = $validated['full_name'];
        $application->email = $validated['email'];
        $application->phone = $validated['phone'] ?? null;
        $application->password = bcrypt($validated['password']);
        $application->status = 'draft';
        $application->save();
        Auth::guard('ppdb_applications')->login($application);
        return redirect()->route('ppdb.biodata', ['school' => $request->route('school')]);
    }

    public function updateBerkas(Request $request)
    {
        $application = Auth::guard('ppdb_applications')->user();
        if (!$application) {
            return redirect()->route('ppdb.login', ['school' => $request->route('school')]);
        }
        $validated = $request->validate([
            'major_1' => 'required|string|max:255',
            'major_2' => 'nullable|string|max:255',
            'kk_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'ijazah_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'photo_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'raport_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
        $application->major_1 = $validated['major_1'];
        $application->major_2 = $validated['major_2'] ?? null;
        // Handle file uploads
        $fileFields = ['kk_file', 'ijazah_file', 'photo_file', 'raport_file'];
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $path = $file->store('ppdb/' . $application->application_id, 'public');
                $application->$field = $path;
            }
        }
        $application->save();
        return redirect()->route('ppdb.payment', ['school' => $request->route('school')])->with('success', 'Berkas berhasil diunggah dan jurusan disimpan.');
    }

    public function updatePayment(Request $request)
    {
        $application = Auth::guard('ppdb_applications')->user();
        if (!$application) {
            return redirect()->route('ppdb.login', ['school' => $request->route('school')]);
        }
        $validated = $request->validate([
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $path = $file->store('ppdb/payments/' . $application->application_id, 'public');
            $application->payment_proof = $path;
            $application->status = 'payment_uploaded';
            $application->save();
        }
        return redirect()->route('ppdb.dashboard', ['school' => $request->route('school')])->with('success', 'Bukti pembayaran berhasil diunggah. Admin akan memverifikasi pembayaran Anda.');
    }
}
