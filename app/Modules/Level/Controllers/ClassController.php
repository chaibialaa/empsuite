<?php
namespace App\Modules\Level\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Modules\Level\Models\Classm;
use App\Modules\Level\Models\Level;
use Input, View, DB, App\Helpers\ConfigFromDB;
class ClassController extends Controller
{
    public function redirectClass()
    {
        return redirect('/admin/level/class');
    }

    public function listClass()
    {
        $module['Title'] = "Class Manager";
        $module['SubTitle'] = "Classes Dashboard";

        $MostClassHavingStudents = DB::table('user_classes')
            ->select('*', DB::raw("COUNT('users.id') AS user_count"))
            ->join('classes', 'classes.id', '=', 'user_classes.user_id')
            ->orderBy('user_count', 'desc')
            ->groupBy('classes.id')
            ->take(5)
            ->get();

        $cList = DB::table('level_classes')
            ->join('classes', 'classes.id', '=', 'level_classes.class_id')
            ->join('levels', 'levels.id', '=', 'level_classes.level_id')
            ->select('levels.title as level_title', 'classes.title as title', 'classes.id as id', 'levels.id as level_id', 'classes.created_at as created_at')
            ->get();


        $lList = Level::all();

        $additionalLibs[0] = "libraries/chartjs/Chart.min.js";
        $additionalLibs[2] = "libraries/datatables/jquery.dataTables.min.js";
        $additionalLibs[1] = "libraries/datatables/dataTables.bootstrap.min.js";
        $additionalCsss[0] = "libraries/datatables/dataTables.bootstrap.css";

        $view = View::make('backend.' . ConfigFromDB::setting('backend_theme') . '.layout');
        $ComposedSubView = View::make('Level::backend.listClass')
            ->with('classes', $MostClassHavingStudents)
            ->with('cList', $cList)
            ->with('lList', $lList);
        $view->with('content', $ComposedSubView)->with('module', $module);
        $view->with('additionalCsss', $additionalCsss);
        $view->with('additionalLibs', $additionalLibs);
        return $view;
    }

    public function addClass(){
        $data = Input::all();

        $ClassData = Classm::create([
            'title' => $data['title']
        ]);

        DB::table('level_classes')->insert(
            ['level_id' => $data['level'],
             'class_id' => $ClassData->id ]);

        alert()->success('Class ajoutee avec success');

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

    }

    public function teachClass(){

    }
}