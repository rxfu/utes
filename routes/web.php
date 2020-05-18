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
        Route::get('/import', 'UserController@showImportForm')->name('import');
        Route::post('/import', 'UserController@import');
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

    Route::prefix('scorepeers')->name('scorepeers.')->group(function () {
        Route::get('/teachers', 'ScorepeerController@teachers')->name('teachers');
        Route::get('/{user}/create', 'ScorepeerController@create')->name('create');
        Route::post('/{user}', 'ScorepeerController@store')->name('store');
    });

    Route::resource('logs', 'LogController')->only(['index', 'show']);
    Route::resource('settings', 'SettingController');
    Route::resource('menus', 'MenuController');
    Route::resource('menuitems', 'MenuitemController');
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    Route::resource('groups', 'GroupController');
    Route::resource('genders', 'GenderController');
    Route::resource('grades', 'GradeController');
    Route::resource('departments', 'DepartmentController');
    Route::resource('titles', 'TitleController');
    Route::resource('applications', 'ApplicationController');
    // Route::resource('scorepeers', 'ScorepeerController');
    // route_here
});
