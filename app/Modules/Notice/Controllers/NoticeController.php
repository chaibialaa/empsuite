<?php namespace App\Modules\Notice\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Modules\User\Models\User;
use View, Auth, Input, DB, App\Helpers\ConfigFromDB, App\Helpers\Logger;
use Intervention\Image\Facades\Image;
use App\Modules\Notice\Models\NoticeCategories as NoticeCategory;
use App\Modules\Notice\Models\Notice as Notice;

class NoticeController extends Controller
{
    public function redirectNotice()
    {
        return redirect('/admin/notice/');
    }

    public function formaddNotice()
    {
        $module['Title'] = trans('Notice::backend/notice.main');
        $module['SubTitle'] = trans('Notice::backend/notice.add_notice');
        $module['URL'] = "/admin/notice";

        $additionalCsss[0] = "libraries/datepicker/datepicker3.css";

        $additionalLibs[0] = "libraries/datepicker/bootstrap-datepicker.js";
        $additionalLibs[1] = "libraries/ckeditor/ckeditor.js";
        $additionalLibs[2] = "libraries/bootstrap-fileinput/js/fileinput.min.js";

        $categories = DB::table('notice_categories')->get();

        if (!$categories) {
            alert()->warning(trans('Notice::backend/notice.at_least_one'));
            return redirect('/admin/notice/category');
        }

        $view = View::make('backend.' . ConfigFromDB::setting('backend_theme') . '.layout');
        $ComposedSubView = View::make('Notice::backend.add')->with('categoriesList', $categories);
        $view->with('content', $ComposedSubView)->with('module', $module);
        $view->with('additionalCsss', $additionalCsss);
        $view->with('additionalLibs', $additionalLibs);

        return $view;
    }

    public function addNotice()
    {
        $data = Input::all();
        $user = Auth::user();
        if (array_key_exists('mainimage', $data)) {

            $image = $data['mainimage'];
            $filename = time() . $user->id . 'emps' . $image->getClientOriginalName();
            $path_tmb = public_path('/storage/uploads/notices/thumbs/' . $filename);
            $h = Image::make($image)->width();
            $w = Image::make($image)->height();
            if ($h > $w) {
                $wh = $h;
            } else {
                $wh = $w;
            }
            Image::make($image->getRealPath())
                ->crop($wh, $wh)
                ->save($path_tmb);

            $thumb = url('/') . '/storage/uploads/notices/thumbs/' . $filename;
        } else {

            $thumb = url('/') . '/storage/fallback/notices/thumbs/default.png';
        }

        $url = strtolower($data['title']);
        $url = preg_replace('/[^a-z0-9 -]+/', '', $url);
        $url = str_replace(' ', '-', $url);
        if (!array_key_exists('end_at', $data)){
            $data['end_at'] = date("Y-m-d", strtotime("tomorrow"));
        }

        $Notice = Notice::create([
            'title' => $data['title'],
            'end_at' => $data['end_at'],
            'content' => $data['content'],
            'user_id' => $user->id,
            'category_id' => $data['category'],
            'thumbpath' => $thumb,
            'status' => $data['status'],
            'comments' => $data['comments'],
            'link' => $url,
        ]);

        alert()->success(trans('Notice::backend/notice.success_add'));
        logger::log($user->id,"Add",2,$Notice->title);
        return $this->redirectNotice();
    }

    public function showNotice($category, $id, $link)
    {
        $module['Title'] = trans('Notice::frontend/notice.dash');

        $module['URL'] = "/notice";

        $categories = NoticeCategory::where('title', '=', $category)->first();
        $notice = Notice::where('id', '=', $id)
            ->where('category_id', '=', $categories->id)
            ->where('link', '=', $link)
            ->where('status', '=', 1)
            ->where('end_at', '>', date('Y-m-d'))
            ->first();
        if (!$notice) {
            alert()->warning(trans('Notice::backend/notice.no_notice'));
            return $this->redirectNotice();
        }
        $user = User::where('id', '=', $notice->user_id)->first();

        $additionalCsss[0] = "libraries/jssocials/jssocials.css";
        $additionalCsss[1] = "libraries/jssocials/jssocials-theme-flat.css";
        $additionalLibs[0] = "libraries/jssocials/jssocials.min.js";

        $module['SubTitle'] = $category;

        $view = View::make('frontend.' . ConfigFromDB::setting('frontend_theme') . '.layout');
        $ComposedSubView = View::make('Notice::frontend.notice')
            ->with('notice', $notice)
            ->with('user', $user)
            ->with('category', ucfirst($category));
        $view->with('content', $ComposedSubView)->with('module', $module);

        $view->with('additionalCsss', $additionalCsss);
        $view->with('additionalLibs', $additionalLibs);
        return $view;
    }

    public function listNoticeFrontend()
    {

        $notices = DB::table('notices')
            ->join('users', 'users.id', '=', 'notices.user_id')
            ->join('notice_categories', 'notice_categories.id', '=', 'notices.category_id')
            ->select('notices.*', 'users.nom', 'notice_categories.title as title_cat')
            ->where('end_at', '>', date('Y-m-d'))
            ->where('notices.status', '=', '1')
            ->orderBy('updated_at', 'asc')
            ->paginate(10);


        $view = View::make('frontend.' . ConfigFromDB::setting('frontend_theme') . '.layout');
        $ComposedSubView = View::make('Notice::frontend.list')
            ->with('notices', $notices);
        $view->with('content', $ComposedSubView);
        return $view;

    }

