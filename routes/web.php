<?php

use App\Http\Controllers\Admin\PartnerActivityAdminController;
use App\Http\Controllers\admin\PartnerAdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PartnerController;

use App\Http\Controllers\Admin\BannerController;

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

Route::delete(
    '/admin/activity/photo/{photo}',
    [PartnerActivityAdminController::class, 'deletePhoto']
)->name('admin.activity.photo.delete');

// Partner Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Partner Management
    Route::resource('partners', PartnerAdminController::class);

    // Activity Management
    Route::resource('activity', PartnerActivityAdminController::class);
    Route::get('/admin/activity/{slug}', [PartnerActivityAdminController::class, 'show'])
        ->name('admin.activity.show');
    
    Route::resource('landing-page/banners', BannerController::class);
    
    
});



Route::prefix('partnership')
    ->name('partnership.')
    ->group(function () {

        Route::get('/', [PartnerController::class, 'index'])
            ->name('index');

        Route::get('/{partner:slug}', [PartnerController::class, 'show'])
            ->name('show');
    });

// Route::get('/partners/{slug}', function ($slug) {
//     return view('partners.show', ['slug' => $slug]);
// })->name('partners.show');
