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

    Route::get('/', 'GeneralController@showmain')->name('main');

    Route::get('login', 'LoginController@show')->name('login.show');
    Route::get('register', 'RegisterController@show')->name('register.show');
    Route::post('register', 'RegisterController@perform')->name('register.perform');

    Route::middleware(['throttle:login'])->group(function () {
        Route::post('login', 'LoginController@login')->name('login.perform');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('logout', 'LoginController@logout')->name('login.logout');


        // Back office

        Route::group(['prefix' => 'backoffice'], function () {
            Route::group(['prefix' => 'users'], function () {
                Route::get('/', 'UsersController@showBackOfficeIndex')->name('users.showBackOfficeIndex');
                Route::get('/create', 'UsersController@showBackOfficeCreate')->name('users.showBackOfficeCreate');
                Route::post('/store', 'UsersController@backOfficeStore')->name('users.backOfficeStore');
                Route::get('/{user}/show', 'UsersController@showBackOfficeOne')->name('users.showBackOfficeOne');
                Route::get('/{user}/edit', 'UsersController@showBackOfficeEdit')->name('users.showBackOfficeEdit');
                Route::patch('/{user}/update', 'UsersController@backOfficeUpdate')->name('users.backOfficeupdate');
                Route::delete('/{user}/delete', 'UsersController@backOfficeDestroy')->name('users.backOfficeDestroy');
                Route::get('/deleteAll', 'UsersController@backOfficeDeleteAll')->name('users.backOfficeDeleteAll');
            });

            Route::group(['prefix' => 'products'], function () {
                Route::get('/showall', 'ProductController@showBackOfficeAll')->name('products.showBackOfficeAll');
                Route::get('/{product}/showOne', 'ProductController@showBackOfficeOne')->name('products.showBackOfficeOne');
                Route::get('/create', 'ProductController@showBackOfficeCreate')->name('products.showBackOfficeCreate');
                Route::post('/store', 'ProductController@backOfficeStore')->name('products.backOfficeStore');
                Route::get('/{product}/edit', 'ProductController@showBackOfficeEdit')->name('products.showBackOfficeEdit');
                Route::put('/{product}/update', 'ProductController@backOfficeUpdate')->name('products.backOfficeupdate');
                Route::get('/{product}/delete', 'ProductController@backOfficeDestroy')->name('products.backOfficeDestroy');
                Route::get('/image/{image}/delete', 'ProductController@backOfficeDestroyImg')->name('products.backOfficeDestroyImg');
            });

            Route::group(['prefix' => 'categories'], function () {
                Route::get('/showall', 'CategoryController@showBackOfficeAll')->name('categories.showBackOfficeAll');
                Route::get('/create', 'CategoryController@showBackOfficeCreate')->name('categories.showBackOfficeCreate');
                Route::post('/store', 'CategoryController@backOfficeStore')->name('categories.backOfficeStore');
                Route::get('/{category}/edit', 'CategoryController@showBackOfficeEdit')->name('categories.showBackOfficeEdit');
                Route::put('/{category}/update', 'CategoryController@backOfficeUpdate')->name('categories.backOfficeupdate');
                Route::get('/{category}/delete', 'CategoryController@backOfficeDestroy')->name('categories.backOfficeDestroy');
            });

            Route::group(['prefix' => 'storehouses'], function () {
                Route::get('/showall', 'StorehouseController@showBackOfficeAll')->name('storehouses.showBackOfficeAll');
                Route::get('/create', 'StorehouseController@showBackOfficeCreate')->name('storehouses.showBackOfficeCreate');
                Route::post('/store', 'StorehouseController@backOfficeStore')->name('storehouses.backOfficeStore');
                Route::get('{storehouse}/edit', 'StorehouseController@showBackOfficeEdit')->name('storehouses.showBackOfficeEdit');
                Route::put('/{storehouse}/update', 'StorehouseController@backOfficeUpdate')->name('storehouses.backOfficeUpdate');
                Route::get('/{storehouse}/delete', 'StorehouseController@backOfficeDestroy')->name('storehouses.backOfficeDestroy');
            });

            Route::group(['prefix' => 'storehousesManagement'], function () {
                Route::get('/showProducts', 'StorehousesManagementController@showBackOfficeAll')->name('storehousesManagement.showBackOfficeAll');
                Route::get('/showFilteredAjax/{storehouseSelected?}/{categorySelected?}/{productSelected?}/{search?}/{offset?}/{historic?}', 'StorehousesManagementController@showFilteredAjax')->name('storehousesManagement.showFilteredAjax');
                Route::get('/searchBy/{search?}', 'StorehousesManagementController@searchBackOfficeByProduct')->name('storehousesManagement.searchBackOfficeByProduct');
                Route::post('/addToStorehouse', 'StorehousesManagementController@backOfficeAddToStorehouse')->name('storehousesManagement.backOfficeAddToStorehouse');
                Route::get('/delete/{storehouse}/{item}', 'StorehousesManagementController@backOfficeRemoveFromStorehouse')->name('storehousesManagement.backOfficeRemoveFromStorehouse');
            });

            Route::group(['prefix' => 'roles'], function () {
                Route::get('/index', 'RolesController@showBackOfficeIndex')->name('roles.showBackOfficeIndex');
                Route::get('/create', 'RolesController@showBackOfficeCreate')->name('roles.showBackOfficeCreate');
                Route::post('/store', 'RolesController@backOfficeStore')->name('roles.backOfficeStore');
                Route::get('{role}/show', 'RolesController@backOfficeShow')->name('roles.backOfficeShow');
                Route::get('{role}/edit', 'RolesController@showBackOfficeEdit')->name('roles.showBackOfficeEdit');
                Route::patch('/{role}/update', 'RolesController@backOfficeUpdate')->name('roles.backOfficeUpdate');
                Route::delete('/{role}/delete', 'RolesController@backOfficeDestroy')->name('roles.backOfficeDestroy');
            });

            Route::group(['prefix' => 'permissions'], function () {
                Route::get('/showall', 'PermissionsController@showBackOfficeIndex')->name('permissions.showBackOfficeIndex');
                Route::get('/create', 'PermissionsController@showBackOfficeCreate')->name('permissions.showBackOfficeCreate');
                Route::post('/store', 'PermissionsController@backOfficeStore')->name('permissions.backOfficeStore');
                Route::get('{permission}/edit', 'PermissionsController@showBackOfficeEdit')->name('permissions.showBackOfficeEdit');
                Route::patch('/{permission}/update', 'PermissionsController@backOfficeUpdate')->name('permissions.backOfficeUpdate');
                Route::delete('/{permission}/delete', 'PermissionsController@backOfficeDestroy')->name('permissions.backOfficeDestroy');
            });
        });
    });

    // End Backoffice
});
