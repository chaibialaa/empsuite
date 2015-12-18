<?php

Route::group(array('module' => 'Level', 'namespace' => 'App\Modules\Level\Controllers'), function() {

    Route::get('admin/level/', 'LevelController@listLevel');
    Route::post('admin/level/add', 'LevelController@addLevel');

    Route::get('admin/level/class', 'ClassController@listClass');
    Route::post('admin/level/class/add', 'ClassController@addClass');

    Route::get('admin/level/section', 'SectionController@listSection');
    Route::post('admin/level/section/add', 'SectionController@addSection');

    Route::get('admin/level/class/{id}', 'ClassController@manageClass');


});	