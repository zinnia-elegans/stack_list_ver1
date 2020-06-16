@extends('layouts.app')

@section('content')
            <div class="container my-5">           
                <div class="card">
                    <div class="card-body">
                        <h2 class="my-4 text-muted border-bottom border-primary">このサイトについて</h2>
                        <p class="py-3">ツイッターに「＃今日の積み上げ」と「積み上げ日数」を投稿することができます。</p>

                        <h2 class="my-4 text-muted border-bottom border-primary">使い方</h2>
                        <p class="py-3">まずトップページのログインボタンから、SNS認証を使ってログインします。</p>
                        <p class="py-3">認証ライブラリはTwitterOAuthを使用しています。</p>
                        <p class="py-3">認証後、ユーザーページに飛ぶと、取得したユーザー情報を反映したページが出てきます。</p>
                        <p class="py-3">ツイッターに投稿するボタンを押すと、実際にツイッターに投稿することができます。</p>
                        <img style="width:40%;" src="https://zinnia-elegans.s3.us-east-2.amazonaws.com/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88+2020-06-13+21.30.54.png" alt="twitter投稿">

                        <h3 class="my-3 text-muted border-bottom border-primary">積み上げ日数自動表示</h3>
                        <p class="py-3">「＃今日の積み上げ」ツイートの中から、「〇〇日」の数字を自動取得。</p>
                        <img class="py-3" style="width:40%;" src="https://zinnia-elegans.s3.us-east-2.amazonaws.com/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88+2020-06-13+21.31.23.png" alt="積み上げリスト">
                        <p class="py-3">+1を自動で加算して、「今日の積み上げ」に表示。</p>
                        <img class="py-3" style="width:40%;" src="https://zinnia-elegans.s3.us-east-2.amazonaws.com/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88+2020-06-13+21.40.18.png" alt="積み上げ日数自動算出">
                        <p class="py-3">例えば翌日、同じように「今日の積み上げ」と「積み上げ日数」をツイートしたい場合、加算された値がすでに入力されていますので、<br>
                        「追加」ボタンを押すだけで、値がフォームに入力されます。</p>
                        <p class="py-3">また手動で「積み上げ日数」を入力することもできます。</p>
                        <p class="py-3">「リセット」ボタンを押すと、入力した日数のみ削除されます。 </p>
                        <p></p>
                    </div>
                </div>
            </div>

@endsection