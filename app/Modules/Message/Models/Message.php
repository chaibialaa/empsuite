<?php namespace App\Modules\Message\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

    protected $table = 'messages';
    public $timestamps = false;
    protected $fillable = ['content', 'subject','priority'];
}
