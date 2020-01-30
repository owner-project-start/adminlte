<?php

Route::group(['prefix' => 'users'], function () {
    Route::get('', 'BackEnd\UserController@index')->name('users');
    Route::get('getData', 'BackEnd\UserController@getData')->name('get.users');

    Route::get('create', 'BackEnd\UserController@create')->name('users.create');
    Route::post('store', 'BackEnd\UserController@store')->name('users.store');

    Route::get('edit/{id}', 'BackEnd\UserController@edit')->name('users.edit');
    Route::put('update/{id}', 'BackEnd\UserController@update')->name('users.update');

    Route::delete('delete/{id}', 'BackEnd\UserController@delete')->name('users.delete');
});
