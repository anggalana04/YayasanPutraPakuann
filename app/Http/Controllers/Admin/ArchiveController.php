<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PpdbApplication;
use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as XlsxWriter;
use ZipArchive;

class ArchiveController extends Controller
{
    // ── Authorization helper ────────────────────────────────────────────────────

    /** Returns school IDs the current admin is allowed to view. */
    private function allowedSchoolIds(): array
    {
        $admin = Auth::guard('admin')->user();
        if ($admin->isSuperAdmin()) {
            return School::pluck('id')->toArray();
        }
        $slug  = $admin->getSchoolSlug();
        $type  = School::resolveDbType($slug ?? '');
        $school = School::where('type', $type)->first();
        return $school ? [$school->id] : [];
    }

    // ── Pages ───────────────────────────────────────────────────────────────────

    /** Archive index — school cards. */
    public function index()
    {
        $allowedIds = $this->allowedSchoolIds();
        $schools    = School::whereIn('id', $allowedIds)
            ->get()
            ->map(function (School $school) {
                // Years from already-promoted students
                $studentYears = Student::where('school_id', $school->id)
                    ->select('academic_year_entry')
                    ->distinct()
                    ->pluck('academic_year_entry');

                // Years from accepted (but not-yet-promoted) PPDB applications
                $ppdbYears = PpdbApplication::where('school_id', $school->id)
                    ->where('status', 'accepted')
                    ->selectRaw('YEAR(created_at) as yr')
                    ->distinct()
                    ->pluck('yr')
                    ->map(fn($y) => $y . '/' . ($y + 1));

                $school->year_list = $studentYears
                    ->merge($ppdbYears)
                    ->unique()
                    ->sortDesc()
                    ->values();

                $school->total_students = Student::where('school_id', $school->id)->count();
                return $school;
            });

        return view('admin.superadmin.archive.index', compact('schools'));
    }

    /** Year-level archive view for a school. */
    public function yearView(string $school, string $year)
    {
        $dbType    = School::resolveDbType($school);
        $schoolModel = School::where('type', $dbType)->firstOrFail();

        abort_unless(in_array($schoolModel->id, $this->allowedSchoolIds()), 403);

        $year = str_replace('-', '/', urldecode($year));
        [$startYear] = explode('/', $year) + [null];
        $ppdb = PpdbApplication::where('school_id', $schoolModel->id)
            ->whereYear('created_at', intval($startYear))
            ->selectRaw("
                COUNT(*) AS total,
                SUM(CASE WHEN status = 'accepted' THEN 1 ELSE 0 END) AS accepted,
                SUM(CASE WHEN status = 'rejected' THEN 1 ELSE 0 END) AS rejected,
                SUM(CASE WHEN status NOT IN ('accepted','rejected','draft') THEN 1 ELSE 0 END) AS pending
            ")
            ->first();

        // Student records
        $studentsQuery = Student::where('school_id', $schoolModel->id)
            ->where('academic_year_entry', $year)
            ->with('ppdbApplication');

        // Filters from request
        $search       = request('search', '');
        $majorFilter  = request('major', 'all');
        $statusFilter = request('status', 'all');
        $classFilter  = request('class', 'all');

        if ($search) {
            $studentsQuery->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                    ->orWhere('nis', 'like', "%{$search}%")
                    ->orWhere('nisn', 'like', "%{$search}%");
            });
        }
        if ($majorFilter !== 'all') {
            $studentsQuery->where('major', $majorFilter);
        }
        if ($statusFilter !== 'all') {
            $studentsQuery->where('enrollment_status', $statusFilter);
        }
        if ($classFilter !== 'all') {
            $studentsQuery->where('current_class', $classFilter);
        }

        $students = $studentsQuery->orderBy('full_name')->get();

        // Major breakdown for SMK
        $majorBreakdown = [];
        if (strtoupper($dbType) === 'SMK') {
            foreach (Student::getSmkMajors() as $maj) {
                $majorBreakdown[$maj] = Student::where('school_id', $schoolModel->id)
                    ->where('academic_year_entry', $year)
                    ->where('major', $maj)
                    ->count();
            }
        }

