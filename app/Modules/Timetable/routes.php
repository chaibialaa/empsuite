<?php

Route::group(array('module' => 'Timetable', 'namespace' => 'App\Modules\Timetable\Controllers'), function() {

    Route::get('admin/timetable/', 'TimetableController@listAll');
    Route::post('admin/timetable/add', 'TimetableController@addformTimetable');

    Route::get('admin/timetable/verifyC', 'TimetableController@verifyClassroom');
    Route::get('admin/timetable/verifyP', 'TimetableController@verifyProfessor');

    Route::post('admin/timetable/submit', 'TimetableController@addTimetable');
    
});