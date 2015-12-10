<?php

Route::group(array('module' => 'Page', 'namespace' => 'App\Modules\Page\Controllers'), function() {

    Route::resource('Page', 'PageController');
    
});	