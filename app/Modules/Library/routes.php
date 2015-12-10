<?php

Route::group(array('module' => 'Library', 'namespace' => 'App\Modules\Library\Controllers'), function() {

    Route::resource('Library', 'LibraryController');
    
});	