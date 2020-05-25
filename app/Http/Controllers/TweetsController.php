<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Models\Twitteruser;

class TweetsController extends Controller
{
    public function about()
    {
        return view('about');
    }

    public function home()
    {    
        return view('index');
    }

    // ユーザーのタイムラインを取得
    public function stack() 
    {
        $statuses = \Twitter::get('statuses/user_timeline',["count" => 30]);
        
        return view('yourstack', [
            'statuses' => $statuses,
            ]);
    }

    public function admin(Request $request)
    {
        // ユーザー情報を取得
        $userdata = \Twitter::get('account/verify_credentials');
        $userInfo = get_object_vars($userdata);

        // ツイートする
        $tweet = $request->tweet;
        $text = \Twitter::post('statuses/update', array("status" => $tweet));

        // 前回の積み上げを取得
        $userTweet = \Twitter::get('statuses/user_timeline',["count" => 30]);

        return view('admin', [
            'userInfo' => $userInfo,
            'text' => $text,
            'userTweet' => $userTweet
        ]);
    }

    public function continue ()
    {
        return view('continue');
    }


}