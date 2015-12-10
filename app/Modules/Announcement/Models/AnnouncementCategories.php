<?php

namespace App\Modules\Announcement\Models;

use Illuminate\Database\Eloquent\Model;

class AnnouncementCategories extends Model
{
    protected $table = 'announcement_categories';

    protected $fillable = ['title'];

}
