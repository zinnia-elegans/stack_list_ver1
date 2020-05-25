@extends('layouts.front')
 
@section('content')
<body>
  <div class="container">
    <div style="margin-top: 30px; text-align: center;"><h3>新規登録完了しました。</h3></div>
      <div class="mx-auto" style="width: 20rem;">
        <a href="{{ url('guest/guestuser') }}" class="btn btn-primary m-3 p-2 d-block">管理画面へ</a>
      </div>
  </div>
</body>
@endsection