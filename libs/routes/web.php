<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace' => 'Admin'], function () {
    Route::group(['prefix' => 'login', 'middleware' => 'CheckLogedIn'], function () {
        Route::get('/', 'LoginController@getLogin');
        Route::post('/', 'LoginController@postLogin');
    });

    Route::get('logout', 'HomeController@getLogout');

    Route::group(['prefix' => 'admin', 'middleware' => 'CheckLogedOut'], function () {
        Route::get('home', 'HomeController@getHome');

        Route::group(['prefix' => 'category'], function () {
            Route::get('/', 'CategoryController@getCate');
            Route::post('/', 'CategoryController@postCate');

            Route::get('edit/{id}', 'CategoryController@getEditCate');
            Route::post('edit/{id}', 'CategoryController@postEditCate');

            Route::get('delete/{id}', 'CategoryController@getDeleteCate');
        });

        Route::group(['prefix' => 'product'], function () {
            Route::get('/', 'ProductController@getPro');

            Route::get('add', 'ProductController@getAddPro');
            Route::post('add', 'ProductController@postAddPro');

            Route::get('edit/{id}', 'ProductController@getEditPro');
            Route::post('edit/{id}', 'ProductController@postEditPro');

            Route::get('delete/{id}', 'ProductController@getDeletePro');
        });
    });
});
