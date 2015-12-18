<?php

Route::group(array('module' => 'Timetable', 'namespace' => 'App\Modules\Timetable\Controllers'), function() {

    Route::get('admin/timetable/', 'TimetableController@listAll');
    Route::get('admin/timetable/class/add', 'TimetableController@addformTimetable');

    Route::post('admin/timetable/class/add', 'TimetableController@addTimetable');
    
});