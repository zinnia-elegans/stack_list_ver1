<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

// ユーザー認証不要
Route::get('/','TweetsController@home')->name('home');
Route::get('/about', 'TweetsController@about');

// Twitter認証
Route::get('/auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('/auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

// 認証後
Route::group(['middleware' => 'auth'], function () {
    // ツイッターユーザー用
    Route::get('users/admin', 'TweetsController@admin');
    Route::post('users/admin', 'TweetsController@admin');
    // ゲストユーザー用
    Route::get('guest/register', 'UserController@getProfile');
    Route::get('guest/guestuser', 'UserController@admin');
    //SNSツール機能    
    Route::resource('users/allusers', 'UserController', ['only' => ['index', 'show', 'edit', 'update']]);
    // フォロー/フォロー解除を追加
    Route::post('users/alluser/follow', 'UserController@follow')->name('follow');
    Route::delete('users/alluser/unfollow', 'UserController@unfollow')->name('unfollow');
    // 継続日数
    Route::get('continue', 'ContinueController@continue');
    Route::post('continue', 'ContinueController@continue');
});