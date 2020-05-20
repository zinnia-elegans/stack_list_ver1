<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Abraham\TwitterOAuth\TwitterOAuth;
// use App\Facades\Twitter;
use Auth;

class TweetsController extends Controller
{

     
     public function tweet(){
        // 検索ツイート取得
        $tweets = \Twitter::get('search/tweets', array("q" =>"#今日の積み上げ", "count" => 20));
        return view('index',['statuses' => $tweets]);
    }
    
    public function index(Request $request){
        // ユーザーのタイムライン取得
        $statuses = \Twitter::get('statuses/user_timeline',["count" => 10]);
        $user = Auth::user();
    
        return view('tweets.index', [
            'user' => $user,
            'statuses' => $statuses,

        ]);
    }

   
    public function post(Request $request){
        $statuses = \Twitter::get('statuses/user_timeline',["count" => 10]);
        $tweet = $request->tweet;
        $text = \Twitter::post('statuses/update', array("status" => $tweet));

        return view('tweets.index', [
            'statuses' => $statuses,
            'text' => $text,
            ]);
    }


}