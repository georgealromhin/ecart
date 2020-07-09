@extends('layout')
@section('title', 'Cart')


@section('content')
@if(Session::has('cart'))

    <h3 class="baity-lithospro-bold"> Your Order</h3>

    <div class="table-responsive-sm">

        <table class="table table-hover bg-light">

            <tbody>

                @foreach ($cart_items as $item)

                    <tr>

                    <th class="item-name h4">

                      

                      {{$item['product']['name']}}

                      </th>

                    <td class="item-qty"> x{{$item['qty']}} </td>

                    <td class="item-price"><small class="baity-lithospro-bold">$</small> {{ $item['price']}} </td>

                    <td class="text-black-worksans"> <a href="{{url('cart/remove')}}/{{$item['product']['id']}} " class="btn btn-outline-danger btn-circle-sm btn-remove"> <i class="fa fa-times mb-1"></i> </a> </td>

                  </tr>

                @endforeach


            </tbody>

          </table>

        </div>

        <div class="row">

            <div class="col-md-6"></div>

            <div class="col-md-6">

                <a href="{{url('order')}}" class="btn btn-lg h4 w-100 btn-danger mt-5 shadow-sm baity-lithospro-bold">Make Order</a>

            </div>

        </div>



    @else

        <div class="text-center nt-5">

            <br><img src="{{asset('images/emptycart.webp')}}" alt="empty_cart" class="img-fluid">

        </div>

    @endif
@endsection


@section('script')
    <script>
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