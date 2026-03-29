<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
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
            $schoolSlug = request()->route('school');
            $ppdbLive = false;
            $ppdbPeriod = null;
            $ppdbCurrentPhase = null;
            $ppdbCountdownDate = null;

            if ($schoolSlug) {
                $schoolUpper = strtoupper($schoolSlug);
                $school = School::where('type', $schoolUpper)->first();
                if ($school) {
                    $phases = PpdbManagementPhase::where('school_id', $school->id)
                        ->orderBy('start_date')
                        ->get();

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
            }

            $view->with('ppdbLive', $ppdbLive)
                ->with('ppdbPeriod', $ppdbPeriod)
                ->with('ppdbCurrentPhase', $ppdbCurrentPhase)
                ->with('ppdbCountdownDate', $ppdbCountdownDate);
        });

        View::composer('admin.superadmin.dashboard', function ($view) {
            $schoolTypes = ['SD', 'SMP', 'SMK'];
            $jenjangStats = collect();

            foreach ($schoolTypes as $type) {
                $school = School::where('type', $type)->first();
                $totalApplicants = PpdbApplication::where('school_type', $type)->count();
                $phases = collect();
                $activePhaseName = 'Belum ada fase aktif';
                $activePhaseEndsIn = null;
                $isLive = false;

                if ($school) {
                    $phases = PpdbManagementPhase::where('school_id', $school->id)->orderBy('start_date')->get();
                    $now = Carbon::now();
                    $active = $phases->first(function ($phase) use ($now) {
                        $start = Carbon::parse($phase->start_date)->startOfDay();
                        $end = Carbon::parse($phase->end_date)->endOfDay();
                        return $now->between($start, $end);
                    });

                    $livePhase = $phases->where('is_live', true)->first();
                    $isLive = $livePhase !== null;

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
                    'totalApplicants' => $totalApplicants,
                    'activePhase' => $activePhaseName,
                    'endsIn' => $activePhaseEndsIn,
                    'isLive' => $isLive,
                ]);
            }

            $pendingVerifications = PpdbApplication::where('status', 'pending')->count();

            $smkCapacityStats = collect();
            $smkCapacityYear = null;

            $smkSchool = School::where('type', 'SMK')->first();
            if ($smkSchool) {
                $smkCapacityYear = PpdbMajorCapacity::where('school_id', $smkSchool->id)
                    ->orderBy('year', 'desc')
                    ->value('year');

                if ($smkCapacityYear) {
                    $yearStart = intval(substr($smkCapacityYear, 0, 4));

                    $yearEnd = intval(substr($smkCapacityYear, 5, 4));

                    $acceptedByMajor = PpdbApplication::where('school_type', 'SMK')
                        ->whereIn('status', ['accepted', 'accepted_major_1', 'accepted_major_2'])
                        ->where(function ($q) use ($yearStart, $yearEnd) {
                            $q->whereBetween('admission_date', ["{$yearStart}-01-01", "{$yearEnd}-12-31"])
                                ->orWhereBetween('created_at', ["{$yearStart}-01-01", "{$yearEnd}-12-31"]);
                        })
                        ->get(['assigned_major', 'major_1', 'major_2'])
                        ->map(function ($app) {
                            return Str::lower(trim($app->assigned_major ?: $app->major_1 ?: $app->major_2 ?: ''));
                        })
                        ->filter()
                        ->countBy();

                    $smkCapacities = PpdbMajorCapacity::where('school_id', $smkSchool->id)
                        ->where('year', $smkCapacityYear)
                        ->orderBy('major')
                        ->get();

                    $totalCapacity = 0;
                    $totalAccepted = 0;

                    foreach ($smkCapacities as $capacity) {
                        $capacityKey = Str::lower(trim($capacity->major));
                        $accepted = $acceptedByMajor[$capacityKey] ?? 0;
                        $totalCapacity += $capacity->capacity;
                        $totalAccepted += $accepted;

                        $filledPct = $capacity->capacity > 0
                            ? min(100, round(($accepted / $capacity->capacity) * 100))
                            : ($accepted > 0 ? 100 : 0);

                        $smkCapacityStats->push([
                            'major' => $capacity->major,
                            'capacity' => $capacity->capacity,
                            'accepted' => $accepted,
                            'fillPercent' => $filledPct,
                        ]);
                    }

                    $smkCapacityStats = $smkCapacityStats->map(function ($item) {
                        $item['fillText'] = $item['capacity'] > 0
                            ? "{$item['accepted']}/{$item['capacity']}"
                            : '0/0';
                        return $item;
                    });

                    $smkCapacityStats = $smkCapacityStats->sortByDesc('fillPercent');
                }
            }

            // Weekly applicant counts for visitor-analytics cards
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
                    'count' => $dailyApplicantCounts->get($date->format('Y-m-d'), 0),
                ]);
            }

            $view->with('jenjangStats', $jenjangStats)
                ->with('masterTotalApplicants', PpdbApplication::count())
                ->with('pendingVerifications', $pendingVerifications)
                ->with('smkCapacityStats', $smkCapacityStats)
                ->with('smkCapacityYear', $smkCapacityYear)
                ->with('weeklyApplicants', $weeklyApplicants);
        });
    }
}
