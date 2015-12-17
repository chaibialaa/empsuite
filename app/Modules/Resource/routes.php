<?php

Route::group(array('module' => 'Resource', 'namespace' => 'App\Modules\Resource\Controllers'), function() {

    Route::get('admin/resource/classroom', 'ClassroomController@listClassroom');
    Route::post('admin/resource/classroom/add', 'ClassroomController@addClassroom');

    
});	