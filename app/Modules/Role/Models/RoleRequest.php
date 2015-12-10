<?php
/**
 * Created by PhpStorm.
 * User: ceo
 * Date: 23/11/2015
 * Time: 21:31
 */

namespace App\Modules\Role\Models;

use Illuminate\Database\Eloquent\Model;

class RoleRequest extends Model{

    protected $table = 'pending_role_user';
    protected $fillable = ['user_id', 'role_id', 'additional_infos'];

}