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
  <h1>ログインフォーム</h1>
  <!-- バリデーション&認証エラーメッセージの追加 -->
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

  <form action="/auth/login" method="post">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="login_email">メールアドレス</label>
      <input class="form-control" type="text" name="email" value="{{ old('email') }}" id="login_email">
    </div>  
    <div class="form-group">
      <label for="login_password">パスワード</label>
      <input class="form-control" type="password" name="password" value="" id="login_password">
    </div>
    <div class="actions">
      <input type="submit" name="action" value="ログイン" class="btn btn-primary" data-disable-with="ログイン">
    </div>
  </form>
  </body>
  </html>
@endsection