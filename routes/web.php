<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\School;
use App\Models\SchoolHomepageSetting;
use App\Models\GalleryItem;
use App\Models\News;
use App\Models\Page;
use App\Models\Prestasi;
use App\Http\Controllers\Admin\CarouselAdminController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\GalleryAdminController;
use App\Http\Controllers\Admin\NewsAdminController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PrestasiAdminController;
use App\Http\Controllers\Admin\PpdbManagementController;
use App\Http\Controllers\Admin\TeacherStaffAdminController;
use App\Http\Controllers\Admin\JurusanAdminController;
use App\Http\Controllers\YayasanPublicController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserManagementController;
use App\Http\Controllers\Admin\AdminPpdbApplicantsController;
use App\Http\Controllers\Admin\ArchiveController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\FaqAdminController;

// =====================
// YAYASAN (MAIN SITE)
// =====================

Route::get('/', [YayasanPublicController::class, 'home'])->name('yayasan.home');

Route::get('/about', [YayasanPublicController::class, 'about'])->name('yayasan.about');

Route::get('/daftar', fn() => view('auth/register'))->name('daftar');

Route::get('/login', fn() => redirect('/admin/login'))->name('login');

Route::get('/sitemap.xml', function () {
    $urls = collect([
        [
            'loc' => route('yayasan.home'),
            'lastmod' => now()->toAtomString(),
            'changefreq' => 'daily',
            'priority' => '1.0',
        ],
        [
            'loc' => route('yayasan.about'),
            'lastmod' => now()->toAtomString(),
            'changefreq' => 'monthly',
            'priority' => '0.8',
        ],
        [
            'loc' => route('yayasan.fasilitas'),
            'lastmod' => now()->toAtomString(),
            'changefreq' => 'weekly',
            'priority' => '0.8',
        ],
        [
            'loc' => route('yayasan.akreditasi'),
            'lastmod' => now()->toAtomString(),
            'changefreq' => 'weekly',
            'priority' => '0.7',
        ],
        [
            'loc' => route('yayasan.prestasi'),
            'lastmod' => now()->toAtomString(),
            'changefreq' => 'weekly',
            'priority' => '0.7',
        ],
        [
            'loc' => route('yayasan.berita'),
            'lastmod' => now()->toAtomString(),
            'changefreq' => 'daily',
            'priority' => '0.9',
        ],
        [
            'loc' => route('yayasan.kontak'),
            'lastmod' => now()->toAtomString(),
            'changefreq' => 'monthly',
            'priority' => '0.7',
        ],
    ]);

    foreach (['sd', 'smp', 'smk'] as $schoolSlug) {
        $urls->push([
            'loc' => route('school.home', ['school' => $schoolSlug]),
            'lastmod' => now()->toAtomString(),
            'changefreq' => 'daily',
            'priority' => '0.9',
        ]);
        $urls->push([
            'loc' => route('school.profil', ['school' => $schoolSlug]),
            'lastmod' => now()->toAtomString(),
            'changefreq' => 'monthly',
            'priority' => '0.8',
        ]);
        $urls->push([
            'loc' => route('school.visi', ['school' => $schoolSlug]),
            'lastmod' => now()->toAtomString(),
            'changefreq' => 'monthly',
            'priority' => '0.7',
        ]);
        $urls->push([
            'loc' => route('school.prestasi', ['school' => $schoolSlug]),
            'lastmod' => now()->toAtomString(),
            'changefreq' => 'weekly',
            'priority' => '0.7',
        ]);
        $urls->push([
            'loc' => route('school.berita', ['school' => $schoolSlug]),
            'lastmod' => now()->toAtomString(),
            'changefreq' => 'daily',
            'priority' => '0.8',
        ]);
        $urls->push([
            'loc' => route('school.galeri', ['school' => $schoolSlug]),
            'lastmod' => now()->toAtomString(),
            'changefreq' => 'weekly',
            'priority' => '0.7',
        ]);
        $urls->push([
            'loc' => route('school.kontak', ['school' => $schoolSlug]),
            'lastmod' => now()->toAtomString(),
            'changefreq' => 'monthly',
            'priority' => '0.6',
        ]);
        $urls->push([
            'loc' => route('school.ppdb', ['school' => $schoolSlug]),
            'lastmod' => now()->toAtomString(),
            'changefreq' => 'daily',
            'priority' => '0.8',
        ]);
        $urls->push([
            'loc' => route('ppdb.login', ['school' => $schoolSlug]),
            'lastmod' => now()->toAtomString(),
            'changefreq' => 'monthly',
            'priority' => '0.6',
        ]);
        $urls->push([
            'loc' => route('ppdb.register', ['school' => $schoolSlug]),
            'lastmod' => now()->toAtomString(),
            'changefreq' => 'daily',
            'priority' => '0.8',
        ]);
    }

    if (Schema::hasTable('news') && Schema::hasTable('schools')) {
        $yayasanNews = News::query()
            ->where('status', 'published')
            ->whereNotNull('slug')
            ->whereHas('school', function ($query) {
                $query->whereRaw('LOWER(type) = ?', ['yayasan']);
            })
            ->orderByDesc('published_at')
            ->orderByDesc('updated_at')
            ->get(['slug', 'updated_at', 'published_at']);

        foreach ($yayasanNews as $newsItem) {
            $urls->push([
                'loc' => route('yayasan.berita.show', ['slug' => $newsItem->slug]),
                'lastmod' => optional($newsItem->updated_at ?? $newsItem->published_at)->toAtomString() ?? now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.7',
            ]);
        }

        $schoolNews = News::query()
            ->where('status', 'published')
            ->whereNotNull('school_id')
            ->whereHas('school', function ($query) {
                $query->whereIn('slug', ['sd', 'smp', 'smk']);
            })
            ->with('school:id,slug')
            ->orderByDesc('published_at')
            ->orderByDesc('updated_at')
            ->get(['id', 'school_id', 'updated_at', 'published_at']);

        foreach ($schoolNews as $newsItem) {
            if (!$newsItem->school?->slug) {
                continue;
            }

            $urls->push([
                'loc' => route('school.berita.detail', ['school' => $newsItem->school->slug, 'slug' => $newsItem->slug]),
                'lastmod' => optional($newsItem->updated_at ?? $newsItem->published_at)->toAtomString() ?? now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.7',
            ]);
        }
    }

    $escape = static fn(string $value): string => htmlspecialchars($value, ENT_QUOTES | ENT_XML1, 'UTF-8');

    $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    $xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

    foreach ($urls->unique('loc')->values() as $urlItem) {
        $xml .= "  <url>\n";
        $xml .= "    <loc>" . $escape($urlItem['loc']) . "</loc>\n";
        $xml .= "    <lastmod>" . $escape($urlItem['lastmod']) . "</lastmod>\n";
        $xml .= "    <changefreq>" . $escape($urlItem['changefreq']) . "</changefreq>\n";
        $xml .= "    <priority>" . $escape($urlItem['priority']) . "</priority>\n";
        $xml .= "  </url>\n";
    }

    $xml .= "</urlset>";

    return response($xml, 200)->header('Content-Type', 'application/xml; charset=UTF-8');
})->name('sitemap');

