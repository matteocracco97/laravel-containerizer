<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GithubController;

// Autenticazione GitHub (Socialite)
Route::prefix('auth/github')->group(function () {
    Route::get('/redirect', [GithubController::class, 'redirect'])->name('auth.github.redirect');
    Route::get('/callback', [GithubController::class, 'callback'])->name('auth.github.callback');
});