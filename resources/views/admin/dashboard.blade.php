@extends('admin.index')
@section('content')
    <div class="page-header">
        <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Dashboard</h2>
        </div>
    </div>
    @include('admin.cards')
    @include('admin.charts')
    @include('admin.line-charts')
    @include('admin.contributions')
    @include('admin.sales-agents')
    @include('admin.todos')
    @include('admin.credits')

@endsection