<?php

Route::group(array('module' => 'Subject', 'namespace' => 'App\Modules\Subject\Controllers'), function() {

    Route::get('admin/subject/', 'SubjectController@listAll');
    Route::post('admin/subject/add', 'SubjectController@addSubject');

    Route::get('admin/subject/subjectModule', 'SubjectController@ModuleSubject');
    Route::get('admin/subject/classModule', 'SubjectController@classModule');

    Route::post('admin/subject/module/add', 'SubjectController@addModule');
    Route::post('admin/subject/classModule/attach', 'SubjectController@attachClassModule');
    Route::post('admin/subject/subjectModule/add', 'SubjectController@addSubjectModule');
});	