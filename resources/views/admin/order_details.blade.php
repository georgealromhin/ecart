@extends('admin.layout')
@section('title', '#'.$order->order_number)

@section('header')

@endsection

@section('content')

            <div class="container mt-5 mb-5">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-group">
                            <li class="list-group-item">#{{$order->order_number}} Date: {{$order->created_at}} ({{$order->order_type}})</li>
                            <li class="list-group-item"><b>Name:</b> {{$order->customer->name}}</li>
                            <li class="list-group-item"><b>Phone:</b> <a href="tel:{{$order->customer->phone}}">{{$order->customer->phone}}</a></li>
                            <li class="list-group-item"><b>Email:</b> <a href="mailto:{{$order->customer->email}}">{{$order->customer->email}}</a> </li>
                            <li class="list-group-item"><b>Delivery Address:</b> {{$order->delivery_address}}</li>
                            <li class="list-group-item"><b>Comments:</b> {{$order->comments}}</li>
                          </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-primary text-light">Order Details</div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                      <tr>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Subtotal</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    {{dd($order->order_details)}}
                                        @foreach ($order->order_details as $item)
                                        <tr>
                                            <td>{{$item->product}}</td>
                                            <td>{{$item->product}}</td>
                                            <td>{{$item->product}}</td>
                                            <td>{{$item->qty}}</td>
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

@endsection