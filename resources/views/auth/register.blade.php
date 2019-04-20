@extends('layouts.app')

@section('title', 'Page Title')

@section('header')
    @include('layouts.header')
@endsection

@section('sidebar')
    <!-- <p>ここはメインのサイドバーに追加される</p> -->
@endsection

@section('content')
  <h1>ユーザー登録フォーム</h1>

  <!-- バリデーションエラーメッセージの追加 -->
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

  <form action="/auth/register" method="post">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="staff_name">名前</label>
      <input class="form-control" type="text" value="" name="name" id="staff_name" />
    </div>
    <div class="form-group">
      <label for="staff_email">メールアドレス</label>
      <input class="form-control" type="email" value="" name="email" id="staff_email" />
    </div>
    <div class="actions">
      <input type="submit" name="commit" value="登録する" class="btn btn-primary" data-disable-with="登録する" />
    </div>
  </form>
@endsection
