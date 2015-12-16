<?php


namespace App\Modules\User\Controllers;
use App\Modules\Role\Models\Role;
use View, App\Helpers\ConfigFromDB;
use App\Http\Controllers\Controller;
use DB,Auth;
use App\Modules\Role\Controllers\RoleController;
class ViewBuilder extends Controller
{
    public static function GuestView(){
        $sidebars[0] = View::make('User::frontend.login');
        $additionalCsss[0] = "libraries/datepicker/datepicker3.css";
        $additionalLibs[0] = "libraries/datepicker/bootstrap-datepicker.js";

        $view = View::make('frontend.' . ConfigFromDB::setting('frontend_theme') . '.layout');
        $view->nest('content', 'User::frontend.register');
        $view->with('sidebars', $sidebars);
        $view->with('additionalCsss',$additionalCsss);
        $view->with('additionalLibs',$additionalLibs);

        return $view;
    }

    public static function LoggedView(){
        // This does build the dashboard
        $roles = DB::table('role_user')->where('user_id','=',Auth::user()->id)->count();
        $external = new RoleController();
        $module['Title'] = "User manager";
        $module['SubTitle'] = "Tableau de Bord";

        $users = DB::table('users')->get();
        $sidebars[0] = View::make('User::widgets.account')->with('usersList',$users);

        $ComposedSubView = View::make('User::frontend.dash')
            ->with('roleCount',$roles)
            ->with('requestRole',$external->formrequestRole());
        $view = View::make('frontend.' . ConfigFromDB::setting('frontend_theme') . '.layout');
        $view->with('sidebars', $sidebars);
        $view->with('content', $ComposedSubView)->with('module',$module);

        return $view;
    }
}