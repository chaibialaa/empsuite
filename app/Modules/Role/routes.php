<?php

Route::group(array('module' => 'Role', 'namespace' => 'App\Modules\Role\Controllers'), function() {

    Route::get('admin/role/', 'RoleController@listAll');
    Route::get('admin/role/affect/', 'RoleController@affectRole');

    Route::get('admin/role/add/', 'RoleController@formaddRole');
    Route::post('admin/role/add/', 'RoleController@addRole');

    Route::get('admin/role/edit/{id}', 'RoleController@formeditRole');
    Route::post('admin/role/edit/{id}', 'RoleController@editRole');

    Route::post('admin/role/affect/manageRequested/{id}', 'RoleController@manageRequested');
    Route::post('admin/role/affect/manageUserRoles/{id}', 'RoleController@manageUserRoles');


});	