<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Models\Twitteruser;
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

    public function admin(Request $request)
    {

        // ユーザー情報を取得
        $userdata = \Twitter::get('account/verify_credentials');
        $userInfo = get_object_vars($userdata);

        // ツイートする
        $tweet = $request->tweet;
        $text = \Twitter::post('statuses/update', array("status" => $tweet));

        // 前回の積み上げを取得
        $userTweet = \Twitter::get('statuses/user_timeline',["count" => 30]);

        return view('users.admin', [
            'userInfo' => $userInfo,
            'text' => $text,
            'userTweet' => $userTweet
        ]);
    }

    public function continue ()
    {
        return view('continue');
    }


    // 一覧表示
    public function index()
    {
        //
    }

    // 新規ツイート入力画面
    public function create()
    {
        //
    }

    // 新規ツイート投稿処理
    public function store(Request $request)
    {
        //
    }

    // ツイート詳細画面
    public function show($id)
    {
        //
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