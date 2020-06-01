<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Models\User;
use Auth;
use Laravel\Socialite\Facades\Socialite;

class TweetsController extends Controller
{
    private $consumerKey = 'd9ktYK8Pj12uAiBB6qX4wZGwD';
    private $consumerSecret = 'X2j9gdo1TjtfQLN86c43zk1KJCwLsJOfSlCHHMwVBUJS47eMsh';
    private $callBackUrl = 'http://127.0.0.1:8000/users/admin/callback';

    public function about()
    {
        return view('about');
    }

    public function index(Request $request)
    {
        //セッションからアクセストークン取得
        $accessToken = session()->get('accessToken');

        //インスタンス生成
        $twitter = new TwitterOAuth(
        $this->consumerKey,
        $this->consumerSecret,
        $accessToken['oauth_token'],
        $accessToken['oauth_token_secret']
        );

        // ユーザー情報を取得
        $userInfo = get_object_vars($twitter->get('account/verify_credentials'));
        // タイムライン取得
        $userTweet = $twitter->get('statuses/user_timeline',["count" => 30]);
        // ツイッターに投稿
        $tweet = $request->tweet;
        $text = $twitter->post('statuses/update', array("status" => $tweet));

        return view('users.admin', [
            'userInfo'  => $userInfo,
            'userTweet' => $userTweet,
            'text'      => $text
        ]);
    }


    public function home(Request $request)
    {    
         //セッションからアクセストークン取得
         $accessToken = session()->get('accessToken');

         //インスタンス生成
         $twitter = new TwitterOAuth(
         $this->consumerKey,
         $this->consumerSecret,
        //  $accessToken['oauth_token'],
        //  $accessToken['oauth_token_secret']
         );

        // ユーザー情報を取得
        $userInfo = get_object_vars($twitter->get('account/verify_credentials'));

        return view('index',[
            'userInfo' => $userInfo
        ]);
    }

   
}