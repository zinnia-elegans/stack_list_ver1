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
              <form method="POST" action="{{ route('admin.store') }}">
                  @csrf

                  <div class="form-group row mb-0">
                      <div class="col-md-12 p-3 w-100 d-flex">
                          <img src="{{ asset('storage/profile_image/' .$user->profile_image) }}" class="rounded-circle" width="50" height="50">
                          <div class="ml-2 d-flex flex-column">
                              <p class="mb-0">{{ $user->name }}</p>
                              <a href="{{ url('users/' .$user->id) }}" class="text-secondary">{{ $user->screen_name }}</a>
                          </div>
                      </div>
                      <div class="col-md-12">
                          <textarea class="form-control @error('text') is-invalid @enderror" name="text" required autocomplete="text" rows="4">{{ old('text') }}</textarea>

                          @error('text')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                  </div>

                  <div class="form-group row mb-0">
                      <div class="col-md-12 text-right">
                          <p class="mb-4 text-danger">140文字以内</p>
                          <button type="submit" class="btn btn-primary">
                              ツイートする
                          </button>
                      </div>
                  </div>
              </form>
            </div>
            <div class="card-body">
              <a href="{{ url('users/allusers') }}">ユーザ一覧 <i class="fas fa-users" class="fa-fw"></i> </a>
              @if (isset($timelines))
                @foreach ($timelines as $timeline)
                        <div class="card">
                            <div class="card-haeder p-3 w-100 d-flex">
                                <img src="{{ asset('storage/profile_image/' .$timeline->user->profile_image) }}" class="rounded-circle" width="50" height="50">
                                <div class="ml-2 d-flex flex-column">
                                    <p class="mb-0">{{ $timeline->user->name }}</p>
                                    <a href="{{ url('users/' .$timeline->user->id) }}" class="text-secondary">{{ $timeline->user->screen_name }}</a>
                                </div>
                                <div class="d-flex justify-content-end flex-grow-1">
                                    <p class="mb-0 text-secondary">{{ $timeline->created_at->format('Y-m-d H:i') }}</p>
                                </div>
                            </div>
                            <div class="card-body">
                                {!! nl2br(e($timeline->text)) !!}
                            </div>
                            <div class="card-footer py-1 d-flex justify-content-end bg-white">
                                @if ($timeline->user->id === Auth::user()->id)
                                    <div class="dropdown mr-3 d-flex align-items-center">
                                        <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-fw"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <form method="POST" action="{{ url('tweets/' .$timeline->id) }}" class="mb-0">
                                                @csrf
                                                @method('DELETE')

                                                <a href="{{ url('tweets/' .$timeline->id .'/edit') }}" class="dropdown-item">編集</a>
                                                <button type="submit" class="dropdown-item del-btn">削除</button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                                <div class="mr-3 d-flex align-items-center">
                                    <a href="{{ url('tweets/' .$timeline->id) }}"><i class="far fa-comment fa-fw"></i></a>
                                    <p class="mb-0 text-secondary">{{ count($timeline->comments) }}</p>
                                </div>
                                <div class="d-flex align-items-center">
                                    <button type="" class="btn p-0 border-0 text-primary"><i class="far fa-heart fa-fw"></i></button>
                                    <p class="mb-0 text-secondary">{{ count($timeline->favorites) }}</p>
                                </div>
                            </div>
                        </div>
                @endforeach
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection
