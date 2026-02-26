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
        return view('smk/index', compact('school'));
    })->name('smk.home');

    Route::get('/profil', function ($school) {
        return view('school/profil', compact('school'));
    })->name('school.profil');

    Route::get('/ppdb', function ($school) {
        return view('school/ppdb', compact('school'));
    })->name('school.ppdb');
});
