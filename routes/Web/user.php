<?php

Route::group(['prefix' => 'users'], function () {
    Route::group(['middleware' => 'permission:users-managements'], function () {
        Route::get('', 'BackEnd\UserController@index')->name('users');
        Route::get('getData', 'BackEnd\UserController@getData')->name('get.users');
    });
    Route::group(['middleware' => 'permission:create-users'], function () {
        Route::get('create', 'BackEnd\UserController@create')->name('users.create');
        Route::post('store', 'BackEnd\UserController@store')->name('users.store');
    });

    Route::group(['middleware' => 'permission:edit-users'], function () {
        Route::get('edit/{id}', 'BackEnd\UserController@edit')->name('users.edit');
        Route::put('update/{id}', 'BackEnd\UserController@update')->name('users.update');
    });

    Route::group(['middleware' => 'permission:delete-users'], function () {
        Route::delete('delete/{id}', 'BackEnd\UserController@delete')->name('users.delete');
    });

    Route::group(['middleware' => 'permission:change-password-users'], function () {
        Route::get('password/{id}', 'BackEnd\UserController@password')->name('users.password');
        Route::put('update-password/{id}', 'BackEnd\UserController@updatePassword')->name('users.update-password');
    });

    Route::get('profile', 'BackEnd\UserController@profile')->name('users.profile');
    Route::put('update-info/{id}', 'BackEnd\UserController@updateInfo')->name('users.update-info');
    Route::put('change-password/{id}', 'BackEnd\UserController@changePassword')->name('users.change-password');
    Route::put('change-avatar/{id}', 'BackEnd\UserController@changeAvatar')->name('users.change-avatar');
});
