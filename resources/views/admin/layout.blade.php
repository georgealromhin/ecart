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
    <link rel="stylesheet" href="{{asset('css/app.css') }}">

    <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/sweetalert2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/fontawesome_all.js')}}"></script>   
    
</head>
<body class="bg-pattern">
    <div class="container">
        @section('content')
        
        @show
    </div>


 
</body>
</html>