<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
{{--        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">--}}

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
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
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
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
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">登陆</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">注册</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Foxymoon <a style="text-decoration:none;" href="/admin"><sup style="font-size:30px;">Admin</sup></a>
                </div>

                <div class="links">
                    <a href="/ddoc">数据库文档</a>
                    <a href="/telescope">接口使用日志</a>
                    <a href="/">七牛云测试</a>
                    <a href="https://laravelacademy.org/">Laravel学院</a>
                    <a href="https://learnku.com/">Laravel社区</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="http://runapi.showdoc.cc/">在线接口测试</a>
                    <a href="/home">OA2.0测试</a>
                </div>
            </div>
        </div>
    </body>
</html>
