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
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                            <img src="https://bahn-csgroup.com/wp-content/uploads/2017/06/tusmiageru.jpg" class="rounded-circle img-fluid mx-auto d-block m-5" width="60%"  alt="積木" >
                            <div class="media m-3 d-block text-center">
                                <h1 class="site-name"><strong>積み上げリスト</strong></h1>
                                <p><a href="/login" class="btn btn-primary" role="button">ログイン</a></p>
                            </div>
                    <div class="card-columns">
                        @foreach ($statuses->statuses as $tweet)
                            <div class="card p-3">
                                <blockquote class="blockquote mb-0">
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
                                </blockquote>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </body>
    </html>

@endsection