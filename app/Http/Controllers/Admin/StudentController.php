<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PpdbApplication;
use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /** Promote accepted PPDB applicant into a permanent student record. */
    public function promote(Request $request)
    {
        $validated = $request->validate([
            'ppdb_application_id' => ['required', 'integer', 'exists:ppdb_applications,id'],
            'nis'                 => ['nullable', 'string', 'max:20'],
            'current_class'       => ['nullable', 'string', 'max:10'],
            'class_room'          => ['nullable', 'string', 'max:5'],
            'enrolled_at'         => ['nullable', 'date'],
            'academic_year_entry' => ['required', 'string', 'max:20'],
        ]);

        $app = PpdbApplication::findOrFail($validated['ppdb_application_id']);

        // Guard: only accepted applicants can be promoted
        if ($app->status !== 'accepted') {
            return response()->json(['success' => false, 'message' => 'Hanya pendaftar yang diterima yang dapat dipromosikan.'], 422);
        }

        // Guard: not already promoted
        if ($app->student()->exists()) {
            return response()->json(['success' => false, 'message' => 'Pendaftar ini sudah dipromosikan.'], 422);
        }

        $school = School::findOrFail($app->school_id);

        // NIS uniqueness check per school
        if (!empty($validated['nis'])) {
            $exists = Student::withTrashed()
                ->where('school_id', $school->id)
                ->where('nis', $validated['nis'])
                ->exists();
            if ($exists) {
                return response()->json(['success' => false, 'message' => 'NIS sudah digunakan di sekolah ini.'], 422);
            }
        }

        $admin = Auth::guard('admin')->user();

        $student = Student::create([
            'school_id'           => $school->id,
            'ppdb_application_id' => $app->id,
            'nis'                 => $validated['nis'] ?? null,
            'full_name'           => $app->full_name,
            'email'               => $app->email,
            'phone'               => $app->phone,
            'date_of_birth'       => $app->date_of_birth,
            'place_of_birth'      => $app->place_of_birth,
            'gender'              => $app->gender,
            'address'             => $app->address,
            'nisn'                => $app->nisn,
            'previous_school'     => $app->previous_school,
            'academic_year_entry' => $validated['academic_year_entry'],
            'major'               => $this->normalizeMajorCode($app->assigned_major ?? $app->major_1),
            'current_class'       => $validated['current_class'] ?? null,
            'class_room'          => $validated['class_room'] ?? null,
            'father_name'         => $app->father_name,
            'father_occupation'   => $app->father_occupation,
            'mother_name'         => $app->mother_name,
            'mother_occupation'   => $app->mother_occupation,
            'parent_salary_range' => $app->parent_salary_range,
            'enrollment_status'   => 'active',
            'enrolled_at'         => $validated['enrolled_at'] ?? now()->toDateString(),
            'created_by'          => $admin?->name ?? 'system',
        ]);

        return response()->json([
            'success'    => true,
            'message'    => 'Siswa berhasil dipromosikan.',
            'student_id' => $student->id,
        ]);
    }

    /**
     * Convert a PPDB full major name to the short archive code.
     * Falls back to the original value (trimmed, max 20 chars) if not mapped.
     */
    private function normalizeMajorCode(?string $major): ?string
    {
        if ($major === null) return null;

        $map = [
            'Teknik Kendaraan Ringan'              => 'TKR',
            'Teknik Sepeda Motor'                  => 'TSM',
            'Teknik Jaringan Komputer'             => 'TKJ',
            'Teknik Jaringan Komputer dan Telekomunikasi' => 'TKJ',
            'TKJ'                                  => 'TKJ',
            'Multimedia/DKV'                       => 'DKV',
            'DKV'                                  => 'DKV',
            'Multimedia'                           => 'DKV',
            'Manajemen Perkantoran'                => 'MPLB',
            'Manajemen Perkantoran dan Layanan Bisnis' => 'MPLB',
            'MPLB'                                 => 'MPLB',
            'Akuntansi'                            => 'AKL',
            'Akuntansi Keuangan Lembaga'           => 'AKL',
            'AKL'                                  => 'AKL',
        ];

        return $map[trim($major)] ?? mb_substr(trim($major), 0, 20);
    }

    /** Manually add a student (not from PPDB). */
    public function store(Request $request)
    {
        $admin   = Auth::guard('admin')->user();
        $schools = $this->allowedSchoolIds();

        $validated = $request->validate([
            'school_id'           => ['required', 'integer', Rule::in($schools)],
            'full_name'           => ['required', 'string', 'max:255'],
            'nis'                 => ['nullable', 'string', 'max:20'],
            'nisn'                => ['nullable', 'string', 'max:20'],
            'gender'              => ['nullable', Rule::in(['Laki-laki', 'Perempuan'])],
            'date_of_birth'       => ['nullable', 'date'],
            'place_of_birth'      => ['nullable', 'string', 'max:100'],
            'address'             => ['nullable', 'string'],
            'email'               => ['nullable', 'email', 'max:255'],
            'phone'               => ['nullable', 'string', 'max:30'],
            'academic_year_entry' => ['required', 'string', 'max:10'],
            'major'               => ['nullable', 'string', 'max:20'],
            'current_class'       => ['nullable', 'string', 'max:10'],
            'class_room'          => ['nullable', 'string', 'max:5'],
            'enrolled_at'         => ['nullable', 'date'],
            'father_name'         => ['nullable', 'string', 'max:255'],
            'mother_name'         => ['nullable', 'string', 'max:255'],
            'notes'               => ['nullable', 'string'],
        ]);

        // NIS uniqueness per school
        if (!empty($validated['nis'])) {
            $exists = Student::withTrashed()
                ->where('school_id', $validated['school_id'])
                ->where('nis', $validated['nis'])
                ->exists();
            if ($exists) {
                return back()->withErrors(['nis' => 'NIS sudah digunakan di sekolah ini.'])->withInput();
            }
        }

        $student = Student::create(array_merge($validated, [
            'enrollment_status' => 'active',
            'enrolled_at'       => $validated['enrolled_at'] ?? now()->toDateString(),
            'created_by'        => $admin?->name ?? 'system',
        ]));

        $school   = School::find($validated['school_id']);
        $slug     = strtolower($school->type === 'SDIT' ? 'sd' : $school->type);
        $year     = $validated['academic_year_entry'];

        return redirect()
            ->to(url("/admin/archive/{$slug}/" . str_replace('/', '-', $year) . "/{$student->id}"))
            ->with('success', 'Siswa berhasil ditambahkan.');
    }

    /** Update a student's profile, class, or status. */
    public function update(Request $request, Student $student)
    {
        $admin = Auth::guard('admin')->user();
        abort_unless(in_array($student->school_id, $this->allowedSchoolIds()), 403);

        $validated = $request->validate([
            'nis'               => ['nullable', 'string', 'max:20'],
            'full_name'         => ['sometimes', 'required', 'string', 'max:255'],
            'email'             => ['nullable', 'email', 'max:255'],
            'phone'             => ['nullable', 'string', 'max:30'],
            'gender'            => ['nullable', Rule::in(['Laki-laki', 'Perempuan'])],
            'date_of_birth'     => ['nullable', 'date'],
            'place_of_birth'    => ['nullable', 'string', 'max:100'],
            'address'           => ['nullable', 'string'],
            'major'             => ['nullable', 'string', 'max:20'],
            'current_class'     => ['nullable', 'string', 'max:10'],
            'class_room'        => ['nullable', 'string', 'max:5'],
            'enrollment_status' => ['nullable', Rule::in(['active', 'graduated', 'dropped', 'transferred'])],
            'graduated_at'      => ['nullable', 'date'],
            'dropped_at'        => ['nullable', 'date'],
            'notes'             => ['nullable', 'string'],
            'father_name'       => ['nullable', 'string', 'max:255'],
            'father_occupation' => ['nullable', 'string', 'max:255'],
            'mother_name'       => ['nullable', 'string', 'max:255'],
            'mother_occupation' => ['nullable', 'string', 'max:255'],
            'parent_salary_range' => ['nullable', 'string', 'max:100'],
        ]);

        // NIS uniqueness on change
        if (isset($validated['nis']) && $validated['nis'] !== $student->nis && !empty($validated['nis'])) {
            $exists = Student::withTrashed()
                ->where('school_id', $student->school_id)
                ->where('nis', $validated['nis'])
                ->where('id', '!=', $student->id)
                ->exists();
            if ($exists) {
                return back()->withErrors(['nis' => 'NIS sudah digunakan di sekolah ini.'])->withInput();
            }
        }

        $student->update(array_merge($validated, ['updated_by' => $admin?->name ?? 'system']));

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Data siswa berhasil diperbarui.']);
        }

        return back()->with('success', 'Data siswa berhasil diperbarui.');
    }

    /** Soft-delete a student record. */
    public function destroy(Student $student)
    {
        abort_unless(in_array($student->school_id, $this->allowedSchoolIds()), 403);
        $student->delete();

        return response()->json(['success' => true, 'message' => 'Data siswa dihapus.']);
    }

    // ── Private helpers ─────────────────────────────────────────────────────────

    private function allowedSchoolIds(): array
    {
        $admin = Auth::guard('admin')->user();
        if ($admin->isSuperAdmin()) {
            return School::pluck('id')->toArray();
        }
        $slug   = $admin->getSchoolSlug();
        $type   = School::resolveDbType($slug ?? '');
        $school = School::where('type', $type)->first();
        return $school ? [$school->id] : [];
    }
}
