<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\School;
use App\Models\SchoolHomepageSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CmsController extends Controller
{
    public function index(string $schoolType)
    {
        $schoolTypeUpper = strtoupper($schoolType);
        $school = School::where('type', $schoolTypeUpper)->firstOrFail();

        $this->abortUnlessSuperAdmin();

        $homepage = SchoolHomepageSetting::where('school_id', $school->id)->first();
        if (!$homepage) {
            $homepage = new SchoolHomepageSetting([
                'school_id' => $school->id,
                'kepsek_photo_url' => $this->defaultKepsekPhotoUrl($schoolTypeUpper),
                'kepsek_name' => 'Nama Kepala Sekolah',
                'kepsek_title' => 'Kepala Sekolah',
                'kepsek_sambutan' => 'Silakan isi sambutan kepala sekolah.',
            ]);
        }

        // Show a small snapshot of latest news on the same page
        $latestNews = News::where('school_id', $school->id)
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        return view('admin.superadmin.cms.unit.index', [
            'schoolType' => strtolower($schoolTypeUpper),
            'school' => $school,
            'homepage' => $homepage,
            'latestNews' => $latestNews,
        ]);
    }

    public function updateKepsek(Request $request, string $schoolType)
    {
        $schoolTypeUpper = strtoupper($schoolType);
        $school = School::where('type', $schoolTypeUpper)->firstOrFail();

        $this->abortUnlessSuperAdmin();

        $validated = $request->validate([
            'kepsek_photo' => ['nullable', 'image', 'max:2048'],
            'kepsek_name' => ['required', 'string', 'max:255'],
            'kepsek_title' => ['required', 'string', 'max:255'],
            'kepsek_sambutan' => ['required', 'string'],
        ]);

        $homepage = SchoolHomepageSetting::firstOrCreate(
            ['school_id' => $school->id],
            [
                'kepsek_photo_url' => $this->defaultKepsekPhotoUrl($schoolTypeUpper),
                'kepsek_name' => $validated['kepsek_name'],
                'kepsek_title' => $validated['kepsek_title'],
                'kepsek_sambutan' => $validated['kepsek_sambutan'],
            ]
        );

        $homepage->kepsek_name = $validated['kepsek_name'];
        $homepage->kepsek_title = $validated['kepsek_title'];
        $homepage->kepsek_sambutan = $validated['kepsek_sambutan'];

        if ($request->hasFile('kepsek_photo')) {
            $file = $request->file('kepsek_photo');
            $ext = strtolower($file->getClientOriginalExtension() ?: 'jpg');
            $filename = 'kepsek_' . $schoolTypeUpper . '_' . Str::uuid()->toString() . '.' . $ext;

            $targetDir = public_path('images/cms/' . strtolower($schoolTypeUpper));
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }

            $file->move($targetDir, $filename);
            $homepage->kepsek_photo_url = '/images/cms/' . strtolower($schoolTypeUpper) . '/' . $filename;
        }

        $homepage->save();

        return redirect()
            ->route('admin.cms.by_school', ['schoolType' => strtolower($schoolTypeUpper)])
            ->with('success', 'Konten Kepala Sekolah berhasil diperbarui.');
    }

    private function defaultKepsekPhotoUrl(string $schoolTypeUpper): string
    {
        return match ($schoolTypeUpper) {
            'SMK' => '/images/KEPSEK_SMK.png',
            'SMP' => '/images/KEPSEK_SMP.png',
            'SD' => '/images/KEPSEK_SDIT.jpg',
            default => '/images/KEPSEK_SMK.png',
        };
    }

    private function abortUnlessSuperAdmin(): void
    {
        $user = auth('admin')->user();
        if (!$user || !$user->isSuperAdmin()) {
            abort(403);
        }
    }
}

