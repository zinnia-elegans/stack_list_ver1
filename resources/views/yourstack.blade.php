@extends('layouts.app')

@section('content')
<div class="container-fulid">
    <h5 class="mt-7 text-center"><strong>#最近のあなたの積み上げ</strong></h5>
        <div class="card-columns">
        @foreach ($statuses as $tweet)
            <div class="card p-3">
                <blockquote class="blockquote mb-0">
                    @if(preg_match("/今日の積み上げ/",$tweet->text)==1)
                        <div class="card mb-2">
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
                </blockquote>
            </div>
        @endforeach
</div>
@endsection