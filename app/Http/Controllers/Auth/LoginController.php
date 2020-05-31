<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Http\Request;
use App\Models\User;
use Socialite;
use Auth;


class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = 'users/admin';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

}
