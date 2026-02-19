<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PartnerAdminController;
use App\Http\Controllers\Admin\PartnerActivityAdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\StudentProjectController; 
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\FreeTrialAdminController;
use App\Http\Controllers\landing\LandingPageController as LandingLandingPageController;
use App\Http\Controllers\landing\TrialController as LandingTrialController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- REDIRECT & PUBLIC LANDING ---
Route::redirect('/', '/'); 

// Halaman Utama Landing
Route::get('/', [LandingLandingPageController::class, 'index'])->name('landing');

// Halaman Form Pendaftaran 
Route::get('/book-free-trial', [LandingTrialController::class, 'index'])->name('trial.index');

// Proses Kirim Data
Route::post('/book-free-trial', [LandingTrialController::class, 'storeBooking'])->name('landing.book-trial.store');

// Route Ganti Bahasa (Fungsi Krisna)
Route::get('/lang/{locale}', [LandingLandingPageController::class, 'changeLanguage'])->name('change.language');


// --- ADMIN ROUTES GROUP ---
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', function () {
        return view('admin.users');
    })->name('users');

    // MANAGEMENT LANDING PAGE
    Route::prefix('landing-page')->group(function() {
    // Dashboard Free Trials
    Route::get('free-trials', [FreeTrialAdminController::class, 'index'])->name('free-trials.index');
    Route::delete('free-trials/delete/{id}', [FreeTrialAdminController::class, 'destroy'])->name('free-trials.destroy');

    // --- MANUAL BANNERS (Biar urutannya jelas & gak nyari 'show') ---
    Route::get('banners', [BannerController::class, 'index'])->name('banners.index');
    Route::get('banners/create', [BannerController::class, 'create'])->name('banners.create');
    Route::post('banners', [BannerController::class, 'store'])->name('banners.store');
    Route::get('banners/{banner}/edit', [BannerController::class, 'edit'])->name('banners.edit');
    Route::put('banners/{banner}', [BannerController::class, 'update'])->name('banners.update');
    Route::delete('banners/{banner}', [BannerController::class, 'destroy'])->name('banners.destroy');

    // Untuk Testimonials & Projects, kalau mau tetep resource tapi aman:
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('projects', StudentProjectController::class);

    // Hero Management
    Route::get('hero/preview', [HeroController::class, 'index'])->name('hero.index');
    Route::get('hero', [HeroController::class, 'edit'])->name('hero.edit');
    Route::put('hero', [HeroController::class, 'update'])->name('hero.update');
});

    // GROUP DENGAN LOCALE (Partners & Activity)
    Route::middleware(['admin.locale'])->group(function () {
        Route::resource('partners', PartnerAdminController::class);
        Route::resource('activity', PartnerActivityAdminController::class);
        Route::get('/activity/{slug}', [PartnerActivityAdminController::class, 'show'])->name('activity.show');
        Route::delete('/activity/photo/{photo}', [PartnerActivityAdminController::class, 'deletePhoto'])->name('activity.photo.delete');
    });
});

// --- PUBLIC PARTNERSHIP ROUTES ---
Route::prefix('partnership')->name('partnership.')->group(function () {
    Route::get('/', [PartnerController::class, 'index'])->name('index');
    Route::get('/{partner:slug}', [PartnerController::class, 'show'])->name('show');
});

// --- AUTHENTICATION ---
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');