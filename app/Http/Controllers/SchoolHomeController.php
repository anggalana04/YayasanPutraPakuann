<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\GalleryItem;
use App\Models\School;
use App\Models\SchoolHomepageSetting;
use App\Models\TeacherStaff;
use App\Models\PpdbManagementPhase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class SchoolHomeController extends Controller
{
    public function index(string $school)
    {
        $schoolTypeUpper = strtoupper($school);
        $schoolModel = School::where('type', $schoolTypeUpper)->firstOrFail();
        $cachePrefix = 'school.home.' . strtolower($schoolTypeUpper) . '.' . $schoolModel->id;

        $homepage = Cache::remember($cachePrefix . '.homepage', 120, function () use ($schoolModel) {
            if (!Schema::hasTable('school_homepage_settings')) {
                return null;
            }

            return SchoolHomepageSetting::where('school_id', $schoolModel->id)->first();
        });

        if (!$homepage) {
            $homepage = new SchoolHomepageSetting([
                'school_id' => $schoolModel->id,
                'kepsek_photo_url' => $this->defaultKepsekPhotoUrl($schoolTypeUpper),
                'kepsek_name' => 'Nama Kepala Sekolah',
                'kepsek_title' => 'Kepala Sekolah',
                'kepsek_sambutan' => 'Silakan isi sambutan kepala sekolah.',
            ]);
        }

        $latestNews = Cache::remember($cachePrefix . '.latest_news', 120, function () use ($schoolModel) {
            if (!Schema::hasTable('news')) {
                return collect();
            }

            return News::where('school_id', $schoolModel->id)
                ->published()
                ->take(3)
                ->get();
        });

        $latestGallery = Cache::remember($cachePrefix . '.latest_gallery', 120, function () use ($schoolModel) {
            if (!Schema::hasTable('gallery_items')) {
                return collect();
            }

            return GalleryItem::where('school_id', $schoolModel->id)
                ->where('status', 'published')
                ->orderByDesc('published_at')
                ->orderByDesc('created_at')
                ->take(3)
                ->get();
        });

        $carouselImages = Cache::remember($cachePrefix . '.carousel', 120, function () use ($schoolModel) {
            if (!Schema::hasTable('carousel_images')) {
                return collect();
            }

            return \App\Models\CarouselImage::where('school_id', $schoolModel->id)
                ->where('status', 'active')
                ->ordered()
                ->get();
        });

        // Fetch PPDB Live Data and phase countdown info
        $ppdbLive = false;
        $ppdbCountdownDate = null;
        $ppdbCurrentPhase = null;
        $ppdbPeriod = null;

        if (Schema::hasTable('ppdb_management_phases')) {
            $phases = Cache::remember($cachePrefix . '.phases', 120, function () use ($schoolModel) {
                return PpdbManagementPhase::where('school_id', $schoolModel->id)
                    ->orderBy('start_date')
                    ->get();
            });

            $ppdbLive = $phases->where('is_live', true)->isNotEmpty();

            $now = Carbon::now();
            $activePhase = $phases->first(function ($phase) use ($now) {
                $start = Carbon::parse($phase->start_date)->startOfDay();
                $end = Carbon::parse($phase->end_date)->endOfDay();
                return $now->between($start, $end);
            });

            $nextPhase = $phases->where('start_date', '>', $now->toDateString())->sortBy('start_date')->first();
            $phaseForCountdown = $activePhase ?? $nextPhase ?? $phases->last();

            if ($phaseForCountdown) {
                $ppdbCurrentPhase = $activePhase ? $activePhase->phase_name : ($nextPhase ? "Upcoming: {$nextPhase->phase_name}" : $phaseForCountdown->phase_name);
                $ppdbCountdownDate = Carbon::parse($phaseForCountdown->end_date)->endOfDay();

                $yearStart = Carbon::parse($phaseForCountdown->start_date)->year;
                $ppdbPeriod = $yearStart . '/' . ($yearStart + 1);
            }
        }

        $view = strtoupper($school) . '.index';

        return view($view, [
            'school' => strtolower($schoolTypeUpper),
            'homepage' => $homepage,
            'latestNews' => $latestNews,
            'latestGallery' => $latestGallery,
            'carouselImages' => $carouselImages,
            'ppdbLive' => $ppdbLive,
            'ppdbCountdownDate' => $ppdbCountdownDate,
            'ppdbCurrentPhase' => $ppdbCurrentPhase,
            'ppdbPeriod' => $ppdbPeriod,
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
