@extends('layouts.app')

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
                    <div class="card mb-2">
                        <div class="thumbnail">
                            <img src="/storage/twitter0.png" class="rounded-circle img-fluid mx-auto d-block m-5" width="60%" height="auto" alt="twitter" >
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <div class="media m-3 d-block text-center">
                                            <h2 class="media-heading"><strong>ログイン方法</strong></h2>
                                            <h3 class="m-5"><strong>当サイトの登録には、OAuthという認証方法を利用しております。サービス利用時、あなたのTwitterパスワードを知らせることはありません。</strong></h3>
                                            <h3 class="m-5">OAuth認証では、ユーザー情報にアクセスする情報を得るだけで、当サイトがサービスのアカウントからユーザー情報を得ることができます。</h3>
                                            <a href="{{ url('auth/twitter') }}">
                                                <button type="button" class="btn btn-primary"><i class="fab fa-twitter"></i> Twitterアカウントでログインする</button>
                                            </a>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </body>
    </html>

@endsection