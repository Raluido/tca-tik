<?php

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

Route::group(['namespace' => 'App\Http\Controllers'], function () {

    Route::get('/', function () {
        return view('main');
    })->name('main');

    Route::get('login', 'LoginController@show')->name('login.show');

    Route::middleware(['throttle:login'])->group(function () {
        Route::post('login', 'LoginController@login')->name('login.perform');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('logout', 'LoginController@logout')->name('login.logout');

        Route::group(['prefix' => 'products'], function () {
            Route::get('showall', 'ProductController@showall')->name('products.showall');
            Route::get('createForm', 'ProductController@createForm')->name('products.createForm');
            Route::post('create', 'ProductController@create')->name('products.create');
            Route::get('{product}/editForm', 'ProductController@editForm')->name('products.editForm');
            Route::put('{product}/edit', 'ProductController@edit')->name('products.edit');
            Route::delete('{product}/delete', 'ProductController@delete')->name('products.delete');
        });

        Route::group(['prefix' => 'categories'], function () {
            Route::get('showall', 'CategoryController@showall')->name('categories.showall');
            Route::get('createForm', 'CategoryController@createForm')->name('categories.createForm');
            Route::post('create', 'CategoryController@create')->name('categories.create');
            Route::get('{category}/editForm', 'CategoryController@editForm')->name('categories.editForm');
            Route::put('{category}/edit', 'CategoryController@edit')->name('categories.edit');
            Route::delete('{category}/delete', 'CategoryController@delete')->name('categories.delete');
        });

        Route::group(['prefix' => 'storehouses'], function () {
            Route::get('showall', 'StorehouseController@showall')->name('storehouses.showall');
            Route::get('createForm', 'StorehouseController@createForm')->name('storehouses.createForm');
            Route::post('create', 'StorehouseController@create')->name('storehouses.create');
            Route::get('{storehouse}/editForm', 'StorehouseController@editForm')->name('storehouses.editForm');
            Route::put('{storehouse}/edit', 'StorehouseController@edit')->name('storehouses.edit');
            Route::delete('{storehouse}/delete', 'StorehouseController@delete')->name('storehouses.delete');
        });
    });
});
