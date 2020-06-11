@extends('layouts.app')

@section('content')
            <div class="container">
                <div class="mx-auto" style="width:35rem;">
                    <img src="https://zinnia-elegans.s3.us-east-2.amazonaws.com/stack2.png" class="rounded-circle img-fluid d-block mt-5" alt="積木" >
                    <div class="text-center my-5">
                    @auth
                        <a href="{{ url('/users/admin') }}" type="button" class="btn btn-twitter btn-social-icon btn-primary p-2 d-block mx-auto my-4" style="width: 12rem">ユーザー画面へ</a>
                    @else
                        <a href="{{ url('/oauth') }}" type="button" class="btn btn-primary m-3 d-block"><i class="fab fa-twitter">Twitterアカウントでログインする</i></a>
                    @endauth
                        <a href="{{ url('/auth/twitter/logout') }}" class="d-block">ログアウト</a>
                    </div>
                </div>
            </div>
@endsection