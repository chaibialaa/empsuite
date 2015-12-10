<?php namespace App\Modules\Announcement\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Modules\User\Models\User;
use View, Auth, Input, DB, App\Helpers\ConfigFromDB;
use Intervention\Image\Facades\Image;
use App\Modules\Announcement\Models\AnnouncementCategories as AnnouncementCategory;
use App\Modules\Announcement\Models\Announcement as Announcement;

class AnnouncementController extends Controller
{
    public function redirectAnnouncement()
    {
        return redirect('/admin/announcement/');

    }

    public function formaddAnnouncement()
    {
        $additionalCsss[0] = "libraries/datepicker/datepicker3.css";

        $additionalLibs[0] = "libraries/datepicker/bootstrap-datepicker.js";
        $additionalLibs[1] = "libraries/ckeditor/ckeditor.js";
        $additionalLibs[2] = "libraries/bootstrap-fileinput/js/fileinput.min.js";

        $categories = DB::table('announcement_categories')->get();

        if (!$categories) {
            alert()->warning('Au moins 1 categorie');
            return redirect('/admin/announcement/category');
        }

        $view = View::make('backend.' . ConfigFromDB::setting('theme') . '.layout');
        $ComposedSubView = View::make('Announcement::backend.add')->with('categoriesList', $categories);
        $view->with('content', $ComposedSubView);
        $view->with('additionalCsss', $additionalCsss);
        $view->with('additionalLibs', $additionalLibs);

        return $view;
    }

