<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberPicture extends Model
{
    protected $table = 'member_pictures';
    protected $primaryKey = 'member_picture_id';
    protected $fillable = [
        'member_id',
        'member_picture',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
