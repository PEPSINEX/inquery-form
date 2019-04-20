@extends('layouts.app')

@section('title', 'Page Title')

@section('header')
    @include('layouts.header')
@endsection

@section('sidebar')
    <!-- <p>ここはメインのサイドバーに追加される</p> -->
@endsection

@section('content')
<html>
  <head>
    <meta charset='utf-8'>
  </head>
  <body>
  <h1>トップ画面</h1>
  @if (Auth::check())
    {{ \Auth::user()->name }}さん<br>
    <a href="/auth/logout">ログアウト</a>
  @else
    ゲストさん<br>
    <a href="/auth/login">ログイン</a><br>
  @endif
  </body>
</html>
@endsection