@extends('layouts.front')

@section('content')
    <!DOCTYPE html>
    <html lang="ja">
        <head>
            <meta charset="UTF-8">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>積み上げリスト</title>
        </head>
        <body>
            <div class="container">
                {{-- <form method="POST" action="{{ route('login') }}"> --}}
                    @csrf     
                    <img src="https://bahn-csgroup.com/wp-content/uploads/2017/06/tusmiageru.jpg" class="rounded-circle img-fluid mx-auto d-block m-5" width="60%"  alt="積木" >
                    <div class="media m-3 text-center">
                        <div class="media-body d-block">
                            <h1 class="site-name"><strong>積み上げリスト</strong></h1>
                            <a href="{{ url('auth/twitter') }}">
                                <button type="button" class="btn btn-primary m-3 p-2"><i class="fab fa-twitter"></i> Twitterアカウントでログインする</button>
                            </a> 
                            <a href="guest/signup">
                                <button class="btn btn-primary m-3 p-2">一般ユーザーでログイン</button>
                            </a>
                            <p class="m-3"><a href="#" role="button">テストユーザー</a></p>
                        </div>
                    </div>
                {{-- </form> --}}
            </div>
        </body>
    </html>

@endsection