@extends('layout')
@section('title', 'Checkout')


@section('content')

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header h3">Checkout</div>
            <div class="card-body">
                <form action="{{url('order/create')}}" method="POST">
                    @csrf
    
                    <div class="form-group">
                        <label for="name">Name*</label>
                        <input type="text" class="form-control shadow-sm" id="name" name="name" maxlength="255" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email*</label>
                        <input type="email" class="form-control shadow-sm" id="email" name="email" maxlength="255" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control shadow-sm" id="phone" name="phone" maxlength="255">
                    </div>
                    <div class="form-group mt-4">
                        <select id="order_type" name="order_type" class="form-control shadow-sm">
                          <option value="Delivery" selected>Delivery</option>
                          <option value="Pickup">Pickup</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="delivery_address">Delivery Address</label>
                        <textarea class="form-control shadow-sm" id="delivery_address" name="delivery_address" rows="3"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="comments">Comments</label>
                        <textarea class="form-control shadow-sm" name="comments" id="comments" rows="3"></textarea>
                      </div>
                      <button type="submit" class="btn btn-danger w-100" id="submitBtn">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>                      

    <div class="col-md-2"></div>
</div>


@endsection

@section('script')
    <script>
        $( "#submitBtn" ).click(function() {
            Swal.fire({title: '',text: 'Loading...',allowEscapeKey: false, allowOutsideClick: false});
            Swal.showLoading();
        });
    </script>
@endsection
