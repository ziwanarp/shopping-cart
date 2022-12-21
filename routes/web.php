<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserCartController;
use App\Http\Controllers\UserHomeController;
use App\Http\Controllers\UserShopController;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\UserRegisterController;
use App\Http\Controllers\UserCouponController;

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminCouponController;
use App\Http\Controllers\AdminProductController;






/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// user home controller
Route::get('/', [UserHomeController::class, 'index']);
// user register controller
Route::get('/register', [UserRegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [UserRegisterController::class, 'register'])->middleware('guest');
// user login controller
Route::get('/login', [UserLoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [UserLoginController::class, 'login'])->middleware('guest');
Route::get('/logout', [UserLoginController::class, 'redirect']);
Route::post('/logout', [UserLoginController::class, 'logout']);


Route::middleware('auth')->group(function () {
    // user shop controller
    Route::get('/shop', [UserShopController::class, 'index']);
    Route::get('/shop/addToCart', [UserShopController::class, 'addToCart']);
    // user cart controller
    Route::get('/cart', [UserCartController::class, 'index']);
    Route::get('/cart/increase', [UserCartController::class, 'increase']);
    Route::get('/cart/decrease', [UserCartController::class, 'decrease']);
    Route::delete('/cart/delete/{cart:id}', [UserCartController::class, 'delete']);
    // user coupon controller
    Route::get('/coupon/addcoupon', [UserCouponController::class, 'addCoupon']);
    Route::get('/coupon/removecoupon', [UserCouponController::class, 'removeCoupon']);
});

Route::get('/admin/login', [AdminLoginController::class, 'index']);
Route::post('/admin/login', [AdminLoginController::class, 'login']);

Route::middleware('admin')->group(function () {
    // admin login controller
    Route::post('/admin/logout', [AdminLoginController::class, 'logout']);
    // admin home controller
    Route::get('/admin/home', [AdminHomeController::class, 'index']);
    // admin user controller
    Route::resource('/admin/user', AdminUserController::class)->except('show');
    // admin product controller
    Route::resource('/admin/product', AdminProductController::class)->except('show');
    // admin coupon controller
    Route::resource('/admin/coupon', AdminCouponController::class)->except('show');
});
