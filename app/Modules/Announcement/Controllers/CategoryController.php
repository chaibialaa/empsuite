<?php namespace App\Modules\Announcement\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use View, Input, DB, App\Helpers\ConfigFromDB, Carbon\Carbon;
use App\Modules\Announcement\Models\AnnouncementCategories as AnnouncementCategory;

class CategoryController extends Controller
{
    public function redirectCategory()
    {
        return redirect('/admin/announcement/category');
    }

    public function listCategory()
    {
        $categories = DB::table('announcements')
            ->select('*', DB::raw("COUNT('announcements.id') AS post_count"))
            ->join('announcement_categories', 'announcement_categories.id', '=', 'announcements.category_id')
            ->orderBy('post_count', 'desc')
            ->groupBy('announcement_categories.id')
            ->take(5)
            ->get();

        $cList = DB::table('announcement_categories')
            ->get();

        $additionalLibs[0] = "libraries/chartjs/Chart.min.js";
        $additionalLibs[2] = "libraries/datatables/jquery.dataTables.min.js";
        $additionalLibs[1] = "libraries/datatables/dataTables.bootstrap.min.js";
        $additionalCsss[0] = "libraries/datatables/dataTables.bootstrap.css";

        $view = View::make('backend.' . ConfigFromDB::setting('theme') . '.layout');
        $ComposedSubView = View::make('Announcement::backend.listCat')->with('categories', $categories)->with('cList', $cList);
        $view->with('content', $ComposedSubView);
        $view->with('additionalCsss', $additionalCsss);
        $view->with('additionalLibs', $additionalLibs);
        return $view;
    }

    public function renameCategory($id)
    {
        DB::table('announcement_categories')
            ->where('id', $id)
            ->update(['title' => Input::get('title'),'updated_at' => Carbon::now()]);
        alert()->success('Categorie renommee avec success');

        return $this->redirectCategory();
    }

    public function deleteCategory($id)
    {
        $rowcount = DB::table('announcements')
            ->select('*', DB::raw("COUNT('announcements.id') AS post_count"))
            ->join('announcement_categories', 'announcement_categories.id', '=', 'announcements.category_id')
            ->count();
        if ($rowcount == 1){
            DB::table('announcements')
                ->where('category_id', $id)
                ->delete();
        } else {

            if (Input::get('action')==1) {

                DB::table('announcements')
                    ->where('category_id', $id)
                    ->delete();

            } else {
                DB::table('announcements')
                    ->where('category_id', $id)
                    ->update(['category_id' => Input::get('moveto'),'updated_at' => Carbon::now()]);
            }

        }
        DB::table('announcement_categories')
            ->where('id', $id)
            ->delete();
        alert()->success('Categorie effacee avec success');

        return $this->redirectCategory();
    }

    public function addCategory()
    {
        $data = Input::all();
        AnnouncementCategory::create([
            'title' => $data['title']
        ]);
        alert()->success('Categorie ajoutee avec success');

        return $this->redirectCategory();
    }

    public function categoryAnnouncement($category)
    {
        $announcements = DB::table('announcements')
            ->join('users', 'users.id', '=', 'announcements.user_id')
            ->join('announcement_categories', 'announcement_categories.id', '=', 'announcements.category_id')
            ->select('announcements.*', 'users.nom', 'announcement_categories.title as title_cat')
            ->where('end_at', '>', date('Y-m-d'))
            ->where('announcements.status', '=', '1')
            ->where('announcement_categories.title', '=', $category)
            ->orderBy('updated_at', 'asc')
            ->paginate(10);

        $view = View::make('frontend.' . ConfigFromDB::setting('theme') . '.layout');
        $ComposedSubView = View::make('Announcement::frontend.list')
            ->with('announcements', $announcements);
        $view->with('content', $ComposedSubView);
        return $view;
    }
}