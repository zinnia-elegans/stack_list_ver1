<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

// 認証ページ
Route::get('/auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('/auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
// トップページ
Route::get('/','TweetsController@home')->name('home');
Route::get('/about', 'TweetsController@about');

Route::group(['middleware' => 'auth'], function () {
    Route::get('admin', 'TweetsController@admin')->name('admin');
    Route::post('admin', 'TweetsController@admin');
    Route::get('guest/register', 'UserController@getProfile')->name('register');
    Route::get('guest/guestuser', 'UserController@admin');
    Route::get('continue', 'ContinueController@continue');
    Route::post('continue', 'ContinueController@continue');
});