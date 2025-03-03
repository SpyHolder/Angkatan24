<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
   protected $table = 'news';
    protected $primaryKey = 'news_id';
    protected $fillable = [
        'picture_news',
        'headline_news',
        'status',
        'publisher',
        'covarage_area',
        'date_publish',
        'time_publish',
        'content_news'
    ];
}
