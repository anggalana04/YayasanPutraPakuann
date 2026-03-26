<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeacherStaff;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeacherStaffAdminController extends Controller
{
    public function index(string $schoolType)
    {
        $this->abortUnlessSuperAdmin();

        $school = School::where('type', strtoupper($schoolType))->firstOrFail();

        $teacherStaff = TeacherStaff::where('school_id', $school->id)
            ->ordered()
            ->paginate(12);

        return view('admin.superadmin.cms.unit.guru.index', [
            'schoolType' => strtolower($schoolType),
            'school' => $school,
            'teacherStaff' => $teacherStaff,
        ]);
    }

    public function create(string $schoolType)
    {
        $this->abortUnlessSuperAdmin();

        $school = School::where('type', strtoupper($schoolType))->firstOrFail();

        return view('admin.superadmin.cms.unit.guru.form', [
            'mode' => 'create',
            'schoolType' => strtolower($schoolType),
            'school' => $school,
            'item' => null,
        ]);
    }

    public function store(Request $request, string $schoolType)
    {
        $this->abortUnlessSuperAdmin();

        $school = School::where('type', strtoupper($schoolType))->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'type' => 'required|in:teacher,staff,management',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->only([
            'name',
            'title',
            'department',
            'email',
            'phone',
            'type',
            'status'
        ]);

        $data['school_id'] = $school->id;
        $data['created_by'] = auth('admin')->user()->name ?? 'System';

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $filename = $this->uploadPhoto($request->file('photo'), $schoolType);
            $data['photo_url'] = $filename;
        }

        TeacherStaff::create($data);

        return redirect()->route('admin.cms.guru.index', ['schoolType' => strtolower($schoolType)])
            ->with('success', 'Data guru/staff berhasil ditambahkan.');
    }

    public function edit(string $schoolType, int $guru)
    {
        $this->abortUnlessSuperAdmin();

        $school = School::where('type', strtoupper($schoolType))->firstOrFail();

        $person = TeacherStaff::findOrFail($guru);

        // Ensure the teacher/staff belongs to the correct school
        if ($person->school_id !== $school->id) {
            abort(404);
        }

        return view('admin.superadmin.cms.unit.guru.form', [
            'mode' => 'edit',
            'schoolType' => strtolower($schoolType),
            'school' => $school,
            'item' => $person,
        ]);
    }

    public function update(Request $request, string $schoolType, int $guru)
    {
        $this->abortUnlessSuperAdmin();

        $school = School::where('type', strtoupper($schoolType))->firstOrFail();

        $person = TeacherStaff::findOrFail($guru);

        // Ensure the teacher/staff belongs to the correct school
        if ($person->school_id !== $school->id) {
            abort(404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'type' => 'required|in:teacher,staff,management',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->only([
            'name',
            'title',
            'department',
            'email',
            'phone',
            'type',
            'status'
        ]);

        $data['updated_by'] = auth('admin')->user()->name ?? 'System';

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $filename = $this->uploadPhoto($request->file('photo'), $schoolType);
            $data['photo_url'] = $filename;
        }

        $person->update($data);

        return redirect()->route('admin.cms.guru.edit', [
            'schoolType' => strtolower($schoolType),
            'guru' => $person->id
        ])->with('success', 'Data guru/staff berhasil diperbarui.');
    }

    public function destroy(string $schoolType, int $guru)
    {
        $this->abortUnlessSuperAdmin();

        $school = School::where('type', strtoupper($schoolType))->firstOrFail();

        $person = TeacherStaff::findOrFail($guru);

        // Ensure the teacher/staff belongs to the correct school
        if ($person->school_id !== $school->id) {
            abort(404);
        }

        $person->delete();

        return redirect()->route('admin.cms.guru.index', ['schoolType' => strtolower($schoolType)])
            ->with('success', 'Data guru/staff berhasil dihapus.');
    }

    private function uploadPhoto($file, $schoolType)
    {
        $filename = 'guru_' . $schoolType . '_' . Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();

        $targetDir = public_path('images/cms/' . $schoolType . '/guru');

        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $file->move($targetDir, $filename);

        return '/images/cms/' . $schoolType . '/guru/' . $filename;
    }

    private function abortUnlessSuperAdmin(): void
    {
        $user = auth('admin')->user();
        if (!$user || !$user->isSuperAdmin()) {
            abort(403);
        }
    }
}
