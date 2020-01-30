<?php

Route::group(['prefix' => 'permissions'], function () {
    Route::get('', 'BackEnd\PermissionController@index')->name('permissions');
    Route::get('getData', 'BackEnd\RoleController@getData')->name('get.permissions');
});
