<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Abraham\TwitterOAuth\TwitterOAuth;

class TweetsController extends Controller
{
    private $consumerKey = 'd9ktYK8Pj12uAiBB6qX4wZGwD';
    private $consumerSecret = 'X2j9gdo1TjtfQLN86c43zk1KJCwLsJOfSlCHHMwVBUJS47eMsh';
    private $callBackUrl = 'http://127.0.0.1:8000/users/admin/callback';

    public function home()
    {    
        return view('index');
    }

    public function about()
    {
        return view('about');
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
        $this->consumerKey,
        $this->consumerSecret,
        $accessToken['oauth_token'],
        $accessToken['oauth_token_secret']
        );

        $userInfo = get_object_vars($twitter->get('account/verify_credentials'));

        $userTweet = $twitter->get('statuses/user_timeline',["count" => 30]);

        $tweet = $request->tweet;
        $text = $twitter->post('statuses/update', array("status" => $tweet));

        return view('users.admin', [
            'userInfo'  => $userInfo,
            'userTweet' => $userTweet,
            'text'      => $text
        ]);
    }

    public function login() {

        $connection = new TwitterOAuth($this->consumerKey, $this->consumerSecret);

        // 認証URLを取得するためのリクエストトークンの生成
        $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => $this->callBackUrl));
        $url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));

        return redirect($url);

    }


    public function callBack(Request $request, User $user){
        //G認証トークン取得
        $oauth_token = $request->input('oauth_token');
        //認証キー取得
        $oauth_verifier = $request->input('oauth_verifier');
    
        $twitter = new TwitterOAuth(
            config('twitter.consumer_key'),
            config('twitter.consumer_secret'),
            $oauth_token,
            $oauth_verifier
        );
    
        //アクセストークン取得
        //'oauth/access_token'はアクセストークンを取得するためのAPIのリソース
        $accessToken = $twitter->oauth('oauth/access_token', array('oauth_token' => $oauth_token, 'oauth_verifier' => $oauth_verifier));
    
        //セッションにアクセストークンを登録
        $value = $request->session()->put('accessToken', $accessToken);
        $authUser = $this->findOrCreateUser($value);
        Auth::login($authUser, true);
    
        return redirect('users/admin');
    }

    public function findOrCreateUser($user)
    {
        // レコードでマッチしたデータを抽出
        $authUser = User::where('twitter_id',$user->id)->first();
        if($authUser) {
            return $authUser;
        }
        return User::create([
            'name' => $user->name,
            'screen_name' => $user->name,
            'email' => $user->name,
            'twitter_id' => $user->twitter_id,
        ]);
    }

    public function logout(){
        //セッションクリア
        session()->flush();
    
        //OAuthログイン画面にリダイレクト
        return redirect('/');
    }
}