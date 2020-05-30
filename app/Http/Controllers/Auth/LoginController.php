<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Auth;
use Socialite;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectToTwitter = '/users/admin';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

}
