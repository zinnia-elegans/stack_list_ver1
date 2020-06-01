<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    
    protected $fillable = [
        'user_id',
        'name',  
        'screen_name',
        'email',
        'password',
        'twitter_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

 
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


}