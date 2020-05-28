<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Follower;
use App\Models\Comment;
use App\Models\Tweet;
use App\Models\User;

class TweetsController extends Controller
{
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


    // 一覧表示
    public function index(Request $request, Tweet $tweet, Follower $follower)
    {

        // ユーザー情報を取得
        $userdata = \Twitter::get('account/verify_credentials');
        $userInfo = get_object_vars($userdata);

        // 前回の積み上げを取得
        $userTweet = \Twitter::get('statuses/user_timeline',["count" => 30]);

        // ツイートする
        $tweet = $request->tweet;
        $text = \Twitter::post('statuses/update', array("status" => $tweet));

        $user = auth()->user();
        $follow_ids = $follower->followingIds($user->id);
        // followed_idだけ抜き出す
        $following_ids = $follow_ids->pluck('followed_id')->toArray();

        $timelines = $tweet->getTimelines($user->id, $following_ids);

        return view('users.admin', [
            'user'      => $user,
            'timelines' => $timelines,
            'userInfo'  => $userInfo,
            'userTweet' => $userTweet,
            'text'      => $text
        ]);
    }

    // 新規ツイート入力画面
    public function create()
    {
        $user = auth()->user();

        return view('users.admin', [
            'user' => $user
        ]);
    }

    // 新規ツイート投稿処理
    public function store(Request $request, Tweet $tweet)
    {
        $user = auth()->user();
        $data = $request->all();
        $validator = Validator::make($data, [
            'text' => ['required', 'string', 'max:140']
        ]);

        $validator->validate();
        $tweet->tweetStore($user->id, $data);

        return redirect('users.admin');
    }

    public function show(Tweet $tweet, Comment $comment)
    {
        $user = auth()->user();
        $tweet = $tweet->getTweet($tweet->id);
        $comments = $comment->getComments($tweet->id);

        return view('users.comment', [
            'user'     => $user,
            'tweet' => $tweet,
            'comments' => $comments
        ]);
    }

    // ツイート編集画面
    public function edit($id)
    {
        //
    }

    // ツイート編集処理
    public function update(Request $request, $id)
    {
        //
    }

    // ツイート削除処理
    public function destroy($id)
    {
        //
    }
}