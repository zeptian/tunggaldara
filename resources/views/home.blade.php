<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Boxed Layout</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/color.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>
<body class="blue">
  <div class="content-wraper card" id="main-wraper">
    <div class="row">
      <div class="col-md-3" id="left">
        @if (Auth::check())
          @include('template.user')
        @else
          @include('template.guest')
        @endif
        
      </div>
      <div class="col-md-9" id="right">
        @include('template.nav')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home')}}">HOME</a></li>
              <li class="breadcrumb-item"><a href="#">KASUS</a></li>
              <li class="breadcrumb-item active" aria-current="page">DATA</li>
            </ol>
        </nav>
        <div class="">
            @yield('content')
        </div>
    </div>
  </div>

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('assets/js/demo.js')}}"></script>
</body>
</html>
