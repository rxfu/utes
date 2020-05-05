<?php

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

Route::get('/', function () {
    return redirect()->route('home');
});

// Auth::routes();

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');

Route::middleware('auth')->group(function () {
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/contact', 'HomeController@contact')->name('contact');

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/{user}/roles', 'UserController@grant')->name('grant');
        Route::post('/{user}/roles', 'UserController@assign')->name('assign');
    });

    Route::prefix('passwords')->name('passwords.')->group(function () {
        Route::get('/', 'PasswordController@create')->name('change');
        Route::post('/', 'PasswordController@store')->name('store');
        Route::get('/{password}/reset', 'PasswordController@edit')->name('reset');
        Route::put('/{password}', 'PasswordController@update')->name('update');
    });

    Route::resource('menus', 'MenuController');
    Route::resource('menuitems', 'MenuitemController');
    Route::resource('logs', 'LogController')->only(['index', 'show']);
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    Route::resource('settings', 'SettingController');
    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    // route_here
});
