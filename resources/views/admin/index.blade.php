<!DOCTYPE html>
<html>
  <head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{asset('template')}}/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{asset('template')}}/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="{{asset('template')}}/css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{asset('template')}}/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{asset('template')}}/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{asset('template')}}/img/favicon.ico">
    @stack('styles')
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    @include('admin.navbar')
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('admin.sidebar')
        <!-- Sidebar Navigation end-->
        <!-- success message-->
        <div class="page-content">
          @if(session('success'))
        <span class="alert alert-success float-right mt-2" role="alert" style="z-index: 1050;">
          {{ session('success') }}
          <button type="button" class="ml-4 close" data-bs-dismiss="alert">x</button>
        </span>
        @endif
        <!-- Success message end-->
        @yield('content')
        
            <footer class="footer">
            <div class="footer__block block no-margin-bottom">
                <div class="container-fluid text-center">
                <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
                <p class="no-margin-bottom">2020 &copy; Dev8. Designer & Developer <a target="_blank" href="https://templateshub.net">Dev8Chak</a>.</p>
                </div>
            </div>
            </footer>
        </div>
    </div>
    <!-- JavaScript files-->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.8/js/bootstrap.min.js"></script>
    <script src="{{asset('template')}}/vendor/jquery/jquery.min.js"></script>
    <script src="{{asset('template')}}/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="{{asset('template')}}/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{asset('template')}}/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="{{asset('template')}}/vendor/chart.js/Chart.min.js"></script>
    <script src="{{asset('template')}}/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="{{asset('template')}}/js/charts-home.js"></script>
    <script src="{{asset('template')}}/js/front.js"></script>
    @stack('scripts')
  </body>
</html>