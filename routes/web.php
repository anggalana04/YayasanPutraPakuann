<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/akreditasi', function () {
    return view('akreditasi');
})->name('akreditasi');

Route::get('/about', function () {
    return view('about');
})->name('about');

