<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

// 認証ページ
Route::get('/auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('/auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
// トップページ
Route::get('/', 'TweetsController@tweet');

Route::group(['middleware' => 'auth'], function () {
    Route::get('tweets', 'TweetsController@index');
    Route::post('tweets', 'TweetsController@index');
    Route::get('yourstack', 'TweetsController@stack');
    Route::get('admin', 'TweetsController@admin');
    Route::post('admin', 'TweetsController@admin');
    Route::get('continue', 'ContinueController@continue');
    Route::post('continue', 'ContinueController@continue');
});