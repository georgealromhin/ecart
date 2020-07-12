@extends('admin.layout')
@section('title', '#'.$order->order_number)

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')

            <div class="container mb-5">
                
                <div class="row">
                  
                    <div class="col-md-12">
                        

                        <ul class="list-group">
                            <li class="list-group-item"><b>#{{$order->order_number}}</b> Date: {{$order->created_at}} ({{$order->order_type}}) 
                                
                                <div class="form-group float-right">
                                <label for="order_status">Order Status</label>
                                <select class="form-control" id="order_status">
                                  <option value="Pending">Pending</option>
                                  <option value="Delivered">Delivered</option>
                                  <option value="Cancelled">Cancelled</option>
                                </select>
                              </div>
                            </li>
                            <li class="list-group-item"><b>Name:</b> {{$order->customer->name}}</li>
                            <li class="list-group-item"><b>Phone:</b> <a href="tel:{{$order->customer->phone}}">{{$order->customer->phone}}</a></li>
                            <li class="list-group-item"><b>Email:</b> <a href="mailto:{{$order->customer->email}}">{{$order->customer->email}}</a> </li>
                            <li class="list-group-item"><b>Delivery Address:</b> {{$order->delivery_address}}</li>
                            <li class="list-group-item"><b>Comments:</b> {{$order->comments}}</li>
                          </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-primary text-light">Order Details <span class="float-right h4">Total: {{$order->total}} {{config('app.currency')}} </span> </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover shadow-sm">
                                    <thead>
                                      <tr>
                                        <th scope="col">Image</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Subtotal</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    {{-- {{dd($order->order_details)}} --}}
                                        @foreach ($order->order_details as $item)
                                        <tr>
                                            <td><img src="{{url($item->products->image)}}" class="product-img" alt=""> </td>
                                            <td>{{$item->products->name}}</td>
                                            <td>{{$item->products->price}} {{config('app.currency')}}</td>
                                            <td>x{{$item->qty}}</td>
                                            <td>{{$item->qty * $item->products->price}} {{config('app.currency')}}</td>
                                        </tr>
                                        
                                        @endforeach
                                    </tbody>
                                  </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
    
@endsection

@section('script')
<script>
    $("#order_status").val("{{$order->order_status}}");
    $('#order_status').on('change', function() {
        var id = {{$order->id}};
        var status = this.value;
        updatestatus(status, id)
    });
    function updatestatus(status, id){
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $.ajax({
            type:"PUT",
            url:"{{url('order_status/update')}}/"+status+'/'+id,
            success:function(t){
                console.log(t)
            },error:function(t,e,o){
                console.log(t)
            }
        })  
    }

</script>
@endsection