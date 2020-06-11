<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Models\User;
use App\Models\Day;
use Storage;

class TweetsController extends Controller
{
    private $consumerKey = 'd9ktYK8Pj12uAiBB6qX4wZGwD';
    private $consumerSecret = 'X2j9gdo1TjtfQLN86c43zk1KJCwLsJOfSlCHHMwVBUJS47eMsh';
    private $callBackUrl = 'http://127.0.0.1:8000/users/admin/callback';

    public function index(Request $request, User $user)
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
        
        $params = array('count' => 100, 'exclude_replies' => true, 'screen_name' => $user, 'include_rts' => false);
        // ユーザーのタイムライン取得
        $tweets_obj = $twitter->get('statuses/user_timeline', $params);

        $pattern = '/#今日の積み上げ+/';
        // textカラムを抽出
        $columns = array_column($tweets_obj, 'text');
        // 配列からワードを抽出
        $result = preg_grep($pattern, $columns);
        // 5件のみ取得
        $stacklist = array_slice($result,0,5);
        // 「日」が直後にある、1~3桁までの数字、以外のもの全てを""に置き換え
        $stacklistdays = preg_replace("/([^0-9,０−９]{1,3}.??(?!=日))/u", "", $stacklist);
        // 最初の配列の数字のみ取得
        $stacklistday = array_slice($stacklistdays,0,1);
        
        $day = Day::select('day')->get();

        $imagePath = Storage::disk('s3')->url('s3://stacklist/1_Primary_logo_on_transparent_393x63.png');


        return view('users.admin', [
            'userInfo'  => $userInfo,
            'stacklist' => $stacklist,
            'stacklistday' => $stacklistday,
            'day' => $day,
            'imagePath' => $imagePath
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
         $accessToken['oauth_token'],
         $accessToken['oauth_token_secret']
         );
 
        $userInfo = get_object_vars($twitter->get('account/verify_credentials'));

        return view('index',[
            'userInfo' => $userInfo,
            ]);
    }

    

    public function continue (Request $request, User $user)
    {
        $accessToken = session()->get('accessToken');

        $twitter = new TwitterOAuth(
        $this->consumerKey,
        $this->consumerSecret,
        $accessToken['oauth_token'],
        $accessToken['oauth_token_secret']
        );

        $userInfo = get_object_vars($twitter->get('account/verify_credentials'));
        $imagePath = Storage::disk('s3')->url('s3://stacklist/1_Primary_logo_on_transparent_393x63.png');

        return view('users.continue',[
            'userInfo' => $userInfo,
            'imagePath' => $imagePath
        ]);
    }

    public function store(Request $request,User $user)
    {
        $accessToken = session()->get('accessToken');

        $twitter = new TwitterOAuth(
        $this->consumerKey,
        $this->consumerSecret,
        $accessToken['oauth_token'],
        $accessToken['oauth_token_secret']
        );

        $userInfo = get_object_vars($twitter->get('account/verify_credentials'));
        $params = array('count' => 100, 'exclude_replies' => true, 'screen_name' => $user, 'include_rts' => false);
        $tweets_obj = $twitter->get('statuses/user_timeline', $params);
        $pattern = '/#今日の積み上げ+/';
        $columns = array_column($tweets_obj, 'text');
        $result = preg_grep($pattern, $columns);
        $stacklist = array_slice($result,0,5);
        $stacklistdays = preg_replace("/([^0-9,０−９]{1,3}.??(?!=日))/u", "", $stacklist);
        $stacklistday = array_slice($stacklistdays,0,1);     

        $continue = new Day;
        $continue->day = $request->continueDay;
        $continue->update();

        $day = Day::select('day')->get();
        $imagePath = Storage::disk('s3')->url('s3://stacklist/1_Primary_logo_on_transparent_393x63.png');

        return view('users.admin',[
            'userInfo' => $userInfo,
            'stacklistday' => $stacklistday,
            'stacklist' => $stacklist,
            'day' => $day,
            'imagePath' => $imagePath
        ]);
    }

    public function about(Request $request)
    {
        $accessToken = session()->get('accessToken');

        $twitter = new TwitterOAuth(
        $this->consumerKey,
        $this->consumerSecret,
        $accessToken['oauth_token'],
        $accessToken['oauth_token_secret']
        );
        $userInfo = get_object_vars($twitter->get('account/verify_credentials'));
        $imagePath = Storage::disk('s3')->url('s3://stacklist/1_Primary_logo_on_transparent_393x63.png');

        return view('about',[
            'userInfo' => $userInfo,
            'imagePath' => $imagePath
        ]);
    }

   
}


