<?php namespace App\Modules\Timetable\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Modules\Level\Models\Classm;
use App\Modules\Timetable\Models\Timetable;
use Input, View, DB, App\Helpers\ConfigFromDB;
use DateTime;
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
            ->select('subjects.title as subject','modules.title as module','users.nom as professor','subject_pc.id as subject_pc','s.week_duration as duration')
            ->get();

        $classroom = DB::table('classrooms')
            ->join('classroom_statuses as c','c.id','=','classrooms.status')
            ->select('classrooms.id as id','c.title as status','classrooms.title as title','classrooms.status as st')
            ->orderBy('status')
            ->get();
        $fcList = array();

        foreach ($classroom as $c) {
            $array = array($c);
            $fcList[$c->status][] = $array;
        }

        $feList = array();
        foreach ($events as $e) {
            $array = array($e);
            $feList[$e->module][] = $array;
        }

        $additionalLibs[0] = "libraries/fullcalendar/lib/jquery-ui.custom.min.js";
        $additionalLibs[1] = "libraries/fullcalendar/lib/moment.min.js";
        $additionalLibs[2] = "libraries/fullcalendar/fullcalendar.min.js";
        $additionalLibs[3] = "libraries/toastr/toastr.js";
        $additionalCsss[0] = "libraries/fullcalendar/fullcalendar.min.css";
        $additionalCsss[1] = "libraries/toastr/build/toastr.css";

        $view = View::make('backend.' . ConfigFromDB::setting('backend_theme') . '.layout');
        if ($data['type'] == 1){
            $ComposedSubView = View::make('Timetable::backend.addRoutine')
                ->with('class', $class)
                ->with('classroom', $fcList)
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
        $d = Input::all();

        // TODO Update class with timetable id
        $timetable = Timetable::create([
            'type' => 1
        ]);
        DB::table('classes')->where('id','=',$d['classid'])->update([
            'timetable_id' => $timetable->id,
        ]);
        foreach($d['events'] as $e=>$t){
                $start = DateTime::createFromFormat('D M d Y H:i:s e+',$t['start']);
                $end = DateTime::createFromFormat('D M d Y H:i:s e+',$t['end']);
                DB::table('timetable_elements')->insert([
                    'timetable' => $timetable->id,
                    'startTime' => $start->format('H:i:s'),
                    'endTime' => $end->format('H:i:s'),
                    'date' => $start->format('Y-m-d'),
                    'day' => $start->format('D'),
                    'color' => $t['bg'],
                    'subject_pc' => $t['spc'],
                    'classroom' => $t['classroom'],
                ]);

        }
        return response()->json(['state'=>1],200);
    }

    public function verifyClassroom(){

        $d= Input::all();
        $day = DateTime::createFromFormat('D M d Y H:i:s e+',$d['day'])->format('D');

        $compare = DB::table('timetable_elements')
            ->Where(function ($query) {
                $query->Where(function ($q) {
                    $q->whereBetween('startTime', array(Input::get('start'), Input::get('end')))
                        ->orwhereBetween('endTime', array(Input::get('start'), Input::get('end')));
                });
                $query->orWhere(function ($q) {
                    $q->where('startTime', '<', Input::get('start'))
                        ->where('endTime', '>', Input::get('end'));
                });
            })
            ->where('classroom','=',$d['classroom'])
            ->where('day','=',$day)
            ->select('timetable_elements.timetable as tid')
            ->first();

        $state = 1;
        $cl = "";
        if ($compare){
            $state = 0;
            $c = DB::table('classes')->where('timetable_id','=',$compare->tid)->select('title')->first();
            $cl = $c->title;
        }


        return response()->json(['state'=>$state,'class'=>$cl],200);
    }
    public function verifyProfessor(){
        $d= Input::all();
        $professor = DB::table('subject_pc')->where('id','=',$d['subject_pc'])->select('professor_id as id')->first();
        $day = DateTime::createFromFormat('D M d Y H:i:s e+',$d['day'])->format('D');

        $compare = DB::table('timetable_elements')
            ->join('subject_pc as pc','pc.id','=','timetable_elements.subject_pc')
            ->Where(function ($query) {
                $query->Where(function ($q) {
                    $q->whereBetween('startTime', array(Input::get('start'), Input::get('end')))
                        ->orwhereBetween('endTime', array(Input::get('start'), Input::get('end')));
                });
                $query->orWhere(function ($q) {
                    $q->where('startTime', '<', Input::get('start'))
                        ->where('endTime', '>', Input::get('end'));
                });
            })
            ->where('pc.professor_id','=',$professor->id)
            ->where('day','=',$day)
            ->first();

        $state = 1;
        if ($compare){
            $state = 0;
        }


        return response()->json(['state'=>$state],200);
    }

}
