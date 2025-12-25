<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\WizardController;

Route::get('/test-analysis', [ImportController::class, 'analyzeTest']);

// Wizard di configurazione
Route::prefix('wizard')->name('wizard.')->group(function () {
    Route::get('/{owner}/{repo}', [WizardController::class, 'analyze'])->name('analyze');
    Route::post('/generate', [WizardController::class, 'generate'])->name('generate');
});