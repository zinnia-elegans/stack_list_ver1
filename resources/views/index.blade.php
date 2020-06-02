@extends('layouts.app')

@section('content')
        <body>
            <div class="container">
                <div class="mx-auto text-center" style="width: 50.5rem;">
                    <img src="https://bahn-csgroup.com/wp-content/uploads/2017/06/tusmiageru.jpg" class="rounded-circle img-fluid mx-auto d-block m-5" width="60%"  alt="積木" >
                    <h1 class="site-name"><strong>積み上げリスト</strong></h1>
                        <div class="mx-auto" style="width: 20rem">
                        @auth
                        <a href="{{ url('/users/admin') }}" type="button" class="btn btn-primary m-3 p-2 d-block"><i class="fab fa-twitter"></i> ユーザー画面へ</a>
                        @else
                        <a href="{{ url('/oauth') }}" type="button" class="btn btn-primary m-3 p-2 d-block"><i class="fab fa-twitter"></i> Twitterアカウントでログインする</a>
                        @endauth
                        <p class="m-3"><a href="#" role="button">テストユーザー</a></p>
                    </div>
                </div>
            </div>
        </body>
    </html>
@endsection