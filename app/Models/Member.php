<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';
    protected $primaryKey = 'member_id';
    protected $fillable = [
        'login_id',
        'full_name',
        'nim',
        'description',
        'quote',
        'year_entry',
        'year_in',
        'year_out',
        'rarity',
        'rank',
        'instagram',
        'linkedin',
        'github',
        'status',
        'website',
    ];
    protected $attributes = [
        'rarity' => null,
        'rank' => null,
        'instagram' => null,
        'github' => null,
        'linkedid' => null,
        'website' => null,
        'year_out' => null
    ];

    public function login()
    {
        return $this->belongsTo(Login::class);
    }
    public function member_picture()
    {
        return $this->hasMany(MemberPicture::class);
    }
}
