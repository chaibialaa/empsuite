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

		$cList = classm::all();

		$fList = DB::table('timetables')
            ->join('classes', 'classes.id', '=', 'timetables.class_id')
            ->join('levels', 'levels.id', '=', 'classes.level_id')
            ->leftjoin('timetable_types as tt','tt.id','=','timetables.type')
            ->leftjoin('sections', 'sections.id', '=', 'classes.section_id')
            ->select('levels.title as level_title', 'classes.title as title', 'classes.id as id', 'levels.id as level_id','classes.section_id as section_id',
                'timetables.status as enb','timetables.id as tid','sections.title as section_title','tt.title as type_title','tt.id as type_id')
            ->orderBy('classes.level_id')
            ->orderBy('classes.section_id')
            ->orderBy('classes.id')
            ->orderBy('type_id')
            ->get();

        $tList = DB::table('timetable_types')->get();

        $fcList = array();

        foreach ($fList as $m) {
            $array = array($m);
            if($m->section_id) {
                $fcList[$m->level_title][$m->section_title][$m->title][$m->type_title][] = $array;
            } else {
                $fcList[$m->level_title]['No Section'][$m->title][$m->type_title][] = $array;
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
        $additionalLibs[4] = "libraries/printElem/jQuery.print.js";

        $additionalCsss[0] = "libraries/fullcalendar/fullcalendar.min.css";
        $additionalCsss[1] = "libraries/toastr/build/toastr.css";

        $view = View::make('backend.' . ConfigFromDB::setting('backend_theme') . '.layout');
        if ($data['type'] == 1){
            $ComposedSubView = View::make('Timetable::backend.addRoutine')
                ->with('class', $class)
                ->with('classroom', $fcList)
                ->with('feList', $feList);
        } else {
            $ComposedSubView = View::make('Timetable::backend.addExam')
                ->with('class', $class)
                ->with('classroom', $fcList)
                ->with('feList', $feList);
        }

        $view->with('content', $ComposedSubView)->with('module', $module);
        $view->with('additionalCsss', $additionalCsss);
        $view->with('additionalLibs', $additionalLibs);
        return $view;
    }

    public function editformTimetable($id){

        $module['Title'] = "Timetable Manager";
        $module['SubTitle'] = "Edit Timetable";
        $timetable = DB::table('timetables')->where('timetables.id','=',$id)->first();
        $class = DB::table('timetables')
            ->join('classes','classes.id','=','timetables.class_id')
            ->where('timetables.id','=',$id)
            ->select('classes.title as title','classes.id as id')
            ->first();
        $iniEvents = DB::table('timetable_elements')
            ->where('timetable','=',$id)
            ->join('subject_pc AS p','p.id','=','timetable_elements.subject_pc')
            ->join('users AS u','u.id','=','p.professor_id')
            ->join('subject_cm AS c','c.id','=','p.cm_id')
            ->join('subjects','subjects.id','=','c.subject_id')
            ->join('classrooms','classrooms.id','=','timetable_elements.classroom')
            ->select('u.nom as professor','subjects.title as subject','classrooms.id as classid','classrooms.title as classroom','color','date','endTime','startTime','p.id as spc')
            ->get();

        $events= DB::table('subject_pc')
            ->where('class_id','=',$class->id)
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
        $additionalLibs[4] = "libraries/printElem/jQuery.print.js";
        $additionalCsss[0] = "libraries/fullcalendar/fullcalendar.min.css";
        $additionalCsss[1] = "libraries/toastr/build/toastr.css";

        $view = View::make('backend.' . ConfigFromDB::setting('backend_theme') . '.layout');
        if ($timetable->type == 1){
            $ComposedSubView = View::make('Timetable::backend.editRoutine')
                ->with('class', $class)
                ->with('classroom', $fcList)
                ->with('feList', $feList)
                ->with('iniEvents', $iniEvents)
                ->with('iii',$id);
        } else {
            $ComposedSubView = View::make('Timetable::backend.editExam')
                ->with('class', $class)
                ->with('classroom', $fcList)
                ->with('feList', $feList)
                ->with('iniEvents', $iniEvents)
                ->with('iii',$id);
        }

        $view->with('content', $ComposedSubView)->with('module', $module);
        $view->with('additionalCsss', $additionalCsss);
        $view->with('additionalLibs', $additionalLibs);
        return $view;
    }

    public function updateTimetable(){
        $d = Input::all();
        if(!Input::has('events')){
            return response()->json(['state'=>9],200);
        }
        DB::table('timetable_elements')->where('timetable','=',$d['iii'])->delete();
        foreach($d['events'] as $e=>$t){
            $start = DateTime::createFromFormat('D M d Y H:i:s e+',$t['start']);
            $end = DateTime::createFromFormat('D M d Y H:i:s e+',$t['end']);
            DB::table('timetable_elements')->insert([
                'timetable' => $d['iii'],
                'startTime' => $start->format('H:i:s'),
                'endTime' => $end->format('H:i:s'),
                'date' => $start->format('Y-m-d'),
                'color' => $t['bg'],
                'subject_pc' => $t['spc'],
                'classroom' => $t['classroom'],
            ]);

        }
        return response()->json(['state'=>5],200);
    }
    public function addTimetable(){
        $d = Input::all();
        if(!Input::has('events')){
            return response()->json(['state'=>9],200);
        }
        if($d['type']==1){
        $timetable = Timetable::create([
            'class_id' => $d['classid'],
            'status' => 0,
            'type' =>1
        ]);} else {
            $timetable = Timetable::create([
                'class_id' => $d['classid'],
                'status' => 1,
                'type' =>2]);
        }
        foreach($d['events'] as $e=>$t){
                $start = DateTime::createFromFormat('D M d Y H:i:s e+',$t['start']);
                $end = DateTime::createFromFormat('D M d Y H:i:s e+',$t['end']);
                DB::table('timetable_elements')->insert([
                    'timetable' => $timetable->id,
                    'startTime' => $start->format('H:i:s'),
                    'endTime' => $end->format('H:i:s'),
                    'date' => $start->format('Y-m-d'),
                    'color' => $t['bg'],
                    'subject_pc' => $t['spc'],
                    'classroom' => $t['classroom'],
                ]);

        }
        return response()->json(['state'=>5],200);
    }

    public function verifyClassroom(){

        $d= Input::all();
        $date = DateTime::createFromFormat('D M d Y H:i:s e+',$d['date'])->format('Y-m-d');

        $compare = DB::table('timetable_elements')
            ->join('timetables','timetables.id','=','timetable_elements.timetable')
            ->where('timetables.status','=',1)
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
            ->where('timetables.type','=',$d['type'])
            ->where('date','=',$date)
            ->select('timetable_elements.timetable as tid')
            ->first();

        $state = 1;
        $cl = "";
        if ($compare){
            $state = 0;
            $c = DB::table('timetables')
                ->join('classes','classes.id','=','timetables.class_id')
                ->where('timetables.id','=',$compare->tid)
                ->select('classes.title as title')
                ->first();
            $cl = $c->title;
            if(Input::get('iii')){
                if (Input::get('iii') == $compare->tid){
                    return response()->json(['state'=>1,'class'=>""],200);
                }
            }
        }


        return response()->json(['state'=>$state,'class'=>$cl],200);
    }
    public function verifyProfessor(){
        $d= Input::all();

        $professor = DB::table('subject_pc')->where('id','=',$d['subject_pc'])->select('professor_id as id')->first();
        $date = DateTime::createFromFormat('D M d Y H:i:s e+',$d['date'])->format('Y-m-d');

        $compare = DB::table('timetable_elements')
            ->join('subject_pc as pc','pc.id','=','timetable_elements.subject_pc')
            ->where('timetables.status','=',1)
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
            ->where('date','=',$date)
            ->select('timetable_elements.timetable as tid')
            ->first();

        $state = 1;
        if ($compare){
            $state = 0;
            if(Input::get('iii')){
                if (Input::get('iii') == $compare->tid){
                    return response()->json(['state'=>1,'class'=>""],200);
                }
            }
        }


        return response()->json(['state'=>$state],200);
    }

    public function deleteTimetable($id){
        DB::table('timetable_elements')->where('timetable','=',$id)->delete();
        DB::table('timetables')->where('id','=',$id)->delete();
        alert()->success('Timetable deleted');
        return $this->redirectTimetable();
    }

    public function enableTimetable($id){
        $class = Input::get('classe');
        DB::table('timetables')->where('class_id','=',$class)
            ->where('status','=',1)
            ->where('type','=',1)
            ->update(['status'=>0]);

        DB::table('timetables')->where('id','=',$id)->update(['status'=>1]);
        alert()->success('Timetable enabled');
        return $this->redirectTimetable();
    }

    public function disableTimetable($id){

        DB::table('timetables')->where('id','=',$id)->update(['status'=>0]);
        alert()->success('Timetable disabled');
        return $this->redirectTimetable();
    }


}
