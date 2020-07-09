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
    <link rel="stylesheet" href="{{asset('css/style-all.css') }}">

    @section('header')
        
        
    @show
    
</head>
<body>
    @include('navbar')
    <div id="app">
        <div class="container mt-5 mb-5">
            
       
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
    <script>
        var t=$(window).height()/2;
    $(window).on("scroll",function(){$(this).scrollTop()>t?$("#back_to_top").css("display","flex"):$("#back_to_top").css("display","none")}),$("#back_to_top").on("click",function(){$("html, body").animate({scrollTop:0},300)})</script>
 </body>
</html>
@section('script')
        
        
@show