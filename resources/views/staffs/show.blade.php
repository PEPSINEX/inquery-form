@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
  @include('layouts.header')
@endsection

@section('content')
  <h1>{{trans('db.models.inquiry')}}詳細</h1>

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

  <div style="display:inline-flex">
    @if ($inquiry->status !== '未対応')
      <form action="{{ route('inquiries.update', ['id' => $inquiry->id]) }}" method="post">
        {{ csrf_field() }}
        @method('PATCH')
        <input type="hidden" name="status" value="00">
        <input type="submit" value="未対応に戻す" class="btn btn-default">
      </form>
    @endif

    @if ($inquiry->status !== '対応中')
      <form action="{{ route('inquiries.update', ['id' => $inquiry->id]) }}" method="post">
        {{ csrf_field() }}
        @method('PATCH')
        <input type="hidden" name="status" value="10">
        <input type="submit" value="対応開始" class="btn btn-default">
      </form>
    @endif

    @if ($inquiry->status !== '対応済')
      <form action="{{ route('inquiries.update', ['id' => $inquiry->id]) }}" method="post">
        {{ csrf_field() }}
        @method('PATCH')
        <input type="hidden" name="status" value="20">
        <input type="submit" value="完了" class="btn btn-default">
      </form>
    @endif
  </div>

  <table class="table table-hover">
    <tbody>
      <tr>
        <th class="text-nowrap">{{ trans('db.inquiry.created_at') }}
        <td>{{ $inquiry->created_at }}
      </tr>
      <tr>
        <th class="text-nowrap">{{ trans('db.inquiry.status') }}
        <td>{{ $inquiry->status }}
      </tr>
      <tr>
        <th class="text-nowrap">{{ trans('db.inquiry.staff') }}
        <td>{{ $inquiry->staff ? $inquiry->staff->name : '' }}
      </tr>
      <tr>
        <th class="text-nowrap">{{ trans('db.inquiry.updated_at') }}
        <td>{{ $inquiry->updated_at }}
      </tr>
      <tr>
        <th class="text-nowrap">{{ trans('db.inquiry.name') }}
        <td>{{ $inquiry->name }}
      </tr>
      <tr>
        <th class="text-nowrap">{{ trans('db.inquiry.email') }}
        <td>{{ $inquiry->email }}
      </tr>
      <tr>
        <th class="text-nowrap">{{ trans('db.inquiry.phone_number') }}
        <td>{{ $inquiry->phone_number }}
      </tr>
      <tr>
        <th class="text-nowrap">{{ trans('db.inquiry.product_type') }}
        <td>{{ $inquiry->product_type }}
      </tr>
      <tr>
        <th class="text-nowrap">{{ trans('db.inquiry.content') }}
        <td>{{ $inquiry->content }}
      </tr>
    </tbody>
  </table>

  <h1>{{trans('db.models.answer')}}一覧</h1>

  <table class="table table-hover">
    <thead>
      <tr>
        <th>{{ trans('db.answer.created_at') }}</th>
        <th>{{ trans('db.answer.content') }}</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($answers as $answer)
        <tr>
          <td>{{ $answer->created_at }}</td>
          <td>{{!! nl2br(e( $answer->content )) !!}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <h1>{{trans('db.models.comment')}}一覧</h1>

  <table class="table table-hover">
    <thead>
      <tr>
        <th>{{ trans('db.comment.created_at') }}</th>
        <th>{{ trans('db.comment.content') }}</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($comments as $comment)
        <tr>
          <td>{{ $comment->created_at }}</td>
          <td>{{!! nl2br(e( $comment->content )) !!}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <h1>{{trans('db.models.answer')}}入力フォーム</h1>

  <form action="{{ route('inquiries.reply', ['id' => $inquiry->id]) }}" method="post">
    {{ csrf_field() }}
    @method('PATCH')
    <div class="form-group">
      <label for="inquiry_reply">{{ trans('db.answer.content') }}</label>
      <textarea class="form-control" cols="40" rows="4" name="inquiries[reply]" id="inquiry_reply"></textarea>
    </div>
    <div class="actions">
      <input type="submit" name="commit" value="メール送信" class="btn btn-primary" />
    </div>
  </form>

  <h1>{{trans('db.models.comment')}}入力フォーム</h1>

  <form action="{{ route('inquiries.comment', ['id' => $inquiry->id]) }}" method="post">
    {{ csrf_field() }}
    @method('PATCH')
    <div class="form-group">
      <label for="inquiry_comment">{{ trans('db.comment.content') }}</label>
      <textarea class="form-control" cols="40" rows="4" name="inquiries[comment]" id="inquiry_comment"></textarea>
    </div>
    <div class="actions">
      <input type="submit" name="commit" value="コメントを残す" class="btn btn-primary" />
    </div>
  </form>

@endsection
