@extends('layouts.app')

@section('content')
    <body>
        <div class="card">
            <h2 class="m-4">積み上げ日数</h2>
              <form action="{{ url('/') }}" method="post">
                <div class="card-body border m-3">
                  <input type="radio" class="m-3" name="continue" value="できてる">開始日から計算して継続日数を登録
                    @csrf
                    <div class="form-group m-3">
                        <input id="year" type="text" name="y" size="6" maxlength="4" value="2020"/> 年 
                        <input id="month" type="text" name="m" size="4" maxlength="2" value="{{ old('m') }}" placeholder="yy"/> 月 
                        <input id="date" type="text" name="d" size="4" maxlength="2" placeholder="dd"/> 日
                    </div>
                  </form>
                </div>
                <div class="card-body border m-3">
                  <input type="radio" class="m-3">手動で積み上げ日数を登録<br>
                  <input type="text" size="8" maxlength="2" class="m-3"> 日
                </div>
                  @foreach($stacklistday as $beforeList)
                  <div class="card-body border m-3">
                    <input type="radio" class="m-3" name="continue" value="できてる？">前回、投稿した日数<br>
                    <h4><input class="m-3" type="text" size="4" value="{{ $beforeList }}">日</h4>
                  </div>
                  @endforeach
                <div class="m-3 text-center">
                  <button id="calcButton" class="btn btn-primary" type="submit" name="regist" >追加</button>
                  <input id="resetButton" class="btn btn-primary" type="reset" name="reset" value="リセット" />
                </div>
              </form>
          </div>
    </body>
@endsection