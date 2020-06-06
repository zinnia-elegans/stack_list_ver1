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
        <div class="card-body mt-3 text-center">
          <p class="d-inline">あなたの積み上げレベル：</p>
          <h4 class="d-inline m-3" id="{{ $stackday }}">{{ $stackday }}</h4>
          <input type="button" class="btn btn-primary d-inline" id="addstack" value="追加">
        </div>
        </div>
        <div class="card-body">
          <form method="post" action={{ url('/users/admin') }}>                         
            @csrf
            <div class="form-group">
                <textarea class="form-control" name="tweet" required autocomplete="text" id="stack" rows="5">#今日の積み上げ 継続〇〇日</textarea>   
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
          @foreach ($tweets_obj as $tweet)
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
