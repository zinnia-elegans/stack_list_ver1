<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

// 認証ページ
Route::get('/auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('/auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
// トップページ
Route::get('/', 'TweetsController@tweet');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('tweets', 'TweetsController', ['only' => ['index', 'create', 'store', 'show','edit', 'update', 'destoru']]);
});