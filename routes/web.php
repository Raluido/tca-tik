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
    });

    Route::group(['middleware' => 'guest'], function () {
        Route::get('login', 'LoginController@show')->name('login.show');
        Route::post('login', 'LoginController@login')->name('login.perform');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('logout', 'LoginController@logout')->name('login.logout');

        Route::group(['prefix' => 'products'], function () {
            Route::get('showall', 'ProductController@showall')->name('product.showall');
        });
    });
});
