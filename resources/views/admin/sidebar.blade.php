 <nav id="sidebar">
        <!-- Sidebar Navidation Menus-->
        <ul class="list-unstyled">
                <li class="{{ str_contains(request()->url(), 'home') ? 'active' : '' }}">
                  <a href="/home"> <i class="icon-home"></i>Dashboard </a>
                </li>
                <li class="{{str_contains(request()->url(), 'bookings') ? 'active' : '' }}">
                  <a href="{{ route('bookingsList') }}"> <i class="icon-grid"></i>Bookings </a>
                </li>
                <!-- <li><a href="charts.html"> <i class="fa fa-bar-chart"></i>Charts </a></li> -->
                <!-- <li><a href="forms.html"> <i class="icon-padnote"></i>Forms </a></li> -->
                <li class="{{str_contains(request()->url(), 'room') ? 'active' : '' }}">
                  <a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Manage</a>
                  <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li><a href="{{ route('addRoom') }}">Create Room</a></li>
                    <li><a href="{{ route('roomsIndex') }}">Our Rooms</a></li>
                    <li><a href="{{ route('hotel_gallery') }}">Gallary</a></li>
                  </ul>
                </li>
                <!-- <li><a href="login.html"> <i class="icon-logout"></i>Login page </a></li> -->
        </ul>
        <!-- <span class="heading">Extras</span> -->
        <ul class="list-unstyled">
          <li> <a href="{{ route('create_post') }}"> <i class="icon-settings"></i>Add Post </a></li>
          <li> <a href="{{ route('admin.posts.index') }}"> <i class="icon-writing-whiteboard"></i>View Posts </a></li>
          <li> <a href="{{ url('admin/messages') }}"> <i class="icon-chart"></i>Messages </a></li>
        </ul>
        <!-- Sidebar Header-->
        <!-- <span class="heading">Main</span> -->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="{{ Auth::user()?->image_url ?? asset('template/img/avatar-me.jpg')}}" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5">{{ Auth::user()->name }}</h1>
            <p>{{ Auth::user()->email }}</p>
          </div>
        </div>
      </nav>