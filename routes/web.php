<?php

use App\Http\Controllers\Admin\PartnerActivityAdminController;
use App\Http\Controllers\admin\PartnerAdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\StudentProjectController; 
use App\Models\StudentProject;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

// Import Model untuk Route Public di bawah
use App\Models\Banner;
use App\Models\Testimonial; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::redirect('/', '/partnership');

// --- AUTHENTICATION ROUTES ---
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// --- ADMIN ROUTES GROUP ---
// Semua yang ada di dalam sini otomatis kena prefix 'admin/' dan nama 'admin.'
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // 1. Group Partner & Activity
    Route::resource('partners', PartnerAdminController::class);
    
    Route::resource('activity', PartnerActivityAdminController::class);
    Route::get('/activity/{slug}', [PartnerActivityAdminController::class, 'show'])
        ->name('activity.show');
    Route::delete('/activity/photo/{photo}', [PartnerActivityAdminController::class, 'deletePhoto'])
        ->name('activity.photo.delete');

    // 2. Group Landing Page Management (DISINI POSISINYA)
    Route::prefix('landing-page')->group(function() {
        // URL: /admin/landing-page/banners
        Route::resource('banners', BannerController::class);

        // URL: /admin/landing-page/testimonials
        Route::resource('testimonials', TestimonialController::class);

        // URL: /admin/landing-page/project
        Route::resource('projects', StudentProjectController::class);
    });

    // Admin Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// --- PUBLIC PARTNERSHIP ROUTES ---
Route::prefix('partnership')->name('partnership.')->group(function () {
    Route::get('/', [PartnerController::class, 'index'])->name('index');
    Route::get('/{partner:slug}', [PartnerController::class, 'show'])->name('show');
});

// --- PUBLIC LANDING PAGE ---
Route::get('landing', function() {
    // 1. Ambil data banner
    $banners = Banner::latest()->get();
    
    // 2. Ambil data testimoni
    $testimonials = Testimonial::latest()->get();

    // 3. Ambil data project (INI YANG KURANG TADI)
    $projects = StudentProject::latest()->get(); 
    
    // 4. Kirim SEMUANYA ke view
    return view('landing_page.index', compact('banners', 'testimonials', 'projects'));
});
