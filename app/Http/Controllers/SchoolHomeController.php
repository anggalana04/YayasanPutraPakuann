<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\GalleryItem;
use App\Models\School;
use App\Models\SchoolHomepageSetting;
use App\Models\TeacherStaff;
use Illuminate\Support\Facades\Schema;

class SchoolHomeController extends Controller
{
    public function index(string $school)
    {
        $schoolTypeUpper = strtoupper($school);
        $schoolModel = School::where('type', $schoolTypeUpper)->firstOrFail();

        $homepage = null;
        if (Schema::hasTable('school_homepage_settings')) {
            $homepage = SchoolHomepageSetting::where('school_id', $schoolModel->id)->first();
        }

        if (!$homepage) {
            $homepage = new SchoolHomepageSetting([
                'school_id' => $schoolModel->id,
                'kepsek_photo_url' => $this->defaultKepsekPhotoUrl($schoolTypeUpper),
                'kepsek_name' => 'Nama Kepala Sekolah',
                'kepsek_title' => 'Kepala Sekolah',
                'kepsek_sambutan' => 'Silakan isi sambutan kepala sekolah.',
            ]);
        }

        $latestNews = collect();
        if (Schema::hasTable('news')) {
            $latestNews = News::where('school_id', $schoolModel->id)
                ->published()
                ->take(3)
                ->get();
        }

        $latestGallery = collect();
        if (Schema::hasTable('gallery_items')) {
            $latestGallery = GalleryItem::where('school_id', $schoolModel->id)
                ->where('status', 'published')
                ->orderByDesc('published_at')
                ->orderByDesc('created_at')
                ->take(3)
                ->get();
        }

        $carouselImages = collect();
        if (Schema::hasTable('carousel_images')) {
            $carouselImages = \App\Models\CarouselImage::where('school_id', $schoolModel->id)
                ->where('status', 'active')
                ->ordered()
                ->get();
        }

        $view = strtoupper($school) . '.index';

        return view($view, [
            'school' => strtolower($schoolTypeUpper),
            'homepage' => $homepage,
            'latestNews' => $latestNews,
            'latestGallery' => $latestGallery,
            'carouselImages' => $carouselImages,
        ]);
    }

    public function teacherDirectory(string $school)
    {
        $schoolTypeUpper = strtoupper($school);
        $schoolModel = School::where('type', $schoolTypeUpper)->firstOrFail();

        $teacherStaff = TeacherStaff::where('school_id', $schoolModel->id)
            ->active()
            ->ordered()
            ->paginate(12); // 12 items per page

        $view = strtoupper($school) . '.direktori_guru';

        return view($view, compact('school', 'schoolModel', 'teacherStaff'));
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
}
