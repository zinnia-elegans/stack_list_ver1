<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '#積み上げリスト') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Noto+Sans+JP:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-white">
    <div id="app" class="bg-white">
        <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand ml-3" href="{{ url('/') }}"><img src="https://zinnia-elegans.s3.us-east-2.amazonaws.com/1_Primary_logo_on_transparent_393x63.png" style="width:60%;" alt="積み上げリスト"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto"></ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav justify-content-end">
                    @auth
                        <li class="nav-item m-3 pt-2"><a class="nav-link" href="{{ url('/users/admin')}}"><h5>#ユーザー画面</h5><span class="sr-only"></span></a>
                    @endauth
                        <li class="nav-item m-3 pt-2"><a class="nav-link" href="{{ url('about')}}"><h5>#このサイトについて</h5></a></li>
                    <!-- Authentication Links -->
                        @auth
                        <li class="nav-item m-2 pt-2"><img src="{{ $userInfo['profile_image_url'] }}" class="rounded-circle shadow" width="50" height="50"></li>
                        <li class="nav-item dropdown pt-4">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="https://twitter.com" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><span class="caret"></span></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('/auth/twitter/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                        @else
                                <li class="nav-item m-3 pt-2"><a class="nav-link" href="{{ url('/oauth') }}"><h5>{{ __('Login') }}</h5></a></li>
                        @endauth
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main class="my-auto">
            @yield('content')
        </main>
    </div>
</body>
</html>
