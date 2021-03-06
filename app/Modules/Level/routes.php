<?php

Route::group(array('module' => 'Level', 'namespace' => 'App\Modules\Level\Controllers'), function() {

    Route::get('admin/level/',['middleware' => 'auth','uses'=>'LevelController@listLevel']);
    Route::post('admin/level/add',['middleware' => 'auth','uses'=>'LevelController@addLevel']);

    Route::get('admin/level/class',['middleware' => 'auth','uses'=>'ClassController@listClass']);
    Route::post('admin/level/class/add',['middleware' => 'auth','uses'=>'ClassController@addClass']);

    Route::get('admin/level/section',['middleware' => 'auth','uses'=>'SectionController@listSection']);
    Route::post('admin/level/section/add',['middleware' => 'auth','uses'=>'SectionController@addSection']);

    Route::get('admin/level/class/{id}',['middleware' => 'auth','uses'=>'ClassController@manageClass']);

    Route::get('dashboard/class',['middleware' => 'auth','uses'=>'ClassController@indexClass']);
    Route::get('dashboard/class/study',['middleware' => 'auth','uses'=>'ClassController@formJoinClass']);
    Route::post('dashboard/class/study',['middleware' => 'auth','uses'=>'ClassController@joinClass']);


});	