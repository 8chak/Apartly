 <div  class="our_room">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="titlepage">
               <h2>Our Room</h2>
               <p>Lorem Ipsum available, but the majority have suffered </p>
            </div>
         </div>
      </div>
      <div class="row">
         @foreach($rooms as $room)
            <div class="col-md-4 col-sm-6">
               <div id="serv_hover"  class="room">
                  <div class="room_img">
                     <figure><img src="{{ asset('storage/'.$room->image) }}" alt="{{ $room->title }}" style="weidth: 350px; height: 200px; object-fit: cover;"/></figure>
                  </div>
                  <div class="bed_room">
                     <h3>{{ $room->title }}</h3>
                     <p>{{ Str::limit($room->description, 50) }}</p>
                     <a href="{{ route('room_details', $room->id) }}" class="btn btn-primary btn-sm mt-2">View</a>
                  </div>
               </div>
            </div>
         @endforeach
      </div>
      <div class="text-center">
         <a href="{{ route('all_rooms') }}" class="btn btn-primary">show more</a>
      </div>
   </div>
</div>