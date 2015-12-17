<?php namespace App\Modules\Section\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Modules\Level\Models\Section;
use Input, View, DB, App\Helpers\ConfigFromDB;

class SectionController extends Controller {

    public function redirectSection()
    {
        return redirect('/admin/level/section');
    }

    public function listSection()
    {
        $module['Title'] = "Section Manager";
        $module['SubTitle'] = "Sections Dashboard";

        $classes = DB::table('classes')
            ->select('*', DB::raw("COUNT('classes.id') AS class_count"))
            ->join('sections', 'sections.id', '=', 'classes.section_id')
            ->orderBy('class_count', 'desc')
            ->groupBy('sections.id')
            ->take(5)
            ->get();

        $sList = DB::table('sections')
            ->get();

        $additionalLibs[0] = "libraries/chartjs/Chart.min.js";
        $additionalLibs[2] = "libraries/datatables/jquery.dataTables.min.js";
        $additionalLibs[1] = "libraries/datatables/dataTables.bootstrap.min.js";
        $additionalCsss[0] = "libraries/datatables/dataTables.bootstrap.css";

        $view = View::make('backend.' . ConfigFromDB::setting('backend_theme') . '.layout');
        $ComposedSubView = View::make('Section::backend.list')
            ->with('classes', $classes)
            ->with('sList', $sList);
        $view->with('content', $ComposedSubView)->with('module', $module);
        $view->with('additionalCsss', $additionalCsss);
        $view->with('additionalLibs', $additionalLibs);
        return $view;
    }

    public function addSection(){
        $data = Input::all();
        Section::create([
            'title' => $data['title']
        ]);
        alert()->success('Section ajoutee avec success');

        return $this->redirectSection();
    }

}
