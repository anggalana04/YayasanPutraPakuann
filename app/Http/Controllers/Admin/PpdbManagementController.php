<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PpdbApplication;
use App\Models\PpdbMajorCapacity;
use App\Models\PpdbManagementPhase;
use App\Models\School;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PpdbManagementController extends Controller
{
    private function flushPpdbViewCaches(School $school): void
    {
        Cache::forget('admin.dashboard.metrics.v2');
        Cache::forget('ppdb.layout.' . strtolower((string) $school->type));
    }

    private function defaultMajorsBySchool($schoolType)
    {
        $map = [
            'SMK' => [
                'Teknik Kendaraan Ringan',
                'Teknik Sepeda Motor',
                'Teknik Jaringan Komputer',
                'Multimedia/DKV',
                'Manajemen Perkantoran',
                'Akuntansi',
            ],
            'SMP' => [
                'Teknik Komputer dan Jaringan',
                'Multimedia',
                'Akuntansi',
            ],
            'SD' => [
                'Umum',
            ],
        ];

        return $map[$schoolType] ?? [];
    }
    public function index(Request $request, $school)
    {
        $schoolModel = School::where('slug', $school)->firstOrFail();

        $phases = PpdbManagementPhase::where('school_id', $schoolModel->id)
            ->orderBy('start_date')
            ->get();

        // compute per-phase status from current date
        $today = Carbon::today();
        $phases->each(function ($phase) use ($today) {
            if ($today->lt(Carbon::parse($phase->start_date))) {
                $phase->computed_status = 'upcoming';
            } elseif ($today->gt(Carbon::parse($phase->end_date))) {
                $phase->computed_status = 'finished';
            } else {
                $phase->computed_status = 'active';
            }
        });

        $academicYears = $phases->filter(function ($phase) {
            return !empty($phase->start_date);
        })->map(function ($phase) {
            $startYear = Carbon::parse($phase->start_date)->year;
            return $startYear . '/' . ($startYear + 1);
        })->unique()->values();

        $selectedYear = $request->query('year');
        $mustSelectYear = empty($selectedYear);

        $selectedPhases = collect();
        $applicants = collect();
        $pendingCount = 0;
        $notHandledCount = 0;

        if (!$mustSelectYear) {
            $schoolType = strtoupper((string) $schoolModel->type);

            $selectedPhases = $phases->filter(function ($phase) use ($selectedYear) {
                $startYear = Carbon::parse($phase->start_date)->year;
                return ($startYear . '/' . ($startYear + 1)) === $selectedYear;
            });

            $yearStart = intval(substr($selectedYear, 0, 4));
            $startDate = Carbon::create($yearStart, 1, 1);
            $endDate = Carbon::create($yearStart + 1, 12, 31);

            $applicants = PpdbApplication::where('school_type', $schoolType)
                ->whereNotIn('status', ['draft'])
                ->whereBetween('created_at', [$startDate, $endDate])
                ->get();

            $pendingCount = $applicants->where('status', 'payment_uploaded')->count();
            $notHandledCount = $applicants->whereIn('status', ['payment_uploaded', 'pending'])->count();
        }


        $applicantsByPhase = collect();
        foreach ($selectedPhases as $phase) {
            $applicantsByPhase[$phase->id] = $applicants->filter(function ($applicant) use ($phase) {
                $created = Carbon::parse($applicant->created_at);
                return $created->between(Carbon::parse($phase->start_date), Carbon::parse($phase->end_date));
            });
        }

        $unassignedApplicants = $applicants->reject(function ($applicant) use ($selectedPhases) {
            $created = Carbon::parse($applicant->created_at);
            foreach ($selectedPhases as $phase) {
                if ($created->between(Carbon::parse($phase->start_date), Carbon::parse($phase->end_date))) {
                    return true;
                }
            }
            return false;
        });

        $nextPhase = $phases->firstWhere('computed_status', 'active');

        return view('admin.superadmin.ppdb.' . strtolower($schoolModel->type) . '.management', [
            'school' => $schoolModel,
            'phases' => $phases,
            'academicYears' => $academicYears,
            'selectedYear' => $selectedYear,
            'mustSelectYear' => $mustSelectYear,
            'selectedPhases' => $selectedPhases,
            'applicantsByPhase' => $applicantsByPhase,
            'unassignedApplicants' => $unassignedApplicants,
            'nextPhase' => $nextPhase,
            'applicants' => $applicants,
            'pendingCount' => $pendingCount,
            'notHandledCount' => $notHandledCount,
        ]);
    }

    public function storeYear(Request $request, $school)
    {
        $schoolModel = School::where('slug', $school)->firstOrFail();

        $validated = $request->validate([
            'year' => ['required', 'regex:/^[0-9]{4}\/[0-9]{4}$/'],
        ]);

        $year = $validated['year'];

        $exists = PpdbManagementPhase::where('school_id', $schoolModel->id)
            ->whereYear('start_date', intval(substr($year, 0, 4)))
            ->exists();

        if ($exists) {
            return back()->withErrors(['year' => 'Tahun ini sudah ada.']);
        }

        // Year created successfully - phases will be created manually by admin
        return redirect()->route('admin.ppdb.management', ['school' => $school, 'year' => $year])->with('success', 'Periode Tahun ' . $year . ' berhasil dibuat. Silakan tambahkan fase pendaftaran secara manual.');
    }

    public function setupPhases(Request $request, $school)
    {
        $schoolModel = School::where('slug', $school)->firstOrFail();

        $validated = $request->validate([
            'year' => ['required', 'regex:/^[0-9]{4}\/[0-9]{4}$/'],
            'periode_1_start' => 'required|date',
            'periode_1_end' => 'required|date|after_or_equal:periode_1_start',
            'periode_2_start' => 'required|date',
            'periode_2_end' => 'required|date|after_or_equal:periode_2_start',
            'periode_3_start' => 'required|date',
            'periode_3_end' => 'required|date|after_or_equal:periode_3_start',
        ]);

        $yearStart = intval(substr($validated['year'], 0, 4));

        $periodeData = [
            1 => ['start' => $validated['periode_1_start'], 'end' => $validated['periode_1_end']],
            2 => ['start' => $validated['periode_2_start'], 'end' => $validated['periode_2_end']],
            3 => ['start' => $validated['periode_3_start'], 'end' => $validated['periode_3_end']],
        ];

        foreach ($periodeData as $index => $dates) {
            // Find phase for this school, year, and periode number
            $phase = PpdbManagementPhase::where('school_id', $schoolModel->id)
                ->where('phase_name', 'Periode ' . $index)
                ->whereYear('start_date', $yearStart)
                ->first();

            // If not found, create new one for this year
            if (!$phase) {
                $phase = new PpdbManagementPhase([
                    'school_id' => $schoolModel->id,
                    'phase_name' => 'Periode ' . $index,
                ]);
            }

            $phase->start_date = $dates['start'];
            $phase->end_date = $dates['end'];
            $phase->status = Carbon::now()->between(Carbon::parse($dates['start']), Carbon::parse($dates['end'])) ? 'active' : 'upcoming';
            $phase->save();
        }

        $this->flushPpdbViewCaches($schoolModel);

        return redirect()->route('admin.ppdb.management', ['school' => $school, 'year' => $validated['year']])->with('success', 'Tanggal 3 periode berhasil disimpan.');
    }

    public function store(Request $request, $school)
    {
        $schoolModel = School::where('slug', $school)->firstOrFail();

        $validated = $request->validate([
            'phase_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:upcoming,active,finished',
        ]);

        $validated['school_id'] = $schoolModel->id;

        PpdbManagementPhase::create($validated);

        $this->flushPpdbViewCaches($schoolModel);

        return redirect()->route('admin.ppdb.management', ['school' => $school])->with('success', 'Phase added successfully.');
    }

    public function update(Request $request, $school, PpdbManagementPhase $phase)
    {
        $schoolModel = School::where('slug', $school)->firstOrFail();

        if ($phase->school_id !== $schoolModel->id) {
            abort(403);
        }

        $validated = $request->validate([
            'phase_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:upcoming,active,finished',
        ]);

        $phase->update($validated);

        $this->flushPpdbViewCaches($schoolModel);

        return redirect()->route('admin.ppdb.management', ['school' => $school])->with('success', 'Phase updated successfully.');
    }

    public function destroy($school, PpdbManagementPhase $phase)
    {
        $schoolModel = School::where('slug', $school)->firstOrFail();

        if ($phase->school_id !== $schoolModel->id) {
            abort(403);
        }

        $phase->delete();

        $this->flushPpdbViewCaches($schoolModel);

        return redirect()->route('admin.ppdb.management', ['school' => $school])->with('success', 'Phase deleted successfully.');
    }

    public function capacityIndex(Request $request, $school)
    {
        $schoolModel = School::where('slug', $school)->firstOrFail();
        $schoolType = strtoupper((string) $schoolModel->type);
        $year = $request->query('year') ?: (date('Y') . '/' . (date('Y') + 1));

        $capacities = PpdbMajorCapacity::where('school_id', $schoolModel->id)
            ->where('year', $year)
            ->get();

        $defaultMajors = $this->defaultMajorsBySchool($schoolModel->type);

        $applicantMajors = PpdbApplication::where('school_type', $schoolType)
            ->whereYear('created_at', intval(substr($year, 0, 4)))
            ->get(['major_1', 'major_2', 'assigned_major'])
            ->flatMap(function ($application) {
                return [$application->major_1, $application->major_2, $application->assigned_major];
            })
            ->filter()
            ->unique()
            ->values()
            ->toArray();

        $majorsToEnsure = collect(array_merge($defaultMajors, $applicantMajors))->unique()->filter()->values();

        foreach ($majorsToEnsure as $major) {
            if (!$capacities->firstWhere('major', $major)) {
                $new = PpdbMajorCapacity::create([
                    'school_id' => $schoolModel->id,
                    'year' => $year,
                    'major' => $major,
                    'capacity' => 0,
                ]);
                $capacities->push($new);
            }
        }

        $yearStart = intval(substr($year, 0, 4));
        $yearEnd = intval(substr($year, 5, 4));

        $applicantCountByMajor = PpdbApplication::where('school_type', $schoolType)
            ->whereIn('status', ['accepted', 'accepted_major_1', 'accepted_major_2'])
            ->where(function ($query) use ($yearStart, $yearEnd) {
                $query->whereBetween('admission_date', ["{$yearStart}-01-01", "{$yearEnd}-12-31"])
                    ->orWhereBetween('created_at', ["{$yearStart}-01-01", "{$yearEnd}-12-31"]);
            })
            ->get(['assigned_major', 'major_1', 'major_2'])
            ->map(function ($app) {
                return Str::lower(trim($app->assigned_major ?: $app->major_1 ?: $app->major_2 ?: ''));
            })
            ->filter()
            ->countBy();

        return view('admin.superadmin.ppdb.' . strtolower($schoolModel->type) . '.capacity', [
            'school' => $schoolModel,
            'year' => $year,
            'capacities' => $capacities,
            'applicantCountByMajor' => $applicantCountByMajor,
        ]);
    }

    public function capacityStore(Request $request, $school)
    {
        $schoolModel = School::where('slug', $school)->firstOrFail();

        if ($request->has('capacities')) {
            $validated = $request->validate([
                'year' => ['required', 'regex:/^[0-9]{4}\/([0-9]{4})$/'],
                'capacities' => 'required|array',
                'capacities.*' => 'required|integer|min:0',
            ]);

            foreach ($validated['capacities'] as $id => $capacityValue) {
                $row = PpdbMajorCapacity::where('school_id', $schoolModel->id)->where('id', $id)->first();
                if ($row) {
                    $row->update(['capacity' => $capacityValue]);
                }
            }

            $this->flushPpdbViewCaches($schoolModel);

            return redirect()->route('admin.ppdb.management.capacity', ['school' => $school, 'year' => $validated['year']])->with('success', 'Kapasitas jurusan berhasil diperbarui secara massal.');
        }

        $validated = $request->validate([
            'year' => ['required', 'regex:/^[0-9]{4}\/([0-9]{4})$/'],
            'major' => 'required|string|max:100',
            'capacity' => 'required|integer|min:0',
        ]);

        PpdbMajorCapacity::updateOrCreate(
            [
                'school_id' => $schoolModel->id,
                'year' => $validated['year'],
                'major' => $validated['major'],
            ],
            ['capacity' => $validated['capacity']]
        );

        $this->flushPpdbViewCaches($schoolModel);

        return redirect()->route('admin.ppdb.management.capacity', ['school' => $school, 'year' => $validated['year']])->with('success', 'Kapasitas jurusan disimpan.');
    }

    public function capacityUpdate(Request $request, $school, PpdbMajorCapacity $capacity)
    {
        $schoolModel = School::where('slug', $school)->firstOrFail();

        if ($capacity->school_id !== $schoolModel->id) {
            abort(403);
        }

        $validated = $request->validate([
            'capacity' => 'required|integer|min:0',
        ]);

        $capacity->update(['capacity' => $validated['capacity']]);

        $this->flushPpdbViewCaches($schoolModel);

        return redirect()->route('admin.ppdb.management.capacity', ['school' => $school, 'year' => $capacity->year])->with('success', 'Kapasitas jurusan diperbarui.');
    }


    public function capacityDestroy($school, PpdbMajorCapacity $capacity)
    {
        $schoolModel = School::where('slug', $school)->firstOrFail();

        if ($capacity->school_id !== $schoolModel->id) {
            abort(403);
        }

        $year = $capacity->year;
        $capacity->delete();

        $this->flushPpdbViewCaches($schoolModel);

        return redirect()->route('admin.ppdb.management.capacity', ['school' => $school, 'year' => $year])->with('success', 'Kapasitas jurusan dihapus.');
    }

    public function activate($school, PpdbManagementPhase $phase)
    {
        $schoolModel = School::where('slug', $school)->firstOrFail();

        if ($phase->school_id !== $schoolModel->id) {
            abort(403);
        }

        // Invalidate any active phases for this school
        PpdbManagementPhase::where('school_id', $schoolModel->id)->where('status', 'active')->update(['status' => 'finished']);

        $phase->status = 'active';
        $phase->save();

        $this->flushPpdbViewCaches($schoolModel);

        return redirect()->route('admin.ppdb.management', ['school' => $school])->with('success', 'Phase activated successfully.');
    }

    public function toggleLive(Request $request, $school)
    {
        $schoolModel = School::where('slug', $school)->firstOrFail();
        $year = $request->query('year');

        if (!$year) {
            return back()->withErrors(['year' => 'Tahun tidak ditemukan.']);
        }

        $yearStart = intval(substr($year, 0, 4));

        // Find all phases for this school and year
        $phases = PpdbManagementPhase::where('school_id', $schoolModel->id)
            ->whereYear('start_date', $yearStart)
            ->get();

        if ($phases->isEmpty()) {
            return back()->withErrors(['year' => 'Tidak ada fase untuk tahun ini.']);
        }

        // Toggle is_live for all phases in this year
        $isCurrentlyLive = $phases->first()->is_live;
        foreach ($phases as $phase) {
            $phase->is_live = !$isCurrentlyLive;
            $phase->save();
        }

        $this->flushPpdbViewCaches($schoolModel);

        $status = !$isCurrentlyLive ? 'dibuka' : 'ditutup';
        return redirect()->route('admin.ppdb.management', ['school' => $school, 'year' => $year])->with('success', 'PPDB untuk tahun ' . $year . ' telah ' . $status . '.');
    }
}
