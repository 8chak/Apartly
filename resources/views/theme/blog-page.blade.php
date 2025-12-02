@extends('theme.layout')
@section('content')
<div class="back_re">
<div class="container">
<div class="row">
    <div class="col-md-12">
        <div class="title">
            <h2>Blog</h2>
        </div>
    </div>
</div>
</div>
</div>
<!-- blog -->
<div  class="blog">
<div class="container">
<div class="row">
    <div class="col-md-12">
        <div class="titlepage">
        
            <p class="margin_0">Lorem Ipsum available, but the majority have suffered </p>
        </div>
    </div>
</div>
<div class="row">
    @foreach($blogs as $blog)
    <div class="col-md-4">
        <a href="{{ route('view_post', $blog->id) }}">
        <div class="blog_box">
            <div class="blog_img">
            <figure><img src="images/blog1.jpg" alt="#"/></figure>
            </div>
            <div class="blog_room">
            <h3>{{ Str::limit($blog->title, 20, '') }}</h3>
            <span>{{ Str::limit($blog->excerpt, 35, '') }}</span>
            <p>{{ Str::limit($blog->content, 100) }}</p>
        </div>
        </div></a>
    </div>
    @endforeach
   
    
</div>
</div>
</div>
<!-- end blog -->
@endsection
     