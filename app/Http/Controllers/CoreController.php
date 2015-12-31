<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Modules\Notice\Controllers\NoticeController;
use Session, Config, Redirect, Auth, Route, DB;
use Illuminate\Support\Facades\View;
use App\Helpers\ConfigFromDB;
use App\Modules\User\Models\User;
class CoreController extends Controller {


	public function home()
	{
		$view = View::make('frontend.'.ConfigFromDB::setting('frontend_theme').'.layout');
		return $view;

	}
	public function admin()
	{

			$view = View::make('backend.'.ConfigFromDB::setting('backend_theme').'.layout');
			return $view;

	}

	public function switchLanguage($lang)
	{
        if (Auth::check()) {
            $user = User::where('id', '=', Auth::user()->id)->first();
            if (array_key_exists($lang, Config::get('app.languages'))) {
            Session::set('applocale', $lang);
            $user->language = $lang;
            $user->save();
            }
        } else {
            if (array_key_exists($lang, Config::get('app.languages'))) {
            Session::set('applocale', $lang);
             }
        }
        return Redirect::back();
	}

}
