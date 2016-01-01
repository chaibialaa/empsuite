<?php

Route::group(array('module' => 'Timetable', 'namespace' => 'App\Modules\Timetable\Controllers'), function() {

    Route::get('admin/timetable/',['middleware' => 'auth','uses'=>'TimetableController@listAll']);
    Route::post('admin/timetable/add',['middleware' => 'auth','uses'=>'TimetableController@addformTimetable']);
    Route::get('admin/timetable/edit/{id}',['middleware' => 'auth','uses'=>'TimetableController@editformTimetable']);

    Route::get('admin/timetable/verifyC',['middleware' => 'auth','uses'=>'TimetableController@verifyClassroom']);
    Route::get('admin/timetable/verifyP',['middleware' => 'auth','uses'=>'TimetableController@verifyProfessor']);

    Route::get('admin/timetable/submit',['middleware' => 'auth','uses'=>'TimetableController@addTimetable']);
    Route::get('admin/timetable/update',['middleware' => 'auth','uses'=>'TimetableController@updateTimetable']);

    Route::post('admin/timetable/enable/{id}',['middleware' => 'auth','uses'=>'TimetableController@enableTimetable']);
    Route::post('admin/timetable/disable/{id}',['middleware' => 'auth','uses'=>'TimetableController@disableTimetable']);
    
});