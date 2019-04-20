@extends('layouts.app')

@section('title', 'Page Title')

@section('script')
  <script>
    $(function(){
      $(".btn-dell").click(function(){
        if(confirm("本当に削除しますか？")){
          //そのままsubmit（削除）
        }else{
          //cancel
        return false;
        }
      });
    });
  </script>
@endsection

@section('sidebar')
    <!-- <p>ここはメインのサイドバーに追加される</p> -->
@endsection

@section('content')
  <h1>スタッフ一覧</h1>

  <table class="table table-striped">
    <thead>
        <tr>
          <th>名前
          <th>メールアドレス
          <th>問い合わせ対応中の件数
          <th>問い合わせ対応済の件数
          <th>
        </tr>
      <tbody>
        @foreach ($staffs as $staff)
          <tr>
            <td>{{$staff->name}}
            <td>{{$staff->email}}
            <td>
            <td>
            <td>
              <form action="/staffs/{{$staff->id}}" method="POST">
                {{ csrf_field() }}
                {{ method_field('delete') }}
                <input type="submit" value="削除" class="btn btn-danger btn-dell">
              </form>
          </tr>
        @endforeach
      </tbody>
    </tbody>
  </table>
@endsection
