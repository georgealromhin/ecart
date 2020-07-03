@extends('admin.layout')
@section('title', 'Add New User')


@section('content')

<div class="d-flex" id="wrapper">
    @include('admin.sidebar')

    <div id="page-content-wrapper">
        @include('admin.navbar')
        <div class="container mt-5">
            <div id="app">
                @if (Auth::user()->role == 'main')
                    <users-manager></users-manager>
                @else
                    <h3 class="text-center"> <i class="fas fa-exclamation-triangle"></i> Unauthorized </h3>
                @endif
            </div>
            
        </div>
    </div>
</div>



@endsection