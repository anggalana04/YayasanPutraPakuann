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
Route::prefix('{school}')->where(['school' => 'sd|smp|smk'])->group(function () {
    Route::get('/', function ($school) {
        // Use the correct view path based on school
        $view = strtoupper($school) . '.index';
        if (view()->exists($view)) {
            return view($view, compact('school'));
        }
        abort(404);
    })->name('school.home');

    Route::get('/visi', function ($school) {
        $view = strtoupper($school) . '.visi';
        if (view()->exists($view)) {
            return view($view, compact('school'));
        }
        abort(404);
    })->name('school.visi');

    Route::get('/profil', function ($school) {
        $view = strtoupper($school) . '.profil';
        if (view()->exists($view)) {
            return view($view, compact('school'));
        }
        abort(404);
    })->name('school.profil');

    Route::get('/ppdb', function ($school) {
        $view = strtoupper($school) . '.ppdb';
        if (view()->exists($view)) {
            return view($view, compact('school'));
        }
        abort(404);
    })->name('school.ppdb');
});
