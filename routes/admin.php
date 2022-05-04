<?php

use App\Http\Controllers\Admin\Order\OrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});
Route::namespace('Auth')->group(function(){
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login')->name('login');
    Route::get('logout', 'LoginController@logout')->name('logout');
});

Route::get('dashboard', 'DashboardController@index')->name('dashboard');

Route::get('orders', [OrderController::class ,'index'])->name('order.list');
Route::get('orders/{id}', [OrderController::class ,'show'])->name('order.show');


Route::namespace('Product')->prefix('product')->group(function(){
    Route::get('categories', 'ProductCategoryController@index')->name('product.category.list');
    Route::post('category-store', 'ProductCategoryController@store')->name('product.category.store');
    Route::get('category-edit/{category}', 'ProductCategoryController@edit')->name('product.category.edit');
    Route::put('category-update/{category}', 'ProductCategoryController@update')->name('product.category.update');
    Route::delete('category-destroy/{category}', 'ProductCategoryController@destroy')->name('product.category.destroy');

    Route::get('list', 'ProductController@index')->name('product.list');
    Route::get('create', 'ProductController@create')->name('product.create');
    Route::post('store', 'ProductController@store')->name('product.store');
    Route::get('edit/{product}', 'ProductController@edit')->name('product.edit');
    Route::put('update/{product}', 'ProductController@update')->name('product.update');
    Route::delete('delete/{product}', 'ProductController@destroy')->name('product.delete');
    Route::put('in-stock-update/{product}', 'ProductController@inStockUpdate')->name('product.in-stock-update');
    Route::put('bulk-in-stock-update', 'ProductController@bulkInStockUpdate')->name('product.bulk-in-stock-update');
    Route::delete('bulk-delete', 'ProductController@bulkDestroy')->name('product.bulk-delete');
});

Route::namespace('Customer')->prefix('customer')->group(function(){
    Route::get('list', 'CustomerController@index')->name('customer.list');
    Route::get('create', 'CustomerController@create')->name('customer.create');
    Route::post('store', 'CustomerController@store')->name('customer.store');
    Route::get('edit/{customer}', 'CustomerController@edit')->name('customer.edit');
    Route::put('update/{customer}', 'CustomerController@update')->name('customer.update');
    Route::delete('delete/{customer}', 'CustomerController@destroy')->name('customer.delete');
    Route::delete('bulk-delete', 'CustomerController@bulkDestroy')->name('customer.bulk-delete');
});

Route::namespace('Sale')->group(function(){
    Route::prefix('promo-code')->group(function(){
        Route::get('list', 'PromoCodeController@index')->name('promo-code.list');
        Route::get('create', 'PromoCodeController@create')->name('promo-code.create');
        Route::post('store', 'PromoCodeController@store')->name('promo-code.store');
        Route::get('edit/{coupon}', 'PromoCodeController@edit')->name('promo-code.edit');
        Route::put('update/{coupon}', 'PromoCodeController@update')->name('promo-code.update');
        Route::delete('delete/{coupon}', 'PromoCodeController@destroy')->name('promo-code.delete');
        Route::delete('bulk-delete', 'PromoCodeController@bulkDestroy')->name('promo-code.bulk-delete');
    });

    Route::prefix('discount')->group(function(){
        Route::get('list', 'DiscountController@index')->name('discount.list');
        Route::get('create', 'DiscountController@create')->name('discount.create');
        Route::post('store', 'DiscountController@store')->name('discount.store');
        Route::get('edit/{discount}', 'DiscountController@edit')->name('discount.edit');
        Route::put('update/{discount}', 'DiscountController@update')->name('discount.update');
        Route::delete('delete/{discount}', 'DiscountController@destroy')->name('discount.delete');
        Route::delete('bulk-delete', 'DiscountController@bulkDestroy')->name('discount.bulk-delete');
        Route::put('is-active-update/{discount}', 'DiscountController@isActiveUpdate')->name('discount.is-active-update');
    });

});

//todo - remove after stretching
Route::fallback(function (Request $request) {
    $makeupViewPath = $request->path();
    if (!view()->exists($makeupViewPath))
    {
        abort(404);
    }

    return view($makeupViewPath);
});
