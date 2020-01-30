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

require __DIR__ . '/Web/auth.php';

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    require __DIR__ . '/Web/dashboard.php';
    Route::group(['prefix' => 'user-managements'], function () {
        require __DIR__ . '/Web/user.php';
        require __DIR__ . '/Web/role.php';
        require __DIR__ . '/Web/permission.php';
    });
});
