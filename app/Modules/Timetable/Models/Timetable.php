<?php namespace App\Modules\Timetable\Models;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model {

    protected $table = 'timetables';
    protected $fillable = ['type','class_id','status'];
}
