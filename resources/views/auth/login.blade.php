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
                <form method="POST" action="{{ route('login') }}">
                    @csrf     
                    <img src="https://bahn-csgroup.com/wp-content/uploads/2017/06/tusmiageru.jpg" class="rounded-circle img-fluid mx-auto d-block m-5" width="60%"  alt="積木" >
                    <div class="media m-3 d-block text-center">
                        <h1 class="site-name"><strong>積み上げリスト</strong></h1>
                        <p><a href="{{ url('auth/twitter') }}" class="btn btn-primary mt-3" role="button"><i class="fa fa-twitter pr-2"></i>Twitter認証でログイン</a></p>
                        <button class="btn btn-primary">一般ユーザーでログイン</button>
                        <p class="mt-4"><a href="#" role="button">テストユーザー</a></p>
                    </div>
                </form>
            </div>
        </body>
    </html>

@endsection