    public function listNoticeBackend()
    {
        $module['Title'] = trans('Notice::backend/notice.main');
        $module['SubTitle'] = trans('Notice::backend/notice.dash');
        $module['URL'] = "/admin/notice";

        $notices = DB::table('notices')
            ->join('users', 'users.id', '=', 'notices.user_id')
            ->join('notice_categories', 'notice_categories.id', '=', 'notices.category_id')
            ->select('notices.*', 'users.nom', 'notice_categories.title as title_cat')
            ->orderBy('updated_at', 'asc')
            ->get();

        $users = DB::table('notices')
            ->select('*', DB::raw("COUNT('notices.id') AS post_count"))
            ->join('users', 'users.id', '=', 'notices.user_id')
            ->orderBy('post_count', 'desc')
            ->groupBy('users.id')
            ->take(5)
            ->get();

        $additionalLibs[0] = "libraries/chartjs/Chart.min.js";
        $additionalLibs[2] = "libraries/datatables/jquery.dataTables.min.js";
        $additionalLibs[1] = "libraries/datatables/dataTables.bootstrap.min.js";
        $additionalCsss[0] = "libraries/datatables/dataTables.bootstrap.css";

        $view = View::make('backend.' . ConfigFromDB::setting('backend_theme') . '.layout');
        $ComposedSubView = View::make('Notice::backend.list')
            ->with('notices', $notices)->with('users', $users);

        $view->with('content', $ComposedSubView)->with('module',$module);
        $view->with('additionalCsss', $additionalCsss);
        $view->with('additionalLibs', $additionalLibs);
        return $view;

    }

    public function publishNotice($id)
    {
        Notice::where('id', '=', $id)
            ->update(['status' => 1]);
        alert()->success('Publication reussie');
        return redirect('/admin/notice/');
    }

    public function holdonNotice($id)
    {
        Notice::where('id', '=', $id)
            ->update(['status' => 0]);
        alert()->success('Mise en attente reussie');
        return $this->redirectNotice();
    }

    public function deleteNotice($id)
    {
        Notice::where('id', '=', $id)
            ->delete();
        alert()->success('Suppression reussie');
        return $this->redirectNotice();
    }

    public function formeditNotice($id)
    {
        $notice = Notice::where('id', '=', $id)
            ->first();
        $categories = DB::table('notice_categories')->get();

        $additionalCsss[0] = "libraries/datepicker/datepicker3.css";

        $additionalLibs[0] = "libraries/datepicker/bootstrap-datepicker.js";
        $additionalLibs[1] = "libraries/ckeditor/ckeditor.js";
        $additionalLibs[2] = "libraries/bootstrap-fileinput/js/fileinput.min.js";

        $view = View::make('backend.' . ConfigFromDB::setting('backend_theme') . '.layout');
        $ComposedSubView = View::make('Notice::backend.edit')->with('categoriesList', $categories)->with('notice', $notice);
        $view->with('content', $ComposedSubView);
        $view->with('additionalCsss', $additionalCsss);
        $view->with('additionalLibs', $additionalLibs);

        return $view;
    }

    public function updateNotice($id)
    {
        $user = Auth::user();
        $data = Input::all();
        if (array_key_exists('mainimage', $data)) {

            $image = $data['mainimage'];
            $filename = time() . $user->id . 'emps' . $image->getClientOriginalName();

            $path_tmb = public_path('/storage/uploads/notices/thumbs/' . $filename);
            $h = Image::make($image)->width();
            $w = Image::make($image)->height();
            if ($h > $w) {
                $wh = $h;
            } else {
                $wh = $w;
            }
            Image::make($image->getRealPath())
                ->crop($wh, $wh)
                ->save($path_tmb);

            $thumb = url('/') . '/storage/uploads/notices/thumbs/' . $filename;
            $data['thumbpath'] = $thumb;
        }
        $data['category_id'] = Input::get('category');
        $url = strtolower($data['title']);
        $url = preg_replace('/[^a-z0-9 -]+/', '', $url);
        $url = str_replace(' ', '-', $url);

        $update = Notice::findOrFail($id);
        if (array_key_exists('owner', $data)) {
            if ($data['owner'] == 1) {
                $data['user_id'] = $user->id;
            }
        }

        $data['link'] = $url;

        $update->fill($data)->save();
        alert()->success('Modification reussie');
        return $this->redirectNotice();

    }

    public function showSlider(){
        $notices = DB::table('notices')
            ->join('users', 'users.id', '=', 'notices.user_id')
            ->join('notice_categories', 'notice_categories.id', '=', 'notices.category_id')
            ->select('notices.*', 'users.nom', 'notice_categories.title as title_cat')
            ->where('end_at', '>', date('Y-m-d'))
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        $ComposedSubView = View::make('Notice::widgets.flexslider')->with('notices', $notices);
        return $ComposedSubView;
    }
}
