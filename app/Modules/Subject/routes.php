<?php

Route::group(array('module' => 'Subject', 'namespace' => 'App\Modules\Subject\Controllers'), function() {

    Route::get('admin/subject/',['middleware' => 'auth','uses'=>'SubjectController@listAll']);
    Route::post('admin/subject/add',['middleware' => 'auth','uses'=>'SubjectController@addSubject']);

    Route::get('admin/subject/subjectModule',['middleware' => 'auth','uses'=>'SubjectController@ModuleSubject']);
    Route::get('admin/subject/classModule',['middleware' => 'auth','uses'=>'SubjectController@classModule']);

    Route::post('admin/subject/module/add',['middleware' => 'auth','uses'=>'SubjectController@addModule']);
    Route::post('admin/subject/classModule/attach',['middleware' => 'auth','uses'=>'SubjectController@attachClassModule']);

    Route::post('admin/subject/classModule/view',['middleware' => 'auth','uses'=>'SubjectController@moduleClassView']);
    Route::post('admin/subject/subjectModule/add',['middleware' => 'auth','uses'=>'SubjectController@addSubjectModule']);
});