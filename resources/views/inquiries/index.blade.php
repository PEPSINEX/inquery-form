@extends('layouts.app')

@section('title', 'Page Title')

@section('header')
    @include('layouts.header')
@endsection

@section('sidebar')
    <!-- <p>ここはメインのサイドバーに追加される</p> -->
@endsection

@section('content')
  <h1>お問い合わせ一覧</h1>

  <table class="table table-striped">
    <thead>
        <tr>
          <th>
          <th>名前
          <th>製品番号
          <th>内容
          <th>状態
          <th>担当者
          <th>
        </tr>
      <tbody>
        @foreach ($inquiries as $inquiry)
          <tr>
            <td><a href="{{ url('inquiries/'.$inquiry->id) }}">詳細</a>
            <td>{{$inquiry->name}}
            <td>{{$inquiry->product_type}}
            <td>{{$inquiry->content}}
            <td>
              @switch($inquiry->status)
                @case(00)
                  未対応
                  @break
                @case(10)
                  対応中
                  @break
                @case(20)
                  対応済
                  @break
              @endswitch 
            <td>{{$inquiry->staff ? $inquiry->staff->name : ''}}
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
@endsection
