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

// =====================
// YAYASAN (MAIN SITE)
// =====================

Route::get('/', function () {
    $homepage = null;
    $pageContent = null;

    if (Schema::hasTable('pages')) {
        $pageContent = Page::whereNull('school_id')
            ->where('slug', 'yayasan-home')
            ->where('status', 'published')
            ->value('content');
    }

    if (Schema::hasTable('schools') && Schema::hasTable('school_homepage_settings')) {
        $yayasanSchool = School::whereRaw('LOWER(type) = ?', ['yayasan'])->first();
        $homepage = $yayasanSchool
            ? SchoolHomepageSetting::where('school_id', $yayasanSchool->id)->first()
            : null;
    }

    $yayasanPrincipals = is_array($homepage?->yayasan_principals)
        ? $homepage->yayasan_principals
        : [];

    $unitSchools = collect();
    $achievementItems = collect();
    $newsItems = collect();

    if ($yayasanSchool) {
        $unitSchools = School::query()
            ->whereRaw('LOWER(type) != ?', ['yayasan'])
            ->orderBy('name')
            ->get(['id', 'name', 'slug', 'type']);

        if (Schema::hasTable('prestasis')) {
            $achievementItems = Prestasi::query()
                ->where('school_id', $yayasanSchool->id)
                ->where('status', 'published')
                ->orderByDesc('featured')
                ->orderByDesc('published_at')
                ->take(6)
                ->get();
        }

        if (Schema::hasTable('news')) {
            $newsItems = News::query()
                ->where('school_id', $yayasanSchool->id)
                ->where('status', 'published')
                ->orderByDesc('featured')
                ->orderByDesc('published_at')
                ->take(4)
                ->get();
        }
    }

    return view('yayasan/index', compact('yayasanPrincipals', 'pageContent', 'unitSchools', 'achievementItems', 'newsItems', 'homepage'));
})->name('yayasan.home');

Route::get('/about', function () {
    $yayasanPrincipals = [];
    $pageContent = null;

    if (Schema::hasTable('pages')) {
        $pageContent = Page::whereNull('school_id')
            ->where('slug', 'yayasan-about')
            ->where('status', 'published')
            ->value('content');
    }

    if (Schema::hasTable('schools') && Schema::hasTable('school_homepage_settings')) {
        $yayasanSchool = School::whereRaw('LOWER(type) = ?', ['yayasan'])->first();
        $homepage = $yayasanSchool
            ? SchoolHomepageSetting::where('school_id', $yayasanSchool->id)->first()
            : null;

        $yayasanPrincipals = is_array($homepage?->yayasan_principals)
            ? $homepage->yayasan_principals
            : [];
    }

    return view('yayasan/about', compact('yayasanPrincipals', 'pageContent'));
})->name('yayasan.about');

Route::get('/daftar', function () {
    return view('auth/register');
})->name('daftar');

Route::get('/login', function () {
    return redirect('/admin/login');
})->name('login');

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
                'loc' => route('school.berita.detail', ['school' => $newsItem->school->slug, 'news' => $newsItem->id]),
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

Route::get('/fasilitas', function () {
    $facilityItems = collect();
    $pageContent = null;

    if (Schema::hasTable('pages')) {
        $pageContent = Page::whereNull('school_id')
            ->where('slug', 'yayasan-fasilitas')
            ->where('status', 'published')
            ->value('content');
    }

    if (Schema::hasTable('schools') && Schema::hasTable('gallery_items')) {
        $yayasanSchool = School::whereRaw('LOWER(type) = ?', ['yayasan'])->first();

        if ($yayasanSchool) {
            $facilityItems = GalleryItem::query()
                ->where('school_id', $yayasanSchool->id)
                ->where('status', 'published')
                ->orderByDesc('published_at')
                ->orderByDesc('created_at')
                ->get();
        }
    }

    return view('yayasan/fasilitas', compact('facilityItems', 'pageContent'));
})->name('yayasan.fasilitas');

Route::get('/akreditasi', function () {
    $prestasiItems = collect();
    $akreditasiItems = collect();
    $pageContent = null;

    if (Schema::hasTable('pages')) {
        $pageContent = Page::whereNull('school_id')
            ->where('slug', 'yayasan-akreditasi')
            ->where('status', 'published')
            ->value('content');
    }

    if (Schema::hasTable('schools') && Schema::hasTable('prestasis')) {
        $yayasanSchool = School::whereRaw('LOWER(type) = ?', ['yayasan'])->first();

        if ($yayasanSchool) {
            $prestasiItems = Prestasi::query()
                ->where('school_id', $yayasanSchool->id)
                ->where('status', 'published')
                ->orderByDesc('featured')
                ->orderByDesc('published_at')
                ->orderByDesc('created_at')
                ->get();

            $akreditasiItems = $prestasiItems->filter(function ($item) {
                $haystack = strtolower(trim(($item->category ?? '') . ' ' . ($item->title ?? '')));
                return str_contains($haystack, 'akreditasi');
            })->values();
        }
    }

    return view('yayasan/prestasi   ', compact('prestasiItems', 'akreditasiItems', 'pageContent'));
})->name('yayasan.akreditasi');

Route::get('/prestasi', function () {
    $prestasiItems = collect();
    $pageContent = null;

    if (Schema::hasTable('pages')) {
        $pageContent = Page::whereNull('school_id')
            ->where('slug', 'yayasan-prestasi')
            ->where('status', 'published')
            ->value('content');
    }

    if (Schema::hasTable('schools') && Schema::hasTable('prestasis')) {
        $yayasanSchool = School::whereRaw('LOWER(type) = ?', ['yayasan'])->first();

        if ($yayasanSchool) {
            $prestasiItems = Prestasi::query()
                ->where('school_id', $yayasanSchool->id)
                ->where('status', 'published')
                ->orderByDesc('featured')
                ->orderByDesc('published_at')
                ->orderByDesc('created_at')
                ->get();
        }
    }

    return view('yayasan/prestasi', compact('prestasiItems', 'pageContent'));
})->name('yayasan.prestasi');

