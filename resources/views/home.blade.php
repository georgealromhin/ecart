@extends('layout')
@section('title', config('app.name'))

@section('content')

<section class="bg-title-page text-center mt-5" style="background-image: url(images/header_image.webp);">

</section>
<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
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
        <div class="col-md-4">
            <div class="card product-card shadow-sm">
                <img class="card-img-top product-img" src="{{$product->image}}" alt="image">
            <div class="card-body">
                <h5 class="card-title">{{$product->name}}</h5>
                <p class="card-text">{{ $product->des ?? 'second value' }}</p>
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


@section('script')
    <script>

function increase(t,e,o){
    $(e).val(parseInt($(e).val())+1);var s=parseFloat($(e).val())*t;$(o).text(s)
}
function decrease(t,e,o){
    var a= 1;
    $(e).val(parseInt($(e).val())-1),$(e).val()<a&&$(e).val(a);var s=parseFloat($(e).val())*t;$(o).text(s)
    // $(e).val(parseInt($(e).val())-1),$(e).val()<a&&$(e).val(a);var s=parseFloat($(e).val())*t;$(o).text(" "+s.toFixed(2).replace(".",","))
}

$( document ).ready(function() {

    $("#myBtn").click(function(){
    
  });
    $(".add-to-cart").click(function(){
        var itemid = this.id;
        qty=$("#qty"+itemid).val();
        $('#'+itemid).prop('disabled', true);
        $.ajax({
            type:"GET",
            url:"cart/store/"+itemid+"/"+qty,
            success:function(t){
                $('.toast').toast('show');
                getTotalPrice();
                $('#'+itemid).prop('disabled', false);
            
            },error:function(t,e,o){
                $('#'+itemid).prop('disabled', false);
            }
        })
    });


    getTotalPrice();
    function getTotalPrice(){
        $.ajax({
            type:"GET",
            url:"total",
            success:function(t){
                $('#cart-total').text(t);
            },error:function(t,e,o){
            }
        })  
    }
});





    </script>
@endsection