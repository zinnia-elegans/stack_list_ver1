<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Facades\Twitter;
use Auth;

class TweetsController extends Controller
{

     // 検索ツイート取得
     public function tweet(){
        $tweets = \Twitter::get('search/tweets', array("q" =>"#今日の積み上げ", "count" => 20));
        return view('index',['statuses' => $tweets]);
    }
    
    public function index(Request $request){


        $statuses = \Twitter::get('statuses/user_timeline',["count" => 10]);
        $user = Auth::user();
    
        return view('tweets.index', [
            'user' => $user,
            'statuses' => $statuses,

        ]);
    }

   
    public function post(){

        $tweet = \Twitter::post("statuses/update", array('status' => 'テスト投稿'));

        return view('tweets.index', ['tweet' => $tweet]);
    }


}