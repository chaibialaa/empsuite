<?php

Route::group(array('module' => 'Message', 'namespace' => 'App\Modules\Message\Controllers', 'middleware' => 'auth'), function() {

    // Frontend routes
    Route::get('message/', 'MessageController@listInboxMessageFrontend');
    Route::get('message/sent', 'MessageController@listSentMessageFrontend');
    Route::get('message/draft', 'MessageController@listDraftMessageFrontend');

    Route::get('message/compose', 'MessageController@formaddMessageFrontend');

    Route::get('message/inbox/{id}', 'MessageController@readInboxMessageFrontend');
    Route::get('message/draft/{id}', 'MessageController@readDraftMessageFrontend');
    Route::get('message/sent/{id}', 'MessageController@readSentMessageFrontend');

    Route::post('message/compose/add', 'MessageController@addMessageFrontend');

});