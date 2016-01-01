<?php

namespace App\Modules\User\Middleware;

use App\Modules\User\Controllers\ViewBuilder;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Session, Config;
class Authenticate
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                alert()->warning('Veuillez vous identifier');
                return redirect('/user');
            }
        } else {
            $lang = $this->auth->user()->language;
            if (array_key_exists($lang, Config::get('app.languages'))) {
                Session::set('applocale', $lang);
            }
        }
        return $next($request);
    }
}
