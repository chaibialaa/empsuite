<?php

Route::group(array('module' => 'Subject', 'namespace' => 'App\Modules\Subject\Controllers'), function() {

    Route::get('admin/subject/', 'SubjectController@listModule');
    Route::post('admin/subject/add', 'SubjectController@addSubject');

    Route::get('admin/subject/subjectModule', 'SubjectController@ModuleSubject');
    Route::get('admin/subject/classModule', 'SubjectController@ClassSubject');

    Route::post('admin/subject/module/add', 'SubjectController@addModule');
});	