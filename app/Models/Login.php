<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Ubah ke Authenticatable agar bisa digunakan untuk login
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Login extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'logins';
    protected $primaryKey = 'login_id';
    protected $fillable = [
        'login_id',
        'username',
        'email',
        'password',
        'role',
    ];
    // protected $hidden = 'password';

    public function member()
    {
        return $this->hasOne(Member::class,'login_id','member_id');
    }
    public function news()
    {
        return $this->hasMany(News::class,'login_id','login_id');
    }

    public function isAdmin(){
        return $this->role === 'admin';
    }
    public function isMember(){
        return $this->hasRole('member');
    }
    public function isPublisher(){
        return $this->hasRole('publisher');
    }

    public function hasRole(string $role){
        return $this->role === $role;
    }
}
