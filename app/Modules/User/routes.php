<?php

Route::group(array('module' => 'User', 'namespace' => 'App\Modules\User\Controllers'), function() {

    Route::post('user/register', 'Auth\AuthController@postRegister');
    Route::get('user/register', 'UserController@redirect');

    Route::get('user/social/{provider}', ['uses' => 'Auth\AuthController@redirectToProvider', 'as' => 'social.login']);
    Route::get('user/social/{provider}/callback', 'Auth\AuthController@handleProviderCallback');
    Route::get('user/profile/{userid}', 'UserController@getUserProfile');

    Route::get('user/login', 'UserController@redirect');
    Route::post('user/login', 'Auth\AuthController@authenticate');

    Route::get('user','UserController@index');

    Route::get('user/verify/{validation}', [
        'as' => 'confirmation_path',
        'uses' => 'UserController@confirm'
    ]);

    Route::get('user/logout', 'Auth\AuthController@getLogout');
    //Route::get('user/role','UserController@formrequestRole');
    Route::post('user/role/request','UserController@requestRole');



});