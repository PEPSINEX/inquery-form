@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
  @include('layouts.header')
@endsection

@section('content')
  <h1>お問い合わせ確認</h1>

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

  <table class="table table-hover">
    <tbody>
      <tr>
        <th>お名前
        <td>{{$inquiry->name}}
      </tr>
      <tr>
        <th>メールアドレス
        <td>{{$inquiry->email}}
      </tr>
      <tr>
        <th>電話番号
        <td>{{$inquiry->phone_number}}
      </tr>
      <tr>
        <th>製品番号
        <td>{{$inquiry->product_type}}
      </tr>
      <tr>
        <th>お問い合わせ内容
        <td>{{$inquiry->content}}
      </tr>
    </tbody>
  </table>

  <h1>対応メール入力フォーム</h1>

  <form action="/answers" method="post">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="answer_content">メール本文</label>
      <textarea class="form-control" cols="40" rows="4" name="content" id="answer_content"></textarea>
    </div>
    <input type="hidden" name="inquiry_id" value="{{ $inquiry->id }}">
    <div class="actions">
      <input type="submit" name="commit" value="メール送信" class="btn btn-primary" data-disable-with="メール送信" />
    </div>
  </form>
@endsection
