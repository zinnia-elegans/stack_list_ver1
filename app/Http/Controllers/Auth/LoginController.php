<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Http\Request;
use App\Models\User;
use Socialite;
use Auth;


class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = 'users/admin';

    private $consumerKey = 'd9ktYK8Pj12uAiBB6qX4wZGwD';
    private $consumerSecret = 'X2j9gdo1TjtfQLN86c43zk1KJCwLsJOfSlCHHMwVBUJS47eMsh';
    private $callBackUrl = 'http://127.0.0.1:8000/users/admin/callback';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
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

        User::create([
            'user_id' => $user->id,
            'screen_name' => $user->name
        ]);

        $authUser = User::where('user_id', $user->id)->first();

        Auth::login($authUser, true);

        //セッションにアクセストークンを登録
        session()->put('accessToken', $accessToken);
    
        return redirect('users/admin');
    }

    public function logout(){
        //セッションクリア
        session()->flush();
        //OAuthログイン画面にリダイレクト
        return redirect('/');
    }

}
