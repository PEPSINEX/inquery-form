@extends('layouts.app')

@section('title', 'Page Title')

<nav class="navbar navbar-dark bg-primary mb-2">
  <span class="navbar-brand mb-0 h1">RapidResponder</span>
</nav>

@section('sidebar')
    <!-- <p>ここはメインのサイドバーに追加される</p> -->
@endsection

@section('content')
  <h1>お問い合わせ</h1>

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

  <form action="/inquiries" method="post">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="inquiry_name">名前</label>
      <input class="form-control" type="text" value="" name="name" id="inquiry_name" />
    </div>
    <div class="form-group">
      <label for="inquiry_email">メールアドレス</label>
      <input class="form-control" type="email" value="" name="email" id="inquiry_email" />
    </div>
    <div class="form-group">
      <label for="inquiry_phone_number">電話番号</label>
      <input class="form-control" type="tel" name="phone_number" id="inquiry_phone_number" />
    </div>
    <div class="form-group">
      <label for="inquiry_product_type">製品番号</label>
      <select class="form-control" name="product_type" id="answer_product_type">
        @foreach ($PRODUCT_TYPES as $PRODUCT_TYPE)
          <option value={{ $PRODUCT_TYPE }}>{{ $PRODUCT_TYPE }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="inquiry_content">お問い合わせ内容</label>
      <textarea class="form-control" cols="40" rows="4" name="content" id="inquiry_content"></textarea>
    </div>
    <div class="actions">
      <input type="submit" name="commit" value="登録する" class="btn btn-primary" data-disable-with="登録する" />
    </div>
  </form>
@endsection