Route::get('/berita', function () {
    $newsItems = collect();
    $featuredNews = null;
    $pageContent = null;

    if (Schema::hasTable('pages')) {
        $pageContent = Page::whereNull('school_id')
            ->where('slug', 'yayasan-berita')
            ->where('status', 'published')
            ->value('content');
    }

    if (Schema::hasTable('schools') && Schema::hasTable('news')) {
        $yayasanSchool = School::whereRaw('LOWER(type) = ?', ['yayasan'])->first();

        if ($yayasanSchool) {
            $newsItems = News::query()
                ->where('school_id', $yayasanSchool->id)
                ->where('status', 'published')
                ->orderByDesc('featured')
                ->orderByDesc('published_at')
                ->orderByDesc('created_at')
                ->get();

            $featuredNews = $newsItems->firstWhere('featured', true) ?? $newsItems->first();
        }
    }

    return view('yayasan/berita', compact('newsItems', 'featuredNews', 'pageContent'));
})->name('yayasan.berita');

Route::get('/berita/{slug}', function ($slug) {
    $news = null;

    if (Schema::hasTable('news')) {
        $news = News::where('slug', $slug)
            ->where('status', 'published')
            ->first();
    }

    if (!$news) {
        abort(404);
    }

    return view('yayasan/berita-detail', compact('news'));
})->name('yayasan.berita.show');

Route::get('/kontak', function () {
    $pageContent = null;
    $contactInfo = [
        'contact_whatsapp' => '6282112345678',
        'contact_email' => 'info@putrapakuan.sch.id',
        'contact_phone' => '+62 21 1234 5678',
        'contact_address' => 'Jl. Pakuan No. 1, Tegallega, Kecamatan Bogor Tengah, Kota Bogor, Jawa Barat 16129',
        'contact_map_url' => 'https://maps.google.com/?q=Yayasan+Putra+Pakuan+Bogor',
    ];

    if (Schema::hasTable('pages')) {
        $pageContent = Page::whereNull('school_id')
            ->where('slug', 'yayasan-kontak')
            ->where('status', 'published')
            ->value('content');
    }

    if (Schema::hasTable('schools') && Schema::hasTable('school_homepage_settings')) {
        $yayasanSchool = School::whereRaw('LOWER(type) = ?', ['yayasan'])->first();
        $homepage = $yayasanSchool
            ? SchoolHomepageSetting::where('school_id', $yayasanSchool->id)->first()
            : null;

        if ($homepage) {
            $contactInfo['contact_whatsapp'] = $homepage->contact_whatsapp ?: $contactInfo['contact_whatsapp'];
            $contactInfo['contact_email'] = $homepage->contact_email ?: $contactInfo['contact_email'];
            $contactInfo['contact_phone'] = $homepage->contact_phone ?: $contactInfo['contact_phone'];
            $contactInfo['contact_address'] = $homepage->contact_address ?: $contactInfo['contact_address'];
            $contactInfo['contact_map_url'] = $homepage->contact_map_url ?: $contactInfo['contact_map_url'];
        }
    }

    return view('yayasan/kontak', compact('pageContent', 'contactInfo'));
})->name('yayasan.kontak');

// Admin/Superadmin Dashboard (protected — defined below inside auth:admin middleware)

