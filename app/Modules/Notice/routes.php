<?php

Route::group(array('module' => 'Notice', 'namespace' => 'App\Modules\Notice\Controllers'), function() {
    // Administration routes
        //Category routes
    Route::get('admin/notice/category/',['middleware' => 'auth','uses'=>'CategoryController@listCategory']);

    Route::post('admin/notice/category/add',['middleware' => 'auth','uses'=>'CategoryController@addCategory']);
    Route::post('admin/notice/category/rename/{id}',['middleware' => 'auth','uses'=>'CategoryController@renameCategory']);
    Route::post('admin/notice/category/delete/{id}',['middleware' => 'auth','uses'=>'CategoryController@deleteCategory']);

        //Notice routes
    Route::get('admin/notice/add',['middleware' => 'auth','uses'=>'NoticeController@formaddNotice']);
    Route::get('admin/notice/edit/{id}',['middleware' => 'auth','uses'=>'NoticeController@formeditNotice']);
    Route::get('admin/notice/',['middleware' => 'auth','uses'=>'NoticeController@listNoticeBackend']);

    Route::post('admin/notice/add',['middleware' => 'auth','uses'=>'NoticeController@addNotice']);
    Route::post('admin/notice/publish/{id}',['middleware' => 'auth','uses'=>'NoticeController@publishNotice']);
    Route::post('admin/notice/holdon/{id}',['middleware' => 'auth','uses'=>'NoticeController@holdonNotice']);
    Route::post('admin/notice/delete/{id}',['middleware' => 'auth','uses'=>'NoticeController@deleteNotice']);
    Route::post('admin/notice/edit/{id}',['middleware' => 'auth','uses'=>'NoticeController@updateNotice']);

    // Frontend routes
        //Category routes
    Route::get('notice/{category}', 'CategoryController@categoryNotice');

        //Notice routes
    Route::get('notice/', 'NoticeController@listNoticeFrontend');
    Route::get('notice/{category}/{id}/{link}', 'NoticeController@showNotice');
});	