@extends('layouts.app')

@section('title', 'Page Title')

<nav class="navbar navbar-dark bg-primary mb-2">
  <span class="navbar-brand mb-0 h1">RapidResponder</span>
</nav>

@section('sidebar')
    <!-- <p>ここはメインのサイドバーに追加される</p> -->
@endsection

@section('content')
  <h1>{{trans('db.models.inquiry')}}</h1>

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
      <label for="inquiry_name">{{ trans('db.inquiry.name') }}</label>
      <input class="form-control" type="text" value="" name="inquiries[name]" id="inquiry_name" />
    </div>
    <div class="form-group">
      <label for="inquiry_email">{{ trans('db.inquiry.email') }}</label>
      <input class="form-control" type="email" value="" name="inquiries[email]" id="inquiry_email" />
    </div>
    <div class="form-group">
      <label for="inquiry_phone_number">{{ trans('db.inquiry.phone_number') }}</label>
      <input class="form-control" type="tel" name="inquiries[phone_number]" id="inquiry_phone_number" />
    </div>
    <div class="form-group">
      <label for="inquiry_product_type">{{ trans('db.inquiry.product_type') }}</label>
      <select class="form-control" name="inquiries[product_type]" id="answer_product_type">
        @foreach ($PRODUCT_TYPES as $PRODUCT_TYPE)
          <option value={{ $PRODUCT_TYPE }}>{{ $PRODUCT_TYPE }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="inquiry_content">{{ trans('db.inquiry.content') }}</label>
      <textarea class="form-control" cols="40" rows="4" name="inquiries[content]" id="inquiry_content"></textarea>
    </div>
    <div class="actions">
      <input type="submit" name="commit" value="送信" class="btn btn-primary" data-disable-with="登録する" />
    </div>
  </form>
@endsection