Route::get('/fasilitas',      [YayasanPublicController::class, 'fasilitas'])->name('yayasan.fasilitas');
Route::get('/akreditasi',    [YayasanPublicController::class, 'akreditasi'])->name('yayasan.akreditasi');
Route::get('/prestasi',        [YayasanPublicController::class, 'prestasi'])->name('yayasan.prestasi');
Route::get('/prestasi/{slug}', [YayasanPublicController::class, 'prestasiShow'])->name('yayasan.prestasi.show');
Route::get('/berita',        [YayasanPublicController::class, 'berita'])->name('yayasan.berita');
Route::get('/berita/{slug}', [YayasanPublicController::class, 'beritaShow'])->name('yayasan.berita.show');
Route::get('/kontak',        [YayasanPublicController::class, 'kontak'])->name('yayasan.kontak');

// Admin/Superadmin Dashboard (protected — defined below inside auth:admin middleware)

// Admin Auth
Route::get('/admin/login', [App\Http\Controllers\AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\AdminAuthController::class, 'login'])->middleware('throttle:5,1')->name('admin.login.post');
Route::post('/admin/logout', [App\Http\Controllers\AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin-protected routes
Route::middleware(['auth:admin', 'admin.access'])->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // CMS Management Index
    Route::get('/admin/cms', [AdminDashboardController::class, 'cmsIndex'])->name('admin.cms.index');

    Route::resource('/admin/cms/pages', PageController::class)->middleware('auth:admin')->names('admin.cms.pages')->except(['show', 'destroy', 'create', 'store']);

    // CMS Detail Page
    Route::get('/admin/cms/detail', fn() => view('admin.superadmin.cms.detail'))->name('admin.cms.detail');

    // School selection page for CMS
    Route::get('/admin/cms/schools', [AdminDashboardController::class, 'cmsSchools'])->name('admin.cms.schools');

    // CMS routes per school type
    Route::prefix('/admin/cms/{schoolType}')
        ->where(['schoolType' => 'smk|sd|smp|yayasan'])
        ->group(function () {
            Route::get('/', [CmsController::class, 'index'])->name('admin.cms.by_school');
            Route::post('/kepsek', [CmsController::class, 'updateKepsek'])->name('admin.cms.kepsek.update');
            Route::post('/contact', [CmsController::class, 'updateContactInfo'])->name('admin.cms.contact.update');
            Route::post('/payment-settings', [CmsController::class, 'updatePaymentSettings'])->name('admin.cms.payment_settings.update');
            Route::post('/yayasan-principals', [CmsController::class, 'updateYayasanPrincipals'])->name('admin.cms.yayasan.principals.update');

            // Berita
            Route::get('/berita', [NewsAdminController::class, 'index'])->name('admin.cms.berita.index');
            Route::get('/berita/create', [NewsAdminController::class, 'create'])->name('admin.cms.berita.create');
            Route::post('/berita', [NewsAdminController::class, 'store'])->name('admin.cms.berita.store');
            Route::get('/berita/{news}/edit', [NewsAdminController::class, 'edit'])->name('admin.cms.berita.edit');
            Route::put('/berita/{news}', [NewsAdminController::class, 'update'])->name('admin.cms.berita.update');
            Route::post('/berita/{news}/toggle-featured', [NewsAdminController::class, 'toggleFeatured'])->name('admin.cms.berita.toggle_featured');
            Route::delete('/berita/{news}', [NewsAdminController::class, 'destroy'])->name('admin.cms.berita.destroy');

            // Galeri
            Route::get('/galeri', [GalleryAdminController::class, 'index'])->name('admin.cms.galeri.index');
            Route::get('/galeri/create', [GalleryAdminController::class, 'create'])->name('admin.cms.galeri.create');
            Route::post('/galeri', [GalleryAdminController::class, 'store'])->name('admin.cms.galeri.store');
            Route::get('/galeri/{id}/edit', [GalleryAdminController::class, 'edit'])->name('admin.cms.galeri.edit');
            Route::put('/galeri/{id}', [GalleryAdminController::class, 'update'])->name('admin.cms.galeri.update');
            Route::delete('/galeri/{id}', [GalleryAdminController::class, 'destroy'])->name('admin.cms.galeri.destroy');

            // Carousel
            Route::get('/carousel', [CarouselAdminController::class, 'index'])->name('admin.cms.carousel.index');
            Route::get('/carousel/create', [CarouselAdminController::class, 'create'])->name('admin.cms.carousel.create');
            Route::post('/carousel', [CarouselAdminController::class, 'store'])->name('admin.cms.carousel.store');
            Route::get('/carousel/{carousel}/edit', [CarouselAdminController::class, 'edit'])->name('admin.cms.carousel.edit');
            Route::put('/carousel/{carousel}', [CarouselAdminController::class, 'update'])->name('admin.cms.carousel.update');
            Route::delete('/carousel/{carousel}', [CarouselAdminController::class, 'destroy'])->name('admin.cms.carousel.destroy');

            // Prestasi
            Route::get('/prestasi', [PrestasiAdminController::class, 'index'])->name('admin.cms.prestasi.index');
            Route::get('/prestasi/create', [PrestasiAdminController::class, 'create'])->name('admin.cms.prestasi.create');
            Route::post('/prestasi', [PrestasiAdminController::class, 'store'])->name('admin.cms.prestasi.store');
            Route::get('/prestasi/{prestasi}/edit', [PrestasiAdminController::class, 'edit'])->name('admin.cms.prestasi.edit');
            Route::put('/prestasi/{prestasi}', [PrestasiAdminController::class, 'update'])->name('admin.cms.prestasi.update');
            Route::delete('/prestasi/{prestasi}', [PrestasiAdminController::class, 'destroy'])->name('admin.cms.prestasi.destroy');

            // Guru & Staff
            Route::get('/guru', [TeacherStaffAdminController::class, 'index'])->name('admin.cms.guru.index');
            Route::get('/guru/create', [TeacherStaffAdminController::class, 'create'])->name('admin.cms.guru.create');
            Route::post('/guru', [TeacherStaffAdminController::class, 'store'])->name('admin.cms.guru.store');
            Route::get('/guru/{guru}/edit', [TeacherStaffAdminController::class, 'edit'])->name('admin.cms.guru.edit');
            Route::put('/guru/{guru}', [TeacherStaffAdminController::class, 'update'])->name('admin.cms.guru.update');
            Route::delete('/guru/{guru}', [TeacherStaffAdminController::class, 'destroy'])->name('admin.cms.guru.destroy');

            // Jurusan (SMK only)
            Route::get('/jurusan', [JurusanAdminController::class, 'index'])->name('admin.cms.jurusan.index');
            Route::get('/jurusan/create', [JurusanAdminController::class, 'create'])->name('admin.cms.jurusan.create');
            Route::post('/jurusan', [JurusanAdminController::class, 'store'])->name('admin.cms.jurusan.store');
            Route::get('/jurusan/{jurusan}/edit', [JurusanAdminController::class, 'edit'])->name('admin.cms.jurusan.edit');
            Route::put('/jurusan/{jurusan}', [JurusanAdminController::class, 'update'])->name('admin.cms.jurusan.update');
            Route::delete('/jurusan/{jurusan}', [JurusanAdminController::class, 'destroy'])->name('admin.cms.jurusan.destroy');

            // FAQ (Yayasan)
            Route::get('/faq', [FaqAdminController::class, 'index'])->name('admin.cms.faq.index');
            Route::post('/faq', [FaqAdminController::class, 'store'])->name('admin.cms.faq.store');
            Route::get('/faq/{faq}/edit', [FaqAdminController::class, 'edit'])->name('admin.cms.faq.edit');
            Route::put('/faq/{faq}', [FaqAdminController::class, 'update'])->name('admin.cms.faq.update');
            Route::delete('/faq/{faq}', [FaqAdminController::class, 'destroy'])->name('admin.cms.faq.destroy');
        });

    // Media upload for Quill editor (jurusan rich content)
    Route::post('/admin/cms/media/upload', [JurusanAdminController::class, 'uploadMedia'])->name('admin.cms.jurusan.media.upload');

    // PPDB Management for selected school (per jenjang view)
    Route::prefix('/admin/ppdb/management/{school}')->group(function () {
        Route::get('/', [PpdbManagementController::class, 'index'])->name('admin.ppdb.management');
        Route::post('/year', [PpdbManagementController::class, 'storeYear'])->name('admin.ppdb.management.year.store');
        Route::post('/phase/setup', [PpdbManagementController::class, 'setupPhases'])->name('admin.ppdb.management.phase.setup');
        Route::post('/phase', [PpdbManagementController::class, 'store'])->name('admin.ppdb.management.phase.store');
        Route::put('/phase/{phase}', [PpdbManagementController::class, 'update'])->name('admin.ppdb.management.phase.update');
        Route::patch('/phase/{phase}/activate', [PpdbManagementController::class, 'activate'])->name('admin.ppdb.management.phase.activate');
        Route::patch('/toggle-live', [PpdbManagementController::class, 'toggleLive'])->name('admin.ppdb.management.year.toggle-live');
        Route::delete('/phase/{phase}', [PpdbManagementController::class, 'destroy'])->name('admin.ppdb.management.phase.destroy');

        Route::get('/capacity', [PpdbManagementController::class, 'capacityIndex'])->name('admin.ppdb.management.capacity');
        Route::post('/capacity', [PpdbManagementController::class, 'capacityStore'])->name('admin.ppdb.management.capacity.store');
        Route::put('/capacity/{capacity}', [PpdbManagementController::class, 'capacityUpdate'])->name('admin.ppdb.management.capacity.update');
        Route::delete('/capacity/{capacity}', [PpdbManagementController::class, 'capacityDestroy'])->name('admin.ppdb.management.capacity.destroy');
    });

    // School selection page for PPDB
    Route::get('/admin/ppdb/schools', [AdminDashboardController::class, 'ppdbSchools'])->name('admin.ppdb.schools');

    // PPDB Applicant Management

    // SMK Applicants
    Route::get('/admin/ppdb/applicants/smk',        [AdminPpdbApplicantsController::class, 'smkIndex'])->name('admin.ppdb.applicants.smk');
    Route::get('/admin/ppdb/applicants/smk/data',   [AdminPpdbApplicantsController::class, 'smkData'])->name('admin.ppdb.applicants.smk.data');
    Route::get('/admin/ppdb/applicants/smk/{id}',   [AdminPpdbApplicantsController::class, 'smkDetail'])->name('admin.ppdb.applicants.smk.detail');

    // Decision endpoint for SMK applicants
    Route::post('/admin/ppdb/applicants/smk/{id}/decision', [\App\Http\Controllers\PpdbApplicationDecisionController::class, 'decide'])->name('admin.ppdb.applicants.smk.decision');

    // Confirm payment for SMK applicants (all payment methods — TU, bank, e-wallet)
    Route::post('/admin/ppdb/applicants/smk/{id}/confirm-payment', function ($id) {
        $schoolModel = \App\Models\School::where('type', 'SMK')->firstOrFail();
        $applicant   = \App\Models\PpdbApplication::findOrFail($id);
        if ($applicant->school_id !== $schoolModel->id) abort(404);

        $statusHistory   = $applicant->status_history ?: [];
        $alreadyConfirmed = collect($statusHistory)->contains(
            fn($h) => in_array($h['status'] ?? '', ['payment_confirmed', 'payment_confirmed_tu'])
        );
        if ($alreadyConfirmed) {
            return redirect()->route('admin.ppdb.applicants.smk.detail', $id)
                ->with('info', 'Pembayaran sudah pernah dikonfirmasi sebelumnya.');
        }

        $statusHistory[] = [
            'status'     => 'payment_confirmed',
            'changed_at' => now()->toDateTimeString(),
            'note'       => 'Pembayaran dikonfirmasi oleh admin: ' . (auth('admin')->user()->name ?? 'admin'),
        ];

        if (! $applicant->unique_code) {
            $applicant->unique_code = \App\Models\PpdbApplication::generateUniqueCode();
        }

        $applicant->payment_date   = $applicant->payment_date ?? now();
        $applicant->status         = 'payment_uploaded';
        $applicant->status_history = $statusHistory;
        $applicant->save();

        return redirect()->route('admin.ppdb.applicants.smk.detail', $id)
            ->with('success', 'Pembayaran berhasil dikonfirmasi. Kode unik: ' . $applicant->unique_code);
    })->name('admin.ppdb.applicants.smk.confirm_payment');

    // SMP Applicants
    Route::get('/admin/ppdb/applicants/smp', fn() => redirect()->route('admin.ppdb.applicants.by_school', ['school' => 'smp-putra-pakuan']))->name('admin.ppdb.applicants.smp');

    // Applicant detail by school (supports SMP/SD/SMK)
    Route::get('/admin/ppdb/applicants/{school}/{id}', [AdminPpdbApplicantsController::class, 'bySchoolDetail'])
        ->whereNumber('id')
        ->name('admin.ppdb.applicants.by_school.detail');

    // Decision endpoint by school
    Route::post('/admin/ppdb/applicants/{school}/{id}/decision', [\App\Http\Controllers\PpdbApplicationDecisionController::class, 'decideBySchool'])
        ->whereNumber('id')
        ->name('admin.ppdb.applicants.by_school.decision');

    // Confirm TU (manual) payment by admin
    Route::post('/admin/ppdb/applicants/{school}/{id}/confirm-payment', [AdminPpdbApplicantsController::class, 'confirmPayment'])
        ->whereNumber('id')
        ->name('admin.ppdb.applicants.by_school.confirm_payment');

    // PPDB Applicants by School (per jenjang view)
    Route::get('/admin/ppdb/applicants/{school}/data', [AdminPpdbApplicantsController::class, 'bySchoolData'])
        ->name('admin.ppdb.applicants.by_school.data');

    Route::get('/admin/ppdb/applicants/{school}/export', [AdminPpdbApplicantsController::class, 'export'])
        ->name('admin.ppdb.applicants.by_school.export');


    Route::get('/admin/ppdb/applicants/{school}/export.xlsx', [AdminPpdbApplicantsController::class, 'exportXlsx'])
        ->name('admin.ppdb.applicants.by_school.export.xlsx');


    Route::get('/admin/ppdb/applicants/{school}', [AdminPpdbApplicantsController::class, 'bySchoolIndex'])
        ->name('admin.ppdb.applicants.by_school');

    // User Management (Superadmin)
    Route::get('/admin/user-management', [AdminUserManagementController::class, 'index'])->name('admin.user_management');

    Route::post('/admin/users', [AdminUserManagementController::class, 'store'])->name('admin.users.store');

    Route::patch('/admin/users/{user}', [AdminUserManagementController::class, 'update'])->name('admin.users.update');

    Route::delete('/admin/users/{user}', [AdminUserManagementController::class, 'destroy'])->name('admin.users.destroy');

    // ─────────────────────────────────────────────────────────────────────────────
    // ARSIP DIGITAL — School Archive & Student Records
    // ─────────────────────────────────────────────────────────────────────────────

    // Archive — school selector
    Route::get('/admin/archive', [ArchiveController::class, 'index'])->name('admin.archive.index');

    // Archive — year view for a school
    Route::get('/admin/archive/{school}/{year}/export/excel', [ArchiveController::class, 'exportExcel'])
        ->where('year', '.+')
        ->name('admin.archive.export.excel');

    Route::get('/admin/archive/{school}/{year}/export/zip', [ArchiveController::class, 'exportZip'])
        ->where('year', '.+')
        ->name('admin.archive.export.zip');

    Route::get('/admin/archive/{school}/{year}/{student}/print', [ArchiveController::class, 'printCard'])
        ->where('year', '.+')
        ->name('admin.archive.student.print');

    Route::get('/admin/archive/{school}/{year}/{student}', [ArchiveController::class, 'studentDetail'])
        ->where('year', '.+')
        ->name('admin.archive.student');

    Route::get('/admin/archive/{school}/{year}', [ArchiveController::class, 'yearView'])
        ->where('year', '.+')
        ->name('admin.archive.year');

    // Students — CRUD
    Route::post('/admin/students/promote', [StudentController::class, 'promote'])->name('admin.students.promote');
    Route::post('/admin/students', [StudentController::class, 'store'])->name('admin.students.store');
    Route::patch('/admin/students/{student}', [StudentController::class, 'update'])->name('admin.students.update');
    Route::delete('/admin/students/{student}', [StudentController::class, 'destroy'])->name('admin.students.destroy');
});

Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('google.redirect');

Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('google.callback');

