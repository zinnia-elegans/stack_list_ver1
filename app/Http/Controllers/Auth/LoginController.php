<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Auth;
use Socialite;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/guest/guestuser';
    protected $redirectToTwitter = '/admin';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function redirectToProvider()
    {
        // twitter認証へリダイレクト
        return Socialite::driver('twitter')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('twitter')->user();
        $authUser = $this->findOrCreateUser($user);
        Auth::login($authUser, true);

        return redirect($this->redirectToTwitter);
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
            'email' => $user->name,
            'twitter_id' => $user->id,
            'twitter_name' => $user->nickname,
            'avatar' => $user->avatar,
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
