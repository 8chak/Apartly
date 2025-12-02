@extends('theme.layout')
@section('content')
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <article class="bg-white shadow-sm rounded overflow-hidden">
        
        <!-- Featured Image -->
        <img src="{{ asset('storage/'.$blog->image) }}" 
             class="img-fluid w-100" 
             alt="Luxury hotel suite" 
             style="max-height: 500px; object-fit: cover;">
        <!-- <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=1200" "> -->
        
        <!-- Post Content -->
        <div class="p-4 p-md-5">
          
          <!-- Meta Info -->
          <div class="d-flex flex-wrap gap-3 text-muted small mb-3">
            <span><i class="bi bi-person"></i>{{ $blog->author }}</span>
            <span><i class="bi bi-calendar ml-2"></i> {{ $blog->created_at->format('F d, Y') }}</span>
            <span><i class="bi bi-chat ml-2"></i> 12 Comments</span>
          </div>
          
          <!-- Title -->
          <h1 class="display-5 fw-bold mb-4">{{ $blog->title }}</h1>
          
          <!-- Description -->
          <div class="lead text-muted mb-4">
            <p>{{ $blog->content }}</p>
          </div>
          
          <!-- Comment Section -->
          <div class="mt-5 pt-4 border-top">
            <h3 class="h4 mb-4">Comments</h3>
            
            <div class="mb-4">
              <div class="d-flex gap-3 mb-3">
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; min-width: 40px;">SM</div>
                <div>
                  <div class="fw-bold">Sarah Mitchell</div>
                  <div class="small text-muted">2 days ago</div>
                  <p class="mb-0 mt-2">This looks absolutely stunning! Can't wait to visit during my next trip to the city.</p>
                </div>
              </div>
            </div>
            
            <div class="mb-4">
              <div class="d-flex gap-3 mb-3">
                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; min-width: 40px;">JC</div>
                <div>
                  <div class="fw-bold">James Chen</div>
                  <div class="small text-muted">5 days ago</div>
                  <p class="mb-0 mt-2">The rooftop terrace is incredible. Stayed here last month and the experience was unforgettable.</p>
                </div>
              </div>
            </div>
            
            <!-- Comment Form -->
            <div class="mt-4">
              <h5>Leave a Comment</h5>
              <form>
                <div class="mb-3">
                  <input type="text" class="form-control" placeholder="Your Name">
                </div>
                <div class="mb-3">
                  <textarea class="form-control" rows="4" placeholder="Your comment..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Post Comment</button>
              </form>
            </div>
          </div>
          
        </div>
      </article>
    </div>
  </div>
</div>
@endsection