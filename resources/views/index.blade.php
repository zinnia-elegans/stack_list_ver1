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
                <div class="card mb-2">
                    <div class="thumbnail">
                        <img src="https://bahn-csgroup.com/wp-content/uploads/2017/06/tusmiageru.jpg" class="rounded-circle img-fluid mx-auto d-block m-5" width="60%" height="auto" alt="積木" >
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <div class="media m-3 d-block text-center">
                                        <h2 class="media-heading m-5"><strong>あなたの日々の積み上げを確認してみましょう。</strong></h2>
                                        <a href="/login" class="btn btn-primary">ログイン</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h5 class="m-3 text-center"><strong>#みんなの積み上げ</strong></h5>
                    @foreach ($statuses->statuses as $tweet)
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="media">
                                    <img src="{{ $tweet->user->profile_image_url_https }}" class="rounded-circle mr-4">
                                    <div class="media-body">
                                        <h5 class="d-inline mr-3"><strong>{{ $tweet->user->name }}</strong></h5>
                                        <h6 class="d-inline text-secondary">{{ date('Y/m/d', strtotime($tweet->created_at)) }}</h6>
                                        <p class="mt-3 mb-0">{{ $tweet->text }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-top-0">
                                <div class="d-flex flex-row justify-content-end">
                                    <div class="mr-5"><i class="far fa-comment text-secondary"></i></div>
                                    <div class="mr-5"><i class="fas fa-retweet text-secondary"></i></div>
                                    <div class="mr-5"><i class="far fa-heart text-secondary"></i></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
            </div>
        </body>
    </html>

@endsection