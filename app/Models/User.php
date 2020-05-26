<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    
    protected $fillable = [
        'name',  
        'screen_name',
        'email',
        'password',
        'avatar',
        'profile_image',
        'twitter_id',
        'twitter_name',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

 
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // リレーションの親子関係
    public function followers()
    {
        return $this->belongsToMany(self::class, 'followers', 'followed_id', 'following_id');
    }

    public function follows()
    {
        return $this->belongsToMany(self::class, 'followers', 'following_id', 'followed_id');
    }

    public function getAllUsers(Int $user_id)
    {
        // 引数で受け取ったログインしているユーザーを５名取得
        return $this->Where('id', '<>', $user_id)->paginate(5);
    }

}