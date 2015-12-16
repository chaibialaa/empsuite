<?php namespace App\Modules\Subject\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Modules\Level\Models\Classm;
use App\Modules\Role\Models\Permission;
use App\Modules\Subject\Models\Module;
use App\Modules\Subject\Models\Subject;
use Input, View, DB, App\Helpers\ConfigFromDB;

class SubjectController extends Controller
{

    public function redirectSubject()
    {
        return redirect('/admin/subject');
    }

    public function redirectSubjectModule()
    {
        return redirect('/admin/subject/subjectModule');
    }

    public function redirectModuleClass()
    {
        return redirect('/admin/subject/classModule');
    }

    public function listAll()
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
        $ComposedSubView = View::make('Subject::backend.list')
            ->with('mList', $mList)
            ->with('sList', $sList);
        $view->with('content', $ComposedSubView)->with('module', $module);
        $view->with('additionalCsss', $additionalCsss);
        $view->with('additionalLibs', $additionalLibs);
        return $view;

    }

    function searchUserExistence($id, $array)
    {
        if (!empty($array)) {
            $x = 0;
            foreach ($array as $element) {
                if ($element->user_id === $id) {
                    $x++;
                }
            }
            if ($x == 0) {
                return false;
            }
        } else {
            return false;
        }
    }

    public function ModuleSubject()
    {
        $module['Title'] = "Subject Manager";
        $module['SubTitle'] = "Subjects Dashboard";

        $mList = Module::all();
        $sList = Subject::all();
        $cmList = DB::table('subject_cm')
            ->join('modules', 'modules.id', '=', 'subject_cm.module_id')
            ->join('subjects', 'subjects.id', '=', 'subject_cm.subject_id')
            ->select('modules.title as module_title', 'subjects.title as subject_title', 'coefficient', 'subject_cm.id')
            ->orderBy('subject_cm.module_id')
            ->get();

        $fcmList = array();
        foreach ($cmList as $cm) {
            $array = array($cm);
            $fcmList[$cm->module_title][] = $array;
        }

        $additionalLibs[0] = "libraries/chartjs/Chart.min.js";

        $additionalLibs[1] = "libraries/datatables/dataTables.bootstrap.min.js";
        $additionalCsss[0] = "libraries/datatables/dataTables.bootstrap.css";

        $view = View::make('backend.' . ConfigFromDB::setting('theme') . '.layout');
        $ComposedSubView = View::make('Subject::backend.ModuleSubject')
            ->with('fcmList', $fcmList)
            ->with('mList', $mList)
            ->with('sList', $sList);
        $view->with('content', $ComposedSubView)->with('module', $module);
        $view->with('additionalCsss', $additionalCsss);
        $view->with('additionalLibs', $additionalLibs);
        return $view;
    }

    public function ClassModule()
    {
        $module['Title'] = "Subject Manager";
        $module['SubTitle'] = "Subjects Dashboard";

        $TeachingPermission = Permission::where('name', 'TeachingStudents')->first();
        $rList = DB::table('permission_role')
            ->join('roles', 'roles.id', '=', 'permission_role.role_id')
            ->where('permission_id', '=', $TeachingPermission->id)
            ->get();

        $pList = array();
        $fpList = array();
        foreach ($rList as $r) {
            $topush = DB::table('role_user')
                ->join('users', 'users.id', '=', 'role_user.user_id')
                ->where('role_id', '=', $r->id)
                ->get();
            array_push($pList, $topush);
        }

        foreach ($pList as $p) {
            foreach ($p as $p_item) {
                if ($this->searchUserExistence($p_item->user_id, $fpList) === false)
                    array_push($fpList, $p_item);
            }
        }

        $cList = DB::table('level_classes')
            ->join('classes', 'classes.id', '=', 'level_classes.class_id')
            ->join('levels', 'levels.id', '=', 'level_classes.level_id')
            ->select('classes.title as class_title', 'levels.title as level_title', 'classes.id as id')
            ->orderBy('level_classes.level_id')
            ->get();

        $fcList = array();
        foreach ($cList as $c) {
            $array = array($c);
            $fcList[$c->level_title][] = $array;
        }

        $mList = Module::all();
        $sList = Subject::all();
        $cmList = DB::table('subject_cm')
            ->join('modules', 'modules.id', '=', 'subject_cm.module_id')
            ->join('subjects', 'subjects.id', '=', 'subject_cm.subject_id')
            ->select('modules.title as module_title', 'subjects.title as subject_title', 'coefficient', 'subject_cm.id')
            ->orderBy('subject_cm.module_id')
            ->get();

        $fcmList = array();
        foreach ($cmList as $cm) {
            $array = array($cm);
            $fcmList[$cm->module_title][] = $array;
        }

        $additionalLibs[0] = "libraries/chartjs/Chart.min.js";

        $additionalLibs[1] = "libraries/datatables/dataTables.bootstrap.min.js";
        $additionalCsss[0] = "libraries/datatables/dataTables.bootstrap.css";

        $view = View::make('backend.' . ConfigFromDB::setting('theme') . '.layout');
        $ComposedSubView = View::make('Subject::backend.ClassModule')
            ->with('fcmList', $fcmList)
            ->with('mList', $mList)
            ->with('sList', $sList)
            ->with('cList', $fcList)
            ->with('fpList', $fpList);
        $view->with('content', $ComposedSubView)->with('module', $module);
        $view->with('additionalCsss', $additionalCsss);
        $view->with('additionalLibs', $additionalLibs);
        return $view;
    }

    public function attachClassModule()
    {
        $data = Input::all();

        $verify = DB::table('subject_pc')
            ->where('cm_id', '=', key($data['professors']))
            ->where('class_id', '=', $data['class'])
            ->first();

        if (!$verify) {
            foreach ($data['professors'] as $key => $value) {
                DB::table('subject_pc')->insert([
                    'cm_id' => $key,
                    'professor_id' => $value,
                    'class_id' => $data['class']
                ]);
                alert()->success('Module attache a la classe avec success');
            }
        } else {
            alert()->error('Module existe deja en cette classe !');
        }

        return $this->redirectModuleClass();
    }

    public function moduleClassView()
    {
        $module['Title'] = "Subject Manager";

        $TeachingPermission = Permission::where('name', 'TeachingStudents')->first();
        $rList = DB::table('permission_role')
            ->join('roles', 'roles.id', '=', 'permission_role.role_id')
            ->where('permission_id', '=', $TeachingPermission->id)
            ->get();

        $pList = array();
        $fpList = array();
        foreach ($rList as $r) {
            $topush = DB::table('role_user')
                ->join('users', 'users.id', '=', 'role_user.user_id')
                ->where('role_id', '=', $r->id)
                ->get();
            array_push($pList, $topush);
        }

        foreach ($pList as $p) {
            foreach ($p as $p_item) {
                if ($this->searchUserExistence($p_item->user_id, $fpList) === false)
                    array_push($fpList, $p_item);
            }
        }


        $data = Input::all();
        $c = classm::where('id','=',$data['class'])->first();


        $module['SubTitle'] = "Class " . $c->title . " Modules";
        if (array_key_exists('all', $data)) {



            $ComposedSubView = View::make('Subject::backend.listClassesModules');

        } else {

            $mList = DB::table('subject_pc')
                ->where('class_id','=',$data['class'])
                ->join('subject_cm','subject_cm.id','=','cm_id')
                ->join('modules','modules.id','=','module_id')
                ->join('subjects','subjects.id','=','subject_id')
                ->join('users','users.id','=','professor_id')
                ->select('modules.title as module_title','subjects.title as subject_title',
                    'users.nom','modules.id as id','subject_cm.coefficient as coefficient','subject_pc.cm_id as cm_id','users.id as user_id')
                ->orderBy('id')
                ->get();



            if (!$mList){
                alert()->error('Aucun module attache a cette classe !');
                return $this->redirectModuleClass();
            }

            $fmList = array();
            foreach ($mList as $m) {
                $array = array($m);
                $fmList[$m->module_title][] = $array;
            }

            $ComposedSubView = View::make('Subject::backend.listClassModules')
                ->with('fmList', $fmList)
                ->with('class', $c->title)->with('fpList', $fpList);

        }

        $additionalLibs[0] = "libraries/chartjs/Chart.min.js";
        $additionalLibs[1] = "libraries/spin.js/spin.js";
        $additionalLibs[2] = "libraries/jQueryUI/jquery-ui.js";
        $additionalCsss[0] = "libraries/datatables/dataTables.bootstrap.css";
        $additionalCsss[1] = "libraries/jQueryUI/themes/smoothness/jquery-ui.css";
        $view = View::make('backend.' . ConfigFromDB::setting('theme') . '.layout');
        $view->with('additionalCsss', $additionalCsss);
        $view->with('additionalLibs', $additionalLibs);
        $view->with('content', $ComposedSubView)->with('module', $module);


        return $view;
    }

    public function addSubjectModule()
    {
        $data = Input::all();
        $verify = DB::table('subject_cm')
            ->where('subject_id', '=', $data['subject'])
            ->where('module_id', '=', $data['module'])
            ->first();

        if (!$verify) {
            DB::table('subject_cm')->insert(
                ['subject_id' => $data['subject'],
                    'module_id' => $data['module'],
                    'coefficient' => $data['coef']]);

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
