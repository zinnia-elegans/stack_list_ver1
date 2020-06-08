@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card text-center">
        <div class="card-body">
          <p>開始日から計算して追加</p>
          <form id="test1" action="{{ url('/continue') }} " method="post">
            @csrf
            <div class="form-group">
                <input id="year" type="text" name="y" size="6" maxlength="4" value="2020"/> 年 
                <input id="month" type="text" name="m" size="4" maxlength="2" value="{{ old('m') }}" placeholder="yy"/> 月 
                <input id="date" type="text" name="d" size="4" maxlength="2" placeholder="dd"/> 日
            </div>
          </form>
          <p>前回、投稿した日数</p>
          <div class="p" name="returnDate">{{ old('returnDate') }}</div>

          <p>過去の積み上げ件数を自動で取得</p>
        </div>
        <div class="m-3">
          <input id="calcButton" class="btn btn-primary" type="submit" name="regist" value="追加" />
          <input id="resetButton" class="btn btn-primary" type="reset" name="reset" value="リセット" />
        </div>
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
