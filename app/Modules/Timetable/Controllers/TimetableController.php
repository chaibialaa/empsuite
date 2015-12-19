<?php namespace App\Modules\Timetable\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Modules\Level\Models\Classm;
use App\Modules\Resource\Models\Classroom;
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

        $tList = DB::table('timetable_types')->get();

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
			->with('cList', $cList)
            ->with('tList', $tList);
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

        $events= DB::table('subject_pc')
            ->where('class_id','=',$data['class'])
            ->join('users','users.id','=','subject_pc.professor_id')
            ->join('subject_cm AS s','s.id','=','subject_pc.cm_id')
            ->join('subjects','subjects.id','=','s.subject_id')
            ->join('modules','modules.id','=','s.module_id')
            ->select('subjects.title as subject','modules.title as module','users.nom as professor','subject_pc.id as subject_pc')
            ->get();

        $classroom = classroom::all();

        $feList = array();
        foreach ($events as $e) {
            $array = array($e);
            $feList[$e->module][] = $array;
        }

        $additionalLibs[0] = "libraries/fullcalendar/lib/jquery-ui.custom.min.js";
        $additionalLibs[1] = "libraries/fullcalendar/lib/moment.min.js";
        $additionalLibs[2] = "libraries/fullcalendar/fullcalendar.min.js";
        $additionalCsss[0] = "libraries/fullcalendar/fullcalendar.min.css";

        $view = View::make('backend.' . ConfigFromDB::setting('backend_theme') . '.layout');
        if ($data['class'] == 1){
            $ComposedSubView = View::make('Timetable::backend.addRoutine')
                ->with('class', $class)
                ->with('classroom', $classroom)
                ->with('feList', $feList);
        } else {
            $ComposedSubView = View::make('Timetable::backend.addSpecial')
                ->with('class', $class)
                ->with('classroom', $classroom)
                ->with('feList', $feList);
        }

        $view->with('content', $ComposedSubView)->with('module', $module);
        $view->with('additionalCsss', $additionalCsss);
        $view->with('additionalLibs', $additionalLibs);
        return $view;
    }

    public function addTimetable(){

        return $this->redirectTimetable();
    }

}
