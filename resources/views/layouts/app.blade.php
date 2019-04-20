<html>
    <head>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <title>Rapid Responder - @yield('title')</title>
    </head>
    <body>
      <!-- jqueryの読み込み -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <!-- BootstrapのJS読み込み -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
      <!-- css -->
      <link rel="stylesheet" href="{{ asset('/resources/sass/app.scss') }}">
        @section('header')
            <!-- ここがメインのサイドバー -->
        @show

        @section('sidebar')
            <!-- ここがメインのサイドバー -->
        @show

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>