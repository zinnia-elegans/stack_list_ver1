<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

// 認証ページ
Route::get('/auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('/auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
// トップページ
Route::get('/about', 'TweetsController@about');
Route::get('/','TweetsController@index');

Route::group(['middleware' => 'auth'], function () {
    Route::get('tweets', 'TweetsController@index');
    Route::post('tweets', 'TweetsController@index');
    Route::get('yourstack', 'TweetsController@stack');
    Route::get('admin', 'TweetsController@admin');
    Route::post('admin', 'TweetsController@admin');
    Route::get('continue', 'ContinueController@continue');
    Route::post('continue', 'ContinueController@continue');
});

// ルーティングにプレフィックス(guest)を指定
Route::group(['prefix' => 'guest'], function() {
 
    Route::get('/signup',[
      'uses' => 'GuestuserController@getSignup',
      'as' => 'guest.signup'
    ]);

    Route::post('/signup',[
        'uses' => 'GuestuserController@postSignup',
        'as' => 'guest.signup'
    ]);
       
        Route::get('/register',[
        'uses' => 'GuestuserController@getProfile',
        'as' => 'guest.register'
    ]);
   
  });