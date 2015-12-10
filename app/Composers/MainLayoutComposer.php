<?php

namespace App\Composers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\ConfigFromDB;
class MainLayoutComposer extends ServiceProvider
{

// This builds the frontend homepage and backend homepage
    public function boot()
    {
        view()->composer('frontend.'.ConfigFromDB::setting('theme').'.layout', function ($view)   {
                $view->with('titre', ConfigFromDB::setting('titre'));
                $view->with('theme', ConfigFromDB::setting('theme'));

        });

        view()->composer('backend.'.ConfigFromDB::setting('theme').'.layout', function ($view)   {
            $view->with('titre', ConfigFromDB::setting('titre'));
            $view->with('theme', ConfigFromDB::setting('theme'));
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