    public function addAnnouncement()
    {
        $data = Input::all();
        $user = Auth::user();
        if (array_key_exists('mainimage', $data)) {

            $image = $data['mainimage'];
            $filename = time() . $user->id . 'emps' . $image->getClientOriginalName();
            $path_tmb = public_path('/storage/uploads/announcements/thumbs/' . $filename);
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

            $thumb = url('/') . '/storage/uploads/announcements/thumbs/' . $filename;
        } else {

            $thumb = url('/') . '/storage/fallback/announcements/thumbs/default.png';
        }

        $url = strtolower($data['title']);
        $url = preg_replace('/[^a-z0-9 -]+/', '', $url);
        $url = str_replace(' ', '-', $url);
        if (array_key_exists('end_at', $data)){
            $data['end_at'] = date("Y-m-d", strtotime("tomorrow"));


        }

        Announcement::create([
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
        alert()->success('Annonce ajoutee avec success');

        return $this->redirectAnnouncement();
    }

    public function showAnnouncement($category, $id, $link)
    {

        $categories = AnnouncementCategory::where('title', '=', $category)->first();
        $announcement = Announcement::where('id', '=', $id)
            ->where('category_id', '=', $categories->id)
            ->where('link', '=', $link)
            ->where('status', '=', 1)
            ->where('end_at', '>', date('Y-m-d'))
            ->first();
        if (!$announcement) {
            alert()->warning('Aucune annonce trouvee');
            return redirect('/announcement');
        }
        $user = User::where('id', '=', $announcement->user_id)->first();

        $additionalCsss[0] = "libraries/jssocials/jssocials.css";
        $additionalCsss[1] = "libraries/jssocials/jssocials-theme-flat.css";
        $additionalLibs[0] = "libraries/jssocials/jssocials.min.js";

        $view = View::make('frontend.' . ConfigFromDB::setting('theme') . '.layout');
        $ComposedSubView = View::make('Announcement::frontend.announcement')
            ->with('announcement', $announcement)
            ->with('user', $user)
            ->with('category', ucfirst($category));
        $view->with('content', $ComposedSubView)
            ->with('module_title', 'Announcement');

        $view->with('additionalCsss', $additionalCsss);
        $view->with('additionalLibs', $additionalLibs);
        return $view;
    }

    public function listAnnouncementFrontend()
    {

        $announcements = DB::table('announcements')
            ->join('users', 'users.id', '=', 'announcements.user_id')
            ->join('announcement_categories', 'announcement_categories.id', '=', 'announcements.category_id')
            ->select('announcements.*', 'users.nom', 'announcement_categories.title as title_cat')
            ->where('end_at', '>', date('Y-m-d'))
            ->where('announcements.status', '=', '1')
            ->orderBy('updated_at', 'asc')
            ->paginate(10);


        $view = View::make('frontend.' . ConfigFromDB::setting('theme') . '.layout');
        $ComposedSubView = View::make('Announcement::frontend.list')
            ->with('announcements', $announcements);
        $view->with('content', $ComposedSubView);
        return $view;

    }



    public function listAnnouncementBackend()
    {
        $announcements = DB::table('announcements')
            ->join('users', 'users.id', '=', 'announcements.user_id')
            ->join('announcement_categories', 'announcement_categories.id', '=', 'announcements.category_id')
            ->select('announcements.*', 'users.nom', 'announcement_categories.title as title_cat')
            ->orderBy('updated_at', 'asc')
            ->get();


        $additionalLibs[0] = "libraries/datatables/jquery.dataTables.min.js";
        $additionalLibs[1] = "libraries/datatables/dataTables.bootstrap.min.js";
        $additionalCsss[0] = "libraries/datatables/dataTables.bootstrap.css";


        $view = View::make('backend.' . ConfigFromDB::setting('theme') . '.layout');
        $ComposedSubView = View::make('Announcement::backend.list')
            ->with('announcements', $announcements);
        $view->with('content', $ComposedSubView);
        $view->with('additionalCsss', $additionalCsss);
        $view->with('additionalLibs', $additionalLibs);

        return $view;

    }

    public function publishAnnouncement($id)
    {
        Announcement::where('id', '=', $id)
            ->update(['status' => 1]);
        alert()->success('Publication reussie');
        return redirect('/admin/announcement/');
    }

    public function holdonAnnouncement($id)
    {
        Announcement::where('id', '=', $id)
            ->update(['status' => 0]);
        alert()->success('Mise en attente reussie');
        return $this->redirectAnnouncement();
    }

    public function deleteAnnouncement($id)
    {
        Announcement::where('id', '=', $id)
            ->delete();
        alert()->success('Suppression reussie');
        return $this->redirectAnnouncement();
    }

    public function formeditAnnouncement($id)
    {
        $announcement = Announcement::where('id', '=', $id)
            ->first();
        $categories = DB::table('announcement_categories')->get();

        $additionalCsss[0] = "libraries/datepicker/datepicker3.css";

        $additionalLibs[0] = "libraries/datepicker/bootstrap-datepicker.js";
        $additionalLibs[1] = "libraries/ckeditor/ckeditor.js";
        $additionalLibs[2] = "libraries/bootstrap-fileinput/js/fileinput.min.js";

        $view = View::make('backend.' . ConfigFromDB::setting('theme') . '.layout');
        $ComposedSubView = View::make('Announcement::backend.edit')->with('categoriesList', $categories)->with('announcement', $announcement);
        $view->with('content', $ComposedSubView);
        $view->with('additionalCsss', $additionalCsss);
        $view->with('additionalLibs', $additionalLibs);

        return $view;
    }

    public function updateAnnouncement($id)
    {
        $user = Auth::user();
        $data = Input::all();
        if (array_key_exists('mainimage', $data)) {

            $image = $data['mainimage'];
            $filename = time() . $user->id . 'emps' . $image->getClientOriginalName();

            $path_tmb = public_path('/storage/uploads/announcements/thumbs/' . $filename);
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

            $thumb = url('/') . '/storage/uploads/announcements/thumbs/' . $filename;
            $data['thumbpath'] = $thumb;
        }
        $data['category_id'] = Input::get('category');
        $url = strtolower($data['title']);
        $url = preg_replace('/[^a-z0-9 -]+/', '', $url);
        $url = str_replace(' ', '-', $url);

        $update = Announcement::findOrFail($id);
        if (array_key_exists('owner', $data)) {
            if ($data['owner'] == 1) {
                $data['user_id'] = $user->id;
            }
        }

        $data['link'] = $url;

        $update->fill($data)->save();
        alert()->success('Modification reussie');
        return $this->redirectAnnouncement();

    }

    public function showSlider(){
        $announcements = DB::table('announcements')
            ->join('users', 'users.id', '=', 'announcements.user_id')
            ->join('announcement_categories', 'announcement_categories.id', '=', 'announcements.category_id')
            ->select('announcements.*', 'users.nom', 'announcement_categories.title as title_cat')
            ->where('end_at', '>', date('Y-m-d'))
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        $ComposedSubView = View::make('Announcement::widgets.flexslider')->with('announcements', $announcements);
        return $ComposedSubView;
    }
}
