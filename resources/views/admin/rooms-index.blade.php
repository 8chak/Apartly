@extends('admin.index')
@section('content')
    @if(session('success'))
    <span class="alert alert-success float-right">{{ session('success') }}</span>
    @endif
    <h1  class="pt-4 pl-4">Our Rooms</h1>
    <div class="table-responsive p-4">
    <table class="table table-dark table-striped table-hover align-middle">
        <thead>
            <th>Image</th>
            <th>Title</th>
            <th>Description</th>
            <th>Room Type</th>
            <th>Rent</th>
            <th>Wifi</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach($rooms as $room)
            <tr>
                <td><img src="{{ asset('storage/' . $room->image) }}"alt="" width="50"></td>
                <td>{{ $room->title }}</td>
                <td>{{ substr($room->description, 0, 50) }}</td>
                <td>{{ $room->type }}</td>
                <td>{{ $room->rent }}</td>
                <td>{{ $room->facility }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('edit_room', $room->id) }}">Edit</a>
                    <form action="{{ route('delete_room', $room->id) }}" method="post" class="d-inline"
                        onsubmit="return confirm('Are you sure you want to delete this room?')">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection