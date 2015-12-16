<?php namespace App\Modules\Notice\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model {
    protected $table = 'notices';
    public function categories()
    {
        return $this->hasOne('Notice::Models.NoticeCategories');
    }
    public function users()
    {
        return $this->hasOne('User::Models.User');
    }
    protected $fillable = ['title', 'status', 'user_id', 'content', 'category_id', 'end_at' ,'link' ,'comments' ,'thumbpath'];
}
