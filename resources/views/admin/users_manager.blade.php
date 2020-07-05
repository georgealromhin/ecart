@extends('admin.layout')
@section('title', 'Users Manager')
@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>
@endsection

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