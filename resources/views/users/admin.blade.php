@extends('layouts.app')

@section('content')

    <div class="container">
      <div class="row">
        <div class="col-md-4">
          {{-- 左カラム --}}
          <div class="card mt-1">
              <div class="view overlay">
                <img class="card-img-top" src="{{ $userInfo['profile_banner_url'] }}" alt="Card image cap">
                <div class="mask rgba-white-slight"></div>
              </div>
              <div class="card-body">
                <div class="card-body d-block border shadow">
                  <img src="{{ Auth::user()->avatar }}" class="rounded-circle shadow-lg border-light d-block mx-auto m-3"  width="60" height="60">
                  <p class="card-title text-center"><strong>{{ Auth::user()->name }}</strong></p>
                  <p class="card-text text-center m-5">{{ Auth::user()->description }}自己紹介文が入る</p>
                  <button class="btn btn-primary mx-auto d-block">フォローしてみる</button>
                </div>
                <p class="card-text d-block text-center m-4" id="returnDate">継続日数が入る</p>
                <div class="card-body">
                  <form method="post" action={{ url('/users/admin') }}>                         
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control" name="tweet" required autocomplete="text">#今日の積み上げ</textarea>   
                          @error('text')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        <div class="text-right">
                          <p class="mb-4 text-danger">140文字以内</p>
                          <button class="btn btn-primary">Twitterに投稿する</button>
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
                            <img src="{{ Auth::user()->avatar }}" class="rounded-circle mr-4">
                            <div class="media-body">
                                <a href="https://twitter.com"><h5 class="d-inline mr-3"><strong>{{ Auth::user()->name }}</strong></h5></a>
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
        {{-- 右カラム --}}
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <h4 class="text-center m-3">タイムライン </h4>
              <form method="post" action={{ url('/users/admin') }}>                         
                  @csrf
                  <div class="form-group">
                      <textarea class="form-control" name="tweet" required autocomplete="text"></textarea>   
                        @error('text')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="text-right">
                        <button class="btn btn-primary">つぶやく</button>
                      </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection
