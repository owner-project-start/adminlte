<?php

Route::group(['prefix' => 'permissions'], function () {
    Route::get('', 'BackEnd\PermissionController@index')->name('permissions');
    Route::get('getData', 'BackEnd\PermissionController@getData')->name('get.permissions');

    Route::get('create', 'BackEnd\PermissionController@create')->name('permissions.create');
    Route::post('create', 'BackEnd\PermissionController@store')->name('permissions.store');

    Route::get('edit/{id}', 'BackEnd\PermissionController@edit')->name('permissions.edit');
    Route::put('edit/{id}', 'BackEnd\PermissionController@update')->name('permissions.update');

    Route::delete('delete/{id}', 'BackEnd\PermissionController@delete')->name('permissions.delete');
});
