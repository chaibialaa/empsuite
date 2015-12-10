<?php

namespace App\Http\Middleware;

use Closure, Session, App, Config, Auth;
class LanguageSwitch
{

    public function handle($request, Closure $next)
	  {
          if (!Auth::check()) {
              if (Session::has('applocale') AND array_key_exists(Session::get('applocale'), Config::get('app.languages'))) {
                  App::setLocale(Session::get('applocale'));
              }

          } else {
              $lang = Auth::user()->language;
              if ($lang AND array_key_exists($lang, Config::get('app.languages'))) {
                  App::setLocale($lang);
              }
          }
          return $next($request);
      }
}