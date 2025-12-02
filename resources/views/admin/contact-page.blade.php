@extends('admin.index')
@section('content')
<div class="col-12 mt-2">
    <div class="block margin-bottom-sm">
    <div class="title"><strong>Messages</strong></div>
    <div class="table-responsive"> 
        <table class="table table-striped">
        <thead>
            <th style="min-width:150px">Name</th>
            <th style="min-width:150px">Phone Number</th>
            <th style="min-width:150px">Email</th>
            <th>Message</th>
        </thead>
        <tbody>
            @foreach($messages as $message)
            <tr>
            <td>{{ $message->name }}</td>
            <td>{{ $message->phone }}</td>
            <td>{{ $message->email }}</td>
            <td>{{ $message->message }}</td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
    </div>
</div>
@endsection