@extends('admin.index')
@section('content')
<div class="col-12 mt-2">
    <div class="block">
    <div class="title"><strong>All Posts</strong></div>
    <div class="table-responsive"> 
        <table class="table table-striped table-hover">
        <thead>
            <th style="min-width: 150px;">#image</th>
            <th style="min-width: 150px;">Post title</th>
            <th>Post body</th>
            <th style="min-width: 150px;">Status</th>
            <th style="width: 150px;"></th>
        </thead>
        <tbody>
            @foreach($blogs as $blog)
            <tr>
                <td><img src="{{ asset('storage/'.$blog->image) }}" alt="" class="" width="100" height="100"></td>
                <td>{{ $blog->title }}</td>
                <td>{{ Str::limit($blog->content, 150) }}</td>
                <td>{{ $blog->status }}</td>
                <td>
                    <a href="{{ route('admin.posts.edit', $blog->id) }}" class="btn btn-primary px-2 py-1">Edit</a>
                    <form action="{{ route('admin.posts.destroy', $blog->id) }}" method="POST" class="" style="display: inline-block">
                        @method('DELETE') @csrf
                        <button type="submit" class="btn btn-danger ml-2 px-2 py-1">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
    </div>
</div>
@endsection 