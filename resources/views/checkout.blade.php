@extends('layout')
@section('title', 'Checkout')


@section('content')

    <div class="card shadow-sm">
        <div class="card-header">Checkout</div>
        <div class="card-body">
            <form action="{{url('order/create')}}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" maxlength="255" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" maxlength="255" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" maxlength="255">
                </div>
                <div class="form-group mt-4">
                    <select id="order_type" name="order_type" class="form-control">
                      <option value="Delivery" selected>Delivery</option>
                      <option value="Pickup">Pickup</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="delivery_address">Delivery Address</label>
                    <textarea class="form-control" id="delivery_address" name="delivery_address" rows="3"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="comments">Comments</label>
                    <textarea class="form-control" name="comments" id="comments" rows="3"></textarea>
                  </div>
                  <button type="submit" class="btn btn-danger w-100">SUBMIT</button>
            </form>
        </div>
    </div>


@endsection


@section('script')
    <script>

$( document ).ready(function() {
    getTotalPrice();


function getTotalPrice(){
    $.ajax({
        type:"GET",
        url:"total",
        success:function(t){
            $('#cart-total').text(t);
        },error:function(t,e,o){
            console.log(t);
        }
    })  
}


});        

    </script>
@endsection