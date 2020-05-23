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
        <div class="card mx-auto" style="width: 37.5rem">
          <div class="card-body">
              <h3>現在の継続日数を確認する</h3>
                  <form id="test1" action="{{ url('/continue') }} " method="post" name="from">
                      <div class="form-group">
                          <input id="year" type="text" name="y" size="6" maxlength="4" value="2020"/> 年 
                          <input id="month" type="text" name="m" size="4" maxlength="2" placeholder="yy"/> 月 
                          <input id="date" type="text" name="d" size="4" maxlength="2" placeholder="dd"/> 日
                          <input id="calcButton" class="btn-primary" type="submit" name="regist" value="登録" />
                          <input id="resetButton" class="btn-primary" type="reset" name="reset" value="リセット" />
                      </div>
                  </form>
              <p>あなたの継続日数は、<p id="returnDate"></p> です。</p>
          </div>
          <div class="card-body">
              <p>過去の積み上げを確認する</p>
          </div>
        </div>
        <div class="card mx-auto" style="width: 37.5rem;">
          <div class="card-body">
            <form method="post" action={{ url('/admin') }}>                         
                @csrf
                <div class="form-group">
                    <textarea class="form-control" name="tweet" required autocomplete="text"><P>＃今日の積み上げ</P></textarea>   
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
        <div class="card mx-auto" style="width: 37.5rem">
          <h5 class="mt-7 text-center"><strong>#前回のあなたの積み上げ</strong></h5>
            <div class="card-body">>
              @foreach ($userTweet as $tweet)
                @if(preg_match("/今日の積み上げ/",$tweet->text)==1)
                    <div class="card p-3">
                        <img src="{{ Auth::user()->avatar }}" class="rounded-circle mr-4">
                        <div class="media-body">
                            <a href="https://twitter.com"><h5 class="d-inline mr-3"><strong>{{ Auth::user()->name }}</strong></h5></a>
                            <h6 class="d-inline text-secondary">{{ date('Y/m/d', strtotime(Auth::user()->created_at)) }}</h6>
                            <p class="mt-3 mb-0">{{ $tweet->text }}</p>
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <div class="d-flex flex-row justify-content-end">
                                <div class="mr-5"><i class="far fa-comment text-secondary"></i></div>
                                <div class="mr-5"><i class="fas fa-retweet text-secondary"></i></div>
                                <div class="mr-5"><i class="far fa-heart text-secondary"></i></div>
                            </div>
                        </div>
                    </div>
                @endif
              @endforeach
            </div>
        </div>
      </div>
    </div>
  </body>
@endsection
