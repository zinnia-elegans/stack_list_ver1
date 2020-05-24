@extends('layouts.app')

@section('content')
  <body>
    <div class="container">
      <div class="row m-2">
        <div class="col">
          <div class="card mt-1 mx-auto" style="width: 37.5rem;">
            <div class="view overlay">
              <img class="card-img-top" src="public/dog.jpg" alt="Card image cap">
              <a href="#">
              <div class="mask rgba-white-slight"></div>
              </a>
            </div>
            <div class="card-body" style="">
              <img src="public/stack1.png" class="rounded-circle d-inline" width="60" height="60">
              <h4 class="card-title d-inline"><strong>ゲストユーザー名</strong></h4>
              <a href="" class="btn-social-icon-twitter ml-2"><span class="btn-social-icon-twitter__square"></span></a>
              <p class="card-text">自己紹介文</p>
            </div>
          </div>
          <div class="card mx-auto" style="width: 37.5rem">
            <div class="card-body">
              <p class="card-text" id="returnDate"></p>
              <button class="btn btn-primary">継続日数を追加</button>
            </div>
          </div>
          <div class="card mx-auto" style="width: 37.5rem;">
            <div class="card-body">
              <form method="post" action={{ url('/admin') }}>                         
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
                        <button class="btn btn-primary">ツイートする</button>
                      </div>
                  </div>
              </form>
            </div>
          </div>
          <div class="card mx-auto pt-3" style="width: 37.5rem">
            <h5 class="text-center pt-3"><strong>#前回の積み上げ</strong></h5>
              <div class="card-body">
                      <div class="card p-3">
                        <div class="media">
                          <img src="public/stack1.png" class="rounded-circle mr-4">
                          <div class="media-body">
                              <a href=""><h5 class="d-inline mr-3"><strong>ユーザー名</strong></h5></a>
                              <h6 class="d-inline text-secondary">日付</h6>
                              <p class="mt-3 mb-0">テキスト</p>
                          </div>
                        </div>
                      </div>
                  @endif
                  @break
                @endforeach
              </div>
          </div>
        </div>
      </div>
    </div>
  </body>
@endsection
