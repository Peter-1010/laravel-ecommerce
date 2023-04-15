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

    Route::get('/', 'Site\HomeController@home')->name('home');

    Route::group(['namespace' => 'Site', 'middleware' => 'guest'], function () {

        Route::get('category/{cat-name}', 'HomeController@home')->name('category');

    });


    Route::group([
        'namespace' => 'Site',
        'middleware' => ['auth', 'verifyUser']
    ], function () {

        Route::get('/test', function () {
            return 'verified';
        });

    });

    Route::group(['namespace' => 'Site', 'middleware' => 'auth'], function () {

        Route::post('verified-user', 'VerificationCodeController@verify')->name('verified.user');
        Route::get('verify', 'VerificationCodeController@getVerifyPage')->name('verification');

    });




});