// Admin Auth
Route::get('/admin/login', [App\Http\Controllers\AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [App\Http\Controllers\AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin-protected routes
Route::middleware(['auth:admin', 'admin.access'])->group(function () {
    Route::get('/admin', function () {
        $user = Auth::guard('admin')->user();
        // Jenjang admins should start from PPDB management (year selection first)
        if ($user && !$user->isSuperAdmin()) {
            return redirect()->route('admin.ppdb.management', ['school' => $user->getSchoolSlug()]);
        }
        return view('admin.superadmin.dashboard');
    })->name('admin.dashboard');

    // CMS Management Index
    Route::get('/admin/cms', function () {
        return redirect()->route('admin.cms.schools');
    })->name('admin.cms.index');

    Route::resource('/admin/cms/pages', PageController::class)->middleware('auth:admin')->names('admin.cms.pages')->except(['show', 'destroy', 'create', 'store']);

    // CMS Detail Page
    Route::get('/admin/cms/detail', function () {
        return view('admin.superadmin.cms.detail');
    })->name('admin.cms.detail');

    // School selection page for CMS
    Route::get('/admin/cms/schools', function () {
        $user = Auth::guard('admin')->user();
        if ($user && !$user->isSuperAdmin()) {
            return redirect(url('/admin/cms/' . $user->getCmsType()));
        }
        $schools = School::all();
        return view('admin.superadmin.cms.schools', compact('schools'));
    })->name('admin.cms.schools');

    // CMS routes per school type
    Route::prefix('/admin/cms/{schoolType}')
        ->where(['schoolType' => 'smk|sd|smp|yayasan'])
        ->group(function () {
            Route::get('/', [CmsController::class, 'index'])->name('admin.cms.by_school');
            Route::post('/kepsek', [CmsController::class, 'updateKepsek'])->name('admin.cms.kepsek.update');
            Route::post('/contact', [CmsController::class, 'updateContactInfo'])->name('admin.cms.contact.update');
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
        });

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
    Route::get('/admin/ppdb/schools', function () {
        $user = Auth::guard('admin')->user();
        if ($user && !$user->isSuperAdmin()) {
            return redirect()->route('admin.ppdb.management', ['school' => $user->getSchoolSlug()]);
        }
        $schools = School::all();
        return view('admin.superadmin.ppdb.schools', compact('schools'));
    })->name('admin.ppdb.schools');

    // PPDB Applicant Management

    // SMK Applicants
    Route::get('/admin/ppdb/applicants/smk', function (Illuminate\Http\Request $request) {
        \App\Models\PpdbApplication::cleanupOldDrafts();

        $schoolModel = \App\Models\School::where('type', 'SMK')->first();

        $selectedYear = $request->query('year');
        $filterMajor = $request->query('major');
        $filterStatus = $request->query('status');

        $applicantQuery = \App\Models\PpdbApplication::where('school_type', 'SMK')
            ->whereIn('status', ['pending', 'payment_uploaded', 'accepted', 'rejected']);

        if (!empty($selectedYear) && preg_match('/^[0-9]{4}$/', $selectedYear)) {
            $applicantQuery->whereYear('created_at', intval($selectedYear));
        }

        if (!empty($filterMajor) && strtolower($filterMajor) !== 'all') {
            $applicantQuery->where(function ($q) use ($filterMajor) {
                $q->where('major_1', $filterMajor)
                    ->orWhere('major_2', $filterMajor)
                    ->orWhere('assigned_major', $filterMajor);
            });
        }

        if (!empty($filterStatus) && strtolower($filterStatus) !== 'all') {
            $applicantQuery->where('status', strtolower($filterStatus));
        }

        $pendingCount = (clone $applicantQuery)->whereIn('status', ['pending', 'payment_uploaded'])->count();
        $pendingOverallCount = \App\Models\PpdbApplication::where('school_type', 'SMK')
            ->whereIn('status', ['pending', 'payment_uploaded'])
            ->count();
        $applicants = $applicantQuery->orderBy('created_at', 'desc')->get();

        $capacityQuery = \App\Models\PpdbMajorCapacity::where('school_id', $schoolModel->id);
        if (!empty($selectedYear) && preg_match('/^[0-9]{4}$/', $selectedYear)) {
            $capacityQuery->where('year', $selectedYear . '/' . ($selectedYear + 1));
        }
        $capacities = $capacityQuery->get();

        return view('admin.superadmin.ppdb.smk.applicants', compact('applicants', 'schoolModel', 'capacities', 'selectedYear', 'pendingCount', 'pendingOverallCount'));
    })->name('admin.ppdb.applicants.smk');

    Route::get('/admin/ppdb/applicants/smk/data', function (Illuminate\Http\Request $request) {
        \App\Models\PpdbApplication::cleanupOldDrafts();

        $query = \App\Models\PpdbApplication::where('school_type', 'SMK')
            ->whereIn('status', ['pending', 'payment_uploaded', 'accepted', 'rejected']);

        if ($request->filled('year') && preg_match('/^[0-9]{4}$/', $request->query('year'))) {
            $query->whereYear('created_at', intval($request->query('year')));
        }
        if ($request->filled('major') && strtolower($request->query('major')) !== 'all') {
            $query->where(function ($q) use ($request) {
                $q->where('major_1', $request->query('major'))
                    ->orWhere('major_2', $request->query('major'))
                    ->orWhere('assigned_major', $request->query('major'));
            });
        }
        if ($request->filled('status') && strtolower($request->query('status')) !== 'all') {
            $query->where('status', strtolower($request->query('status')));
        }

        $applicants = $query->orderBy('created_at', 'desc')->get();

        $pending = $applicants->whereIn('status', ['pending', 'payment_uploaded'])->count();
        $pendingOverall = \App\Models\PpdbApplication::where('school_type', 'SMK')
            ->whereIn('status', ['pending', 'payment_uploaded'])
            ->count();

        return response()->json([
            'applicants' => $applicants->map(function ($item) {
                return [
                    'id' => $item->id,
                    'application_id' => $item->application_id,
                    'full_name' => $item->full_name,
                    'email' => $item->email,
                    'major_1' => $item->major_1,
                    'major_2' => $item->major_2,
                    'assigned_major' => $item->assigned_major,
                    'status' => $item->status,
                    'created_at' => $item->created_at ? $item->created_at->format('Y-m-d') : '-',
                ];
            }),
            'total' => $applicants->count(),
            'pending' => $pending,
            'pending_overall' => $pendingOverall,
        ]);
    })->name('admin.ppdb.applicants.smk.data');

    //smk applicant detail
    Route::get('/admin/ppdb/applicants/smk/{id}', function ($id) {
        $applicant = \App\Models\PpdbApplication::findOrFail($id);
        $schoolModel = \App\Models\School::where('type', 'SMK')->first();

        $referenceDate = $applicant->created_at ?: now();
        $yearStart = \Carbon\Carbon::parse($referenceDate)->year;
        $yearPeriod = $yearStart . '/' . ($yearStart + 1);

        $majorCandidates = array_filter([$applicant->major_1, $applicant->major_2]);

        $capacities = \App\Models\PpdbMajorCapacity::where('school_id', $schoolModel->id)
            ->where('year', $yearPeriod)
            ->get()
            ->keyBy(function ($item) {
                return trim(strtolower($item->major));
            });

        $assignedCounts = \App\Models\PpdbApplication::where('school_type', 'SMK')
            ->whereIn('status', ['accepted', 'accepted_major_1', 'accepted_major_2'])
            ->whereYear('created_at', $yearStart)
            ->get()
            ->map(function ($app) {
                return trim(strtolower($app->assigned_major ?? ''));
            })
            ->filter()
            ->countBy();

        $majorStats = [];
        foreach (['major_1' => $applicant->major_1, 'major_2' => $applicant->major_2] as $key => $major) {
            if (!$major) continue;
            $normalized = trim(strtolower($major));
            $capObj = $capacities[$normalized] ?? null;
            $majorStats[$major] = [
                'capacity' => $capObj ? $capObj->capacity : 0,
                'accepted' => $assignedCounts[$normalized] ?? 0,
            ];
        }

        return view('admin.superadmin.ppdb.smk.applicant_detail', compact('applicant', 'schoolModel', 'capacities', 'assignedCounts', 'majorStats', 'yearPeriod'));
    })->name('admin.ppdb.applicants.smk.detail');

    // Decision endpoint for SMK applicants
    Route::post('/admin/ppdb/applicants/smk/{id}/decision', [\App\Http\Controllers\PpdbApplicationDecisionController::class, 'decide'])->name('admin.ppdb.applicants.smk.decision');

    // SMP Applicants
    Route::get('/admin/ppdb/applicants/smp', function () {
        return redirect()->route('admin.ppdb.applicants.by_school', ['school' => 'smp-putra-pakuan']);
    })->name('admin.ppdb.applicants.smp');

    // Applicant detail by school (supports SMP/SD/SMK)
    Route::get('/admin/ppdb/applicants/{school}/{id}', function ($school, $id) {
        $schoolModel = \App\Models\School::where('slug', $school)->firstOrFail();
        $applicant = \App\Models\PpdbApplication::findOrFail($id);

        // Case-insensitive school type comparison
        if (strtoupper($applicant->school_type) !== strtoupper($schoolModel->type)) {
            abort(404);
        }

        $capacities = collect();
        $assignedCounts = collect();
        $majorStats = [];
        $yearPeriod = null;

        if ($schoolModel->type === 'SMK') {
            $referenceDate = $applicant->created_at ?: now();
            $yearStart = \Carbon\Carbon::parse($referenceDate)->year;
            $yearPeriod = $yearStart . '/' . ($yearStart + 1);

            $capacities = \App\Models\PpdbMajorCapacity::where('school_id', $schoolModel->id)
                ->where('year', $yearPeriod)
                ->get()
                ->keyBy(function ($item) {
                    return trim(strtolower($item->major));
                });

            $assignedCounts = \App\Models\PpdbApplication::where('school_type', 'SMK')
                ->whereIn('status', ['accepted', 'accepted_major_1', 'accepted_major_2'])
                ->whereYear('created_at', $yearStart)
                ->get()
                ->map(function ($app) {
                    return trim(strtolower($app->assigned_major ?? ''));
                })
                ->filter()
                ->countBy();

            foreach (['major_1' => $applicant->major_1, 'major_2' => $applicant->major_2] as $major) {
                if (!$major) {
                    continue;
                }
                $normalized = trim(strtolower($major));
                $capObj = $capacities[$normalized] ?? null;
                $majorStats[$major] = [
                    'capacity' => $capObj ? $capObj->capacity : 0,
                    'accepted' => $assignedCounts[$normalized] ?? 0,
                ];
            }
        }

        $view = 'admin.superadmin.ppdb.' . strtolower($schoolModel->type) . '.applicant_detail';
        if (!view()->exists($view)) {
            abort(404, 'Applicant detail view not found for this school.');
        }

        return view($view, compact('applicant', 'schoolModel', 'capacities', 'assignedCounts', 'majorStats', 'yearPeriod'));
    })->whereNumber('id')->name('admin.ppdb.applicants.by_school.detail');

    // Decision endpoint by school
    Route::post('/admin/ppdb/applicants/{school}/{id}/decision', [\App\Http\Controllers\PpdbApplicationDecisionController::class, 'decideBySchool'])
        ->whereNumber('id')
        ->name('admin.ppdb.applicants.by_school.decision');

    // PPDB Applicants by School (per jenjang view)
    Route::get('/admin/ppdb/applicants/{school}/data', function ($school, Illuminate\Http\Request $request) {
        \App\Models\PpdbApplication::cleanupOldDrafts();

        $schoolModel = \App\Models\School::where('slug', $school)->firstOrFail();

        $selectedYear = $request->query('year');
        $filterMajor = $request->query('major');
        $filterStatus = $request->query('status');
        $searchTerm = $request->query('search');

        $applicantsQuery = \App\Models\PpdbApplication::where('school_type', strtolower($schoolModel->type))
            ->whereIn('status', ['pending', 'payment_uploaded', 'accepted', 'rejected']);

        if ($searchTerm) {
            $applicantsQuery->where(function ($q) use ($searchTerm) {
                $q->where('full_name', 'like', "%{$searchTerm}%")
                    ->orWhere('email', 'like', "%{$searchTerm}%")
                    ->orWhere('application_id', 'like', "%{$searchTerm}%");
            });
        }

        if ($selectedYear && strtolower($selectedYear) !== 'all') {
            [$startYear] = explode('/', $selectedYear) + [null];
            if ($startYear && is_numeric($startYear)) {
                $applicantsQuery->whereYear('created_at', intval($startYear));
            }
        }

        if ($filterMajor && strtolower($filterMajor) !== 'all') {
            $applicantsQuery->where(function ($q) use ($filterMajor) {
                $q->where('major_1', $filterMajor)
                    ->orWhere('major_2', $filterMajor)
                    ->orWhere('assigned_major', $filterMajor);
            });
        }

        if ($filterStatus && strtolower($filterStatus) !== 'all') {
            $applicantsQuery->where('status', strtolower($filterStatus));
        }

        $pendingCount = (clone $applicantsQuery)->whereIn('status', ['pending', 'payment_uploaded'])->count();
        $perPage = 10;
        $page = $request->query('page', 1);

        $applicants = $applicantsQuery
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'applicants' => $applicants->getCollection()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'application_id' => $item->application_id,
                    'full_name' => $item->full_name,
                    'email' => $item->email,
                    'major_1' => $item->major_1,
                    'major_2' => $item->major_2,
                    'assigned_major' => $item->assigned_major,
                    'status' => $item->status,
                    'created_at' => $item->created_at ? $item->created_at->format('Y-m-d') : '-',
                ];
            })->toArray(),
            'total' => $applicants->total(),
            'pending' => $pendingCount,
            'current_page' => $applicants->currentPage(),
            'last_page' => $applicants->lastPage(),
            'per_page' => $applicants->perPage(),
            'from' => $applicants->firstItem(),
            'to' => $applicants->lastItem(),
        ]);
    })->name('admin.ppdb.applicants.by_school.data');

    Route::get('/admin/ppdb/applicants/{school}/export', function ($school, Illuminate\Http\Request $request) {
        \App\Models\PpdbApplication::cleanupOldDrafts();

        $schoolModel = \App\Models\School::where('slug', $school)->firstOrFail();

        $selectedYear = $request->query('year');
        $filterMajor = $request->query('major');
        $filterStatus = $request->query('status');
        $searchTerm = $request->query('search');

        $applicantsQuery = \App\Models\PpdbApplication::where('school_type', strtolower($schoolModel->type))
            ->whereIn('status', ['pending', 'payment_uploaded', 'accepted', 'rejected']);

        if ($selectedYear && strtolower($selectedYear) !== 'all') {
            [$startYear] = explode('/', $selectedYear) + [null];
            if ($startYear && is_numeric($startYear)) {
                $applicantsQuery->whereYear('created_at', intval($startYear));
            }
        }

        if ($filterMajor && strtolower($filterMajor) !== 'all') {
            $applicantsQuery->where(function ($q) use ($filterMajor) {
                $q->where('major_1', $filterMajor)
                    ->orWhere('major_2', $filterMajor)
                    ->orWhere('assigned_major', $filterMajor);
            });
        }

        if ($filterStatus && strtolower($filterStatus) !== 'all') {
            $applicantsQuery->where('status', strtolower($filterStatus));
        }

        if ($searchTerm) {
            $applicantsQuery->where(function ($q) use ($searchTerm) {
                $q->where('full_name', 'like', "%{$searchTerm}%")
                    ->orWhere('email', 'like', "%{$searchTerm}%")
                    ->orWhere('application_id', 'like', "%{$searchTerm}%");
            });
        }

        $applicants = $applicantsQuery->orderBy('created_at', 'desc')->get();

        $filename = 'ppdb_applicants_' . $schoolModel->slug . '_' . now()->format('YmdHis') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $columns = [
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
            'Updated At'
        ];

        $callback = function () use ($applicants, $columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);

            foreach ($applicants as $item) {
                fputcsv($handle, [
                    $item->id,
                    $item->application_id,
                    $item->school_type,
                    $item->full_name,
                    $item->email,
                    $item->phone,
                    $item->date_of_birth ? $item->date_of_birth->format('Y-m-d') : '',
                    $item->place_of_birth,
                    $item->gender,
                    $item->address,
                    $item->previous_school,
                    $item->nisn,
                    $item->average_grade,
                    $item->status,
                    is_array($item->status_history) ? json_encode($item->status_history) : $item->status_history,
                    is_array($item->uploaded_documents) ? json_encode($item->uploaded_documents) : $item->uploaded_documents,
                    $item->payment_amount,
                    $item->payment_method,
                    $item->payment_proof,
                    $item->payment_date ? $item->payment_date->format('Y-m-d H:i:s') : '',
                    $item->interview_date ? $item->interview_date->format('Y-m-d H:i:s') : '',
                    $item->interview_notes,
                    $item->admission_date ? $item->admission_date->format('Y-m-d H:i:s') : '',
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
                    $item->created_at ? $item->created_at->format('Y-m-d H:i:s') : '',
                    $item->updated_at ? $item->updated_at->format('Y-m-d H:i:s') : '',
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    })->name('admin.ppdb.applicants.by_school.export');


    Route::get('/admin/ppdb/applicants/{school}/export.xlsx', function ($school, Illuminate\Http\Request $request) {
        \App\Models\PpdbApplication::cleanupOldDrafts();

        $schoolModel = \App\Models\School::where('slug', $school)->firstOrFail();

        $selectedYear = $request->query('year');
        $filterMajor = $request->query('major');
        $filterStatus = $request->query('status');
        $searchTerm = $request->query('search');

        $applicantsQuery = \App\Models\PpdbApplication::where('school_type', strtolower($schoolModel->type))
            ->whereIn('status', ['pending', 'payment_uploaded', 'accepted', 'rejected']);

        if ($selectedYear && strtolower($selectedYear) !== 'all') {
            [$startYear] = explode('/', $selectedYear) + [null];
            if ($startYear && is_numeric($startYear)) {
                $applicantsQuery->whereYear('created_at', intval($startYear));
            }
        }

        if ($filterMajor && strtolower($filterMajor) !== 'all') {
            $applicantsQuery->where(function ($q) use ($filterMajor) {
                $q->where('major_1', $filterMajor)
                    ->orWhere('major_2', $filterMajor)
                    ->orWhere('assigned_major', $filterMajor);
            });
        }

        if ($filterStatus && strtolower($filterStatus) !== 'all') {
            $applicantsQuery->where('status', strtolower($filterStatus));
        }

        if ($searchTerm) {
            $applicantsQuery->where(function ($q) use ($searchTerm) {
                $q->where('full_name', 'like', "%{$searchTerm}%")
                    ->orWhere('email', 'like', "%{$searchTerm}%")
                    ->orWhere('application_id', 'like', "%{$searchTerm}%");
            });
        }

        $applicants = $applicantsQuery->orderBy('created_at', 'desc')->get();

        if (!class_exists(\PhpOffice\PhpSpreadsheet\Spreadsheet::class)) {
            // Fallback to CSV when PhpSpreadsheet is unavailable.
            $filename = 'ppdb_applicants_' . $schoolModel->slug . '_' . now()->format('YmdHis') . '.csv';
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ];

            $columns = [
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
                'Updated At'
            ];

            $callback = function () use ($applicants, $columns) {
                $handle = fopen('php://output', 'w');
                fputcsv($handle, $columns);

                foreach ($applicants as $item) {
                    fputcsv($handle, [
                        $item->id,
                        $item->application_id,
                        $item->school_type,
                        $item->full_name,
                        $item->email,
                        $item->phone,
                        $item->date_of_birth ? $item->date_of_birth->format('Y-m-d') : '',
                        $item->place_of_birth,
                        $item->gender,
                        $item->address,
                        $item->previous_school,
                        $item->nisn,
                        $item->average_grade,
                        $item->status,
                        is_array($item->status_history) ? json_encode($item->status_history) : $item->status_history,
                        is_array($item->uploaded_documents) ? json_encode($item->uploaded_documents) : $item->uploaded_documents,
                        $item->payment_amount,
                        $item->payment_method,
                        $item->payment_proof,
                        $item->payment_date ? $item->payment_date->format('Y-m-d H:i:s') : '',
                        $item->interview_date ? $item->interview_date->format('Y-m-d H:i:s') : '',
                        $item->interview_notes,
                        $item->admission_date ? $item->admission_date->format('Y-m-d H:i:s') : '',
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
                        $item->created_at ? $item->created_at->format('Y-m-d H:i:s') : '',
                        $item->updated_at ? $item->updated_at->format('Y-m-d H:i:s') : '',
                    ]);
                }

                fclose($handle);
            };

            return response()->stream($callback, 200, $headers);
        }

        // Re-use the $applicants collection already built above
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [
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
            'Updated At'
        ];

        $sheet->fromArray($headers, null, 'A1');

        $row = 2;
        foreach ($applicants as $item) {
            $sheet->fromArray([
                $item->id,
                $item->application_id,
                $item->school_type,
                $item->full_name,
                $item->email,
                $item->phone,
                $item->date_of_birth ? $item->date_of_birth->format('Y-m-d') : '',
                $item->place_of_birth,
                $item->gender,
                $item->address,
                $item->previous_school,
                $item->nisn,
                $item->average_grade,
                $item->status,
                is_array($item->status_history) ? json_encode($item->status_history) : $item->status_history,
                is_array($item->uploaded_documents) ? json_encode($item->uploaded_documents) : $item->uploaded_documents,
                $item->payment_amount,
                $item->payment_method,
                $item->payment_proof,
                $item->payment_date ? $item->payment_date->format('Y-m-d H:i:s') : '',
                $item->interview_date ? $item->interview_date->format('Y-m-d H:i:s') : '',
                $item->interview_notes,
                $item->admission_date ? $item->admission_date->format('Y-m-d H:i:s') : '',
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
                $item->created_at ? $item->created_at->format('Y-m-d H:i:s') : '',
                $item->updated_at ? $item->updated_at->format('Y-m-d H:i:s') : '',
            ], null, 'A' . $row);
            $row++;
        }

        $sheet->setAutoFilter($sheet->calculateWorksheetDimension());
        foreach (range('A', $sheet->getHighestDataColumn()) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'ppdb_applicants_' . $schoolModel->slug . '_' . now()->format('YmdHis') . '.xlsx';

        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        return response()->stream(function () use ($writer) {
            $writer->save('php://output');
        }, 200, $headers);
    })->name('admin.ppdb.applicants.by_school.export.xlsx');


    Route::get('/admin/ppdb/applicants/{school}', function ($school) {
        \App\Models\PpdbApplication::cleanupOldDrafts();

        $schoolModel = \App\Models\School::where('slug', $school)->firstOrFail();

        $selectedYear = request()->query('year');
        $filterMajor = request()->query('major');
        $filterStatus = request()->query('status');

        $applicantsQuery = \App\Models\PpdbApplication::where('school_type', strtolower($schoolModel->type))
            ->whereIn('status', ['pending', 'payment_uploaded', 'accepted', 'rejected']);

        if ($selectedYear) {
            [$startYear] = explode('/', $selectedYear) + [null];
            if ($startYear && is_numeric($startYear)) {
                $applicantsQuery->whereYear('created_at', intval($startYear));
            }
        }

        if ($filterMajor && strtolower($filterMajor) !== 'all') {
            $applicantsQuery->where(function ($q) use ($filterMajor) {
                $q->where('major_1', $filterMajor)
                    ->orWhere('major_2', $filterMajor)
                    ->orWhere('assigned_major', $filterMajor);
            });
        }

        if ($filterStatus && strtolower($filterStatus) !== 'all') {
            $applicantsQuery->where('status', strtolower($filterStatus));
        }

        $applicants = $applicantsQuery->orderBy('created_at', 'desc')->get();

        $capacityQuery = \App\Models\PpdbMajorCapacity::where('school_id', $schoolModel->id);
        if ($selectedYear) {
            [$startYear] = explode('/', $selectedYear) + [null];
            if ($startYear && is_numeric($startYear)) {
                $capacityQuery->where('year', $startYear . '/' . (intval($startYear) + 1));
            }
        }
        $capacities = $capacityQuery->get();

        $view = 'admin.superadmin.ppdb.' . strtolower($schoolModel->type) . '.applicants';
        if (view()->exists($view)) {
            return view($view, compact('applicants', 'schoolModel', 'selectedYear', 'capacities'));
        }
        // fallback to generic applicants if not found
        return view('admin.superadmin.ppdb.applicants', compact('applicants', 'schoolModel', 'selectedYear', 'capacities'));
    })->name('admin.ppdb.applicants.by_school');

    // User Management (Superadmin)
    Route::get('/admin/user-management', function () {
        $allAdmins = \App\Models\User::where('is_admin', true)
            ->where('admin_role', '!=', 'superadmin')
            ->orderBy('name')
            ->get()
            ->groupBy('admin_role');
        return view('admin.superadmin.user_management', compact('allAdmins'));
    })->name('admin.user_management');

    Route::post('/admin/users', function (\Illuminate\Http\Request $request) {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|string|min:8|confirmed',
            'admin_role' => 'required|in:smk_admin,smp_admin,sd_admin',
        ]);
        \App\Models\User::create([
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'password'   => bcrypt($validated['password']),
            'is_admin'   => true,
            'admin_role' => $validated['admin_role'],
        ]);
        return redirect()->route('admin.user_management')->with('success', 'Admin berhasil ditambahkan.');
    })->name('admin.users.store');

    Route::patch('/admin/users/{user}', function (\Illuminate\Http\Request $request, \App\Models\User $user) {
        if ($user->isSuperAdmin()) {
            return redirect()->route('admin.user_management')->with('error', 'Superadmin tidak dapat diubah.');
        }
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        $data = ['name' => $validated['name'], 'email' => $validated['email']];
        if (!empty($validated['password'])) {
            $data['password'] = bcrypt($validated['password']);
        }
        $user->update($data);
        return redirect()->route('admin.user_management')->with('success', 'Admin berhasil diperbarui.');
    })->name('admin.users.update');

    Route::delete('/admin/users/{user}', function (\App\Models\User $user) {
        if ($user->isSuperAdmin()) {
            return redirect()->route('admin.user_management')->with('error', 'Superadmin tidak dapat dihapus.');
        }
        $user->delete();
        return redirect()->route('admin.user_management')->with('success', 'Admin berhasil dihapus.');
    })->name('admin.users.destroy');
});

