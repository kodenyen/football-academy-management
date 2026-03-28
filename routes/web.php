<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistrationController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/register-trial', [RegistrationController::class, 'create'])->name('register.trial');
Route::post('/register-trial', [RegistrationController::class, 'store'])->name('register.store');

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\CoachController as AdminCoachController;
use App\Http\Controllers\WebsiteManager\SettingsController as WebsiteSettingsController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Admin Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('coaches', AdminCoachController::class);
});

// Website Manager Routes
Route::middleware(['auth', 'verified'])->prefix('website-manager')->name('website.')->group(function () {
    Route::get('/settings', [WebsiteSettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/general', [WebsiteSettingsController::class, 'updateGeneral'])->name('settings.updateGeneral');
    Route::post('/settings/payment', [WebsiteSettingsController::class, 'updatePayment'])->name('settings.updatePayment');
    Route::post('/settings/slider', [WebsiteSettingsController::class, 'storeSlider'])->name('settings.storeSlider');
    Route::delete('/settings/slider/{slider}', [WebsiteSettingsController::class, 'deleteSlider'])->name('settings.deleteSlider');
    Route::post('/settings/program', [WebsiteSettingsController::class, 'storeProgram'])->name('settings.storeProgram');
    Route::delete('/settings/program/{program}', [WebsiteSettingsController::class, 'deleteProgram'])->name('settings.deleteProgram');
    
    // Form Builder
    Route::post('/form-builder', [\App\Http\Controllers\WebsiteManager\FormBuilderController::class, 'store'])->name('form.store');
    Route::delete('/form-builder/{field}', [\App\Http\Controllers\WebsiteManager\FormBuilderController::class, 'destroy'])->name('form.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
