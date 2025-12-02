<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- site metas -->
      <title>{{ config('app.name', 'Laravel') }}</title>
      <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
       @stack('styles')
      <!-- bootstrap css -->
      <link rel="stylesheet" href="{{ asset('css') }}/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="{{ asset('css') }}/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="{{ asset('css') }}/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="{{ asset('images') }}/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="{{ asset('css') }}/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
   </head>
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="{{asset('images')}}/loading.gif" alt="#"/></div>
      </div>
      <!-- end loader -->
      <!-- header -->
      @include('theme.navbar')
      <div class="relative" style="position: relative;">
         @if (session('success'))
         <div class="alert alert-success alert-dismissible fade show mt-3 w-50 m-4 transparent"
         style="position: absolute; top: 20px; right: 20px; width: 50%; z-index: 1050;" role="alert">
            <button type="button" class="close" data-bs-dismiss="alert">x</button>
            {{ session('success') }}
         </div>
         @elseif(session('error'))
         <div class="alert alert-danger alert-dismissible fade show mt-3 w-50 m-4 transparent"
         style="position: absolute; top: 20px; right: 20px; width: 50%; z-index: 1050;" role="alert">
            <button type="button" class="close" data-bs-dismiss="alert">x</button>
            {{ session('error') }}
         </div>
         @endif
      </div>
      @yield('content')
      <!-- end header inner -->
      <!-- end header -->
      <!-- banner -->
      
      <!-- end banner -->
      <!-- about -->
     
      <!-- end about -->
      <!-- our_room -->
      
      <!-- end our_room -->
      <!-- gallery -->
      
      <!-- end gallery -->
      <!-- blog -->
      
      <!-- end blog -->
      <!--  contact -->
      
      <!-- end contact -->
      <!--  footer -->
      <footer>
         <div class="footer">
            <div class="container">
               <div class="row">
                  <div class=" col-md-4">
                     <h3>Contact US</h3>
                     <ul class="conta">
                        <li><i class="fa fa-map-marker" aria-hidden="true"></i> Address</li>
                        <li><i class="fa fa-mobile" aria-hidden="true"></i> +01 1234569540</li>
                        <li> <i class="fa fa-envelope" aria-hidden="true"></i><a href="#"> demo@gmail.com</a></li>
                     </ul>
                  </div>
                  <div class="col-md-4">
                     <h3>Menu Link</h3>
                     <ul class="link_menu">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="about.html"> about</a></li>
                        <li><a href="room.html">Our Room</a></li>
                        <li><a href="gallery.html">Gallery</a></li>
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                     </ul>
                  </div>
                  <div class="col-md-4">
                     <h3>News letter</h3>
                     <form class="bottom_form">
                        <input class="enter" placeholder="Enter your email" type="text" name="Enter your email">
                        <button class="sub_btn">subscribe</button>
                     </form>
                     <ul class="social_icon">
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="copyright">
               <div class="container">
                  <div class="row">
                     <div class="col-md-10 offset-md-1">
                        
                        <p>
                        © 2019 All Rights Reserved. Design by <a href="https://themewagon.com/" target="_blank"> DEV8CHAK</a>
                        </p>

                     </div>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!-- end footer -->
      <!-- Javascript files-->
      <script src="{{asset('js')}}/jquery.min.js"></script>
      <script src="{{asset('js')}}/bootstrap.bundle.min.js"></script>
      <script src="{{asset('js')}}/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="{{asset('js')}}/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="{{asset('js')}}/custom.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.8/js/bootstrap.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
      @stack('scripts')
   </body>
</html>