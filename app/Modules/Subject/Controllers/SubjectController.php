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
        $cpmList = DB::table('subject_cpm')
            ->join('modules', 'modules.id', '=', 'subject_cpm.module_id')
            ->join('subjects', 'subjects.id', '=', 'subject_cpm.subject_id')
            ->join('users', 'users.id', '=', 'subject_cpm.professor_id')
            ->select('modules.title as module_title','users.nom as professor_title','subjects.title as subject_title')
            ->get();

        $additionalLibs[0] = "libraries/chartjs/Chart.min.js";
        $additionalLibs[2] = "libraries/datatables/jquery.dataTables.min.js";
        $additionalLibs[1] = "libraries/datatables/dataTables.bootstrap.min.js";
        $additionalCsss[0] = "libraries/datatables/dataTables.bootstrap.css";

        $view = View::make('backend.' . ConfigFromDB::setting('theme') . '.layout');
        $ComposedSubView = View::make('Subject::backend.ModuleSubject')
            ->with('cpmList', $cpmList)
            ->with('mList', $mList)
            ->with('sList', $sList)
            ->with('fpList', $fpList);
        $view->with('content', $ComposedSubView)->with('module', $module);
        $view->with('additionalCsss', $additionalCsss);
        $view->with('additionalLibs', $additionalLibs);
        return $view;
    }

    public function addModule()
    {
        $data = Input::all();

        Module::create(['title' => $data['title']]);

        alert()->success('Module ajoutee avec success');

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
