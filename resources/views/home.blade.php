@extends('layout')
@section('title', config('app.name'))


@section('content')
@foreach ($categories as $category)
<h3 class="mt-3">{{$category->name}}</h3>
<hr>
<div class="row">
    @foreach ($category->products as $product)
        <div class="col-md-4">
            <div class="card product-card shadow-sm">
                <img class="card-img-top product-img" src="{{$product->image}}" alt="image">
            <div class="card-body">
                <h5 class="card-title">{{$product->name}}</h5>
                <p class="card-text">{{$product->des}}</p>
                <div class="row text-center">
                    <div class="col"><button class="btn btn-primary btn-circle" id="btn-minus" onclick="decrease({{$product->price}}, qty{{$product->id}}, price{{$product->id}})">-</button> </div>
                    <div class="col">              <input type="number" class="count h4 qty-input text-center" id="qty{{ $product->id }}" name="qty" value="1" disabled>
                    </div>
                    <div class="col"><button class="btn btn-primary btn-circle" id="btn-plus" onclick="increase({{$product->price}}, qty{{$product->id}}, price{{$product->id}})">+</button></div>
                </div>
                 
                <button class="btn btn-danger w-100 mt-3 add-to-cart" id="{{$product->id}}">Add to cart $ <span id="price{{$product->id}}">{{$product->price}}</span> </button>
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
    $(e).val(parseInt($(e).val())+1);var s=parseFloat($(e).val())*t;$(o).text(" "+s.toFixed(2).replace(".",","))
}
function decrease(t,e,o){
    var a= 1;
    $(e).val(parseInt($(e).val())-1),$(e).val()<a&&$(e).val(a);var s=parseFloat($(e).val())*t;$(o).text(" "+s.toFixed(2).replace(".",","))
}
$(".add-to-cart").click(function(){
    var itemid = this.id;
    qty=$("#qty"+itemid).val();
    $('#'+itemid).prop('disabled', true);
    $.ajax({
        type:"GET",
        url:"cart/store/"+itemid+"/"+qty,
        success:function(t){
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
            getTotalPrice();
            $('#cart-total').text(t);
        },error:function(t,e,o){
        }
    })  
}


    </script>
@endsection