        // Accepted PPDB applicants not yet promoted to students
        $promotedAppIds = Student::where('school_id', $schoolModel->id)
            ->where('academic_year_entry', $year)
            ->whereNotNull('ppdb_application_id')
            ->pluck('ppdb_application_id')
            ->toArray();

        $unpromoted = PpdbApplication::where('school_id', $schoolModel->id)
            ->where('status', 'accepted')
            ->whereYear('created_at', intval($startYear))
            ->whereNotIn('id', $promotedAppIds)
            ->get();

        return view('admin.superadmin.archive.year', compact(
            'schoolModel',
            'school',
            'year',
            'ppdb',
            'students',
            'majorBreakdown',
            'unpromoted',
            'search',
            'majorFilter',
            'statusFilter',
            'classFilter'
        ));
    }

    /** Student detail page. */
    public function studentDetail(string $school, string $year, Student $student)
    {
        $dbType      = School::resolveDbType($school);
        $schoolModel = School::where('type', $dbType)->firstOrFail();

        abort_unless(in_array($schoolModel->id, $this->allowedSchoolIds()), 403);
        abort_unless($student->school_id === $schoolModel->id, 403);

        $student->load('ppdbApplication', 'school');
        $year = str_replace('-', '/', urldecode($year));

        return view('admin.superadmin.archive.student_detail', compact(
            'schoolModel',
            'school',
            'year',
            'student'
        ));
    }

    /** Print card page (print-only layout). */
    public function printCard(Student $student)
    {
        $student->load('school', 'ppdbApplication');
        abort_unless(in_array($student->school_id, $this->allowedSchoolIds()), 403);

        return view('admin.superadmin.archive.print_card', compact('student'));
    }

    // ── Exports ─────────────────────────────────────────────────────────────────

    /** Export student list as Excel. */
    public function exportExcel(string $school, string $year)
    {
        $dbType      = School::resolveDbType($school);
        $schoolModel = School::where('type', $dbType)->firstOrFail();
        abort_unless(in_array($schoolModel->id, $this->allowedSchoolIds()), 403);

        $year     = str_replace('-', '/', urldecode($year));
        $ids      = array_filter(explode(',', request()->query('ids', '')), 'is_numeric');
        $query    = Student::where('school_id', $schoolModel->id)
            ->where('academic_year_entry', $year)
            ->with('ppdbApplication')
            ->orderBy('full_name');
        if (!empty($ids)) {
            $query->whereIn('id', $ids);
        }
        $students = $query->get();

        $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Siswa');

        // Header row — use fromArray (PhpSpreadsheet 2.x compatible)
        $columns = [
            // ── Siswa (Student record) ──────────────────────────────
            'No',
            'NIS',
            'NISN',
            'Nama Lengkap',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jurusan (Arsip)',
            'Kelas',
            'Ruang',
            'Status Siswa',
            'Tanggal Masuk',
            'Email',
            'No. HP',
            'Alamat',
            'Nama Ayah',
            'Pekerjaan Ayah',
            'Nama Ibu',
            'Pekerjaan Ibu',
            'Penghasilan Orang Tua',
            'Sekolah Asal',
            'Catatan Siswa',
            // ── PPDB Application (from ppdb_applications) ──────────
            'ID Pendaftaran',
            'Status PPDB',
            'Jurusan Pilihan 1',
            'Jurusan Pilihan 2',
            'Jurusan Ditetapkan',
            'Tanggal Diterima (PPDB)',
        ];
        $sheet->fromArray($columns, null, 'A1');

        // Auto-size all columns
        $lastCol = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(count($columns));
        foreach (range(1, count($columns)) as $colIdx) {
            $sheet->getColumnDimensionByColumn($colIdx)->setAutoSize(true);
        }
        $sheet->setAutoFilter('A1:' . $lastCol . '1');

        // Data rows
        $row = 2;
        foreach ($students as $i => $s) {
            $app = $s->ppdbApplication;
            $sheet->fromArray([
                // Student fields
                $i + 1,
                $s->nis ?? '-',
                $s->nisn ?? '-',
                $s->full_name,
                $s->gender ?? '-',
                $s->place_of_birth ?? '-',
                $s->date_of_birth ? $s->date_of_birth->format('d/m/Y') : '-',
                $s->major ?? '-',
                $s->current_class ?? '-',
                $s->class_room ?? '-',
                Student::getStatusLabel($s->enrollment_status),
                $s->enrolled_at ? $s->enrolled_at->format('d/m/Y') : '-',
                $s->email ?? '-',
                $s->phone ?? '-',
                $s->address ?? '-',
                $s->father_name ?? '-',
                $s->father_occupation ?? '-',
                $s->mother_name ?? '-',
                $s->mother_occupation ?? '-',
                $s->parent_salary_range ?? '-',
                $s->previous_school ?? '-',
                $s->notes ?? '',
                // PPDB Application fields (non-file)
                $app?->application_id ?? '-',
                $app?->status ?? '-',
                $app?->major_1 ?? '-',
                $app?->major_2 ?? '-',
                $app?->assigned_major ?? '-',
                $app?->admission_date ? $app->admission_date->format('d/m/Y') : '-',
            ], null, 'A' . $row);
            $row++;
        }

        $writer   = new XlsxWriter($spreadsheet);
        $filename = 'siswa-' . $schoolModel->slug . '-' . str_replace('/', '-', $year) . '.xlsx';

        return response()->stream(function () use ($writer) {
            $writer->save('php://output');
        }, 200, [
            'Content-Type'        => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }

    /** Export student berkas files as a ZIP archive, grouped by class (and major for SMK). */
    public function exportZip(string $school, string $year)
    {
        $dbType      = School::resolveDbType($school);
        $schoolModel = School::where('type', $dbType)->firstOrFail();
        abort_unless(in_array($schoolModel->id, $this->allowedSchoolIds()), 403);

        $year     = str_replace('-', '/', urldecode($year));
        $ids      = array_filter(explode(',', request()->query('ids', '')), 'is_numeric');
        $query    = Student::where('school_id', $schoolModel->id)
            ->where('academic_year_entry', $year)
            ->with('ppdbApplication')
            ->orderBy('major')
            ->orderBy('current_class')
            ->orderBy('full_name');
        if (!empty($ids)) {
            $query->whereIn('id', $ids);
        }
        $students = $query->get();

        $zipPath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'arsip_' . uniqid() . '.zip';
        $zip     = new ZipArchive();

        if ($zip->open($zipPath, ZipArchive::CREATE) !== true) {
            abort(500, 'Gagal membuat file ZIP.');
        }

        $isSmk       = strtoupper($dbType) === 'SMK';
        $filesAdded  = 0;
        $studentCount = 0;

        foreach ($students as $student) {
            // Build folder path: {Major}/{Kelas}/{Nama (NIS)} for SMK
            //                    {Kelas}/{Nama (NIS)} for SD/SMP
            $kelas     = trim($student->current_class ?? 'Tanpa Kelas');
            $nisLabel  = $student->nis ? 'NIS-' . $student->nis : 'ID-' . $student->id;
            $namePart  = \Illuminate\Support\Str::slug($student->full_name) . '_' . $nisLabel;

            if ($isSmk && $student->major) {
                $folder = $student->major . '/' . $kelas . '/' . $namePart;
            } else {
                $folder = $kelas . '/' . $namePart;
            }

            // Always write a biodata.txt for every student regardless of uploaded files
            $biodata  = "=== DATA SISWA ===\n";
            $biodata .= "Nama Lengkap     : {$student->full_name}\n";
            $biodata .= "NIS              : " . ($student->nis ?? '-') . "\n";
            $biodata .= "NISN             : " . ($student->nisn ?? '-') . "\n";
            $biodata .= "Jenis Kelamin    : " . ($student->gender ?? '-') . "\n";
            $biodata .= "Tempat, Tgl Lahir: " . ($student->place_of_birth ?? '-') . ", " . ($student->date_of_birth?->format('d/m/Y') ?? '-') . "\n";
            $biodata .= "Alamat           : " . ($student->address ?? '-') . "\n";
            $biodata .= "Jurusan          : " . ($student->major ?? '-') . "\n";
            $biodata .= "Kelas            : " . (trim(($student->current_class ?? '') . ' ' . ($student->class_room ?? '')) ?: '-') . "\n";
            $biodata .= "Tahun Masuk      : " . ($student->academic_year_entry ?? '-') . "\n";
            $biodata .= "Status           : " . Student::getStatusLabel($student->enrollment_status ?? 'active') . "\n";
            $biodata .= "Tgl Masuk        : " . ($student->enrolled_at?->format('d/m/Y') ?? '-') . "\n";
            $biodata .= "Email            : " . ($student->email ?? '-') . "\n";
            $biodata .= "No. HP           : " . ($student->phone ?? '-') . "\n";
            $biodata .= "\n=== DATA ORANG TUA ===\n";
            $biodata .= "Nama Ayah        : " . ($student->father_name ?? '-') . "\n";
            $biodata .= "Pekerjaan Ayah   : " . ($student->father_occupation ?? '-') . "\n";
            $biodata .= "Nama Ibu         : " . ($student->mother_name ?? '-') . "\n";
            $biodata .= "Pekerjaan Ibu    : " . ($student->mother_occupation ?? '-') . "\n";
            $biodata .= "Penghasilan      : " . ($student->parent_salary_range ?? '-') . "\n";
            if ($student->notes) {
                $biodata .= "\n=== CATATAN ===\n" . $student->notes . "\n";
            }
            $zip->addFromString("{$folder}/biodata.txt", $biodata);

            // Add PPDB berkas files if available
            $app = $student->ppdbApplication;
            if ($app) {
                $fileMap = [
                    'kk'          => $app->kk_file,
                    'ijazah'      => $app->ijazah_file,
                    'foto'        => $app->photo_file,
                    'akta-kelahiran' => $app->akta_kelahiran_file,
                    'prestasi'    => $app->prestasi_file,
                    'bukti-bayar' => $app->payment_proof,
                ];

                foreach ($fileMap as $label => $storagePath) {
                    if (!$storagePath) continue;
                    $absolutePath = Storage::disk('public')->path($storagePath);
                    if (file_exists($absolutePath)) {
                        $ext = pathinfo($storagePath, PATHINFO_EXTENSION);
                        $zip->addFile($absolutePath, "{$folder}/{$label}.{$ext}");
                        $filesAdded++;
                    }
                }
            }

            $studentCount++;
        }

        // Top-level manifest
        $structureNote = $isSmk
            ? "Struktur folder: {Jurusan}/{Kelas}/{Nama_NIS}/\n"
            : "Struktur folder: {Kelas}/{Nama_NIS}/\n";

        $manifest  = "ARSIP DIGITAL — {$schoolModel->name}\n";
        $manifest .= "Tahun Ajaran : {$year}\n";
        $manifest .= "Diunduh      : " . now()->format('d/m/Y H:i') . "\n";
        $manifest .= "Total Siswa  : {$studentCount}\n";
        $manifest .= "Total Berkas : {$filesAdded}\n\n";
        $manifest .= $structureNote;
        $manifest .= "Setiap folder siswa berisi biodata.txt dan file berkas PPDB (kk, ijazah, foto, akta-kelahiran, prestasi, bukti-bayar) bila tersedia.\n";
        $zip->addFromString('MANIFEST.txt', $manifest);

        $zip->close();

        if (!file_exists($zipPath)) {
            abort(500, 'Gagal membuat file ZIP. Silakan coba lagi.');
        }

        $filename = 'berkas-' . $schoolModel->slug . '-' . str_replace('/', '-', $year) . '.zip';

        return response()->download($zipPath, $filename)->deleteFileAfterSend();
    }
}
