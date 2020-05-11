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
    Route::get('/maintenance', 'HomeController@maintenance')->name('maintenance');

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/{user}/roles', 'UserController@showRoleForm')->name('role');
        Route::post('/{user}/roles', 'UserController@assignRole');
        Route::get('/{user}/groups', 'UserController@showGroupForm')->name('group');
        Route::post('/{user}/groups', 'UserController@assignGroup');
    });

    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/{role}/permissions', 'RoleController@showPermissionForm')->name('permission');
        Route::post('/{role}/permissions', 'RoleController@assignPermission');
    });

    Route::prefix('passwords')->name('passwords.')->group(function () {
        Route::get('/', 'PasswordController@create')->name('change');
        Route::post('/', 'PasswordController@store')->name('store');
        Route::get('/{password}/reset', 'PasswordController@edit')->name('reset');
        Route::put('/{password}', 'PasswordController@update')->name('update');
    });

    Route::resource('logs', 'LogController')->only(['index', 'show']);
    Route::resource('settings', 'SettingController');
    Route::resource('menus', 'MenuController');
    Route::resource('menuitems', 'MenuitemController');
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    Route::resource('groups', 'GroupController');
    // route_here
});
