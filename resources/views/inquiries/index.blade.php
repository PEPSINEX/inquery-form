@extends('layouts.app')

@section('title', 'Page Title')

@section('header')
    @include('layouts.header')
@endsection

@section('sidebar')
    <!-- <p>ここはメインのサイドバーに追加される</p> -->
@endsection

@section('content')
  <h1>{{ trans('db.models.inquiry') }}一覧</h1>

  <div style="display:inline-flex">
    <form action={{ route('inquiries.index') }} method="get">
      <input type="hidden" name="status" value="00">
      <input type="submit" value="未対応のみ表示" class="btn btn-default">
    </form>

    <form action={{ route('inquiries.index') }} method="get">
      <input type="hidden" name="status" value="10">
      <input type="submit" value="対応中のみ表示" class="btn btn-default">
    </form>

    <form action={{ route('inquiries.index') }} method="get">
      <input type="hidden" name="status" value="20">
      <input type="submit" value="完了のみ表示" class="btn btn-default">
    </form>

    <form action={{ route('inquiries.index') }} method="get" name="all">
      <input type="submit" value="全て表示" class="btn btn-default">
    </form>
  </div>

  <table class="table table-striped">
    <thead>
        <tr>
          <th>
          <th class="text-nowrap">{{ trans('db.inquiry.status') }}
          <th class="text-nowrap">{{ trans('db.inquiry.name') }}
          <th class="text-nowrap">{{ trans('db.inquiry.phone_number') }}
          <th class="text-nowrap">{{ trans('db.inquiry.product_type') }}
          <th class="text-nowrap">{{ trans('db.inquiry.content') }}
          <th class="text-nowrap">{{ trans('db.inquiry.created_at') }}
          <th>
        </tr>
      <tbody>
        @foreach ($inquiries as $inquiry)
          <tr class="inquiries">
            <td><a href="{{ url('inquiries/'.$inquiry->id) }}">詳細</a>
            <td class="{{ $inquiry->status }}">{{ $inquiry->status }}
            <td class="text-nowrap">{{ $inquiry->name }}
            <td class="text-nowrap " >{{ $inquiry->phone_number }}
            <td class="text-nowrap">{{ $inquiry->product_type }}
            <td>{{ $inquiry->mbSubstrContent(100) }}
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

  {{ $inquiries->appends(Request::only('status'))->links() }}

  <span>ここに検索機能を追加したい</span>
  <form action="inquiries" method="get">
    <div class="form-group">
      <input type="text" name="product_type" value="" class="form-control" placeholder="検索したい文字列を入力してください">
    </div>
    <input type="submit" value="検索" class="btn btn-info">
  </form>
@endsection
