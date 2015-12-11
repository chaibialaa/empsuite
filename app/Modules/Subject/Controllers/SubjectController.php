<?php namespace App\Modules\Subject\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Modules\Role\Models\Permission;
use App\Modules\Role\Models\Role;
use App\Modules\Subject\Models\Module;
use App\Modules\Subject\Models\Subject;
use Input, View, DB, App\Helpers\ConfigFromDB;

class SubjectController extends Controller {

    public function redirectSubject()
    {
        return redirect('/admin/subject');
    }

    public function redirectSubjectModule()
    {
        return redirect('/admin/subject/subjectModule');
    }

	public function listModule()
	{
        $module['Title'] = "Subject Manager";
        $module['SubTitle'] = "Subjects Dashboard";

        $sList = Subject::all();

        $mList = Module::all();
 // TODO : add a row count of modules usage and subjects usage
        $additionalLibs[0] = "libraries/chartjs/Chart.min.js";
        $additionalLibs[2] = "libraries/datatables/jquery.dataTables.min.js";
        $additionalLibs[1] = "libraries/datatables/dataTables.bootstrap.min.js";
        $additionalCsss[0] = "libraries/datatables/dataTables.bootstrap.css";

        $view = View::make('backend.' . ConfigFromDB::setting('theme') . '.layout');
        $ComposedSubView = View::make('Subject::backend.listModule')
            ->with('mList', $mList)
            ->with('sList', $sList);
        $view->with('content', $ComposedSubView)->with('module', $module);
        $view->with('additionalCsss', $additionalCsss);
        $view->with('additionalLibs', $additionalLibs);
        return $view;

	}

    function searchForUserID($id, $array) {
        $res=null;
        foreach ($array as $key => $val) {
            if ($val->user_id === $id) {
                $res = true;
            }
            else $res = false;
        }
        return $res;
    }

    public function ModuleSubject(){
        $module['Title'] = "Subject Manager";
        $module['SubTitle'] = "Subjects Dashboard";

        $TeachingPermission = Permission::where('name','TeachingStudents')->first();
        $rList = DB::table('permission_role')
            ->join('roles','roles.id','=','permission_role.role_id')
            ->where('permission_id','=',$TeachingPermission->id)
            ->get();

        $pList = array();
        $fpList = array();
        foreach ($rList as $r)
        {
            $topush = DB::table('role_user')
                ->join('users','users.id','=','role_user.user_id')
                ->where('role_id','=',$r->id)
                ->get();
            array_push($pList, $topush);
        }

        foreach ($pList as $p)
        {
            foreach ($p as $p_item)
            {
                if ($this->searchForUserID($p_item->user_id,$fpList) == false) {
                array_push($fpList, $p_item);
                }
            }
        }

        $mList = Module::all();
        $sList = Subject::all();
        $precmList = DB::table('subject_cm')
            ->join('modules', 'modules.id', '=','subject_cm.module_id' )
            ->join('subjects', 'subjects.id', '=', 'subject_cm.subject_id')
            ->select('modules.title as module_title','subjects.title as subject_title','coefficient')

            ->get();



        $additionalLibs[0] = "libraries/chartjs/Chart.min.js";
        $additionalLibs[2] = "libraries/datatables/jquery.dataTables.min.js";
        $additionalLibs[1] = "libraries/datatables/dataTables.bootstrap.min.js";
        $additionalCsss[0] = "libraries/datatables/dataTables.bootstrap.css";

        $view = View::make('backend.' . ConfigFromDB::setting('theme') . '.layout');
        $ComposedSubView = View::make('Subject::backend.ModuleSubject')
            ->with('cmList', $cmList)
            ->with('mList', $mList)
            ->with('sList', $sList)
            ->with('fpList', $fpList);
        $view->with('content', $ComposedSubView)->with('module', $module);
        $view->with('additionalCsss', $additionalCsss);
        $view->with('additionalLibs', $additionalLibs);
        return $view;
    }

    public function addSubjectModule()
    {
        $data = Input::all();
        $verify = DB::table('subject_cm')->where('subject_id','=',$data['subject'])->where('module_id','=',$data['module'])->first();
        if (!$verify){
        DB::table('subject_cm')->insert(
            ['subject_id' => $data['subject'],
              'module_id' => $data['module'],
                'coefficient' => $data['coef'] ]);

        alert()->success('Sujet ajoute au module avec success');
        } else {
            alert()->error('Sujet deja existant au module');
        }
        return $this->redirectSubjectModule();
    }

    public function addModule()
    {
        $data = Input::all();

        Module::create(['title' => $data['title']]);

        alert()->success('Module ajoute avec success');

        return $this->redirectSubject();
    }

    public function addSubject()
    {
        $data = Input::all();

        Subject::create(['title' => $data['title']]);

        alert()->success('Subject ajoutee avec success');

        return $this->redirectSubject();
    }

}
