<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistrationController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [\App\Http\Controllers\AboutController::class, 'index'])->name('about');
Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::get('/gallery', [\App\Http\Controllers\GalleryController::class, 'index'])->name('gallery');
Route::get('/showcase', [\App\Http\Controllers\ShowcaseController::class, 'index'])->name('showcase');
Route::get('/register-trial', [RegistrationController::class, 'create'])->name('register.trial');
Route::get('/register-player', [RegistrationController::class, 'direct'])->name('register.player');
Route::post('/register-trial', [RegistrationController::class, 'store'])->name('register.store');
Route::post('/register-player', [RegistrationController::class, 'storeDirect'])->name('register.store_direct');

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\CoachController as AdminCoachController;
use App\Http\Controllers\WebsiteManager\SettingsController as WebsiteSettingsController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Admin Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('coaches', AdminCoachController::class);
    Route::get('/trials', [\App\Http\Controllers\Admin\TrialController::class, 'index'])->name('trials.index');
    Route::post('/trials/{registration}', [\App\Http\Controllers\Admin\TrialController::class, 'updateStatus'])->name('trials.update');

    // Payment Logs
    Route::get('/payments', [\App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('payments.index');
    });

// Coach Routes
Route::middleware(['auth', 'verified'])->prefix('coach')->name('coach.')->group(function () {
    Route::get('/attendance', [\App\Http\Controllers\Coach\AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance', [\App\Http\Controllers\Coach\AttendanceController::class, 'store'])->name('attendance.store');
    
    Route::get('/reports/create', [\App\Http\Controllers\Coach\PerformanceReportController::class, 'create'])->name('reports.create');
    Route::post('/reports', [\App\Http\Controllers\Coach\PerformanceReportController::class, 'store'])->name('reports.store');
});

// Website Manager Routes
Route::middleware(['auth', 'verified'])->prefix('website-manager')->name('website.')->group(function () {
    Route::get('/settings', [WebsiteSettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/general', [WebsiteSettingsController::class, 'updateGeneral'])->name('settings.updateGeneral');
    Route::post('/settings/payment', [\App\Http\Controllers\WebsiteManager\PaymentSettingsController::class, 'update'])->name('settings.updatePayment');
    Route::post('/settings/mail', [WebsiteSettingsController::class, 'updateMail'])->name('settings.updateMail');
    Route::post('/settings/slider', [WebsiteSettingsController::class, 'storeSlider'])->name('settings.storeSlider');
    Route::put('/settings/slider/{slider}', [WebsiteSettingsController::class, 'updateSlider'])->name('settings.updateSlider');
    Route::delete('/settings/slider/{slider}', [WebsiteSettingsController::class, 'deleteSlider'])->name('settings.deleteSlider');
    Route::post('/settings/program', [WebsiteSettingsController::class, 'storeProgram'])->name('settings.storeProgram');
    Route::put('/settings/program/{program}', [WebsiteSettingsController::class, 'updateProgram'])->name('settings.updateProgram');
    Route::delete('/settings/program/{program}', [WebsiteSettingsController::class, 'deleteProgram'])->name('settings.deleteProgram');
    
    // Form Builder
    Route::post('/form-builder', [\App\Http\Controllers\WebsiteManager\FormBuilderController::class, 'store'])->name('form.store');
    Route::delete('/form-builder/{field}', [\App\Http\Controllers\WebsiteManager\FormBuilderController::class, 'destroy'])->name('form.destroy');

    // News & Fixtures
    Route::resource('news', \App\Http\Controllers\WebsiteManager\NewsController::class);
    Route::resource('fixtures', \App\Http\Controllers\WebsiteManager\FixtureController::class);

    // About Page Management
    Route::post('/settings/about', [\App\Http\Controllers\WebsiteManager\AboutPageController::class, 'updateAbout'])->name('settings.updateAbout');
    Route::post('/settings/facility', [\App\Http\Controllers\WebsiteManager\AboutPageController::class, 'storeFacility'])->name('settings.storeFacility');
    Route::put('/settings/facility/{facility}', [\App\Http\Controllers\WebsiteManager\AboutPageController::class, 'updateFacility'])->name('settings.updateFacility');
    Route::delete('/settings/facility/{facility}', [\App\Http\Controllers\WebsiteManager\AboutPageController::class, 'deleteFacility'])->name('settings.deleteFacility');

    // Gallery Management
    Route::post('/gallery', [\App\Http\Controllers\WebsiteManager\GalleryController::class, 'store'])->name('gallery.store');
    Route::delete('/gallery/{gallery}', [\App\Http\Controllers\WebsiteManager\GalleryController::class, 'destroy'])->name('gallery.destroy');

    // Funding Campaigns
    Route::post('/settings/campaign', [WebsiteSettingsController::class, 'storeCampaign'])->name('settings.storeCampaign');
    Route::put('/settings/campaign/{campaign}', [WebsiteSettingsController::class, 'updateCampaign'])->name('settings.updateCampaign');
    Route::delete('/settings/campaign/{campaign}', [WebsiteSettingsController::class, 'deleteCampaign'])->name('settings.deleteCampaign');

    // Showcase Videos
    Route::post('/settings/showcase', [WebsiteSettingsController::class, 'storeShowcase'])->name('settings.storeShowcase');
    Route::put('/settings/showcase/{showcase}', [WebsiteSettingsController::class, 'updateShowcase'])->name('settings.updateShowcase');
    Route::delete('/settings/showcase/{showcase}', [WebsiteSettingsController::class, 'deleteShowcase'])->name('settings.deleteShowcase');
});

// Player Utilities
Route::middleware(['auth', 'verified'])->prefix('player')->name('player.')->group(function () {
    Route::get('/{player}/pdf', [\App\Http\Controllers\PlayerController::class, 'downloadPdf'])->name('pdf');
    Route::get('/{player}/qr', [\App\Http\Controllers\PlayerController::class, 'generateQr'])->name('qr');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::patch('/player-profile', [\App\Http\Controllers\PlayerController::class, 'updateProfile'])->name('player.profile.update');
});

// Donation Routes
Route::get('/donate', [\App\Http\Controllers\DonationController::class, 'index'])->name('donate.index');
Route::post('/donate/initialize', [\App\Http\Controllers\DonationController::class, 'initialize'])->name('donate.initialize');
Route::get('/donate/callback', [\App\Http\Controllers\DonationController::class, 'callback'])->name('donate.callback');

require __DIR__.'/auth.php';
