<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\School;
use App\Models\PpdbApplication;
use App\Models\PpdbMajorCapacity;
use App\Models\PpdbManagementPhase;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['layouts.SMK.app', 'layouts.SMP.app', 'layouts.SD.app'], function ($view) {
            $schoolSlug = strtolower((string) (request()->route('school') ?: request()->segment(1)));
            $allowedSchoolSlugs = ['sd', 'smp', 'smk'];

            if (!in_array($schoolSlug, $allowedSchoolSlugs, true)) {
                $view->with('ppdbLive', false)
                    ->with('ppdbPeriod', null)
                    ->with('ppdbCurrentPhase', null)
                    ->with('ppdbCountdownDate', null);
                return;
            }

            $ppdbData = Cache::remember("ppdb.layout.{$schoolSlug}", 120, function () use ($schoolSlug) {
                $defaults = [
                    'ppdbLive' => false,
                    'ppdbPeriod' => null,
                    'ppdbCurrentPhase' => null,
                    'ppdbCountdownDate' => null,
                ];

                $school = School::whereRaw('LOWER(type) = ?', [$schoolSlug])->first();
                if (!$school) {
                    return $defaults;
                }

                $phases = PpdbManagementPhase::where('school_id', $school->id)
                    ->select(['phase_name', 'start_date', 'end_date', 'is_live'])
                    ->orderBy('start_date')
                    ->get();

                if ($phases->isEmpty()) {
                    return $defaults;
                }

                $now = Carbon::now();
                $activePhase = $phases->first(function ($phase) use ($now) {
                    $start = Carbon::parse($phase->start_date)->startOfDay();
                    $end = Carbon::parse($phase->end_date)->endOfDay();
                    return $now->between($start, $end);
                });

                $nextPhase = $phases->where('start_date', '>', $now->toDateString())->sortBy('start_date')->first();
                $phaseForCountdown = $activePhase ?? $nextPhase ?? $phases->last();

                $ppdbCurrentPhase = null;
                $ppdbCountdownDate = null;
                $ppdbPeriod = null;

                if ($phaseForCountdown) {
                    $ppdbCurrentPhase = $activePhase
                        ? $activePhase->phase_name
                        : ($nextPhase ? "Upcoming: {$nextPhase->phase_name}" : $phaseForCountdown->phase_name);

                    $ppdbCountdownDate = Carbon::parse($phaseForCountdown->end_date)->endOfDay();
                    $yearStart = Carbon::parse($phaseForCountdown->start_date)->year;
                    $ppdbPeriod = $yearStart . '/' . ($yearStart + 1);
                }

                return [
                    'ppdbLive' => $phases->where('is_live', true)->isNotEmpty(),
                    'ppdbPeriod' => $ppdbPeriod,
                    'ppdbCurrentPhase' => $ppdbCurrentPhase,
                    'ppdbCountdownDate' => $ppdbCountdownDate,
                ];
            });

            $view->with($ppdbData);
        });

        View::composer('admin.superadmin.dashboard', function ($view) {
            $metrics = Cache::remember('admin.dashboard.metrics.v2', 120, function () {
                $schoolTypes = ['SD', 'SMP', 'SMK'];
                $schools = School::whereIn('type', $schoolTypes)
                    ->get(['id', 'type'])
                    ->keyBy('type');

                $totalApplicantsByType = PpdbApplication::selectRaw('UPPER(school_type) as school_type, COUNT(*) as total')
                    ->groupBy(DB::raw('UPPER(school_type)'))
                    ->pluck('total', 'school_type');

                $phaseGroups = PpdbManagementPhase::whereIn('school_id', $schools->pluck('id')->all())
                    ->orderBy('start_date')
                    ->get(['school_id', 'phase_name', 'start_date', 'end_date', 'is_live'])
                    ->groupBy('school_id');

                $now = Carbon::now();
                $jenjangStats = collect();

                foreach ($schoolTypes as $type) {
                    $school = $schools->get($type);
                    $phases = $school ? ($phaseGroups->get($school->id) ?? collect()) : collect();

                    $activePhaseName = 'Belum ada fase aktif';
                    $activePhaseEndsIn = null;
                    $isLive = $phases->where('is_live', true)->isNotEmpty();

                    if ($phases->isNotEmpty()) {
                        $active = $phases->first(function ($phase) use ($now) {
                            $start = Carbon::parse($phase->start_date)->startOfDay();
                            $end = Carbon::parse($phase->end_date)->endOfDay();
                            return $now->between($start, $end);
                        });

                        if ($active) {
                            $activePhaseName = $active->phase_name;
                            $activePhaseEndsIn = Carbon::parse($active->end_date)->endOfDay()->diffInDays($now, false);
                        } else {
                            $upcoming = $phases->where('start_date', '>', $now->toDateString())->sortBy('start_date')->first();
                            if ($upcoming) {
                                $activePhaseName = 'Upcoming: ' . $upcoming->phase_name;
                                $activePhaseEndsIn = Carbon::parse($upcoming->end_date)->endOfDay()->diffInDays($now, false);
                            }
                        }
                    }

                    $jenjangStats->push([
                        'type' => $type,
                        'totalApplicants' => (int) ($totalApplicantsByType->get($type, 0)),
                        'activePhase' => $activePhaseName,
                        'endsIn' => $activePhaseEndsIn,
                        'isLive' => $isLive,
                    ]);
                }

                $pendingVerifications = PpdbApplication::where('status', 'pending')->count();
                $masterTotalApplicants = PpdbApplication::count();

                $smkCapacityStats = collect();
                $smkCapacityYear = null;

                $smkSchool = $schools->get('SMK');
                if ($smkSchool) {
                    $smkCapacityYear = PpdbMajorCapacity::where('school_id', $smkSchool->id)
                        ->orderBy('year', 'desc')
                        ->value('year');

                    if ($smkCapacityYear) {
                        $yearStart = intval(substr($smkCapacityYear, 0, 4));
                        $yearEnd = intval(substr($smkCapacityYear, 5, 4));

                        $acceptedByMajor = PpdbApplication::query()
                            ->where('school_type', 'SMK')
                            ->whereIn('status', ['accepted', 'accepted_major_1', 'accepted_major_2'])
                            ->where(function ($q) use ($yearStart, $yearEnd) {
                                $q->whereBetween('admission_date', ["{$yearStart}-01-01", "{$yearEnd}-12-31"])
                                    ->orWhereBetween('created_at', ["{$yearStart}-01-01", "{$yearEnd}-12-31"]);
                            })
                            ->selectRaw("LOWER(TRIM(COALESCE(NULLIF(assigned_major,''), NULLIF(major_1,''), NULLIF(major_2,'')))) as major_key, COUNT(*) as total")
                            ->groupBy('major_key')
                            ->pluck('total', 'major_key');

                        $smkCapacities = PpdbMajorCapacity::where('school_id', $smkSchool->id)
                            ->where('year', $smkCapacityYear)
                            ->orderBy('major')
                            ->get(['major', 'capacity']);

                        foreach ($smkCapacities as $capacity) {
                            $capacityKey = Str::lower(trim((string) $capacity->major));
                            $accepted = (int) ($acceptedByMajor->get($capacityKey, 0));

                            $filledPct = $capacity->capacity > 0
                                ? min(100, round(($accepted / $capacity->capacity) * 100))
                                : ($accepted > 0 ? 100 : 0);

                            $smkCapacityStats->push([
                                'major' => $capacity->major,
                                'capacity' => $capacity->capacity,
                                'accepted' => $accepted,
                                'fillPercent' => $filledPct,
                                'fillText' => $capacity->capacity > 0
                                    ? "{$accepted}/{$capacity->capacity}"
                                    : '0/0',
                            ]);
                        }

                        $smkCapacityStats = $smkCapacityStats->sortByDesc('fillPercent')->values();
                    }
                }

                $sevenDaysAgo = Carbon::now()->subDays(6)->startOfDay();
                $dailyApplicantCounts = PpdbApplication::whereBetween('created_at', [$sevenDaysAgo, Carbon::now()->endOfDay()])
                    ->selectRaw('DATE(created_at) as date, count(*) as total')
                    ->groupBy('date')
                    ->orderBy('date')
                    ->pluck('total', 'date');

                $weeklyApplicants = collect();
                for ($i = 0; $i < 7; $i++) {
                    $date = $sevenDaysAgo->copy()->addDays($i);
                    $weeklyApplicants->push([
                        'label' => $date->format('D'),
                        'count' => (int) $dailyApplicantCounts->get($date->format('Y-m-d'), 0),
                    ]);
                }

                return [
                    'jenjangStats' => $jenjangStats,
                    'masterTotalApplicants' => $masterTotalApplicants,
                    'pendingVerifications' => $pendingVerifications,
                    'smkCapacityStats' => $smkCapacityStats,
                    'smkCapacityYear' => $smkCapacityYear,
                    'weeklyApplicants' => $weeklyApplicants,
                ];
            });

            $view->with($metrics);
        });
    }
}
