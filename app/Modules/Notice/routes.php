<?php

Route::group(array('module' => 'Announcement', 'namespace' => 'App\Modules\Announcement\Controllers'), function() {
    // Administration routes
        //Category routes
    Route::get('admin/announcement/category/', 'CategoryController@listCategory');

    Route::post('admin/announcement/category/add', 'CategoryController@addCategory');
    Route::post('admin/announcement/category/rename/{id}', 'CategoryController@renameCategory');
    Route::post('admin/announcement/category/delete/{id}', 'CategoryController@deleteCategory');

        //Announcement routes
    Route::get('admin/announcement/add', 'AnnouncementController@formaddAnnouncement');
    Route::get('admin/announcement/edit/{id}', ['as' => 'edit', 'uses'=>'AnnouncementController@formeditAnnouncement']);
    Route::get('admin/announcement/', 'AnnouncementController@listAnnouncementBackend');

    Route::post('admin/announcement/add', 'AnnouncementController@addAnnouncement');
    Route::post('admin/announcement/publish/{id}', 'AnnouncementController@publishAnnouncement');
    Route::post('admin/announcement/holdon/{id}', 'AnnouncementController@holdonAnnouncement');
    Route::post('admin/announcement/delete/{id}', 'AnnouncementController@deleteAnnouncement');
    Route::post('admin/announcement/edit/{id}', 'AnnouncementController@updateAnnouncement');

    // Frontend routes
        //Category routes
    Route::get('announcement/{category}', 'CategoryController@categoryAnnouncement');

        //Announcement routes
    Route::get('announcement/', 'AnnouncementController@listAnnouncementFrontend');
    Route::get('announcement/{category}/{id}/{link}', 'AnnouncementController@showAnnouncement');
});	