<?php

use App\Http\Controllers\TweetsController;
use Illuminate\Support\Facades\Route;


Auth::routes();

// ユーザー認証不要
Route::get('/','TweetsController@home')->name('home');
Route::get('/about', 'TweetsController@about');
// TwitterOAuth認証
Route::get('/oauth', 'Auth\LoginController@login');
//Callback用のルーティング
Route::get('/users/admin/callback', 'Auth\LoginController@callBack');
 
    

// 認証後
Route::group(['middleware' => 'auth'], function () {
  //indexのルーティング
 Route::get('/users/admin', 'TweetsController@index');
 Route::post('/users/admin', 'TweetsController@index');
 Route::get('/users/index', 'TweetsController@index');
  // 継続日数
  Route::get('continue', 'ContinueController@continue');
  Route::post('continue', 'ContinueController@continue');
});

  //logoutのルーティング
  Route::get('/logout', 'TweetsController@logout');