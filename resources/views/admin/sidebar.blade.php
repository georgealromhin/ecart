<div class="bg-primary sticky-top" id="sidebar-wrapper" role="tablist">

    <div class="list-group list-group-flush">

    <a class="list-group-item list-group-item-action bg-primary text-light @if(Request::url() === url('/dashboard')) bg-active @endif " href="{{url('/dashboard')}}"><i class="fas fa-tachometer-alt"></i> {{__('auth.dashboard')}}</a>

        <a class="list-group-item list-group-item-action bg-primary text-light @if(Request::url() === url('/orders')) bg-active @endif " href="{{url('/orders')}}"><i class="fas fa-list-alt"></i> {{__('auth.orders')}}</a>

        <a class="list-group-item list-group-item-action bg-primary text-light @if(Request::url() === url('/categories')) bg-active @endif " href="{{url('/categories')}}">  <i class="fas fa-tags"></i> {{__('auth.categories')}}</a>

        <a class="list-group-item list-group-item-action bg-primary text-light @if(Request::url() === url('/items')) bg-active @endif " href="{{url('/items')}}"><i class="fas fa-utensils"></i> {{__('auth.menu_items')}}</a>

        <a class="list-group-item list-group-item-action bg-primary text-light @if(Request::url() === url('/delivery_areas')) bg-active @endif " href="{{url('/delivery_areas')}}"><i class="fas fa-motorcycle"></i> {{__('auth.delivery_areas')}}</a>

          <a class="list-group-item list-group-item-action bg-primary text-light @if(Request::url() === url('/payment_methods')) bg-active @endif " href="{{url('/payment_methods')}}"><i class="far fa-credit-card"></i> {{__('auth.payment_method')}}</a>

        <a class="list-group-item list-group-item-action bg-primary text-light @if(Request::url() === url('/shop_info')) bg-active @endif " href="{{url('/shop_info')}}"><i class="fas fa-info-circle"></i> {{__('auth.shop_info')}}</a>
        
        <a class="list-group-item list-group-item-action bg-primary text-light @if(Request::url() === url('/coupons')) bg-active @endif " href="{{url('/coupons')}}"><i class="fas fa-ticket-alt"></i> {{__('auth.coupons')}}</a>

    </div>

  </div>

