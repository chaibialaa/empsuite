<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Modules\Announcement\Controllers\AnnouncementController;
use Session, Config, Redirect, Auth, Route, DB;
use Illuminate\Support\Facades\View;
use App\Helpers\ConfigFromDB;
use App\Modules\User\Models\User;
class CoreController extends Controller {


	public function home()
	{
		$view = View::make('frontend.'.ConfigFromDB::setting('theme').'.layout');
        $return = new AnnouncementController();
		$view->with('topcontent',$return->showSlider());
		return $view;

	}
	public function admin()
	{

			$view = View::make('backend.'.ConfigFromDB::setting('theme').'.layout');


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

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
