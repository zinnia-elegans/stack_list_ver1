@extends('layouts.app')

@section('content')

<div class="row m-2">
  <div class="col">
    <div class="card mt-5 mx-auto" style="width: 37.5rem;">
      <div class="view overlay">
        <img class="card-img-top" src="./storage/dog.jpg" alt="Card image cap">
        <a href="#">
        <div class="mask rgba-white-slight"></div>
        </a>
      </div>
      <div class="card-body" style="">
        <img src="{{ Auth::user()->avatar }}" class="rounded-circle d-inline" width="60" height="60">
        <h4 class="card-title d-inline">{{ Auth::user()->name }}</h4>
        <p class="card-text">テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。</p>
        <a href="#" class="btn btn-primary">フォローする</a>
      </div>
    </div>
  </div>
</div>





@endsection
