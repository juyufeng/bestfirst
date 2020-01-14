@extends('layouts.app')
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
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card-body">

            <div style="font-size: 30px;">
                狂啊科技
                <a style="text-decoration:none;font-size:20px;" href="/admin">
                    Admin
                </a>
            </div>

            <div class="links">
                <a href="/ddoc">数据库文档</a>
                <a href="/telescope">接口使用日志</a>
            </div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="container">
                        <!-- Vue 默认绑定的根节点 -->
                        <div id="app" class="container">
                            <passport-clients></passport-clients>
                            <passport-authorized-clients></passport-authorized-clients>
                            <passport-personal-access-tokens></passport-personal-access-tokens>
                        </div>
                    </div>


       </div>
    </div>
</div>






@endsection
