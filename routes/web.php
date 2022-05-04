<?php

use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Ajax\Product\CheckAddressController;
use App\Http\Controllers\Order\PayPalController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('home.index');

Route::namespace('Product')->prefix('product')->name('product.')->group(function(){
    Route::get('all-items', 'ProductController@allProduct')->name('all');
    Route::get('cart', 'CartController@cart')->name('cart');
    Route::get('checkout', 'CartController@checkout')->name('checkout');
    Route::post('checkout/shipping', 'CartController@checkoutShipping')->name('checkout.shipping');
    Route::get('coupon/code', 'CartController@coupon')->name('coupon');
    Route::post('cart/remove', 'CartController@remove')->name('cart.remove');
    Route::any('cart/qty/{id}', 'CartController@qtyUpdate')->name('cart.qty');
    Route::get('category/{category}', 'ProductController@category')->name('category');
    Route::get('detail/{product}', 'ProductController@detail')->name('detail');
});

Route::get('check/address/{id}',[CheckAddressController::class ,'checkAddress'])->name('check.address');

Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');

Route::namespace('Auth')->group(function(){
    Route::get('register', 'RegisterFrontController@showRegisterForm')->name('register');
    Route::post('register', 'RegisterFrontController@register')->name('register');
    Route::get('login', 'LoginFrontController@showLoginForm')->name('login');
    Route::post('login', 'LoginFrontController@login')->name('login');
    Route::get('logout', 'LoginFrontController@logout')->name('logout');
});
