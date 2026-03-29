<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PpdbApplication;
use App\Models\PpdbMajorCapacity;
use App\Models\School;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminPpdbApplicantsController extends Controller
{
    // ---------------------------------------------------------------
    // Shared private helpers
    // ---------------------------------------------------------------

    /**
     * Build a filtered applicant query.  Handles search, year, major, and
     * status filters consistently across all applicant list/data endpoints.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function buildApplicantQuery(string $schoolType, Request $request)
    {
        PpdbApplication::cleanupOldDrafts();

        $query = PpdbApplication::where('school_type', strtoupper($schoolType))
            ->whereIn('status', ['pending', 'payment_uploaded', 'accepted', 'rejected']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('full_name',       'like', "%{$search}%")
                    ->orWhere('email',          'like', "%{$search}%")
                    ->orWhere('application_id', 'like', "%{$search}%");
            });
        }

        if ($request->filled('year') && strtolower($request->year) !== 'all') {
            [$startYear] = explode('/', $request->year) + [null];
            if ($startYear && is_numeric($startYear)) {
                $query->whereYear('created_at', intval($startYear));
            }
        }

        if ($request->filled('major') && strtolower($request->major) !== 'all') {
            $major = $request->major;
            $query->where(function ($q) use ($major) {
                $q->where('major_1',        $major)
                    ->orWhere('major_2',        $major)
                    ->orWhere('assigned_major', $major);
            });
        }

        if ($request->filled('status') && strtolower($request->status) !== 'all') {
            $query->where('status', strtolower($request->status));
        }

        return $query;
    }

    private function getCapacities(int $schoolId, ?string $year): \Illuminate\Database\Eloquent\Collection
    {
        $q = PpdbMajorCapacity::where('school_id', $schoolId);

        if ($year && strtolower($year) !== 'all') {
            [$startYear] = explode('/', $year) + [null];
            if ($startYear && is_numeric($startYear)) {
                $q->where('year', $startYear . '/' . (intval($startYear) + 1));
            }
        }

        return $q->get();
    }

    /**
     * Compute major capacity stats for an SMK applicant.
     * Returns [$capacities, $assignedCounts, $majorStats, $yearPeriod].
     */
    private function computeMajorStats(PpdbApplication $applicant, int $schoolId, string $schoolType): array
    {
        $yearStart  = Carbon::parse($applicant->created_at ?? now())->year;
        $yearPeriod = $yearStart . '/' . ($yearStart + 1);

        $capacities = PpdbMajorCapacity::where('school_id', $schoolId)
            ->where('year', $yearPeriod)
            ->get()
            ->keyBy(fn($item) => trim(strtolower($item->major)));

        $assignedCounts = PpdbApplication::where('school_type', strtoupper($schoolType))
            ->whereIn('status', ['accepted', 'accepted_major_1', 'accepted_major_2'])
            ->whereYear('created_at', $yearStart)
            ->get()
            ->map(fn($app) => trim(strtolower($app->assigned_major ?? '')))
            ->filter()
            ->countBy();

        $majorStats = [];
        foreach (['major_1' => $applicant->major_1, 'major_2' => $applicant->major_2] as $major) {
            if (! $major) {
                continue;
            }
            $normalized        = trim(strtolower($major));
            $capObj            = $capacities[$normalized] ?? null;
            $majorStats[$major] = [
                'capacity' => $capObj?->capacity ?? 0,
                'accepted' => $assignedCounts[$normalized] ?? 0,
            ];
        }

        return [$capacities, $assignedCounts, $majorStats, $yearPeriod];
    }

    /** Map a PpdbApplication to the JSON array shape expected by the frontend. */
    private function mapApplicant(PpdbApplication $item): array
    {
        return [
            'id'             => $item->id,
            'application_id' => $item->application_id,
            'full_name'      => $item->full_name,
            'email'          => $item->email,
            'major_1'        => $item->major_1,
            'major_2'        => $item->major_2,
            'assigned_major' => $item->assigned_major,
            'status'         => $item->status,
            'created_at'     => $item->created_at?->format('Y-m-d') ?? '-',
        ];
    }

    private static function csvColumns(): array
    {
        return [
            'ID',
            'Application ID',
            'School Type',
            'Full Name',
            'Email',
            'Phone',
            'Date of Birth',
            'Place of Birth',
            'Gender',
            'Address',
            'Previous School',
            'NISN',
            'Average Grade',
            'Status',
            'Status History',
            'Uploaded Documents',
            'Payment Amount',
            'Payment Method',
            'Payment Proof',
            'Payment Date',
            'Interview Date',
            'Interview Notes',
            'Admission Date',
            'Father Name',
            'Father Occupation',
            'Mother Name',
            'Mother Occupation',
            'Parent Salary Range',
            'Major 1',
            'Major 2',
            'Assigned Major',
            'KK File',
            'Ijazah File',
            'Photo File',
            'Raport File',
            'Created At',
            'Updated At',
        ];
    }

    private static function applicantToRow(PpdbApplication $item): array
    {
        return [
            $item->id,
            $item->application_id,
            $item->school_type,
            $item->full_name,
            $item->email,
            $item->phone,
            $item->date_of_birth?->format('Y-m-d') ?? '',
            $item->place_of_birth,
            $item->gender,
            $item->address,
            $item->previous_school,
            $item->nisn,
            $item->average_grade,
            $item->status,
            is_array($item->status_history)     ? json_encode($item->status_history)     : $item->status_history,
            is_array($item->uploaded_documents) ? json_encode($item->uploaded_documents) : $item->uploaded_documents,
            $item->payment_amount,
            $item->payment_method,
            $item->payment_proof,
            $item->payment_date?->format('Y-m-d H:i:s') ?? '',
            $item->interview_date?->format('Y-m-d H:i:s') ?? '',
            $item->interview_notes,
            $item->admission_date?->format('Y-m-d H:i:s') ?? '',
            $item->father_name,
            $item->father_occupation,
            $item->mother_name,
            $item->mother_occupation,
            $item->parent_salary_range,
            $item->major_1,
            $item->major_2,
            $item->assigned_major,
            $item->kk_file,
            $item->ijazah_file,
            $item->photo_file,
            $item->raport_file,
            $item->created_at?->format('Y-m-d H:i:s') ?? '',
            $item->updated_at?->format('Y-m-d H:i:s') ?? '',
        ];
    }

    // ---------------------------------------------------------------
    // SMK-specific endpoints (legacy named routes kept for links)
    // ---------------------------------------------------------------

    /** GET /admin/ppdb/applicants/smk */
    public function smkIndex(Request $request)
    {
        $schoolModel        = School::where('type', 'SMK')->firstOrFail();
        $query              = $this->buildApplicantQuery('SMK', $request);
        $pendingCount       = (clone $query)->whereIn('status', ['pending', 'payment_uploaded'])->count();
        $pendingOverallCount = PpdbApplication::where('school_type', 'SMK')
            ->whereIn('status', ['pending', 'payment_uploaded'])->count();
        $applicants  = $query->orderBy('created_at', 'desc')->get();
        $capacities  = $this->getCapacities($schoolModel->id, $request->year);
        $selectedYear = $request->year;

        return view('admin.superadmin.ppdb.smk.applicants', compact(
            'applicants',
            'schoolModel',
            'capacities',
            'selectedYear',
            'pendingCount',
            'pendingOverallCount'
        ));
    }

    /** GET /admin/ppdb/applicants/smk/data */
    public function smkData(Request $request)
    {
        $query      = $this->buildApplicantQuery('SMK', $request);
        $applicants = $query->orderBy('created_at', 'desc')->get();

        return response()->json([
            'applicants'      => $applicants->map(fn(PpdbApplication $item) => $this->mapApplicant($item)),
            'total'           => $applicants->count(),
            'pending'         => $applicants->whereIn('status', ['pending', 'payment_uploaded'])->count(),
            'pending_overall' => PpdbApplication::where('school_type', 'SMK')
                ->whereIn('status', ['pending', 'payment_uploaded'])->count(),
        ]);
    }

    /** GET /admin/ppdb/applicants/smk/{id} */
    public function smkDetail(int $id)
    {
        $applicant   = PpdbApplication::findOrFail($id);
        $schoolModel = School::where('type', 'SMK')->firstOrFail();

        [$capacities, $assignedCounts, $majorStats, $yearPeriod] =
            $this->computeMajorStats($applicant, $schoolModel->id, 'SMK');

        return view('admin.superadmin.ppdb.smk.applicant_detail', compact(
            'applicant',
            'schoolModel',
            'capacities',
            'assignedCounts',
            'majorStats',
            'yearPeriod'
        ));
    }

    // ---------------------------------------------------------------
    // Generic by-school endpoints
    // ---------------------------------------------------------------

    /** GET /admin/ppdb/applicants/{school} */
    public function bySchoolIndex(Request $request, string $school)
    {
        $schoolModel  = School::where('slug', $school)->firstOrFail();
        $query        = $this->buildApplicantQuery($schoolModel->type, $request);
        $applicants   = $query->orderBy('created_at', 'desc')->get();
        $capacities   = $this->getCapacities($schoolModel->id, $request->year);
        $selectedYear = $request->year;

        $view = 'admin.superadmin.ppdb.' . strtolower($schoolModel->type) . '.applicants';
        if (! view()->exists($view)) {
            $view = 'admin.superadmin.ppdb.applicants';
        }

        return view($view, compact('applicants', 'schoolModel', 'selectedYear', 'capacities'));
    }

    /** GET /admin/ppdb/applicants/{school}/data */
    public function bySchoolData(Request $request, string $school)
    {
        $schoolModel  = School::where('slug', $school)->firstOrFail();
        $query        = $this->buildApplicantQuery($schoolModel->type, $request);
        $pendingCount = (clone $query)->whereIn('status', ['pending', 'payment_uploaded'])->count();

        $applicants = $query->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'page', $request->query('page', 1));

        return response()->json([
            'applicants'   => $applicants->getCollection()->map(fn(PpdbApplication $item) => $this->mapApplicant($item))->toArray(),
            'total'        => $applicants->total(),
            'pending'      => $pendingCount,
            'current_page' => $applicants->currentPage(),
            'last_page'    => $applicants->lastPage(),
            'per_page'     => $applicants->perPage(),
            'from'         => $applicants->firstItem(),
            'to'           => $applicants->lastItem(),
        ]);
    }

    /** GET /admin/ppdb/applicants/{school}/{id} */
    public function bySchoolDetail(string $school, int $id)
    {
        $schoolModel = School::where('slug', $school)->firstOrFail();
        $applicant   = PpdbApplication::findOrFail($id);

        if (strtoupper($applicant->school_type) !== strtoupper($schoolModel->type)) {
            abort(404);
        }

        $capacities   = collect();
        $assignedCounts = collect();
        $majorStats   = [];
        $yearPeriod   = null;

        if ($schoolModel->type === 'SMK') {
            [$capacities, $assignedCounts, $majorStats, $yearPeriod] =
                $this->computeMajorStats($applicant, $schoolModel->id, 'SMK');
        }

        $view = 'admin.superadmin.ppdb.' . strtolower($schoolModel->type) . '.applicant_detail';
        if (! view()->exists($view)) {
            abort(404, 'Applicant detail view not found for this school.');
        }

        return view($view, compact(
            'applicant',
            'schoolModel',
            'capacities',
            'assignedCounts',
            'majorStats',
            'yearPeriod'
        ));
    }

    /** GET /admin/ppdb/applicants/{school}/export (CSV) */
    public function export(Request $request, string $school)
    {
        $schoolModel = School::where('slug', $school)->firstOrFail();
        $applicants  = $this->buildApplicantQuery($schoolModel->type, $request)
            ->orderBy('created_at', 'desc')
            ->get();

        $filename = 'ppdb_applicants_' . $schoolModel->slug . '_' . now()->format('YmdHis') . '.csv';
        $headers  = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $columns = self::csvColumns();

        return response()->stream(function () use ($applicants, $columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);
            foreach ($applicants as $item) {
                fputcsv($handle, self::applicantToRow($item));
            }
            fclose($handle);
        }, 200, $headers);
    }

    /** GET /admin/ppdb/applicants/{school}/export.xlsx (XLSX, falls back to CSV) */
    public function exportXlsx(Request $request, string $school)
    {
        if (! class_exists(\PhpOffice\PhpSpreadsheet\Spreadsheet::class)) {
            return $this->export($request, $school);
        }

        $schoolModel = School::where('slug', $school)->firstOrFail();
        $applicants  = $this->buildApplicantQuery($schoolModel->type, $request)
            ->orderBy('created_at', 'desc')
            ->get();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();
        $columns     = self::csvColumns();

        $sheet->fromArray($columns, null, 'A1');

        $row = 2;
        foreach ($applicants as $item) {
            $sheet->fromArray(self::applicantToRow($item), null, 'A' . $row);
            $row++;
        }

        $sheet->setAutoFilter($sheet->calculateWorksheetDimension());
        foreach (range('A', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $writer   = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'ppdb_applicants_' . $schoolModel->slug . '_' . now()->format('YmdHis') . '.xlsx';
        $headers  = [
            'Content-Type'        => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        return response()->stream(fn() => $writer->save('php://output'), 200, $headers);
    }
}
