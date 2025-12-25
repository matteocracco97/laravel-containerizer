<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WizardController;

// Scelta del repository
Route::get('/dashboard', [WizardController::class, 'index'])->name('dashboard');

// Logout
Route::post('/logout', function () {
    auth()->logout();
    return redirect('/');
})->name('logout');