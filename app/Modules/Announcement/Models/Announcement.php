<?php namespace App\Modules\Announcement\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model {
    protected $table = 'announcements';
    public function categories()
    {
        return $this->hasOne('Statements::Models.AnnouncementCategories');
    }
    public function users()
    {
        return $this->hasOne('User::Models.User');
    }
    protected $fillable = ['title', 'status', 'user_id', 'content', 'category_id', 'end_at' ,'link' ,'comments' ,'thumbpath'];
}
