@extends('layouts.app')

@section('content')
  <body>
    <div class="row m-2">
      <div class="col">
        <div class="card mt-1 mx-auto" style="width: 37.5rem;">
          <div class="view overlay">
            <img class="card-img-top" src="{{ $userInfo['profile_banner_url'] }}" alt="Card image cap">
            <a href="#">
            <div class="mask rgba-white-slight"></div>
            </a>
          </div>
          <div class="card-body" style="">
            <img src="{{ Auth::user()->avatar }}" class="rounded-circle d-inline" width="60" height="60">
            <h4 class="card-title d-inline">{{ Auth::user()->name }}</h4>
            <p class="card-text">{{ $userInfo['description']}}</p>
            <a href="#" class="btn btn-primary">フォローする</a>
          </div>
        </div>
        <div class="card mx-auto" style="width: 37.5rem;">
          <div class="card-body">
            <p class="d-inline">あなたの継続日数は<input type="text" id="datepicker">です。</p>
            <button class="btn btn-primary d-inline">継続日数を追記する</button>
          </div>
        </div>
        <div class="card mx-auto" style="width: 37.5rem;">
          <div class="card-body">
            <form method="post" action={{ url('/admin') }}>                         
                @csrf
                <div class="form-group">
                    <textarea class="form-control" name="tweet" required autocomplete="text">＃今日の積み上げ</textarea>   
                      @error('text')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                    <div class="text-right">
                      <p class="mb-4 text-danger">140文字以内</p>
                      <button class="btn btn-primary">ツイートする</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
@endsection
