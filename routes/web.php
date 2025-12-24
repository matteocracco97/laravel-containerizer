<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\WizardController;
use \App\Http\Controllers\Auth\GithubController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-analysis', [App\Http\Controllers\ImportController::class, 'analyzeTest']);

// Autenticazione GitHub (Socialite)
Route::prefix('auth/github')->group(function () {
    Route::get('/redirect', [GithubController::class, 'redirect'])->name('auth.github.redirect');
    Route::get('/callback', [GithubController::class, 'callback'])->name('auth.github.callback');
});

//Route::middleware(['auth'])->group(function () {
    
    // Scelta del repository
    Route::get('/dashboard', [WizardController::class, 'index'])->name('dashboard');

    // Wizard di configurazione
    Route::prefix('wizard')->name('wizard.')->group(function () {
        Route::get('/{owner}/{repo}', [WizardController::class, 'analyze'])->name('analyze');
        Route::post('/generate', [WizardController::class, 'generate'])->name('generate');
    });

    // Logout
    Route::post('/logout', function () {
        auth()->logout();
        return redirect('/');
    })->name('logout');
//});