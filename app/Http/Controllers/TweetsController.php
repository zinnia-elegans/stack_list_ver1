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

         // ツイッターに投稿
         $tweet = $request->tweet;
         $text = $twitter->post('statuses/update', array("status" => $tweet));

        // ユーザー情報を取得
        $userInfo = get_object_vars($twitter->get('account/verify_credentials'));
        // タイムライン取得
        $userTweet = $twitter->get('statuses/user_timeline',["count" => 30]);

        $params = array('count' =>  100);
        // リクエスト回数
        $request_number = 10;

        for ($i = 0; $i <$request_number; $i++) { 
            echo $params['count'] * $i + 1 . " - " . $params['count'] * ($i + 1) . " 件目取得中\n"; 
            $tweets_obj = $twitter->get('statuses/user_timeline', $params);
        
        // オブジェクトを配列に変換
        $json = json_encode($tweets_obj);
        $tweets_arr = json_decode($json, true);
        $columns = array_column($tweets_arr, 'text');
        $stack = "/#今日の積み上げ /";

        for($i = 0; $i < count($columns); $i++) {
            if(preg_match($stack, $columns[$i])) {
                echo 'できてるよ！';
            } else {
                echo 'できてないよ！';
            };
        };

        // // next_results が無ければ処理を終了
        // if (!$next_results) {
        //     break;
        // }

        // // パラメータに変換
        // parse_str($next_results, $params);
    }
        return view('users.admin', [
            'userInfo'  => $userInfo,
            'userTweet' => $userTweet,
            'text'      => $text
        ]);
    }

    public function store(Request $request)
    {
        $returnDate = $request->returnDate;

        dd($returnDate);
    }


    public function home(Request $request)
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

        return view('index',[
            'userInfo' => $userInfo
        ]);
    }

   
}