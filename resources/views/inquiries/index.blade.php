@extends('layouts.app')

@section('title', 'Page Title')

@section('header')
    @include('layouts.header')
@endsection

@section('sidebar')
    <!-- <p>ここはメインのサイドバーに追加される</p> -->
@endsection

@section('content')
  <h1>{{trans('eloquent.models.inquiry')}}一覧</h1>

  <div style="display:inline-flex">
    <form action="inquiries" method="get" name="waiting">
      <input type="hidden" name="status" value="00">
      <a href="javascript:waiting.submit()">未対応のみ表示</a>
    </form>
    <span>&ensp;|&ensp;</span>
    <form action="inquiries" method="get" name="working">
      <input type="hidden" name="status" value="10">
      <a href="javascript:working.submit()">対応中のみ表示</a>
    </form>
    <span>&ensp;|&ensp;</span>
    <form action="inquiries" method="get" name="completed">
      <input type="hidden" name="status" value="20">
      <a href="javascript:completed.submit()">完了のみ表示</a>
    </form>
    <span>&ensp;|&ensp;</span>
    <form action="inquiries" method="get" name="all">
      <a href="javascript:all.submit()">全て表示</a>
    </form>
  </div>

  <table class="table table-striped">
    <thead>
        <tr>
          <th>
          <th class="text-nowrap">{{ trans('eloquent.columns.inquiry.status') }}
          <th class="text-nowrap">{{ trans('eloquent.columns.inquiry.name') }}
          <th class="text-nowrap">{{ trans('eloquent.columns.inquiry.phone_number') }}
          <th class="text-nowrap">{{ trans('eloquent.columns.inquiry.product_type') }}
          <th class="text-nowrap">{{ trans('eloquent.columns.inquiry.content') }}
          <th class="text-nowrap">{{ trans('eloquent.columns.inquiry.created_at') }}
          <th>
        </tr>
      <tbody>
        @foreach ($inquiries as $inquiry)
          <tr>
            <td><a href="{{ url('inquiries/'.$inquiry->id) }}">詳細</a>
            <td>{{ $inquiry->status }}
            <td class="text-nowrap">{{ $inquiry->name }}
            <td class="text-nowrap">{{ $inquiry->phone_number }}
            <td class="text-nowrap">{{ $inquiry->product_type }}
            <td>{{ $inquiry->mbSubstr('content', 100) }}
            <td class="text-nowrap">{{ $inquiry->created_at }}
            <td>
              <form action="/inquiries/{{$inquiry->id}}" method="POST">
                {{ csrf_field() }}
                <input type="submit" value="削除" class="btn btn-danger btn-dell">
              </form>
          </tr>
        @endforeach
      </tbody>
    </tbody>
  </table>

  <span>ここに検索機能を追加したい</span>
  <form action="inquiries" method="get">
    <div class="form-group">
      <input type="text" name="product_type" value="" class="form-control" placeholder="名前を入力してください">
    </div>
    <input type="submit" value="検索" class="btn btn-info">
  </form>
@endsection
