<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Models\User;
use App\Models\Day;
use Storage;
use DateTime;

class TweetsController extends Controller
{
   
    public function index(Request $request, User $user)
    {
        // ツイッターに投稿
        $tweet = $request->tweet;
        \Twitter::post('statuses/update', array("status" => $tweet));
        // ユーザー情報を取得
        $userInfo = get_object_vars(\Twitter::get('account/verify_credentials'));
        
        $params = array('count' => 20, 'exclude_replies' => true, 'screen_name' => $user, 'include_rts' => false);
        // ユーザーのタイムライン取得
        $tweets_obj = \Twitter::get('statuses/user_timeline', $params);
        
        // JSONに変換し、配列に変換
        $twitter_arr = json_decode(json_encode($tweets_obj),true);
        // textカラムを抽出
        $columns = array_column($twitter_arr,'text','created_at');
        
        // 配列からワードを抽出
        $result = preg_grep('/#今日の積み上げ+/', $columns);
        // 5件のみ取得
        $stacklist = array_slice($result,0,5);
        // 「日」が直後にある、1~3桁までの数字以外のもの全てを""に置き換え
        $stacklistdays = preg_replace("/[#今日の積み上げ]?+([^0-9][^{1,3}])+?[^日]/u", "", $stacklist);
        // 最初の配列の数字のみ取得
        $stacklistday = array_slice($stacklistdays,0,1);
        
        $day = Day::select('day')->get();

        return view('users.admin', [
            'userInfo'  => $userInfo,
            'stacklist' => $stacklist,
            'stacklistday' => $stacklistday,
            'day' => $day,
            'tweets_obj' => $tweets_obj,
        ]);
    }

    public function home(Request $request)
    {    
 
        $userInfo = get_object_vars(\Twitter::get('account/verify_credentials'));

        return view('index',[
            'userInfo' => $userInfo,
            ]);
    }

    public function about(Request $request)
    {
        $userInfo = get_object_vars(\Twitter::get('account/verify_credentials'));
        $imagePath = Storage::disk('s3')->url('s3://stacklist/1_Primary_logo_on_transparent_393x63.png');

        return view('about',[
            'userInfo' => $userInfo,
            'imagePath' => $imagePath
        ]);
    }

   
}


