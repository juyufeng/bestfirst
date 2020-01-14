@extends('layouts.app')
@section('content')
<div class="container">
    <!-- Vue 默认绑定的根节点 -->
    <div id="app" class="container">
        <passport-clients></passport-clients>
        <passport-authorized-clients></passport-authorized-clients>
        <passport-personal-access-tokens></passport-personal-access-tokens>
    </div>
</div>
@endsection
