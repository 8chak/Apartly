<header>
         <!-- header inner -->
         <div class="header">
            <div class="container">
               <div class="row">
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                     <div class="full">
                        <div class="center-desk">
                           <div class="logo">
                              <a href="/"><img src="{{asset('images')}}/Apartly.png" alt="#" /></a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                     <nav class="navigation navbar navbar-expand-md navbar-dark ">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarsExample04">
                           <ul class="navbar-nav mr-auto">
                              <li class="nav-item active">
                                 <a class="nav-link" href="/">Home</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="#">About</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="{{ route('all_rooms') }}">Our room</a>
                              </li>
                              <!-- <li class="nav-item">
                                 <a class="nav-link" href="gallery.html">Gallery</a>
                              </li> -->
                              <li class="nav-item">
                                 <a class="nav-link" href="{{ route('blog_page') }}">Blog</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="{{ route('contact_page') }}">Contact Us</a>
                              </li>
                              @if (Route::has('login'))
                                 @auth
                                    <li class="nav-item"><form action="{{ route('logout') }}" method="POST">@csrf
                                       <button type="submit" class="btn btn-sm btn-outline-secondary">Log out</button>
                                    </form></li>
                                 @else
                                    <li class="nav-item"><a href="{{ route('login') }}" class="btn btn-sm btn-outline-secondary">Login</a></li>
                                    @if (Route::has('register'))
                                       <li class="nav-item"><a href="{{ route('register') }}" class="ml-2 btn btn-sm btn-outline-secondary">Register</a></li>
                                    @endif
                                 @endauth
                              @endif
                           </ul>
                        </div>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </header>