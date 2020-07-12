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
@section('script')
<script type="text/javascript" src="{{asset('js/easy_notify.js')}}"></script>   
<script type="text/javascript" src="{{asset('js/notification.js')}}"></script>   

@endsection