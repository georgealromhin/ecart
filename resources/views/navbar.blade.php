<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
    <a class="navbar-brand" href="{{url('/')}}"> {{$settings[0]->value}} </a>
    <button class="navbar-toggler" onclick="openNav()" type="button">
      <i class="fas fa-bars"></i>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item @if(Request::url() === url('/')) active @endif ">
          <a class="nav-link" href="{{url('/')}}">Home</a>
        </li>
        <li class="nav-item @if(Request::url() === url('contact')) active @endif ">
          <a class="nav-link" href="{{url('contact')}}">Contact</a>
        </li>
        <li class="nav-item @if(Request::url() === url('about')) active @endif">
            <a class="nav-link" href="{{url('about')}}">About</a>
          </li>
      </ul>
      <a href="{{url('cart')}}" class="btn shadow my-2 my-sm-0 btn-danger text-shadow" id="cart-btn" style="font-size: 14px;"><i class="fas fa-shopping-cart"></i> Cart: <cart-total-component></cart-total-component>  {{config('app.currency')}}</a>
    </div>
</nav>

<div id="main-sidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <a  href="{{url('cart')}}"><i class="fas fa-shopping-cart"></i> Cart</a>
  <a  href="{{url('/')}}"><i class="fas fa-home"></i> Home</a>
  <a  href="{{url('contact')}}"><i class="fas fa-phone-alt"></i> Contact</a>
  <a  href="{{url('about')}}"><i class="fas fa-info-circle"></i> About</a>
</div>