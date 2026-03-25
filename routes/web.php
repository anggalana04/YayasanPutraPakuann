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
        return view('admin.superadmin.cms.index');
    })->name('admin.cms.index');

    // CMS Detail Page
    Route::get('/admin/cms/detail', function () {
        return view('admin.superadmin.cms.detail');
    })->name('admin.cms.detail');

    // School selection page for CMS
    Route::get('/admin/cms/schools', function () {
        $schools = School::all();
        return view('admin.superadmin.cms.schools', compact('schools'));
    })->name('admin.cms.schools');

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

        Route::get('/', fn($school) => $render($school, 'index'))->name('school.home');

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
