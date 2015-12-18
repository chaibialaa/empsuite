<?php namespace App\Modules\Timetable\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Modules\Level\Models\Classm;
use Hamcrest\Core\Is;
use Input, View, DB, App\Helpers\ConfigFromDB;

class TimetableController extends Controller {

    public function redirectTimetable(){
        return redirect('/admin/timetable');
    }

	public function listAll()
	{
		$module['Title'] = "Timetables Manager";
		$module['SubTitle'] = "Timetables Dashboard";

		$cList = classm::whereNull('timetable_id')->get();

		$fList = DB::table('classes')
            ->join('levels', 'levels.id', '=', 'classes.level_id')
            ->join('timetables','timetables.id','=','classes.timetable_id')
            ->select('levels.title as level_title', 'classes.title as title', 'classes.id as id', 'levels.id as level_id','classes.section_id as section_id')
            ->orderBy('classes.level_id', 'classes.section_id')
            ->get();

        $fcList = array();

        foreach ($fList as $m) {
            $array = array($m);
            if($m->section_id) {
                $fcList[$m->level_title][$m->section_id][] = $array;
            } else {
                $fcList[$m->level_title]['No Section'][] = $array;
            }
        }

		$additionalLibs[0] = "libraries/chartjs/Chart.min.js";
		$additionalLibs[2] = "libraries/datatables/jquery.dataTables.min.js";
		$additionalLibs[1] = "libraries/datatables/dataTables.bootstrap.min.js";
		$additionalCsss[0] = "libraries/datatables/dataTables.bootstrap.css";

		$view = View::make('backend.' . ConfigFromDB::setting('backend_theme') . '.layout');
		$ComposedSubView = View::make('Timetable::backend.list')
			->with('fcList', $fcList)
			->with('cList', $cList);
		$view->with('content', $ComposedSubView)->with('module', $module);
		$view->with('additionalCsss', $additionalCsss);
		$view->with('additionalLibs', $additionalLibs);
		return $view;
	}

    public function addformTimetable(){
        $data = Input::all();
        $module['Title'] = "Timetable Manager";
        $module['SubTitle'] = "New Timetable";

        $class = classm::where('id',$data['class'])->first();

        $additionalLibs[0] = "libraries/fullcalendar/lib/jquery-ui.custom.min.js";
        $additionalLibs[1] = "libraries/fullcalendar/lib/moment.min.js";
        $additionalLibs[2] = "libraries/fullcalendar/fullcalendar.min.js";
        $additionalCsss[0] = "libraries/fullcalendar/fullcalendar.min.css";

        $view = View::make('backend.' . ConfigFromDB::setting('backend_theme') . '.layout');
        $ComposedSubView = View::make('Timetable::backend.add')
            ->with('class', $class);
        $view->with('content', $ComposedSubView)->with('module', $module);
        $view->with('additionalCsss', $additionalCsss);
        $view->with('additionalLibs', $additionalLibs);
        return $view;
    }

    public function addTimetable(){

        return $this->redirectTimetable();
    }

}
