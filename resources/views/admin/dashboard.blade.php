@extends('admin.layout')
@section('title', 'Dashboard')


@section('content')
<div class="d-flex" id="wrapper">
    @include('admin.sidebar')

    <div id="page-content-wrapper">
        @include('admin.navbar')
        <div class="container mt-5 mb-5">

            <div class="row">
                <div class="col-md-4">
                        

            <div class="card shadow-sm text-light border-0" style="background-color: #21D4FD;background-image: linear-gradient(19deg, #21D4FD 0%, #B721FF 100%);">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center"><i class="fas fa-money-bill-alt mt-2 fa-3x"></i></div>
                        <div class="col-md-8">
                           <p class="h4"> {{ $orders_info[0]->total_sales}} {{config('app.currency')}}</p>
                           <p>Total Sales</p>
                           </div>
                    </div>
                </div>
                </div>


                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 text-light" style="background-color: #ff4444;background-image: linear-gradient(19deg, #ff4444 0%, #cc0000 100%);">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 text-center"><i class="fas fa-shopping-cart mt-2 fa-3x"></i></div>
                                <div class="col-md-8">
                                   <p class="h4"> {{ $orders_info[0]->total_orders }}</p>
                                   <p>Total Orders</p>
                                   </div>
                            </div>
                        </div>
                        </div>
    
                </div>
                <div class="col-md-4">
                   
                    <div class="card shadow-sm border-0 text-light" style="background-color: #00c851;background-image: linear-gradient(19deg, #00c851 0%, #007e33 100%);">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 text-center"><i class="fas fa-user mt-2  fa-3x"></i></div>
                                <div class="col-md-8">
                                   <p class="h4"> {{$total_customers}}</p>
                                   <p>Total Customers</p>
                                   </div>
                            </div>

                        </div>
                        </div>
                </div>
            </div>



            <div class="row mt-5">
                <div class="col-md-6">

                    <div class="card shadow-sm rounded">
                        <div class="card-header"><i class="fas fa-chart-line"></i> Orders Analytics</div>
                        <div class="card-body">
                            <canvas id="lineChart"></canvas>
                        </div>
                    </div>
               
            
                </div>
                <div class="col-md-6">
                <div class="card shadow-sm rounded">
                    <div class="card-header"><i class="fas fa-chart-bar"></i> Sales Analytics</div>
                    <div class="card-body">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
                </div>
            </div>

            <div class="card shadow-sm rounded mt-5">
                <div class="card-header"><i class="fas fa-inbox"></i> Latest Orders</div>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Order №</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($latest_orders as $order)
                                
                        <tr>
                            <td>{{$order->order_number}}</td>
                            <td>{{$order->customer->name}}</td>
                            <td>{{$order->customer->phone}}</td>
                            <td>{{$order->order_status}}</td>
                            <td>{{$order->created_at}}</td>
                            <td><a href="{{url('order_details')}}/{{$order->id}}" target="_blank"><i class="far fa-eye"></i> View</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                  </table>
            </div>





        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="{{asset('js/easy_notify.js')}}"></script>   
<script type="text/javascript" src="{{asset('js/notification.js')}}"></script>   
<script type="text/javascript" src="{{ asset('js/chart.min.js') }}"></script>



<script>
    // line chart for orders bt date
var ctx=document.getElementById("lineChart").getContext("2d");
lineChart=new Chart(ctx, {
    type:"line", data: {
        labels:[], datasets:[ {
            label: "Orders", borderColor: "#4285F4", data: []
        }
        ]
    }
    , options: {
        layout: {
            padding: 10
        }
        , legend: {
            position: "bottom"
        }
        , title: {
            display: !0, text: "Orders"
        }
        , scales: {
            yAxes:[ {
                scaleLabel: {
                    display: !0, labelString: "Number of orders"
                }
            }
            ], xAxes:[ {
                scaleLabel: {
                    display: !0, labelString: "Date"
                }
            }
            ]
        }
    }
});

        @foreach ($orders as $order)
                lineChart.data.labels.push("{{$order->date}}"), lineChart.data.datasets.forEach(a=> {
                a.data.push("{{$order->total}}");      
            });  
       @endforeach
       lineChart.update();


// bar chart for sales
var ctxa = document.getElementById("barChart").getContext("2d");
barChart =new Chart(ctxa, {
    type:"bar", data: {
        labels:[], datasets:[ {
            label: "Sales", borderColor: "#4285F4", data: []
        }
        ]
    }
    , options: {
        layout: {
            padding: 10
        }
        , legend: {
            position: "bottom"
        }
        , title: {
            display: !0, text: "Sales"
        }
        , scales: {
            yAxes:[ {
                scaleLabel: {
                    display: !0, labelString: "Amount in  {{config('app.currency')}}"
                }
            }
            ], xAxes:[ {
                scaleLabel: {
                    display: !0, labelString: "date"
                }
            }
            ]
        }
    }
});

        @foreach ($sales as $sale)
        barChart.data.labels.push("{{$sale->date}}"), barChart.data.datasets.forEach(a=> {
                a.data.push("{{$sale->total}}");      
            });  
       @endforeach
       barChart.update();


</script>
@endsection