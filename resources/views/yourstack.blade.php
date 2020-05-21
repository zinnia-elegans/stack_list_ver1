@extends('layouts.app')

@section('content')
<div class="container-fulid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    <div class="card-body"> 
                        <div class="mt-5">
                        <h5 class="mt-7 text-center"><strong>#最近のあなたの積み上げ</strong></h5>
                            @foreach ($statuses as $tweet)
                            @if(preg_match("/今日の積み上げ/",$tweet->text)==1)
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <div class="media">
                                            <img src="{{ Auth::user()->avatar }}" class="rounded-circle mr-4">
                                            <div class="media-body">
                                                <a href="https://twitter.com"><h5 class="d-inline mr-3"><strong>{{ Auth::user()->name }}</strong></h5></a>
                                                <h6 class="d-inline text-secondary">{{ date('Y/m/d', strtotime(Auth::user()->created_at)) }}</h6>
                                                <p class="mt-3 mb-0">{{ $tweet->text }}</p>
                                            </div>
                                        </div>
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
    </div>
</div>
@endsection