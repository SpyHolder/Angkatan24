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
        'login_id',
        'covarage_area',
        'date_publish',
        'time_publish',
        'content_news'
    ];
    public function login()
    {
        return $this->belongsTo(Login::class,'login_id','login_id');
    }
}
