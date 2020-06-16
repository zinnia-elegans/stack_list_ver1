<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Models\User;
use App\Models\Day;
use Storage;
use DateTime;
use Auth;

class TweetsController extends Controller
{
   
    private $consumerKey = 'd9ktYK8Pj12uAiBB6qX4wZGwD';
    private $consumerSecret = 'X2j9gdo1TjtfQLN86c43zk1KJCwLsJOfSlCHHMwVBUJS47eMsh';

    public function index(Request $request, User $user)
    {
        
        //セッションからアクセストークン取得
        $accessToken = session()->get('accessToken');

        //インスタンス生成
        $twitter_user = new TwitterOAuth(
            //API Key
            $this->consumerKey,
            //API Secret
            $this->consumerSecret,
            //アクセストークン
            $accessToken['oauth_token'],
            $accessToken['oauth_token_secret']
        );

        // ツイッターに投稿
        $tweet = $request->tweet;
        $twitter_user->post('statuses/update', array("status" => $tweet));
        //'account/verify_credentials'はユーザ情報を取得するためのAPIのリソース
        // get_object_vars()でオブジェクトの中身をjsonで返す
        $userInfo = get_object_vars($twitter_user->get('account/verify_credentials'));
        
        $params = array('count' => 20, 'exclude_replies' => true, 'screen_name' => $user, 'include_rts' => false);
        // ユーザーのタイムライン取得
        $tweets_obj = $twitter_user->get('statuses/user_timeline', $params);

        // JSONに変換し、配列に変換
        $twitter_arr = json_decode(json_encode($tweets_obj),true);
        // textカラムを抽出
        $columns = array_column($twitter_arr,'text');
        // 配列からワードを抽出
        $result = preg_grep('/#今日の積み上げ+/', $columns);
        // 5件のみ取得
        $stacklist = array_slice($result,0,5);
        $textStacklist = implode($stacklist);
        // 「日」が直後にある、1~3桁までの数字以外のもの全てを""に置き換え
        preg_match_all("/(?<=#今日の積み上げ |　)?+[0-9,０-９]{1,3}.(?=日)/u", $textStacklist,$stack);
        // 最初の配列の数字のみ取得
        $date = array($stack);
        $stacklistday = $date[0][0][0];

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
