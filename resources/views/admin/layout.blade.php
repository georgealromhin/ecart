<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" type="image/ico" href="{{url('favicon.ico') }}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/style.css') }}">
    <link rel="stylesheet" href="{{asset('css/sidebar.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style rel="stylesheet">
        body{padding-top: 56px;}
    </style>
    @section('style')
        
        
    @show
    
</head>
<body class="bg-pattern">
<div id="app">
    @section('content')
        
        
    @show
</div>
   


 
    {{-- <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script> --}}
    {{-- <script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script> --}}
    {{-- <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script> --}}
    <script type="text/javascript" src="{{asset('js/sweetalert2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/fontawesome_all.js')}}"></script>   
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>   
</body>
</html>
<script  type="text/javascript">
$("#menu-toggle").click(function(a){a.preventDefault(),$("#wrapper").toggleClass("toggled")});
</script>
@section('script')
        
        
@show