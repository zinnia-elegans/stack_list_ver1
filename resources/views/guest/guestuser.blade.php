@extends('layouts.app')

@section('content')

    <div class="container">
      <div class="row">
        <div class="col-md-4">
          {{-- 左カラム --}}
          <div class="card mt-1">
            <div class="view overlay">
              <img class="card-img-top" src="" alt="Card image cap">
              <div class="mask rgba-white-slight"></div>
            </div>
            <div class="card-body">
              <div class="card-body d-block border shadow">
                <img src="" class="rounded-circle shadow-lg border-light d-block mx-auto m-3"  width="60" height="60">
                <p class="card-title text-center"><strong>{{ Auth::user()->name }}</strong></p>
                <p class="card-text text-center m-5">{{ Auth::user()->description }}自己紹介文が入る</p>
                <a href="{{ url('users/allusers') }}" class="btn btn-primary m-3 d-block">フォロワー管理</a>
              </div>
              <p class="card-text d-block text-center m-4" id="returnDate">継続日数が入る</p>
              <h5 class="text-center pt-3"><strong>#前回の積み上げ</strong></h5>
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
                      <div class="text-right m-3">
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
