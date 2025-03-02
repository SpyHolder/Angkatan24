<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $table = 'logins';
    protected $primaryKey = 'login_id';
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    public function member()
    {
        return $this->hasOne(Member::class,'login_id','member_id');
    }
}
