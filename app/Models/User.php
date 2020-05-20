<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage as FacadesStorage;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',  
        'email',
        'password',
        'text',
        'avatar',
        'twitter_id',
        'twitter_name',
        'provider',
        'provider_id'
    ];

    protected $guarded = array('id');

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
