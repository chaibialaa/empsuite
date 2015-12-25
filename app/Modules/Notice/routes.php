<?php

Route::group(array('module' => 'Notice', 'namespace' => 'App\Modules\Notice\Controllers'), function() {
    // Administration routes
        //Category routes
    Route::get('admin/notice/category/', 'CategoryController@listCategory');

    Route::post('admin/notice/category/add', 'CategoryController@addCategory');
    Route::post('admin/notice/category/rename/{id}', 'CategoryController@renameCategory');
    Route::post('admin/notice/category/delete/{id}', 'CategoryController@deleteCategory');

        //Notice routes
    Route::get('admin/notice/add', 'NoticeController@formaddNotice');
    Route::get('admin/notice/edit/{id}', ['as' => 'edit', 'uses'=>'NoticeController@formeditNotice']);
    Route::get('admin/notice/', 'NoticeController@listNoticeBackend');

    Route::post('admin/notice/add', 'NoticeController@addNotice');
    Route::post('admin/notice/publish/{id}', 'NoticeController@publishNotice');
    Route::post('admin/notice/holdon/{id}', 'NoticeController@holdonNotice');
    Route::post('admin/notice/delete/{id}', 'NoticeController@deleteNotice');
    Route::post('admin/notice/edit/{id}', 'NoticeController@updateNotice');

    // Frontend routes
        //Category routes
    Route::get('notice/{category}', 'CategoryController@categoryNotice');

        //Notice routes
    Route::get('notice/', 'NoticeController@listNoticeFrontend');
    Route::get('notice/{category}/{id}/{link}', 'NoticeController@showNotice');
});	