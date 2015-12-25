<?php

namespace App\Modules\Notice\Models;

use Illuminate\Database\Eloquent\Model;

class NoticeCategories extends Model
{
    protected $table = 'notice_categories';

    protected $fillable = ['title'];

}
