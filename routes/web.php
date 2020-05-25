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
    Route::get('guest/register', 'UserController@getProfile')->name('register');
    Route::get('admin', 'TweetsController@admin')->name('admin');
    Route::post('admin', 'TweetsController@admin');
    Route::get('continue', 'ContinueController@continue');
    Route::post('continue', 'ContinueController@continue');
});


Route::group(['prefix' => 'guest'], function() {
 
    Route::get('/signup',[
      'uses' => 'UserController@getSignup',
      'as' => 'guest.signup'
    ]);

    Route::post('/signup',[
        'uses' => 'UserController@postSignup',
        'as' => 'guest.signup'
    ]);
       
    Route::get('/register',[
        'uses' => 'UserController@getProfile',
        'as' => 'guest.register'
    ]);

    Route::post('/register',[
        'uses' => 'UserController@getProfile',
        'as' => 'guest.guestuser'
    ]);
   
  });