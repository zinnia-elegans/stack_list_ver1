<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function admin()
    {



        
        return view('guest.guestuser');
    }

    public function getProfile()
    {
        return view('guest.register');
    }

}
