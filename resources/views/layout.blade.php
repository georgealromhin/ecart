<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="{{$settings[13]->value }}">
    <meta property="og:title" content="{{$settings[12]->value }}"/>
    <meta property="og:description" content="{{$settings[13]->value }}"/>
    <meta property="og:image" content="{{url('favicon.ico')}}"/>
    <meta name="language" content="en" />
    <link rel="apple-touch-icon" href="{{url('favicon.ico')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{url('favicon.ico')}}">
    <meta name="theme-color" content="#ffffff">
    <link rel="icon" type="image/ico" href="{{url('favicon.ico') }}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/style-all.css') }}">
    @section('header')
        
        
    @show
    
</head>
<body>
    @include('navbar')
    <div id="app">
        <div class="container mb-5">
            
       
        @section('content')


        @show
    </div>
    </div>
    <div class="btn-back-to-top bg0-hov" id="back_to_top">
        <span class="symbol-btn-back-to-top">
          <i class="fas fa-angle-double-up"></i>
        </span>
      </div>
    
   @include('footer')
    <script type="text/javascript" src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/fontawesome_all.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
    
 </body>
</html>
@section('script')
        
        
@show