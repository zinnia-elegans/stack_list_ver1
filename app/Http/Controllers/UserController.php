<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Tweet;
use App\Models\Follower;

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

    public function index(User $user)
    {
        // ログインしているユーザーIDを取得
        $all_users = $user->getAllUsers(auth()->user()->id);

        return view('users.allusers', [
            'all_users'  => $all_users
        ]);
    }

}
