<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/akreditasi', function () {
    return view('akreditasi');
})->name('akreditasi');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/fasilitas', function () {
    return view('fasilitas');
})->name('fasilitas');

Route::get('/berita', function() {
    return view('berita');
})->name('berita');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');
