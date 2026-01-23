<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session; 
use App\Http\Controllers\Admin\PartnerActivityAdminController;
use App\Http\Controllers\admin\PartnerAdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\StudentProjectController; 
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\LandingController;

use App\Models\Banner;
use App\Models\Testimonial; 
use App\Models\StudentProject;
use App\Models\Hero;

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
Route::middleware(['auth', 'admin.locale'])->prefix('admin')->name('admin.')->group(function () {
    
    // 1. (TAMBAHAN PENTING) Redirect /admin ke /admin/dashboard
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    // 2. Group Partner & Activity
    Route::resource('partners', PartnerAdminController::class);
    
    Route::resource('activity', PartnerActivityAdminController::class);
    Route::get('/activity/{slug}', [PartnerActivityAdminController::class, 'show'])
        ->name('activity.show');
    Route::delete('/activity/photo/{photo}', [PartnerActivityAdminController::class, 'deletePhoto'])
        ->name('activity.photo.delete');

    // 3. Group Landing Page Management
        Route::prefix('landing-page')->group(function() {
    
    // Resource Banners, Testimoni, Project (Akan kembali normal jadi: admin.projects.index, dll)
            Route::resource('banners', BannerController::class);
            Route::resource('testimonials', TestimonialController::class);
            Route::resource('projects', StudentProjectController::class);

            // Hero Section (Kita beri nama simpel saja)
            Route::get('hero/preview', [HeroController::class, 'index'])->name('hero.index');
            Route::get('hero', [HeroController::class, 'edit'])->name('hero.edit');
            Route::put('hero', [HeroController::class, 'update'])->name('hero.update');
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
Route::get('/', function() {
    $hero = Hero::first();

    $banners = Banner::latest()->get();
    $testimonials = Testimonial::latest()->get();
    $projects = StudentProject::latest()->take(6)->get(); 
    
    return view('landing_page.index', compact('hero', 'banners', 'testimonials', 'projects'));
})->name('landing');

// Route Ganti Bahasa
Route::get('/lang/{locale}', function ($locale) {
    $availableLocales = ['en', 'id', 'ms', 'fil', 'ar', 'ja', 'bn'];
    if (in_array($locale, $availableLocales)) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('change.language');
