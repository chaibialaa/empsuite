<?php namespace App\Modules\Level\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Modules\Level\Models\Level;
use Input, View, DB, App\Helpers\ConfigFromDB;

class LevelController extends Controller {

    public function redirectLevel()
    {
        return redirect('/admin/level/');
    }

	public function listLevel()
	{
        $module['Title'] = "Level Manager";
        $module['SubTitle'] = "Levels Dashboard";

		$classes = DB::table('classes')
			->select('*', DB::raw("COUNT('classes.id') AS class_count"))
			->join('levels', 'levels.id', '=', 'classes.level_id')
  			->orderBy('class_count', 'desc')
			->groupBy('levels.id')
			->take(5)
			->get();

		$lList = DB::table('levels')
			->get();

		$additionalLibs[0] = "libraries/chartjs/Chart.min.js";
		$additionalLibs[2] = "libraries/datatables/jquery.dataTables.min.js";
		$additionalLibs[1] = "libraries/datatables/dataTables.bootstrap.min.js";
		$additionalCsss[0] = "libraries/datatables/dataTables.bootstrap.css";

		$view = View::make('backend.' . ConfigFromDB::setting('backend_theme') . '.layout');
		$ComposedSubView = View::make('Level::backend.list')
			->with('classes', $classes)
			->with('lList', $lList);
		$view->with('content', $ComposedSubView)->with('module', $module);
		$view->with('additionalCsss', $additionalCsss);
		$view->with('additionalLibs', $additionalLibs);
		return $view;
	}

    public function addLevel(){
        $data = Input::all();
        Level::create([
            'title' => $data['title']
        ]);
        alert()->success('Level ajoutee avec success');

        return $this->redirectLevel();
    }

}
