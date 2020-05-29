<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class TweetsController extends Controller
{
    public function home()
    {    
        return view('index');
    }

    public function about()
    {
        return view('about');
    }

    // ユーザーのタイムラインを取得
    public function stack() 
    {
        $statuses = \Twitter::get('statuses/user_timeline',["count" => 30]);
        
        return view('yourstack', [
            'statuses' => $statuses,
            ]);
    }

    public function continue ()
    {
        return view('continue');
    }


    public function index(Request $request)
    {

        $userdata = \Twitter::get('account/verify_credentials');
        $userInfo = get_object_vars($userdata);

        $userTweet = \Twitter::get('statuses/user_timeline',["count" => 30]);

        $tweet = $request->tweet;
        $text = \Twitter::post('statuses/update', array("status" => $tweet));


        return view('users.admin', [
            'userInfo'  => $userInfo,
            'userTweet' => $userTweet,
            'text'      => $text
        ]);
    }

}