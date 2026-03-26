<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\School;
use App\Models\PpdbManagementPhase;

// =====================
// YAYASAN (MAIN SITE)
// =====================
Route::get('/', function () {
    return view('yayasan/index');
})->name('yayasan.home');

Route::get('/about', function () {
    return view('yayasan/about');
})->name('yayasan.about');

Route::get('/daftar', function () {
    return view('auth/register');
})->name('daftar');

Route::get('/login', function () {
    return redirect('/admin/login');
})->name('login');

Route::get('/fasilitas', function () {
    return view('yayasan/fasilitas');
})->name('yayasan.fasilitas');

Route::get('/akreditasi', function () {
    return view('yayasan/akreditasi');
})->name('yayasan.akreditasi');

Route::get('/berita', function () {
    return view('yayasan/berita');
})->name('yayasan.berita');

Route::get('/kontak', function () {
    return view('yayasan/kontak');
})->name('yayasan.kontak');

Route::get('/admin', function () {
    return view('admin.superadmin.dashboard');
});

// Admin/Superadmin Dashboard
Route::get('/admin', function () {
    return view('admin.superadmin.dashboard');
});

// Admin Auth
Route::get('/admin/login', [App\Http\Controllers\AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [App\Http\Controllers\AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin-protected routes
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.superadmin.dashboard');
    })->name('admin.dashboard');

    // CMS Management Index
    Route::get('/admin/cms', function () {
        return redirect()->route('admin.cms.schools');
    })->name('admin.cms.index');

    Route::resource('/admin/cms/pages', App\Http\Controllers\Admin\PageController::class)->middleware('auth:admin')->names('admin.cms.pages')->except(['show', 'destroy', 'create', 'store']);

    // CMS Detail Page
    Route::get('/admin/cms/detail', function () {
        return view('admin.superadmin.cms.detail');
    })->name('admin.cms.detail');

    // School selection page for CMS
    //smk
    Route::get('/admin/cms/schools', function () {
        $schools = School::all();
        return view('admin.superadmin.cms.schools', compact('schools'));
    })->name('admin.cms.schools');

    Route::get('/admin/cms/{schoolType}', [\App\Http\Controllers\Admin\CmsController::class, 'index'])
        ->where('schoolType', 'smk|sd|smp')
        ->name('admin.cms.by_school');

    Route::post('/admin/cms/{schoolType}/kepsek', [\App\Http\Controllers\Admin\CmsController::class, 'updateKepsek'])
        ->where('schoolType', 'smk|sd|smp')
        ->name('admin.cms.kepsek.update');

    Route::get('/admin/cms/{schoolType}/berita', [\App\Http\Controllers\Admin\NewsAdminController::class, 'index'])
        ->where('schoolType', 'smk|sd|smp')
        ->name('admin.cms.berita.index');

    Route::get('/admin/cms/{schoolType}/berita/create', [\App\Http\Controllers\Admin\NewsAdminController::class, 'create'])
        ->where('schoolType', 'smk|sd|smp')
        ->name('admin.cms.berita.create');

    Route::post('/admin/cms/{schoolType}/galeri', [\App\Http\Controllers\Admin\GalleryAdminController::class, 'store'])
        ->where('schoolType', 'smk|sd|smp')
        ->name('admin.cms.galeri.store');

    Route::get('/admin/cms/{schoolType}/galeri', [\App\Http\Controllers\Admin\GalleryAdminController::class, 'index'])
        ->where('schoolType', 'smk|sd|smp')
        ->name('admin.cms.galeri.index');

    Route::get('/admin/cms/{schoolType}/galeri/create', [\App\Http\Controllers\Admin\GalleryAdminController::class, 'create'])
        ->where('schoolType', 'smk|sd|smp')
        ->name('admin.cms.galeri.create');

    // Carousel management for hero section
    Route::get('/admin/cms/{schoolType}/carousel', [\App\Http\Controllers\Admin\CarouselAdminController::class, 'index'])
        ->where('schoolType', 'smk|sd|smp')
        ->name('admin.cms.carousel.index');

    Route::get('/admin/cms/{schoolType}/carousel/create', [\App\Http\Controllers\Admin\CarouselAdminController::class, 'create'])
        ->where('schoolType', 'smk|sd|smp')
        ->name('admin.cms.carousel.create');

    Route::post('/admin/cms/{schoolType}/carousel', [\App\Http\Controllers\Admin\CarouselAdminController::class, 'store'])
        ->where('schoolType', 'smk|sd|smp')
        ->name('admin.cms.carousel.store');

    Route::get('/admin/cms/{schoolType}/carousel/{carousel}/edit', [\App\Http\Controllers\Admin\CarouselAdminController::class, 'edit'])
        ->where('schoolType', 'smk|sd|smp')
        ->name('admin.cms.carousel.edit');

    Route::put('/admin/cms/{schoolType}/carousel/{carousel}', [\App\Http\Controllers\Admin\CarouselAdminController::class, 'update'])
        ->where('schoolType', 'smk|sd|smp')
        ->name('admin.cms.carousel.update');

    Route::delete('/admin/cms/{schoolType}/carousel/{carousel}', [\App\Http\Controllers\Admin\CarouselAdminController::class, 'destroy'])
        ->where('schoolType', 'smk|sd|smp')
        ->name('admin.cms.carousel.destroy');

    Route::get('/admin/cms/{schoolType}/galeri/{id}/edit', [\App\Http\Controllers\Admin\GalleryAdminController::class, 'edit'])
        ->where('schoolType', 'smk|sd|smp')
        ->name('admin.cms.galeri.edit');

    Route::put('/admin/cms/{schoolType}/galeri/{id}', [\App\Http\Controllers\Admin\GalleryAdminController::class, 'update'])
        ->where('schoolType', 'smk|sd|smp')
        ->name('admin.cms.galeri.update');

    Route::delete('/admin/cms/{schoolType}/galeri/{id}', [\App\Http\Controllers\Admin\GalleryAdminController::class, 'destroy'])
        ->where('schoolType', 'smk|sd|smp')
        ->name('admin.cms.galeri.destroy');

    Route::post('/admin/cms/{schoolType}/berita', [\App\Http\Controllers\Admin\NewsAdminController::class, 'store'])
        ->where('schoolType', 'smk|sd|smp')
        ->name('admin.cms.berita.store');

    Route::get('/admin/cms/{schoolType}/berita/{news}/edit', [\App\Http\Controllers\Admin\NewsAdminController::class, 'edit'])
        ->where('schoolType', 'smk|sd|smp')
        ->name('admin.cms.berita.edit');

    Route::put('/admin/cms/{schoolType}/berita/{news}', [\App\Http\Controllers\Admin\NewsAdminController::class, 'update'])
        ->where('schoolType', 'smk|sd|smp')
        ->name('admin.cms.berita.update');

    Route::post('/admin/cms/{schoolType}/berita/{news}/toggle-featured', [\App\Http\Controllers\Admin\NewsAdminController::class, 'toggleFeatured'])
        ->where('schoolType', 'smk|sd|smp')
        ->name('admin.cms.berita.toggle_featured');

    Route::delete('/admin/cms/{schoolType}/berita/{news}', [\App\Http\Controllers\Admin\NewsAdminController::class, 'destroy'])
        ->where('schoolType', 'smk|sd|smp')
        ->name('admin.cms.berita.destroy');

    // Teacher & Staff Management Routes
    Route::get('/admin/cms/{schoolType}/guru', [\App\Http\Controllers\Admin\TeacherStaffAdminController::class, 'index'])
        ->where('schoolType', 'smk|sd|smp')
        ->name('admin.cms.guru.index');

    Route::get('/admin/cms/{schoolType}/guru/create', [\App\Http\Controllers\Admin\TeacherStaffAdminController::class, 'create'])
        ->where('schoolType', 'smk|sd|smp')
        ->name('admin.cms.guru.create');

    Route::post('/admin/cms/{schoolType}/guru', [\App\Http\Controllers\Admin\TeacherStaffAdminController::class, 'store'])
        ->where('schoolType', 'smk|sd|smp')
        ->name('admin.cms.guru.store');

    Route::get('/admin/cms/{schoolType}/guru/{guru}/edit', [\App\Http\Controllers\Admin\TeacherStaffAdminController::class, 'edit'])
        ->where('schoolType', 'smk|sd|smp')
        ->name('admin.cms.guru.edit');

    Route::put('/admin/cms/{schoolType}/guru/{guru}', [\App\Http\Controllers\Admin\TeacherStaffAdminController::class, 'update'])
        ->where('schoolType', 'smk|sd|smp')
        ->name('admin.cms.guru.update');

    Route::delete('/admin/cms/{schoolType}/guru/{guru}', [\App\Http\Controllers\Admin\TeacherStaffAdminController::class, 'destroy'])
        ->where('schoolType', 'smk|sd|smp')
        ->name('admin.cms.guru.destroy');

    // PPDB Management for selected school (per jenjang view)
    Route::get('/admin/ppdb/management/{school}', function ($school) {
        $schoolModel = \App\Models\School::where('slug', $school)->firstOrFail();
        $phases = \App\Models\PpdbManagementPhase::where('school_id', $schoolModel->id)->orderBy('start_date')->get();
        // Render the correct view for each jenjang
        $view = 'admin.superadmin.ppdb.' . strtolower($schoolModel->type) . '.management';
        if (view()->exists($view)) {
            return view($view, [
                'phases' => $phases,
                'school' => $schoolModel
            ]);
        }
        // fallback to generic management if not found
        return view('admin.superadmin.ppdb.management', [
            'phases' => $phases,
            'school' => $schoolModel
        ]);
    })->name('admin.ppdb.management');

    // School selection page for PPDB
    Route::get('/admin/ppdb/schools', function () {
        $schools = School::all();
        return view('admin.superadmin.ppdb.schools', compact('schools'));
    })->name('admin.ppdb.schools');

    // PPDB Applicant Management
    // Route::get('/admin/ppdb/applicants', function () {
    //     return view('admin.superadmin.ppdb.applicants');
    // })->name('admin.ppdb.applicants');

    //smk
    Route::get('/admin/ppdb/applicants/smk', function () {
        $schoolModel = \App\Models\School::where('type', 'SMK')->first();
        $applicants = \App\Models\PpdbApplication::where('school_type', 'SMK')->get();
        return view('admin.superadmin.ppdb.smk.applicants', compact('applicants', 'schoolModel'));
    })->name('admin.ppdb.applicants.smk');

    //smk applicant detail
    Route::get('/admin/ppdb/applicants/smk/{id}', function ($id) {
        $applicant = \App\Models\PpdbApplication::findOrFail($id);
        return view('admin.superadmin.ppdb.smk.applicant_detail', compact('applicant'));
    })->name('admin.ppdb.applicants.smk.detail');

    // Decision endpoint for SMK applicants
    Route::post('/admin/ppdb/applicants/smk/{id}/decision', [\App\Http\Controllers\PpdbApplicationDecisionController::class, 'decide'])->name('admin.ppdb.applicants.smk.decision');

    //smp
    Route::get('/admin/ppdb/applicants/smp', function () {
        return view('admin.superadmin.ppdb.smp.applicants');
    })->name('admin.ppdb.applicants.smp');

    // Route for applicant detail view
    // Route::get('/admin/ppdb/applicants/{id}', function ($id) {
    //     // You can replace this with controller logic as needed
    //     return view('admin.superadmin.ppdb.applicant_detail');
    // })->name('admin.ppdb.applicant_detail');

    // PPDB Applicant Management by School (per jenjang view)
    Route::get('/admin/ppdb/applicants/{school}', function ($school) {
        $schoolModel = \App\Models\School::where('slug', $school)->firstOrFail();
        $applicants = \App\Models\PpdbApplication::where('school_type', $schoolModel->type)->get();
        $view = 'admin.superadmin.ppdb.' . strtolower($schoolModel->type) . '.applicants';
        if (view()->exists($view)) {
            return view($view, compact('applicants', 'schoolModel'));
        }
        // fallback to generic applicants if not found
        return view('admin.superadmin.ppdb.applicants', compact('applicants', 'schoolModel'));
    })->name('admin.ppdb.applicants.by_school');

    // User Management (Superadmin)
    Route::get('/admin/user-management', function () {
        return view('admin.superadmin.user_management');
    })->name('admin.user_management');
});