// Google OAuth routes
// All school redirects use a single callback URL (config GOOGLE_REDIRECT_URI).
Route::get('/auth/google/redirect', function () {
    session(['ppdb_school' => 'smk']);
    return Socialite::driver('google')->redirect();
})->name('google.redirect');

Route::get('/auth/google/callback', function () {
    $school = session('ppdb_school', 'smk');
    try {
        $googleUser = Socialite::driver('google')->user();

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName() ?? $googleUser->getNickname() ?? 'User',
                'password' => bcrypt(uniqid()),
            ]
        );

        Auth::login($user);

        $ppdb = \App\Models\PpdbApplication::firstOrCreate(
            [
                'email' => $user->email,
                'school_type' => strtoupper($school),
            ],
            [
                'full_name' => $user->name,
                'status' => 'draft',
                'application_id' => 'PPDB-' . date('Y') . '-' . strtoupper(substr(md5($user->email . $school), 0, 6)),
                'password' => bcrypt(uniqid()),
                'assigned_major' => null,
            ]
        );

        if (!$ppdb->full_name) $ppdb->full_name = $user->name;
        if (!$ppdb->application_id) $ppdb->application_id = 'PPDB-' . date('Y') . '-' . strtoupper(substr(md5($user->email . $school), 0, 6));
        if (!$ppdb->password) $ppdb->password = bcrypt(uniqid());
        if (!$ppdb->status) $ppdb->status = 'draft';
        if (!$ppdb->last_registration_step) {
            $ppdb->last_registration_step = 'biodata';
        }
        $ppdb->save();

        Auth::guard('ppdb_applications')->login($ppdb);

        $nextStep = $ppdb->last_registration_step;
        if (!$nextStep && $ppdb->status === 'draft') {
            $nextStep = 'biodata';
        }

        if ($nextStep && $nextStep !== 'done') {
            switch ($nextStep) {
                case 'jurusan_berkas':
                    return redirect()->route('ppdb.berkas', ['school' => $school]);
                case 'payment':
                    return redirect()->route('ppdb.payment', ['school' => $school]);
                default:
                    return redirect()->route('ppdb.biodata', ['school' => $school]);
            }
        }

        return redirect()->route('ppdb.dashboard', ['school' => $school]);
    } catch (\Exception $e) {
        Log::error('Google OAuth callback error: ' . $e->getMessage());
        return redirect()->route('ppdb.login', ['school' => $school])->withErrors(['google' => 'Gagal login dengan Google. Silakan coba lagi atau gunakan metode lain.']);
    }
})->name('google.callback');

