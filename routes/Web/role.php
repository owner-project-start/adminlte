<?php

Route::group(['prefix' => 'roles'], function () {
    Route::get('', 'BackEnd\RoleController@index')->name('roles');
    Route::get('edit/{id}', 'BackEnd\RoleController@edit')->name('roles.edit');
    Route::get('getData', 'BackEnd\RoleController@getData')->name('get.roles');
    Route::delete('delete/{id}', 'BackEnd\RoleController@delete')->name('roles.delete');
});
