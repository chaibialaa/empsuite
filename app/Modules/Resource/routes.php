<?php

Route::group(array('module' => 'Resource', 'namespace' => 'App\Modules\Resource\Controllers'), function() {

    Route::get('admin/resource/classroom',['middleware' => 'auth','uses'=>'ClassroomController@listClassroom']);
    Route::post('admin/resource/classroom/add',['middleware' => 'auth','uses'=>'ClassroomController@addClassroom']);

    
});	