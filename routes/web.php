<?php

use App\Http\Controllers\Admin\PartnerActivityAdminController;
use App\Http\Controllers\admin\PartnerAdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PartnerController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Partner Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Partner Management
    Route::resource('partners', PartnerAdminController::class);

    // Activity Management
    Route::resource('activity', PartnerActivityAdminController::class);
});

// Route::get('adminnibos', [PartnerAdminController::class, 'index']);

Route::get('partnership', [PartnerController::class, 'index'])->name('partners.index');
Route::get('/partnership/{partner:slug}', [PartnerController::class, 'show'])->name('partners.show');

Route::get('/partners/{slug}', [PartnerController::class, 'show'])
    ->name('partners.show');

Route::get('lang/{locale}', function ($locale) {
    $availableLangs = ['id', 'en', 'ja', 'ar', 'hi', 'tl', 'ms'];

    if (in_array($locale, $availableLangs)) {
        session(['locale' => $locale]);
    }

    return redirect()->back();
})->name('lang.switch');
