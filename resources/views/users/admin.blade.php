@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card">
        <h2 class="m-4">積み上げ日数</h2>
          <form action="{{ url('/') }}" method="post">
            <div class="card-body border m-3">
              <input type="radio" class="m-3">登録した日数<br>
              <input type="text" size="8" maxlength="2" class="m-3"> 日
            </div>
              @foreach($stacklistday as $beforeList)
              <div class="card-body border m-3">
                <input type="radio" class="m-3" name="continue" value="できてる？">前回、投稿した日数<br>
                <h4><input class="m-3" type="text" size="4" value="{{ $beforeList }}">日</h4>
              </div>
              @endforeach
            <div class="m-3 text-center">
              <button id="calcButton" class="btn btn-primary" type="submit" name="regist" >追加</button>
              <input id="resetButton" class="btn btn-primary" type="reset" name="reset" value="リセット" />
            </div>
          </form>
      </div>
    </div>

    <div class="col">
      <div class="card mt-1">
        <div class="view overlay">
          <img class="card-img-top" src="{{ $userInfo['profile_banner_url'] }}" alt="Card image cap">
        </div>
        <div class="card-body">
          <div class="card-body d-block border">
            <img src="{{ $userInfo['profile_image_url'] }}" class="rounded-circle border-light d-block mx-auto m-3"  width="70" height="70">
            <p class="card-title text-center"><strong>{{ $userInfo['name'] }}</strong></p>
            <p class="card-text text-center m-3">{{ $userInfo['description'] }} </p>
          </div>
          <div class="card-body">
            <form method="post" action={{ url('/users/admin') }}>                         
                @csrf
                  <div class="form-group">
                      <textarea class="form-control" name="tweet" required autocomplete="text" id="returnDate" rows="5">#今日の積み上げ </textarea>
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
