<?php

namespace App\Composers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\ConfigFromDB, App\Helpers\PlacementFetch, DB;
class MainLayoutComposer extends ServiceProvider
{

// This builds the frontend homepage and backend homepage
    public function boot()
    {
        view()->composer('frontend.'.ConfigFromDB::setting('frontend_theme').'.layout', function ($view)   {
                $view->with('title', ConfigFromDB::setting('title'));
                $view->with('theme', ConfigFromDB::setting('frontend_theme'));


            $elem = PlacementFetch::fetch(1);
            foreach($elem as $e=>$t) {
                $view->with($e, $t);
            }
        });

        view()->composer('backend.'.ConfigFromDB::setting('backend_theme').'.layout', function ($view)   {
            $view->with('title', ConfigFromDB::setting('title'));
            $view->with('theme', ConfigFromDB::setting('backend_theme'));
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}