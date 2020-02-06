<?php

Route::group(['prefix' => 'roles'], function () {
    Route::get('', 'BackEnd\RoleController@index')->name('roles');
    Route::get('getData', 'BackEnd\RoleController@getData')->name('get.roles');

    Route::get('create', 'BackEnd\RoleController@create')->name('roles.create');
    Route::post('create', 'BackEnd\RoleController@store')->name('roles.store');

    Route::get('edit/{id}', 'BackEnd\RoleController@edit')->name('roles.edit');
    Route::put('edit/{id}', 'BackEnd\RoleController@update')->name('roles.update');

    Route::delete('delete/{id}', 'BackEnd\RoleController@delete')->name('roles.delete');
});
