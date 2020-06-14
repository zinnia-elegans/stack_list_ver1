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

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider(){
        return Socialite::driver('twitter')->redirect();
    }

    public function handleProviderCallback(){

        $twitterUser = Socialite::driver('twitter')->user();
        $twitter_id = $twitterUser->nickname; //ツイッターID
        $twitter_name = $twitterUser->name; //表示名
		$twitter_icon = $twitterUser->avatar_original; //アイコン画像のURLを保存する

        // 各自ログイン処理 初回はDBに登録、2回目以降は認証のみ
        // twitter_idがDBに登録されているかチェック
        // されていればログイン処理のみ、いなければDBに新規登録
        $user = User::where('twitter_id', $twitter_id)->first();
        if ($user) {

        }else{
            $user = User::create([
                'twitter_id' => $twitter_id,
                'twitter_name' => $twitter_name,
				'twitter_icon' => $twitter_icon,
          ]);
        }
        Auth::login($user);

        return redirect('/users/admin');
    }

    // logout
    public function logout(Request $request){
        Auth::logout();
        return redirect('/');
    }







}
