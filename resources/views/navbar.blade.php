<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
    <a class="navbar-brand" href="{{url('/')}}"> {{config('app.name')}} </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="{{url('/')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('contact')}}">Contact</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('about')}}">About</a>
          </li>
      </ul>
      <a href="{{url('cart')}}" class="btn shadow my-2 my-sm-0 btn-danger text-shadow" id="cart-btn" style="font-size: 14px;"><i class="fas fa-shopping-cart"></i> Cart: $ <span id="cart-total" class="subtotal mt-2 mr-2"></span></a>
    </div>
  </nav>