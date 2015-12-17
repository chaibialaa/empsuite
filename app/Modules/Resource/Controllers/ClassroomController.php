<?php namespace App\Modules\Resource\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Modules\Resource\Models\Classroom;
use Input, View, DB, App\Helpers\ConfigFromDB;

class ClassroomController extends Controller {

    public function redirectClassroom()
    {
        return redirect('/admin/resource/classroom');
    }

	public function listClassroom()
	{
        $module['Title'] = "Subject Manager";
        $module['SubTitle'] = "Subjects Dashboard";

        $crList = DB::table('classrooms')
            ->join('classroom_statuses','classroom_statuses.id','=','classrooms.status')
            ->select('capacity','classrooms.id as id', 'classroom_statuses.title as status_title', 'classrooms.title as title')
            ->get();
        $crsList = DB::table('classroom_statuses')->get();

        $additionalLibs[0] = "libraries/chartjs/Chart.min.js";
        $additionalLibs[2] = "libraries/datatables/jquery.dataTables.min.js";
        $additionalLibs[1] = "libraries/datatables/dataTables.bootstrap.min.js";
        $additionalCsss[0] = "libraries/datatables/dataTables.bootstrap.css";

        $view = View::make('backend.' . ConfigFromDB::setting('backend_theme') . '.layout');
        $ComposedSubView = View::make('Resource::backend.listClassroom')
            ->with('crList',$crList)
            ->with('crsList',$crsList);
        $view->with('content', $ComposedSubView)->with('module', $module);
        $view->with('additionalCsss', $additionalCsss);
        $view->with('additionalLibs', $additionalLibs);
        return $view;
	}

	public function addClassroom(){
        $data = Input::all();
        Classroom::create([
           'title' => $data['title'],
            'status' => $data['status'],
            'capacity' => $data['capacity']
        ]);
        alert()->success('Salle de classe creee avec success');
        return $this->redirectClassroom();
	}

}
