<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Abraham\TwitterOAuth\TwitterOAuth;
use Auth;
use Socialite;

class TweetsController extends Controller
{

    private $callBackUrl = 'http://127.0.0.1:8000/users/admin/callback';

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
        //セッションからアクセストークン取得
        $accessToken = session()->get('accessToken');

        //インスタンス生成
        $twitter = new TwitterOAuth(
        config('twitter.consumer_key'),
        config('twitter.consumer_secret'),
        //アクセストークン
        $accessToken['oauth_token'],
        $accessToken['oauth_token_secret']
        );

        $userInfo = get_object_vars($twitter->get('account/verify_credentials'));

        $userTweet = \Twitter::get('statuses/user_timeline',["count" => 30]);

        $tweet = $request->tweet;
        $text = \Twitter::post('statuses/update', array("status" => $tweet));

        return view('users.admin', [
            'userInfo'  => $userInfo,
            'userTweet' => $userTweet,
            'text'      => $text
        ]);
    }

    public function login() {

        $connection = new TwitterOAuth(
            config('twitter.consumer_key'),
            config('twitter.consumer_secret'),
        );

        // 認証URLを取得するためのリクエストトークンの生成
        $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => $this->callBackUrl));
        $url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));

        return redirect($url);

    }


    public function callBack(){
        //GETパラメータから認証トークン取得
        $oauth_token = Input::get('oauth_token');
        //GETパラメータから認証キー取得
        $oauth_verifier = Input::get('oauth_verifier');
    
        //インスタンス生成
        $twitter = new TwitterOAuth(
            config('twitter.consumer_key'),
            config('twitter.consumer_secret'),
            //認証トークン
            $oauth_token,
            //認証キー
            $oauth_verifier
        );
    
        //アクセストークン取得
        //'oauth/access_token'はアクセストークンを取得するためのAPIのリソース
        $accessToken = $twitter->oauth('oauth/access_token', array('oauth_token' => $oauth_token, 'oauth_verifier' => $oauth_verifier));
    
        //セッションにアクセストークンを登録
        session()->put('accessToken', $accessToken);
    
        //indexページにリダイレクト
        return redirect('users.admin');
    }
}