<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\TypeController as AdminTypeController;
use App\Http\Controllers\Admin\ItemController as AdminItemController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;

//Front
use App\Http\Controllers\Front\LandingController as FrontLandingController;
use App\Http\Controllers\Front\DetailController as FrontDetailController;
use App\Http\Controllers\Front\CheckoutController as FrontCheckoutController;

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

Route::name('front.')->group(function () {
    Route::get('/', [FrontLandingController::class, 'index'])->name('index');
    Route::get('/detail/{slug}', [FrontDetailController::class, 'index'])->name('detail');
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/checkout/{slug}', [FrontCheckoutController::class, 'index'])->name('checkout');
        Route::post('/checkout/{slug}', [FrontCheckoutController::class, 'store'])->name('checkout.store');
    });
});

Route::prefix('admin')->name('admin.')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'is_admin'
])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('brands', AdminBrandController::class);
    Route::resource('types', AdminTypeController::class);
    Route::resource('items', AdminItemController::class);
    Route::resource('bookings', AdminBookingController::class);
});