// Per-school Google redirect — stores school in session then uses the same single callback URL
Route::get('/{school}/auth/google/redirect', function ($school) {
    session(['ppdb_school' => $school]);
    return Socialite::driver('google')->redirect();
})->where('school', 'sd|smp|smk')->name('google.redirect.by.school');

// Keep the per-school callback URL as an alias so old bookmarks / links still work
Route::get('/{school}/auth/google/callback', function ($school) {
    try {
        $googleUser = Socialite::driver('google')->user();

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName() ?? $googleUser->getNickname() ?? 'User',
                'password' => bcrypt(uniqid()),
            ]
        );

        Auth::login($user);

        $ppdb = \App\Models\PpdbApplication::firstOrCreate(
            [
                'email' => $user->email,
                'school_type' => $school,
            ],
            [
                'full_name' => $user->name,
                'status' => 'draft',
                'application_id' => 'PPDB-' . date('Y') . '-' . strtoupper(substr(md5($user->email . $school), 0, 6)),
                'password' => bcrypt(uniqid()),
                'assigned_major' => null,
            ]
        );

        if (!$ppdb->full_name) $ppdb->full_name = $user->name;
        if (!$ppdb->application_id) $ppdb->application_id = 'PPDB-' . date('Y') . '-' . strtoupper(substr(md5($user->email . $school), 0, 6));
        if (!$ppdb->password) $ppdb->password = bcrypt(uniqid());
        if (!$ppdb->status) $ppdb->status = 'draft';
        if (!$ppdb->last_registration_step) {
            $ppdb->last_registration_step = 'biodata';
        }
        $ppdb->save();

        Auth::guard('ppdb_applications')->login($ppdb);

        $nextStep = $ppdb->last_registration_step;
        if (!$nextStep && $ppdb->status === 'draft') {
            $nextStep = 'biodata';
        }

        if ($nextStep && $nextStep !== 'done') {
            switch ($nextStep) {
                case 'jurusan_berkas':
                    return redirect()->route('ppdb.berkas', ['school' => $school]);
                case 'payment':
                    return redirect()->route('ppdb.payment', ['school' => $school]);
                default:
                    return redirect()->route('ppdb.biodata', ['school' => $school]);
            }
        }

        return redirect()->route('ppdb.dashboard', ['school' => $school]);
    } catch (\Exception $e) {
        Log::error('Google OAuth callback error (school=' . $school . '): ' . $e->getMessage());
        return redirect()->route('ppdb.login', ['school' => $school])->withErrors(['google' => 'Gagal login dengan Google. Silakan coba lagi atau gunakan metode lain.']);
    }
})->where('school', 'sd|smp|smk')->name('google.callback.by.school');

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

        Route::get('/visi', fn($school) => $render($school, 'visi'))->name('school.visi');

        Route::get('/profil', fn($school) => $render($school, 'profil'))->name('school.profil');

        Route::get('/ppdb', fn($school) => $render($school, 'ppdb.index'))->name('school.ppdb');

        // PPDB Authentication Routes (now per jenjang, with pretty URLs)
        Route::get('/login', fn($school) => view(strtoupper($school) . '.ppdb.login', compact('school')))->name('ppdb.login');
        Route::get('/daftar', fn($school) => view(strtoupper($school) . '.ppdb.register', compact('school')))->name('ppdb.register');
        Route::post('/login', [App\Http\Controllers\PpdbAuthController::class, 'login'])->name('ppdb.login.post');
        Route::post('/logout', [App\Http\Controllers\PpdbAuthController::class, 'logout'])->name('ppdb.logout');
        Route::post('/daftar', [App\Http\Controllers\PpdbAuthController::class, 'register'])->name('ppdb.register.post');

        // PPDB Routes (Frontend Development - Auth will be added later)
        Route::get('/ppdb/dashboard', [App\Http\Controllers\PpdbAuthController::class, 'dashboard'])->name('ppdb.dashboard');
        Route::get('/ppdb/biodata', fn($school) => $render($school, 'ppdb.biodata'))->name('ppdb.biodata');
        // Biodata update POST route
        Route::post('/ppdb/biodata', [App\Http\Controllers\PpdbAuthController::class, 'updateBiodata'])->name('ppdb.biodata.update');
        Route::get('/ppdb/berkas', fn($school) => $render($school, 'ppdb.berkas'))->name('ppdb.berkas');
        Route::post('/ppdb/berkas', [App\Http\Controllers\PpdbAuthController::class, 'updateBerkas'])->name('ppdb.berkas.update');
        Route::get('/ppdb/payment', fn($school) => $render($school, 'ppdb.payment'))->name('ppdb.payment');
        Route::post('/ppdb/payment', [App\Http\Controllers\PpdbAuthController::class, 'updatePayment'])->name('ppdb.payment.update');
        Route::get('/ppdb/profil', fn($school) => $render($school, 'ppdb.profil'))->name('ppdb.profil');

        Route::get('/program', fn($school) => $render($school, 'program'))->name('school.program');

        Route::get('/kesiswaan', fn($school) => $render($school, 'kesiswaan'))->name('school.kesiswaan');

        Route::get('/prestasi', function ($school) {
            $schoolModel = \App\Models\School::where('type', strtoupper($school))->firstOrFail();

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
            $schoolType = strtoupper($school);
            $schoolModel = School::where('type', $schoolType)->firstOrFail();

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

        Route::get('/berita/detail/{news}', [\App\Http\Controllers\SchoolNewsController::class, 'show'])->name('school.berita.detail');

        Route::get('/direktori/guru', [\App\Http\Controllers\SchoolHomeController::class, 'teacherDirectory'])->name('school.direktori.guru');

        Route::get('/direktori/siswa', function ($school) {
            $view = strtoupper($school) . '.direktori_siswa';

            if (view()->exists($view)) {
                return view($view, compact('school'));
            }

            abort(404);
        })->name('school.direktori.siswa');
    });
