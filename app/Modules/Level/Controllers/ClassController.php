<?php
namespace App\Modules\Level\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Modules\Level\Models\Classm;
use App\Modules\Level\Models\Level;
use App\Modules\Level\Models\Section;
use Auth, Input, View, DB, App\Helpers\ConfigFromDB,App\Helpers\Logger;
class ClassController extends Controller
{
    public function redirectClass()
    {
        return redirect('/admin/level/class');
    }

    public function listClass()
    {

        if (!Auth::user()->can('ListLevelClass')) {
            alert()->warning(trans('common.no_access'));
            return redirect('/admin/level/');
        }

        $module['Title'] = "Class Manager";
        $module['SubTitle'] = "Classes Dashboard";

        $MostClassHavingStudents = DB::table('class_users')
            ->select('*', DB::raw("COUNT('users.id') AS user_count"))
            ->join('classes', 'classes.id', '=', 'class_users.student_id')
            ->where('status','=','1')
            ->orderBy('user_count', 'desc')
            ->groupBy('classes.id')
            ->take(5)
            ->get();

        $cList = DB::table('classes')
            ->join('levels', 'levels.id', '=', 'classes.level_id')
            ->leftjoin('sections', 'sections.id', '=', 'classes.section_id')
            ->select('sections.title as section_title','levels.title as level_title', 'classes.title as title', 'classes.id as id', 'levels.id as level_id','classes.section_id as section_id')
            ->orderBy('classes.level_id', 'classes.section_id')
            ->get();


        $lList = Level::all();
        $sList = Section::all();

        $fcList = array();

            foreach ($cList as $m) {
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
        $ComposedSubView = View::make('Level::backend.listClass')
            ->with('classes', $MostClassHavingStudents)
            ->with('cList', $fcList)
            ->with('sList', $sList)
            ->with('lList', $lList);
        $view->with('content', $ComposedSubView)->with('module', $module);
        $view->with('additionalCsss', $additionalCsss);
        $view->with('additionalLibs', $additionalLibs);
        return $view;
    }

    public function addClass(){
        if (!Auth::user()->can('AddLevelClass')) {
            alert()->warning(trans('common.no_action'));
            return $this->redirectClass();
        }
        $data = Input::all();
        if ((!array_key_exists('section', $data)) or (($data['section']=='No Section'))){
            Classm::create([
                'title' => $data['title'],
                'level_id' => $data['level']
            ]);

        }else {
            Classm::create([
                'title' => $data['title'],
                'level_id' => $data['level'],
                'section_id' => $data['section']
            ]);
        }


        alert()->success(trans('common.success_add', ['item' => 'Class']));
        logger::log(Auth::user()->id,trans('common.add'),4,$data['title']);
        return $this->redirectClass();
    }

    public function manageClass($id){
        /* TODO :
         Subjects + Teachers + Students
         subjects should be classified in a datatable of subjects with their appropriate teachers and students not
         being a teachers
         */
    }

    public function joinClass(){
        if (!Auth::user()->can('JoinClass')) {
            alert()->warning(trans('common.no_action'));
            return redirect('/class');
        }

    }

    public function formJoinClass(){

        $verify = DB::table('class_users')
            ->where('student_id','=',Auth::user()->id)
            ->get();

        if ($verify) {
            // verify if user has no pending joins or already have a class
            if ($verify->status == 0) {
                alert()->warning(trans('Level::frontend/class.pending'));
                return redirect('/class');
            }
            elseif ($verify->status == 1) {
                alert()->warning(trans('Level::frontend/class.already_join'));
                return redirect('/class');
            }
        }

        $module['Title'] = "Subject Manager";
        $module['SubTitle'] = "Subjects Dashboard";
        // list classes
        $classes = DB::table('classes')
            ->join('levels', 'levels.id', '=', 'classes.level_id')
            ->leftjoin('sections', 'sections.id', '=', 'classes.section_id')
            ->select('levels.title as level_title', 'classes.title as title', 'classes.id as id', 'levels.id as level_id','classes.section_id as section_id',
               'sections.title as section_title')
                ->orderBy('classes.level_id')
                ->orderBy('classes.section_id')
                ->orderBy('classes.id')
                ->get();

        $fcList = array();
        foreach ($classes as $m) {
            $array = array($m);
            if($m->section_id) {
                $fcList[$m->level_title][$m->section_id][] = $array;
            } else {
                $fcList[$m->level_title]['No Section'][] = $array;
            }
        }
        $view = View::make('frontend.' . ConfigFromDB::setting('frontend_theme') . '.layout');
        $ComposedSubView = View::make('Level::frontend.study')
            ->with('classes', $fcList);
        $view->with('content', $ComposedSubView);
        return $view;

    }
    public function teachClass(){

    }
}