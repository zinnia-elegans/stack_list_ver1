@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row">
        <div class="card mx-auto" style="width: 37.5rem;">
            <div class="card-body">
                <form action="{{ route('guest.signup') }}" method="post" class="form-horizontal" style="margin-top: 50px;">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="InputName">ニックネーム</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" class="form-control" id="InputName" placeholder="氏名">
                    </div>
                </div>
            
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="InputEmail">メールアドレス</label>
                    <div class="col-sm-9">
                        <input type="email" name="email" class="form-control" id="InputEmail" placeholder="メール・アドレス">
                    </div>
                </div>
            
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="InputPassword">パスワード</label>
                    <div class="col-sm-9">
                        <input type="password" name="password" class="form-control" id="InputPassword" placeholder="パスワード">
                    </div>
                </div>
            
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-primary btn-block">新規登録</button>
                    </div>
                </div>
                {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
</div>
@endsection