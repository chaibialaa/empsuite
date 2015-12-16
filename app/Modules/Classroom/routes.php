<?php

Route::group(array('module' => 'Classroom', 'namespace' => 'App\Modules\Classroom\Controllers'), function() {

    Route::resource('Classroom', 'ClassroomController');
    
});	