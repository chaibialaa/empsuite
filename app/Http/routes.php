<?php



    Route::get('/', 'CoreController@home');
    Route::get('admin',['middleware' => 'auth','uses'=>'CoreController@admin']);
    Route::get('/lang/{lang}', ['as'=>'lang.switch', 'uses'=>'CoreController@switchLanguage']);

/*
          Sert d'exemple pour un double middleware (gerer droit)
         ,
              'middleware' => 'auth',
              'uses'=>'CoreController@admin', function()
          {
              'CoreController@admin';
          }*/