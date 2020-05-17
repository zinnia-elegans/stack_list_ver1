<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Facades\Twitter;
use Auth;

class TweetsController extends Controller
{

     // 検索ツイート取得
     public function tweet(){
        $statuses = \Twitter::get('search/tweets', array("q" =>"#今日の積み上げ", "count" => 20));
        return view('index',['statuses' => $statuses]);
    }
    
    public function index(){

        $user = Auth::user();
        $search = ["q" => "今日の積み上げ", "count" => 10];
        $statuses = \Twitter::get('statuses/user_timeline',$search);

        return view('tweets.index', [
            'user' => $user,
            'statuses' => $statuses,
        ]);
    }

   
    public function create(){

    }

  
    public function store(){

    }

   
    public function show(){
        
    }

    
    public function edit(){
        
    }

    
    public function update(){
        
    }

   
    public function destroy(){

}

}