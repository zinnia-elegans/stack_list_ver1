@extends('layouts.app')

@section('content')

<div class="container">
  <div class="card mt-1 w-50 mx-auto">
      <div class="view overlay">
      <img class="card-img-top" src="{{ $userInfo['profile_banner_url'] }}" alt="Card image cap">
      </div>
      <div class="card-body">
        <div class="card-body d-block border">
          <img src="{{ $userInfo['profile_image_url'] }}" class="rounded-circle border-light d-block mx-auto m-3"  width="70" height="70">
          <p class="card-title text-center"><strong>{{ $userInfo['name'] }}</strong></p>
          <p class="card-text text-center m-3">{{ $userInfo['description'] }} </p>
        </div>
        <div class="card">
        <div class="card-body mt-3">
            <p class="text-center">最後の積み上げからの継続日数を登録してください。</p>
            <p class="text-center">次回以降は、自動入力されます。</p>
            <form id="test1" action="{{ url('/continue') }} " method="post" name="from">
                <div class="form-group text-center">
                    <input id="year" type="text" name="y" size="6" maxlength="4" value="2020"/> 年 
                    <input id="month" type="text" name="m" size="4" maxlength="2" placeholder="yy"/> 月 
                    <input id="date" type="text" name="d" size="4" maxlength="2" placeholder="dd"/> 日
                    <button id="calcButton" class="btn btn-primary" type="button" name="regist">登録</button>
                    <button id="resetButton" class="btn btn-primary" type="reset" name="reset">リセット</button>
                </div>
            </form>
        </div>
        </div>
        <div class="card-body">
          <form method="post" action={{ url('/users/admin') }}>                         
            @csrf
            <div class="form-group">
                <textarea class="form-control" name="tweet" required autocomplete="text" id="returnDate" rows="5">#今日の積み上げ 継続〇〇日</textarea>   
                  @error('text')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="text-right">
                  <p class="mb-4 pr-4 text-danger d-inline">140文字以内</p>
                  <button class="btn btn-primary d-inline">Twitterに投稿する</button>
                </div>
            </div>
          </form>
        </div>
        <div class="card-body">
          <h5 class="text-center pt-3"><strong>#前回の積み上げ</strong></h5>
          @foreach ($userTweet as $tweet)
            @if(preg_match("/今日の積み上げ/",$tweet->text)==1)
                <div class="card p-3">
                  <div class="media">
                    <img src="{{ $userInfo['profile_image_url'] }}" class="rounded-circle mr-4">
                    <div class="media-body">
                        <a href="https://twitter.com"><h5 class="d-inline mr-3"><strong>{{ $userInfo['name'] }}</strong></h5></a>
                        <h6 class="d-inline text-secondary">{{ date('Y/m/d', strtotime($tweet->created_at)) }}</h6>
                        <p class="mt-3 mb-0">{{ $tweet->text }}</p>
                    </div>
                  </div>
                </div>
              @break
            @endif
          @endforeach
        </div>
      </div>
    </div>

@endsection
