<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>【カラータイプを知ろう】アイテムカラー診断</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #9b894d;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
                background-image: url(storage/image/back-top.jpg);
                background-position: center center;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
                background-color: #fff;
                opacity: 0.8;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                padding: 15px;
                background: rgba(0,0,0,.62);
            }

            .title {
                font-size: 60px;
            }

            .links {
                margin-bottom: 10px;
            }

            .links > a {
                color: #9b894d;
                padding: 0 25px;
                font-size: 17px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">


            <div class="content">
                <div class="title m-b-md">
                    アイテムカラー診断
                </div>
                <p>黄み・青みカラーの見分け方がわからない…なんてことはありませんか？</p>
                <p style="margin-bottom: 30px;">服・バッグなどのカラーコードをあなたのパーソナルカラーと比較し、あなたに似合う色選びをお手伝いします。</p>
            @if (Route::has('login'))
                <div class="links">
                    @auth
                        <a href="{{ url('/admin/item') }}">始める</a>
                    @else
                        <a href="{{ route('login') }}">ログイン</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">新規登録</a>
                        @endif
                    @endauth
                </div>
            @endif
            </div>
        </div>
    </body>
</html>
