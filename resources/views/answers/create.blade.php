@extends('layouts.app')

@section('title', 'Page Title')

@section('header')
    @include('layouts.header')
@endsection

@section('sidebar')
    <!-- <p>ここはメインのサイドバーに追加される</p> -->
@endsection

@section('content')
  

  <h1>対応メール入力フォーム</h1>

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

  <form action="/answers" method="post">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="answer_name"></label>
      <input class="form-control" type="text" value="" name="name" id="answer_name" />
    </div>
    <div class="form-group">
      <label for="answer_email">メールアドレス</label>
      <input class="form-control" type="email" value="" name="email" id="answer_email" />
    </div>
    <div class="form-group">
      <label for="answer_phone_number">電話番号</label>
      <input class="form-control" type="tel" name="phone_number" id="answer_phone_number" />
    </div>
    <div class="form-group">
      <label for="answer_product_type">製品番号</label>
      <select class="form-control" name="product_type" id="answer_product_type">
        @foreach ($PRODUCT_TYPES as $PRODUCT_TYPE)
          <option value={{ $PRODUCT_TYPE }}>$PRODUCT_TYPE</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="answer_content">お問い合わせ内容</label>
      <textarea class="form-control" cols="40" rows="4" name="content" id="answer_content"></textarea>
    </div>
    <div class="actions">
      <input type="submit" name="commit" value="登録する" class="btn btn-primary" data-disable-with="登録する" />
    </div>
  </form>

  <h1>お問い合わせ内容/h1>

  <table class="table table-hover">
    <tbody>
      <tr>
        <th>お名前
        <td>{{$inquiry->name}}
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

@endsection
