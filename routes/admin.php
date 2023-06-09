<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function() {

    Route::group(['prefix' => 'admin', 'namespace' => 'Dashboard', 'middleware' => 'auth:admin'], function () {

        Route::get('/', 'DashboardController@index')->name('admin.dashboard');
        Route::get('logout', 'LoginController@logout')->name('admin.logout');

        Route::group(['prefix' => 'profile'], function () {
            Route::get('edit', 'ProfileController@editProfile')->name('edit.profile');
            Route::put('update', 'ProfileController@updateProfile')->name('update.profile');
        });

        Route::group(['prefix' => 'settings'], function () {
            Route::get('shipping-methods/{type}', 'SettingsController@editShippingMethods')->name('edit.shipping.methods');
            Route::put('shipping-methods/{id}', 'SettingsController@updateShippingMethods')->name('update.shipping.methods');
        });

        ########################### Main Categories Routes ###########################
        Route::group(['prefix' => 'main_categories', 'middleware' => 'can:categories'], function (){
            Route::get('/', 'MainCategoriesController@index')->name('admin.maincategories');
            Route::get('create', 'MainCategoriesController@create')->name('admin.maincategories.create');
            Route::post('store', 'MainCategoriesController@store')->name('admin.maincategories.store');
            Route::get('edit/{id}', 'MainCategoriesController@edit')->name('admin.maincategories.edit');
            Route::post('update/{id}', 'MainCategoriesController@update')->name('admin.maincategories.update');
            Route::get('delete/{id}', 'MainCategoriesController@destroy')->name('admin.maincategories.delete');
        });
        ###########################  End Main Categories   ###########################

        ########################### Sub Categories Routes ############################
        Route::group(['prefix' => 'sub_categories', 'middleware' => 'can:categories'], function (){
            Route::get('/', 'SubCategoriesController@index')->name('admin.subcategories');
            Route::get('create', 'SubCategoriesController@create')->name('admin.subcategories.create');
            Route::post('store', 'SubCategoriesController@store')->name('admin.subcategories.store');
            Route::get('edit/{id}', 'SubCategoriesController@edit')->name('admin.subcategories.edit');
            Route::post('update/{id}', 'SubCategoriesController@update')->name('admin.subcategories.update');
            Route::get('delete/{id}', 'SubCategoriesController@destroy')->name('admin.subcategories.delete');
        });
        ############################  End Sub Categories   ############################

        ############################### Brands Routes #################################
        Route::group(['prefix' => 'brands', 'middleware' => 'can:brands'], function (){
            Route::get('/', 'BrandsController@index')->name('admin.brands');
            Route::get('create', 'BrandsController@create')->name('admin.brands.create');
            Route::post('store', 'BrandsController@store')->name('admin.brands.store');
            Route::get('edit/{id}', 'BrandsController@edit')->name('admin.brands.edit');
            Route::post('update/{id}', 'BrandsController@update')->name('admin.brands.update');
            Route::get('delete/{id}', 'BrandsController@destroy')->name('admin.brands.delete');
        });
        ################################  End Brands   ################################

        ################################ Tags Routes ##################################
        Route::group(['prefix' => 'tags', 'middleware' => 'can:tags'], function (){
            Route::get('/', 'TagsController@index')->name('admin.tags');
            Route::get('create', 'TagsController@create')->name('admin.tags.create');
            Route::post('store', 'TagsController@store')->name('admin.tags.store');
            Route::get('edit/{id}', 'TagsController@edit')->name('admin.tags.edit');
            Route::post('update/{id}', 'TagsController@update')->name('admin.tags.update');
            Route::get('delete/{id}', 'TagsController@destroy')->name('admin.tags.delete');
        });
        #################################  End Tags  ################################

        ############################## Products Routes ##############################
        Route::group(['prefix' => 'products', 'middleware' => 'can:products'], function (){
            Route::get('/', 'ProductsController@index')->name('admin.products');

            Route::get('create', 'ProductsController@create')->name('admin.products.create');
            Route::post('store', 'ProductsController@store')->name('admin.products.store');

            Route::get('price/{id}', 'ProductsController@getPrice')->name('admin.products.price');
            Route::post('price', 'ProductsController@storePrice')->name('admin.products.price.store');

            Route::get('stock/{id}', 'ProductsController@getStock')->name('admin.products.stock');
            Route::post('stock', 'ProductsController@storeStock')->name('admin.products.stock.store');

            Route::get('images/{id}', 'ProductsController@addImages')->name('admin.products.image');
            Route::post('image', 'ProductsController@saveImage')->name('admin.products.image.store');
            Route::post('image/DB', 'ProductsController@saveImageDB')->name('admin.products.image.store.db');

            Route::get('delete/{id}', 'ProductsController@destroy')->name('admin.products.delete');
        });
        ###############################  End Products  ##############################

        ############################### Attributes Routes #################################
        Route::group(['prefix' => 'attributes'], function (){
            Route::get('/', 'AttributesController@index')->name('admin.attributes');
            Route::get('create', 'AttributesController@create')->name('admin.attributes.create');
            Route::post('store', 'AttributesController@store')->name('admin.attributes.store');
            Route::get('edit/{id}', 'AttributesController@edit')->name('admin.attributes.edit');
            Route::post('update/{id}', 'AttributesController@update')->name('admin.attributes.update');
            Route::get('delete/{id}', 'AttributesController@destroy')->name('admin.attributes.delete');
        });
        ################################  End Attributes   ################################

        ############################### Options Routes #################################
        Route::group(['prefix' => 'options', 'middleware' => 'can:options'], function (){
            Route::get('/', 'OptionsController@index')->name('admin.options');
            Route::get('create', 'OptionsController@create')->name('admin.options.create');
            Route::post('store', 'OptionsController@store')->name('admin.options.store');
            Route::get('edit/{id}', 'OptionsController@edit')->name('admin.options.edit');
            Route::post('update/{id}', 'OptionsController@update')->name('admin.options.update');
            Route::get('delete/{id}', 'OptionsController@destroy')->name('admin.options.delete');
        });
        ################################  End Options   ################################

        ############################### Slider Routes #################################
        Route::group(['prefix' => 'slider'], function (){
            Route::get('/', 'SliderController@addImages')->name('admin.slider.create');
            Route::post('images', 'SliderController@saveSliderImages')->name('admin.slider.images.store');
            Route::post('images/db', 'SliderController@saveSliderImagesDB')->name('admin.slider.images.store.db');
        });
        ################################  End Slider   ################################

        ############################### Roles Routes #################################
        Route::group(['prefix' => 'roles'], function (){
            Route::get('/', 'RoleController@index')->name('admin.roles.index');
            Route::get('create', 'RoleController@create')->name('admin.roles.create');
            Route::post('store', 'RoleController@store')->name('admin.roles.store');
            Route::get('edit/{id}', 'RoleController@edit')->name('admin.roles.edit');
            Route::post('update/{id}', 'RoleController@update')->name('admin.roles.update');
            Route::get('delete/{id}', 'RoleController@destroy')->name('admin.roles.delete');
        });
        ################################  End Roles   ################################

        ############################### Users Routes #################################
        Route::group(['prefix' => 'users', 'middleware' => 'can:users'], function (){
            Route::get('/', 'UserController@index')->name('admin.users.index');
            Route::get('create', 'UserController@create')->name('admin.users.create');
            Route::post('store', 'UserController@store')->name('admin.users.store');
            Route::get('delete/{id}', 'UserController@destroy')->name('admin.users.delete');
        });
        ################################  End Users   ################################

    });

    Route::group(['prefix' => 'admin', 'namespace' => 'Dashboard', 'middleware' => 'guest:admin'], function () {

        Route::get('login', 'LoginController@login')->name('admin.login');
        Route::post('login', 'LoginController@postLogin')->name('admin.post.login');

    });

});
