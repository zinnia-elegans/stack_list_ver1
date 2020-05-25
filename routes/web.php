<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

// トップページ
Route::get('/','TweetsController@home')->name('home');
Route::get('/about', 'TweetsController@about');

// 認証ページ
Route::get('/auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('/auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

// 認証後ページ
Route::group(['middleware' => 'auth'], function () {
    // ツイッターユーザー用
    Route::get('admin', 'TweetsController@admin')->name('admin');
    Route::post('admin', 'TweetsController@admin');
    // ゲストユーザー用
    Route::get('guest/register', 'UserController@getProfile');
    Route::get('guest/guestuser', 'UserController@admin');


    Route::get('continue', 'ContinueController@continue');
    Route::post('continue', 'ContinueController@continue');
});