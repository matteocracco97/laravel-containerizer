<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'));

Route::group([], base_path('routes/domains/github.php'));

Route::middleware(['auth'])->group(function () {
    Route::group([], base_path('routes/domains/user.php'));
    Route::group([], base_path('routes/domains/analyzer.php'));
});