// Google OAuth routes
Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('google.redirect');

Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->user();
    // Find or create user in users table
    $user = User::firstOrCreate(
        ['email' => $googleUser->getEmail()],
        [
            'name' => $googleUser->getName() ?? $googleUser->getNickname() ?? 'User',
            'password' => bcrypt(uniqid()),
        ]
    );
    Auth::login($user);

    // Also create or update PPDB application for this user (SMK by default)
    \App\Models\PpdbApplication::firstOrCreate(
        [
            'email' => $user->email,
            'school_type' => 'smk',
        ],
        [
            'full_name' => $user->name,
            'status' => 'draft',
            'application_id' => 'PPDB-' . date('Y') . '-' . strtoupper(substr(md5($user->email), 0, 6)),
            'password' => bcrypt(uniqid()), // Add a default password for DB constraint
        ]
    );

    // After login, redirect to /smk/ppdb/biodata for the correct school
    return redirect('/smk/ppdb/biodata');
})->name('google.callback');

// Google OAuth routes (now flexible by school)
use Illuminate\Support\Facades\Log;

Route::get('/{school}/auth/google/redirect', function ($school) {
    // Remove stateless/redirectUrl, use default Socialite
    return Socialite::driver('google')->redirect();
})->where('school', 'sd|smp|smk')->name('google.redirect.by.school');

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
        // Create or update PPDB application for this user (by school)
        $ppdb = \App\Models\PpdbApplication::firstOrCreate(
            [
                'email' => $user->email,
                'school_type' => $school,
            ],
            [
                'full_name' => $user->name,
                'status' => 'draft',
                'application_id' => 'PPDB-' . date('Y') . '-' . strtoupper(substr(md5($user->email), 0, 6)),
                'password' => bcrypt(uniqid()),
                'assigned_major' => null,
            ]
        );
        // Ensure all required fields are set for Google users
        if (!$ppdb->full_name) $ppdb->full_name = $user->name;
        if (!$ppdb->application_id) $ppdb->application_id = 'PPDB-' . date('Y') . '-' . strtoupper(substr(md5($user->email), 0, 6));
        if (!$ppdb->password) $ppdb->password = bcrypt(uniqid());
        if (!$ppdb->status) $ppdb->status = 'draft';
        if (!isset($ppdb->assigned_major)) $ppdb->assigned_major = null;
        $ppdb->save();
        Auth::guard('ppdb_applications')->login($ppdb);
        return redirect('/' . $school . '/ppdb/biodata');
    } catch (\Exception $e) {
        Log::error('Google OAuth error: ' . $e->getMessage());
        return redirect()->route('ppdb.login', ['school' => $school])->withErrors(['google' => 'Gagal login dengan Google. Silakan coba lagi atau gunakan metode lain.']);
    }
});

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

        Route::get('/galeri', [\App\Http\Controllers\GalleryController::class, 'index'])->name('school.galeri');
        Route::get('/galeri/load-more', [\App\Http\Controllers\GalleryController::class, 'loadMore'])->name('school.galeri.load-more');

        Route::get('/kontak', fn($school) => $render($school, 'kontak'))->name('school.kontak');

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
