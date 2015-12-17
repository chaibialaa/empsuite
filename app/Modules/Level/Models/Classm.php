<?php
namespace App\Modules\Level\Models;

use Illuminate\Database\Eloquent\Model;


class Classm extends Model {

    protected $table = 'classes';

    protected $fillable = ['title','level_id','section_id'];

}