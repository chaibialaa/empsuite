<?php

Route::group(array('module' => 'Timetable', 'namespace' => 'App\Modules\Timetable\Controllers'), function() {

    Route::get('admin/timetable/', 'TimetableController@listAll');
    Route::post('admin/timetable/add', 'TimetableController@addformTimetable');
    Route::get('admin/timetable/edit/{id}', 'TimetableController@editformTimetable');

    Route::get('admin/timetable/verifyC', 'TimetableController@verifyClassroom');
    Route::get('admin/timetable/verifyP', 'TimetableController@verifyProfessor');

    Route::get('admin/timetable/submit', 'TimetableController@addTimetable');
    Route::get('admin/timetable/update', 'TimetableController@updateTimetable');

    Route::post('admin/timetable/enable/{id}', 'TimetableController@enableTimetable');
    Route::post('admin/timetable/disable/{id}', 'TimetableController@disableTimetable');
    
});