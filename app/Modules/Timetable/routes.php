<?php

Route::group(array('module' => 'Timetable', 'namespace' => 'App\Modules\Timetable\Controllers'), function() {

    Route::get('admin/timetable/', 'TimetableController@listAll');
    Route::post('admin/timetable/add', 'TimetableController@addformTimetable');

    Route::get('admin/timetable/verify', 'TimetableController@verifyClassroom');

    Route::post('admin/timetable/submit', 'TimetableController@addTimetable');
    
});