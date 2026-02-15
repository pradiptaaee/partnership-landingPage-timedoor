<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session; 
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PartnerAdminController;
use App\Http\Controllers\Admin\PartnerActivityAdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\StudentProjectController; 
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\FreeTrialAdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- REDIRECT UTAMA ---
Route::redirect('/', '/partnership');

// --- AUTHENTICATION ---
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// --- ADMIN ROUTES GROUP ---
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Utama
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', function () {
        return view('admin.users');
    })->name('users');

    // MANAGEMENT LANDING PAGE (Group ini ditaruh di luar locale dulu buat aman)
    Route::prefix('landing-page')->group(function() {
        // --- ROUTE FREE TRIAL (Manual biar gak error MethodNotAllowed) ---
        Route::get('free-trials', [FreeTrialAdminController::class, 'index'])->name('free-trials.index');
        // Ganti baris DELETE lo jadi ini:
        Route::post('free-trials/delete/{id}', [FreeTrialAdminController::class, 'destroy'])->name('free-trials.destroy');

        // Resource lainnya
        Route::resource('banners', BannerController::class);
        Route::resource('testimonials', TestimonialController::class);
        Route::resource('projects', StudentProjectController::class);

        // Hero Management
        Route::get('hero/preview', [HeroController::class, 'index'])->name('hero.index');
        Route::get('hero', [HeroController::class, 'edit'])->name('hero.edit');
        Route::put('hero', [HeroController::class, 'update'])->name('hero.update');
    });

    // GROUP DENGAN LOCALE (Bahasa)
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

// --- PUBLIC LANDING PAGE ---
Route::get('/home', [LandingController::class, 'index'])->name('landing'); 
Route::get('/book-free-trial', [LandingController::class, 'showBookingForm'])->name('landing.book-trial');
Route::post('/book-free-trial', [LandingController::class, 'storeBooking'])->name('landing.book-trial.store');

// --- ROUTE GANTI BAHASA ---
Route::get('/lang/{locale}', function ($locale) {
    $availableLocales = ['en', 'id', 'ms', 'fil', 'ar', 'ja', 'bn'];
    if (in_array($locale, $availableLocales)) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('change.language');