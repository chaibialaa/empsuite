<?php

Route::group(array('module' => 'Role', 'namespace' => 'App\Modules\Role\Controllers'), function() {

    Route::get('admin/role/',['middleware' => 'auth','uses'=>'RoleController@listAll']);
    Route::get('admin/role/affect/',['middleware' => 'auth','uses'=>'RoleController@affectRole']);

    Route::get('admin/role/add/',['middleware' => 'auth','uses'=>'RoleController@formaddRole']);
    Route::post('admin/role/add/',['middleware' => 'auth','uses'=>'RoleController@addRole]']);

    Route::get('admin/role/edit/{id}',['middleware' => 'auth','uses'=>'RoleController@formeditRole']);
    Route::post('admin/role/edit/{id}',['middleware' => 'auth','uses'=>'RoleController@editRole']);

    Route::post('admin/role/affect/manageRequested/{id}',['middleware' => 'auth','uses'=>'RoleController@manageRequested']);
    Route::post('admin/role/affect/manageUserRoles/{id}',['middleware' => 'auth','uses'=>'RoleController@manageUserRoles']);


});	