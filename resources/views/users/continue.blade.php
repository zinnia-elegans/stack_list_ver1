@extends('layouts.app')

@section('content')
    <body>
        <div class="container w-25">
            <div class="card">
                <h2 class="m-4 text-center">積み上げ日数</h2>
                    <form action="{{ url('/users/admin') }}" method="post">
                        <div class="card-body border m-3">
                        <h6><input type="radio" class="m-3" name="continue" value="できてる">開始日から計算して継続日数を登録</h6>
                            <p>今日までの連続継続日数を登録してください。</p>
                            @csrf
                            <div class="form-group m-3 text-center">
                                <input id="year" type="text" name="y" size="6" maxlength="4" value="2020"/> 年 
                                <input id="month" type="text" name="m" size="4" maxlength="2" value="{{ old('m') }}" placeholder="yy"/> 月 
                                <input id="date" type="text" name="d" size="4" maxlength="2" placeholder="dd"/> 日
                            </div>
                        </div>
                    </form>
                    <div class="card-body border m-3">
                        <h6><input type="radio" class="m-3">手動で積み上げ日数を登録<br></h6>
                        <p>これまで積み上げた日数を登録してください。</p>
                        <div class="text-center">
                            <h4><input type="text" size="8" maxlength="2" class="m-3 text-center">日</h4>
                        </div>
                    </div>
                    <div class="m-3 text-center">
                        <button id="calcButton" class="btn btn-primary" type="submit" name="regist" >登録</button>
                        <input id="resetButton" class="btn btn-primary" type="reset" name="reset" value="リセット" />
                    </div>
                </form>
            </div>
        </div>
    </body>
@endsection