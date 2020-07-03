@extends('admin.layout')
@section('title', 'Dashboard')


@section('content')
<div class="d-flex" id="wrapper">
    @include('admin.sidebar')

    <div id="page-content-wrapper">
        @include('admin.navbar')
        <div class="container">
            
        </div>
    </div>
</div>
@endsection