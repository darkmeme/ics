<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Digital</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
  <style media="screen">
    .logo { padding: 5px; margin: 30px; border: 0px solid black; float: right; width: 100px; }
    .logo2 { position:relative; top: 50px; left: 15px; float: left; width: 450px; }
    body {
  background-color: white;
     }
  </style>
<div class="row">
<img class="logo" src="images/logo.png" id="logo">
</div>
    <div id="app">

        @yield('content')
    </div>


    <div class="img-fluid row">
      <img class="logo2" src="images/1.jpg">
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
