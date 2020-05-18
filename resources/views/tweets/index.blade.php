@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header p-3 w-100 d-flex">ツイート投稿</div>
                    <div class="card-body"> 
                        
                        <form method="POST" action="tweets">                         
                            @csrf
                            
                            <div class="form-group row mb-0">
                                <div class="col-md-12 p-3 w-100 d-flex">
                                    <img src="{{ Auth::user()->avatar }}" class="rounded-circle" width="60" height="60">
                                    <div class="mt-3 ml-3 d-flex flex-column">
                                        <a href="https://twitter.com"><h5 class="text-secondary"><strong>{{ Auth::user()->name }}</strong></h5></a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <textarea class="form-control @error('text') is-invalid @enderror" name="tweet" placeholder="＃今日の積み上げをツイートしよう！" required autocomplete="text" rows="4"></textarea>
                                    
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
                                    <button class="btn btn-primary">ツイートする</button>
                                </div>
                            </div>
                        </form>
                        <div class="mt-5">
                        <h5 class="mt-7 text-center"><strong>#あなたの積み上げ</strong></h5>
                            @foreach ($statuses->statuses as $tweet)
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <div class="media">
                                            <img src="{{ Auth::user()->avatar }}" class="rounded-circle mr-4">
                                            <div class="media-body">
                                                <a href="https://twitter.com"><h5 class="d-inline mr-3"><strong>{{ Auth::user()->name }}</strong></h5></a>
                                                <h6 class="d-inline text-secondary">{{ date('Y/m/d', strtotime($tweet->created_at)) }}</h6>
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
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection