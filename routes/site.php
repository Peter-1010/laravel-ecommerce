<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Site Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "site" middleware group. Now create something great!
|
*/

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function() {

    Auth::routes();


    Route::group(['namespace' => 'Site'], function () {

        Route::get('/', 'HomeController@home')->name('home');
        Route::get('category/{slug}', 'CategoryController@productsBySlug')->name('category');
        Route::get('product/{id}', 'ProductController@productsBySlug')->name('products.details');

        Route::group(['prefix' => 'cart'], function () {

            Route::get('/', 'CartController@index')->name('cart.index');
            Route::post('add/{slug?}', 'CartController@add')->name('cart.add');
            Route::post('update/{slug?}', 'CartController@update')->name('cart.update');
            Route::post('update-all/{slug}', 'CartController@updateAll')->name('cart.update.all');

        });
    });


    Route::group([
        'namespace' => 'Site',
        'middleware' => ['auth', 'verifyUser']
    ], function () {



    });

    Route::group(['namespace' => 'Site', 'middleware' => 'auth'], function () {

        Route::post('verified-user', 'VerificationCodeController@verify')->name('verified.user');
        Route::get('verify', 'VerificationCodeController@getVerifyPage')->name('verification');
        Route::get('products/{productId}/reviews', 'ProductReviewController@index')->name('products.reviews.index');
        Route::post('products/{productId}/reviews', 'ProductReviewController@store')->name('products.reviews.store');
        Route::get('payment/{amount}', 'PaymentController@getPayments') -> name('payment');
        Route::post('payment', 'PaymentController@processPayment') -> name('payment.process');

    });


});

Route::group(['namespace' => 'Site', 'middleware' => 'auth'], function () {

    Route::post('wishlist', 'WishlistController@store')->name('wishlist.store');
    Route::delete('wishlist', 'WishlistController@destroy')->name('wishlist.destroy');
    Route::get('wishlist/products', 'WishlistController@index')->name('wishlist.products.index');

});
