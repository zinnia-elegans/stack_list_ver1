@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="view overlay">
          <img class="card-img-top" src="{{ $userInfo['profile_banner_url'] }}" alt="Card image cap">
        </div>
          <div class="card-body d-block border">
            <a href="https://twitter.com/home"><p class="card-title text-center"><strong>{{ $userInfo['name'] }}</strong></p></a>
            <p class="card-text text-center m-3">{{ $userInfo['description'] }} </p>
          </div>
                  @foreach($stacklistday as $beforeList)
                  <div class="card-body border m-3 text-center">
                    <div class="m-3" name="continue">今日の積み上げ<br>
                      <h4><input class="m-3" id="addDays" type="text" size="4" value="{{ $beforeList + 1 }}">日</h4>
                    </div>
                    <div class="">
                      <button class="btn btn-primary" id="addText">追加</button>
                      <button class="btn btn-primary" id="resetText">リセット</button>
                    </div>
                  </div>
                  @endforeach
            
              </form>
          <div class="card-body">
            <form method="post" action={{ url('/users/admin') }}>                         
                @csrf
                  <div class="form-group">
                      <textarea class="form-control" name="tweet" required autocomplete="text" id="addTweet" rows="5">#今日の積み上げ </textarea>
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
            </form>
          </div>
      </div>
    </div>

    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="text-center pt-3"><strong>#積み上げリスト</strong></h5>
          @foreach ($stacklist as $tweet)
            @if(preg_match("/今日の積み上げ/",$tweet)==1)
                <div class="card p-3">
                  <div class="media">
                    <div class="media-body">
                        <h6 class="d-inline text-secondary">{{ date('Y/m/d', strtotime($tweet)) }}</h6>
                        <p class="mt-3 mb-0">{{ $tweet }}</p>
                    </div>
                  </div>
                </div>
            @endif
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
