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

            abort(404);
        };

        Route::get('/', fn($school) => $render($school, 'index'))->name('school.home');

        Route::get('/visi', fn($school) => $render($school, 'visi'))->name('school.visi');

        Route::get('/profil', fn($school) => $render($school, 'profil'))->name('school.profil');

        Route::get('/ppdb', fn($school) => $render($school, 'ppdb.index'))->name('school.ppdb');

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
