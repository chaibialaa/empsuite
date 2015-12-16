<?php namespace App\Modules\Resource\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Modules\Resource\Models\Classroom;
use Input, View, DB, App\Helpers\ConfigFromDB;

class ClassroomController extends Controller {

	public function listClassroom()
	{
        $module['Title'] = "Subject Manager";
        $module['SubTitle'] = "Subjects Dashboard";

        $crList = Classroom::all();
        $crsList = DB::table('classroom_statuses');

        $additionalLibs[0] = "libraries/chartjs/Chart.min.js";
        $additionalLibs[2] = "libraries/datatables/jquery.dataTables.min.js";
        $additionalLibs[1] = "libraries/datatables/dataTables.bootstrap.min.js";
        $additionalCsss[0] = "libraries/datatables/dataTables.bootstrap.css";

        $view = View::make('backend.' . ConfigFromDB::setting('theme') . '.layout');
        $ComposedSubView = View::make('Resource::backend.listClassroom');
        $view->with('content', $ComposedSubView)->with('module', $module);
        $view->with('additionalCsss', $additionalCsss);
        $view->with('additionalLibs', $additionalLibs);
        return $view;
	}

	public function addClassroom(){

	}

}