// Per-school Google redirect — stores school in session then uses the same single callback URL
Route::get('/{school}/auth/google/redirect', [GoogleAuthController::class, 'redirect'])
    ->where('school', 'sd|smp|smk')
    ->name('google.redirect.by.school');

// Keep the per-school callback URL as an alias so old bookmarks / links still work
Route::get('/{school}/auth/google/callback', [GoogleAuthController::class, 'callback'])
    ->where('school', 'sd|smp|smk')
    ->name('google.callback.by.school');

// SDIT alias routes (canonical school path remains /sd)
Route::get('/sdit/{path?}', function (?string $path = null) {
    $target = '/sd' . ($path ? '/' . ltrim($path, '/') : '');
    $query = request()->getQueryString();
    if ($query) {
        $target .= '?' . $query;
    }

    return redirect($target, 301);
})->where('path', '.*')->name('school.alias.sdit');

// =====================
// SEKOLAH (SD / SMP / SMK)
// =====================
Route::prefix('{school}')
    ->where(['school' => 'sd|smp|smk'])
    ->group(function () {

        // helper function
        $render = function ($school, $page) {
            $view = strtoupper($school) . '.' . $page;

            if (view()->exists($view)) {
                return view($view, compact('school'));
            }

            // Fallback to SMK views for PPDB and other shared pages
            $fallback = 'SMK.' . $page;
            if (view()->exists($fallback)) {
                return view($fallback, compact('school'));
            }

            abort(404);
        };

        Route::get('/', [\App\Http\Controllers\SchoolHomeController::class, 'index'])->name('school.home');

        Route::get('/visi', fn($school) => redirect()->to(route('school.profil', ['school' => $school]) . '#visi-misi'))->name('school.visi');

        Route::get('/profil', fn($school) => $render($school, 'profil'))->name('school.profil');

        Route::get('/ppdb', fn($school) => $render($school, 'ppdb.index'))->name('school.ppdb');

        // PPDB Authentication Routes — Unique Code Based
        Route::get('/login', fn($school) => view(strtoupper($school) . '.ppdb.login', compact('school')))->name('ppdb.login');
        Route::get('/daftar', [App\Http\Controllers\PpdbAuthController::class, 'showRegisterForm'])->name('ppdb.register');
        Route::post('/login', [App\Http\Controllers\PpdbAuthController::class, 'login'])->middleware('throttle:10,1')->name('ppdb.login.post');
        Route::post('/logout', [App\Http\Controllers\PpdbAuthController::class, 'logout'])->name('ppdb.logout');
        Route::post('/daftar', [App\Http\Controllers\PpdbAuthController::class, 'register'])->name('ppdb.register.post');

        // Registration success page (payment pending admin verification)
        Route::get('/ppdb/register-success', [App\Http\Controllers\PpdbAuthController::class, 'registerSuccess'])->name('ppdb.register.success');

        // Cek Kode Unik — applicant retrieves their code after admin verifies payment
        Route::get('/ppdb/cek-kode', [App\Http\Controllers\PpdbAuthController::class, 'showCheckCode'])->name('ppdb.cek.kode');
        Route::post('/ppdb/cek-kode', [App\Http\Controllers\PpdbAuthController::class, 'checkCode'])->name('ppdb.cek.kode.post');

        // PPDB authenticated routes (middleware enforced at routing layer)
        Route::middleware('ppdb.auth')->group(function () use ($render) {
            Route::get('/ppdb/dashboard', [App\Http\Controllers\PpdbAuthController::class, 'dashboard'])->name('ppdb.dashboard');
            Route::get('/ppdb/biodata', fn($school) => $render($school, 'ppdb.biodata'))->name('ppdb.biodata');
            Route::post('/ppdb/biodata', [App\Http\Controllers\PpdbAuthController::class, 'updateBiodata'])->name('ppdb.biodata.update');
            Route::get('/ppdb/berkas', fn($school) => $render($school, 'ppdb.berkas'))->name('ppdb.berkas');
            Route::post('/ppdb/berkas', [App\Http\Controllers\PpdbAuthController::class, 'updateBerkas'])->name('ppdb.berkas.update');
            Route::get('/ppdb/profil', fn($school) => $render($school, 'ppdb.profil'))->name('ppdb.profil');
        });

        Route::get('/program', fn($school) => $render($school, 'program'))->name('school.program');

        Route::get('/kesiswaan', fn($school) => $render($school, 'kesiswaan'))->name('school.kesiswaan');

        Route::get('/prestasi/{slug}', function ($school, $slug) {
            $schoolModel = \App\Models\School::where('type', \App\Models\School::resolveDbType($school))->firstOrFail();

            $prestasi = \App\Models\Prestasi::where('school_id', $schoolModel->id)
                ->where('slug', $slug)
                ->where('status', 'published')
                ->firstOrFail();

            $related = \App\Models\Prestasi::where('school_id', $schoolModel->id)
                ->where('status', 'published')
                ->where('id', '!=', $prestasi->id)
                ->where('category', $prestasi->category)
                ->orderByDesc('published_at')
                ->limit(3)
                ->get();

            if ($related->count() < 3) {
                $extra = \App\Models\Prestasi::where('school_id', $schoolModel->id)
                    ->where('status', 'published')
                    ->where('id', '!=', $prestasi->id)
                    ->whereNotIn('id', $related->pluck('id'))
                    ->orderByDesc('published_at')
                    ->limit(3 - $related->count())
                    ->get();
                $related = $related->concat($extra);
            }

            return view(strtoupper($school) . '.prestasi-detail', compact('school', 'schoolModel', 'prestasi', 'related'));
        })->name('school.prestasi.show');

        Route::get('/prestasi', function ($school) {
            $schoolModel = \App\Models\School::where('type', \App\Models\School::resolveDbType($school))->firstOrFail();

            $prestasi = \App\Models\Prestasi::where('school_id', $schoolModel->id)
                ->published()
                ->get();

            // Fallback if no published prestasi exists (admin may have created in draft mode)
            if ($prestasi->isEmpty()) {
                $prestasi = \App\Models\Prestasi::where('school_id', $schoolModel->id)
                    ->orderByDesc('published_at')
                    ->orderByDesc('created_at')
                    ->get();
            }

            return view(strtoupper($school) . '.prestasi', compact('school', 'schoolModel', 'prestasi'));
        })->name('school.prestasi');

        Route::get('/galeri', [\App\Http\Controllers\GalleryController::class, 'index'])->name('school.galeri');
        Route::get('/galeri/load-more', [\App\Http\Controllers\GalleryController::class, 'loadMore'])->name('school.galeri.load-more');

        Route::get('/kontak', function ($school) {
            $schoolModel = School::where('type', School::resolveDbType($school))->firstOrFail();

            $contactDefaults = [
                'contact_whatsapp' => '6282112345678',
                'contact_email' => 'info@putrapakuan.sch.id',
                'contact_phone' => '+62 21 1234 5678',
                'contact_address' => 'Jl. Pakuan No. 1, Tegallega, Kecamatan Bogor Tengah, Kota Bogor, Jawa Barat 16129',
                'contact_map_url' => 'https://maps.google.com/?q=Yayasan+Putra+Pakuan+Bogor',
            ];

            $homepage = SchoolHomepageSetting::where('school_id', $schoolModel->id)->first();

            $contact = [
                'contact_whatsapp' => $homepage && $homepage->contact_whatsapp ? $homepage->contact_whatsapp : $contactDefaults['contact_whatsapp'],
                'contact_email' => $homepage && $homepage->contact_email ? $homepage->contact_email : $contactDefaults['contact_email'],
                'contact_phone' => $homepage && $homepage->contact_phone ? $homepage->contact_phone : $contactDefaults['contact_phone'],
                'contact_address' => $homepage && $homepage->contact_address ? $homepage->contact_address : $contactDefaults['contact_address'],
                'contact_map_url' => $homepage && $homepage->contact_map_url ? $homepage->contact_map_url : $contactDefaults['contact_map_url'],
            ];

            return view(strtoupper($school) . '.kontak', compact('school', 'contact'));
        })->name('school.kontak');

        Route::get('/berita', [\App\Http\Controllers\SchoolNewsController::class, 'index'])->name('school.berita');

        Route::get('/berita/{slug}', [\App\Http\Controllers\SchoolNewsController::class, 'show'])->name('school.berita.detail')->where('slug', '[a-z0-9\-]+');

        Route::get('/direktori/guru', [\App\Http\Controllers\SchoolHomeController::class, 'teacherDirectory'])->name('school.direktori.guru');

        Route::get('/direktori/siswa', function ($school) {
            $view = strtoupper($school) . '.direktori_siswa';

            if (view()->exists($view)) {
                return view($view, compact('school'));
            }

            abort(404);
        })->name('school.direktori.siswa');

        // ── Jurusan (SMK only) ─────────────────────────────────────────────────
        Route::get('/jurusan', function ($school) {
            abort_unless($school === 'smk', 404);

            $schoolModel = \App\Models\School::where('type', \App\Models\School::resolveDbType($school))->firstOrFail();

            $jurusans = \App\Models\SmkJurusan::where('school_id', $schoolModel->id)
                ->active()
                ->get();

            return view('SMK.jurusan.index', compact('school', 'schoolModel', 'jurusans'));
        })->name('school.jurusan.index');

        Route::get('/jurusan/{slug}', function ($school, $slug) {
            abort_unless($school === 'smk', 404);

            $schoolModel = \App\Models\School::where('type', \App\Models\School::resolveDbType($school))->firstOrFail();

            $jurusan = \App\Models\SmkJurusan::where('school_id', $schoolModel->id)
                ->where('slug', $slug)
                ->where('is_active', true)
                ->firstOrFail();

            $otherJurusans = \App\Models\SmkJurusan::where('school_id', $schoolModel->id)
                ->where('is_active', true)
                ->where('id', '!=', $jurusan->id)
                ->orderBy('order_column')
                ->get();

            $prestasi = \App\Models\Prestasi::where('school_id', $schoolModel->id)
                ->published()
                ->take(12)
                ->get();

            return view('SMK.jurusan.show', compact('school', 'schoolModel', 'jurusan', 'otherJurusans', 'prestasi'));
        })->name('school.jurusan.show');
    });
