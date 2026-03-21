<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth/login');
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

// CMS Management Index
Route::get('/admin/cms', function () {
    return view('admin.superadmin.cms.index');
})->name('admin.cms.index');

// CMS Detail Page
Route::get('/admin/cms/detail', function () {
    return view('admin.superadmin.cms.detail');
})->name('admin.cms.detail');

// School selection page for CMS
Route::get('/admin/cms/schools', function () {
    return view('admin.superadmin.cms.schools');
})->name('admin.cms.schools');

// PPDB Management
Route::get('/admin/ppdb/management', function () {
    return view('admin.superadmin.ppdb.management');
})->name('admin.ppdb.management');

// School selection page for CMS
Route::get('/admin/cms/schools', function () {
    return view('admin.superadmin.ppdb.schools');
})->name('admin.ppdb.schools');

// PPDB Applicant Management
Route::get('/admin/ppdb/applicants', function () {
    return view('admin.superadmin.ppdb.applicants');
})->name('admin.ppdb.applicants');

// Route for applicant detail view
Route::get('/admin/ppdb/applicants/{id}', function ($id) {
    // You can replace this with controller logic as needed
    return view('admin.superadmin.ppdb.applicant_detail');
})->name('admin.ppdb.applicant_detail');

// User Management (Superadmin)
Route::get('/admin/user-management', function () {
    return view('admin.superadmin.user_management');
})->name('admin.user_management');

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

        Route::get('/', fn($school) => $render($school, 'index'))->name('school.home');

        Route::get('/visi', fn($school) => $render($school, 'visi'))->name('school.visi');

        Route::get('/profil', fn($school) => $render($school, 'profil'))->name('school.profil');

        Route::get('/ppdb', fn($school) => $render($school, 'ppdb.index'))->name('school.ppdb');

        // PPDB Authentication Routes
        Route::get('/ppdb/login', fn($school) => view('ppdb.login', compact('school')))->name('ppdb.login');
        Route::get('/ppdb/register', fn($school) => $render($school, 'ppdb.register'))->name('ppdb.register');
        Route::post('/ppdb/login', [App\Http\Controllers\PpdbAuthController::class, 'login'])->name('ppdb.login.post');
        Route::post('/ppdb/logout', [App\Http\Controllers\PpdbAuthController::class, 'logout'])->name('ppdb.logout');

        // PPDB Routes (Frontend Development - Auth will be added later)
        Route::get('/ppdb/dashboard', fn($school) => $render($school, 'ppdb.dashboard'))->name('ppdb.dashboard');
        Route::get('/ppdb/biodata', fn($school) => $render($school, 'ppdb.biodata'))->name('ppdb.biodata');
        Route::get('/ppdb/berkas', fn($school) => $render($school, 'ppdb.berkas'))->name('ppdb.berkas');
        Route::get('/ppdb/payment', fn($school) => $render($school, 'ppdb.payment'))->name('ppdb.payment');

        Route::get('/program', fn($school) => $render($school, 'program'))->name('school.program');

        Route::get('/kesiswaan', fn($school) => $render($school, 'kesiswaan'))->name('school.kesiswaan');

        Route::get('/galeri', fn($school) => $render($school, 'galeri'))->name('school.galeri');

        Route::get('/kontak', fn($school) => $render($school, 'kontak'))->name('school.kontak');

        Route::get('/berita', fn($school) => $render($school, 'berita.index'))->name('school.berita');

        Route::get('/berita/detail', fn($school) => $render($school, 'berita.detail'))->name('school.berita.detail');

        Route::get('/direktori/guru', function ($school) {
            $view = strtoupper($school) . '.direktori_guru';

            if (view()->exists($view)) {
                return view($view, compact('school'));
            }

            abort(404);
        })->name('school.direktori.guru');

        Route::get('/direktori/siswa', function ($school) {
            $view = strtoupper($school) . '.direktori_siswa';

            if (view()->exists($view)) {
                return view($view, compact('school'));
            }

            abort(404);
        })->name('school.direktori.siswa');
    });
