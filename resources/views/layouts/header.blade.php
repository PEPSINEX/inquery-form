<nav class="navbar navbar-dark bg-primary mb-2">
  <span class="navbar-brand mb-0 h1">RapidResponder</span>
  @if( Auth::check() )
    @if( Auth::user()->is_admin === 1 )
      <span class="navbar-brand mb-0 h1">[管理者用ページ]</span>
      <span class="navbar-brand mb-0 h1">{{ \Auth::user()->name }}さん</span>
      <a class="navbar-brand mb-0 h1" href="/auth/register">スタッフ登録</a>
      <a class="navbar-brand mb-0 h1" href="/staffs">スタッフ一覧</a>
      <a class="navbar-brand mb-0 h1" href="/auth/logout">ログアウト</a>
    @else
      <span class="navbar-brand mb-0 h1">[スタッフ用ページ]</span>
      <span class="navbar-brand mb-0 h1">{{ \Auth::user()->name }}さん</span>
      <a class="navbar-brand mb-0 h1" href="/inquiries">問い合わせ一覧</a>
      <a class="navbar-brand mb-0 h1" href="#">マイページ</a>
      <a class="navbar-brand mb-0 h1" href="/auth/logout">ログアウト</a>
    @endif
  @else
    <a class="navbar-brand mb-0 h1" href="/auth/login">ログイン</a>
  @endif
</nav>
