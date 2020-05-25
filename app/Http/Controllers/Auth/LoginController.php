<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Twitteruser;
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


    public function redirectToProvider($provider)
    {
        // twitter認証へリダイレクト
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);
        
        Auth::login($authUser, true);

        return redirect($this->redirectToTwitter);
    }

    public function findOrCreateUser($user, $provider)
    {
        $authUser = Twitteruser::where('provider_id', $user->id)->first();
        if($authUser) {
            return $authUser;
        }
        return Twitteruser::create([
            'name' => $user->name,
            'email' => $user->name,
            'twitter_id' => $user->id,
            'twitter_name' => $user->nickname,
            'avatar' => $user->avatar,
            'provider' => strtoupper($provider),
            'provider_id' => $user->id
        ]);
    }
}
