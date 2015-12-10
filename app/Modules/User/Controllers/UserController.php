<?php
namespace App\Modules\User\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Modules\User\Models\User;
use App\Modules\Role\Controllers\RoleController;
use Auth;

class UserController extends Controller {

    public function index()
    {
        if (Auth::check()) {
            $result = ViewBuilder::LoggedView();

        } else {
            $result = ViewBuilder::GuestView();

        }
        return $result;
    }

    public function redirect(){
        return redirect('/user');
    }

    public function confirm($validation)
    {
        $login_path = '/user';
        if( ! $validation)
        {
            alert()->warning( 'validation incorrecte');

        }

        $user = User::whereValidation($validation)->first();

        if ( ! $user)
        {
            alert()->error( 'Compte invalide');


        }
        if ($user && $validation) {
            $user->status = 1;
            $user->validation = null;
            $user->save();
            Auth::login($user);
            alert()->success( 'Compte valide');


        }
        return redirect($login_path);

    }

    public function formrequestRole(){
        $external = new RoleController();
        return $external->formrequestRole();
    }

    public function requestRole(){
        $external = new RoleController();
        $external->requestRole();
        return redirect('user');
    }
}