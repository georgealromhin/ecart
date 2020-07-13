@extends('layout')
@section('title', $settings[12]->value)
@section('content')


<div id="carouselControls" class="carousel slide mt-4 shadow" data-ride="carousel">
    <div class="carousel-inner">

      @foreach ($banners as $banner)
      <div class="carousel-item @if($loop->first) active @endif ">
        <img class="d-block w-100 carousel-img rounded" src="{{url($banner->image)}}" alt="image">
      </div>
      @endforeach

    </div>
    <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>




<div class="toast float-left" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body">
        <i class="fas fa-check-circle text-success"></i> Added to cart
    </div>
  </div>

  <ul class="nav fixed-top bg-danger justify-content-center" style="margin-top: 56px;">
    @foreach ($categories as $category)
    <li class="nav-item">
      <a class="nav-link text-light text-center" href="#{{$category->id}}{{$category->name}}">{{$category->name}}</a>
    </li>
    @endforeach
</ul>



@foreach ($categories as $category)
<h3 class="mt-5" id="{{$category->id}}{{$category->name}}">{{$category->name}}</h3>
<hr>
<div class="row">
    @foreach ($category->products as $product)
        <div class="col-md-4 d-flex align-items-stretch">
            <div class="card product-card shadow-sm">
                <img class="card-img-top product-img" src="{{$product->image}}" alt="image">
            <div class="card-body">
                <h5 class="card-title">{{$product->name}}</h5>
                <p class="card-text">{{$product->des }}</p>
            </div>
            <div class="card-footer border-0 bg-transparent">
                <div class="row text-center">
                    <div class="col"><button class="btn btn-primary btn-circle p-0" id="btn-minus" onclick="decrease({{$product->price}}, qty{{$product->id}}, price{{$product->id}})"><i class="fas fa-minus"></i></button> </div>
                    <div class="col">              <input type="number" class="count h4 qty-input text-center" id="qty{{ $product->id }}" name="qty" value="1" disabled>
                    </div>
                    <div class="col"><button class="btn btn-primary btn-circle p-0" id="btn-plus" onclick="increase({{$product->price}}, qty{{$product->id}}, price{{$product->id}})"><i class="fas fa-plus"></i></button></div>
                </div>
                 
                <button class="btn btn-danger w-100 mt-3 border-0 add-to-cart" id="{{$product->id}}">Add to cart <span id="price{{$product->id}}">{{$product->price}}</span> {{config('app.currency')}}</button>
           
            </div>
            </div>
        </div>
    @endforeach
</div>
@endforeach

@endsection