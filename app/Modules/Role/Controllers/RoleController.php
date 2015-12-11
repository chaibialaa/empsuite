<?php namespace App\Modules\Role\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Modules\Role\Models\Permission;
use View,Input,DB, Auth;
use App\Modules\Role\Models\Role;
use App\Modules\Role\Models\RoleRequest;
use App\Helpers\ConfigFromDB;

class RoleController extends Controller {

	public function formaddRole()
	{
        $module['Title'] = "Role Manager";
        $module['SubTitle'] = "Add New Role";
        $Permissions = Permission::all();
		$view = View::make('backend.' . ConfigFromDB::setting('theme') . '.layout');
		$ComposedSubView = View::make('Role::backend.addRole')->with('permissionList',$Permissions);
		$view->with('content', $ComposedSubView)->with('module', $module);
        return $view;
	}

    public function formeditRole($id)
    {

        $Permissions = Permission::all();
        $PermissionsChecked = DB::table('permission_role')
            ->select('permission_id')
            ->where('role_id','=',$id)
            ->get();
        $role = Role::findOrFail($id);

        $module['Title'] = "Role Manager";
        $module['SubTitle'] = "Edit Role : ".$role->display_name;

        $view = View::make('backend.' . ConfigFromDB::setting('theme') . '.layout');
        $ComposedSubView = View::make('Role::backend.edit')
            ->with('permissionList',$Permissions)
            ->with('permissionChecked',$PermissionsChecked)
            ->with('role',$role);
        $view->with('content', $ComposedSubView)->with('module', $module);
        return $view;
    }

	public function addRole()
	{
        $data = Input::all();

        $role = new Role();
        $role->name         = $data['name'];
        $role->display_name = $data['displayname'];
        $role->description  = $data['description'];
        $role->save();

		if (array_key_exists('permission', $data)) {
            $permission_ids = $data['permission'];
            foreach($permission_ids as $permission){
            $role->attachPermission($permission);
		}}

        alert()->success('Role added avec success');
        return redirect('admin/role/add');

	}

    public function editRole($id)
    {
        $data = Input::all();
        DB::table('permission_role')
            ->select('permission_id')
            ->where('role_id','=',$id)
            ->delete();

        $role = Role::findOrFail($id);

        $role->name         = $data['name'];
        $role->display_name = $data['displayname'];
        $role->description  = $data['description'];
        $role->save();

        if (array_key_exists('permission', $data)) {
            $permission_ids = $data['permission'];
            foreach($permission_ids as $permission){
                $role->attachPermission($permission);
            }}

        alert()->success('Role edit avec success');
        return redirect('/admin/role/add');

    }

    public function formrequestRole(){

        $requestedRolesCount = DB::table('pending_role_user')
            ->where('user_id','=',Auth::user()->id)
            ->count();
        $roles = Role::all();
        $module['Title'] = "Role Manager";
        $module['SubTitle'] = "Request Joining a Role";


        $view = View::make('Role::frontend.request')
            ->with('roleList',$roles)
            ->with('requested',$requestedRolesCount);

        return $view;
    }

    public function requestRole(){
        $data = Input::all();

        if (array_key_exists('roles', $data)) {
            $role_ids = $data['roles'];
            foreach($role_ids as $role_id){
                $role = new RoleRequest();
                $role->user_id         = Auth::user()->id;
                $role->role_id  = $role_id;
                $role->additional_infos  = $data['additional_infos'];
                $role->save();
            }}

        alert()->success('Role requested avec success');

    }

    public function affectRole(){
        $module['Title'] = "Role Manager";
        $module['SubTitle'] = "Affect/Revoke Roles";

        $obtainedRolesList = DB::table('role_user')->get();
        $requestedList = DB::table('pending_role_user')->get();
        $rolesList = Role::all();

        $uhList = DB::table('users')
            ->select('*', DB::raw("COUNT('users.id') AS pending_roles_count"))
            ->join('pending_role_user','pending_role_user.user_id','=','users.id')
            ->where('users.status','>','0')
            ->groupBy('users.id')
            ->get();

        $uoList = DB::table('users')
            ->leftjoin('role_user','role_user.user_id','=','users.id')
            ->where('users.status','>','0')
            ->groupBy('users.id')
            ->get();

        $additionalLibs[1] = "libraries/datatables/jquery.dataTables.min.js";
        $additionalLibs[0] = "libraries/datatables/dataTables.bootstrap.min.js";
        $additionalCsss[0] = "libraries/datatables/dataTables.bootstrap.css";

        $view = View::make('backend.' . ConfigFromDB::setting('theme') . '.layout');
        $ComposedSubView = View::make('Role::backend.affect')
            ->with('rList',$rolesList)
            ->with('oList',$obtainedRolesList)
            ->with('rrList',$requestedList)
            ->with('uoList',$uoList)
            ->with('uhList',$uhList);
        $view->with('content', $ComposedSubView)->with('module', $module);
        $view->with('additionalCsss', $additionalCsss);
        $view->with('additionalLibs', $additionalLibs);
        return $view;
    }

    public function manageRequested($id){
        $data = Input::all();
        if (array_key_exists('requestedRoles', $data)) {
            $requested_ids = $data['requestedRoles'];
            foreach($requested_ids as $role){
                DB::table('role_user')->insert(
                    ['user_id' => $id,
                     'role_id' => $role ]);
            }

        }
        DB::table('pending_role_user')->where('user_id','=',$id)->delete();
        alert()->success('User updated');
        return redirect('/admin/role/affect/');
    }

    public function manageUserRoles($id){
        $data = Input::all();
        DB::table('role_user')->where('user_id','=',$id)->delete();

        if (array_key_exists('Roles', $data)) {
            $role_ids = $data['Roles'];
            foreach($role_ids as $role){
                DB::table('role_user')->insert(
                    ['user_id' => $id,
                        'role_id' => $role ]);

            }
        }
        alert()->success('User updated');
        return redirect('/admin/role/affect/');
    }

}
