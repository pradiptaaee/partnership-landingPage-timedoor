<?php

use App\Http\Controllers\Admin\PartnerActivityAdminController;
use App\Http\Controllers\admin\PartnerAdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PartnerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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

