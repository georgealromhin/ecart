<div class="bg-primary sticky-top" id="sidebar-wrapper" role="tablist">

    <div class="list-group list-group-flush">

    <a class="list-group-item list-group-item-action bg-primary text-light @if(Request::url() === url('/dashboard')) bg-active @endif " href="{{url('/dashboard')}}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>

        <a class="list-group-item list-group-item-action bg-primary text-light @if(Request::url() === url('/orders')) bg-active @endif " href="{{url('/orders')}}"><i class="fas fa-inbox"></i> Orders</a>

        <a class="list-group-item list-group-item-action bg-primary text-light @if(Request::url() === url('/categories')) bg-active @endif " href="{{url('/categories')}}">  <i class="fas fa-tags"></i> Categories</a>

        <a class="list-group-item list-group-item-action bg-primary text-light @if(Request::url() === url('/items')) bg-active @endif " href="{{url('/items')}}"><i class="fas fa-archive"></i> Products</a>

        <a class="list-group-item list-group-item-action bg-primary text-light @if(Request::url() === url('/shop_info')) bg-active @endif " href="{{url('/shop_info')}}"><i class="fas fa-info-circle"></i> Shop info</a>
        
    </div>

  </div>

