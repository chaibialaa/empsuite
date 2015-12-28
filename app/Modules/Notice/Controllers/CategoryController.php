<?php namespace App\Modules\Notice\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use View, Input, DB, App\Helpers\ConfigFromDB, Carbon\Carbon;
use App\Modules\Notice\Models\NoticeCategories as NoticeCategory;

class CategoryController extends Controller
{
    public function redirectCategory()
    {
        return redirect('/admin/notice/category');
    }

    public function listCategory()
    {
        $module['Title'] = trans('Notice::backend/notice.main');
        $module['SubTitle'] = trans('Notice::backend/category.dash');
        $module['URL'] = "/admin/notice";

        $categories = DB::table('notices')
            ->select('*', DB::raw("COUNT('notices.id') AS post_count"))
            ->join('notice_categories', 'notice_categories.id', '=', 'notices.category_id')
            ->orderBy('post_count', 'desc')
            ->groupBy('notice_categories.id')
            ->take(5)
            ->get();

        $cList = DB::table('notice_categories')
            ->get();

        $additionalLibs[0] = "libraries/chartjs/Chart.min.js";
        $additionalLibs[2] = "libraries/datatables/jquery.dataTables.min.js";
        $additionalLibs[3] = "libraries/jValidation/dist/jquery.validate.js";
        $additionalLibs[4] = "libraries/toastr/toastr.js";
        $additionalLibs[1] = "libraries/datatables/dataTables.bootstrap.min.js";
        $additionalCsss[0] = "libraries/datatables/dataTables.bootstrap.css";
        $additionalCsss[1] = "libraries/toastr/build/toastr.css";

        $view = View::make('backend.' . ConfigFromDB::setting('backend_theme') . '.layout');
        $ComposedSubView = View::make('Notice::backend.listCat')->with('categories', $categories)->with('cList', $cList);
        $view->with('content', $ComposedSubView)->with('module',$module);
        $view->with('additionalCsss', $additionalCsss);
        $view->with('additionalLibs', $additionalLibs);
        return $view;
    }

    public function renameCategory($id)
    {
        if (!Input::has('title')){
            alert()->error(trans('backend/common.required', ['item' => 'Title']));

            return $this->redirectCategory();
        }
        DB::table('notice_categories')
            ->where('id', $id)
            ->update(['title' => Input::get('title'),'updated_at' => Carbon::now()]);
        alert()->success(trans('backend/common.success_update', ['item' => 'Category']));

        return $this->redirectCategory();
    }

    public function deleteCategory($id)
    {
        $rowcount = DB::table('notices')
            ->select('*', DB::raw("COUNT('notices.id') AS post_count"))
            ->join('notice_categories', 'notice_categories.id', '=', 'notices.category_id')
            ->count();
        if ($rowcount == 1){
            DB::table('notices')
                ->where('category_id', $id)
                ->delete();
        } else {

            if (Input::get('action')==1) {

                DB::table('notices')
                    ->where('category_id', $id)
                    ->delete();

            } else {
                DB::table('notices')
                    ->where('category_id', $id)
                    ->update(['category_id' => Input::get('moveto'),'updated_at' => Carbon::now()]);
            }

        }
        DB::table('notice_categories')
            ->where('id', $id)
            ->delete();
        alert()->success(trans('backend/common.success_delete', ['item' => 'Category']));

        return $this->redirectCategory();
    }

    public function addCategory()
    {
        if (!Input::has('title')){
            alert()->error(trans('backend/common.required', ['item' => 'Title']));

            return $this->redirectCategory();
        }
        $data = Input::all();
        NoticeCategory::create([
            'title' => $data['title']
        ]);
        alert()->success(trans('backend/common.success_add', ['item' => 'Category']));

        return $this->redirectCategory();
    }

    public function categoryNotice($category)
    {
        $notices = DB::table('notices')
            ->join('users', 'users.id', '=', 'notices.user_id')
            ->join('notice_categories', 'notice_categories.id', '=', 'notices.category_id')
            ->select('notices.*', 'users.nom', 'notice_categories.title as title_cat')
            ->where('end_at', '>', date('Y-m-d'))
            ->where('notices.status', '=', '1')
            ->where('notice_categories.title', '=', $category)
            ->orderBy('updated_at', 'asc')
            ->paginate(10);

        $view = View::make('frontend.' . ConfigFromDB::setting('frontend_theme') . '.layout');
        $ComposedSubView = View::make('Notice::frontend.list')
            ->with('notices', $notices);
        $view->with('content', $ComposedSubView);
        return $view;
    }
}