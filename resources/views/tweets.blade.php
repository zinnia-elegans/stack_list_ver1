@extends('layouts.app')

@section('content')
<div class="container-fulid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header p-3 w-100 d-flex">ツイート投稿</div>
                    <div class="card-body"> 
                        <form method="post" action={{ route("login") }}>                         
                            @csrf
                            <div class="form-group row mb-0">
                                <div class="col-md-12 p-3 w-100 d-flex">
                                    <img src="{{ Auth::user()->avatar }}" class="rounded-circle" width="60" height="60">
                                    <div class="mt-3 ml-3 d-flex flex-column">
                                        <a href="https://twitter.com"><h5 class="text-secondary"><strong>{{ Auth::user()->name }}</strong></h5></a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                <textarea class="form-control" name="tweet" required autocomplete="text" rows="4"></textarea>   
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection