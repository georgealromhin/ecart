<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\OrderDetails;
use App\Customer;
use Carbon\Carbon;
use DB;


class DashboardController extends Controller
{
    //
    public function index(){

        $order = new Order();
        $order_details = new OrderDetails();
        $totalAmount =  DB::table("orders")->sum('total');
        $totalOrders = $order->count();
        $totalCustomers = Customer::get()->groupBy('name')->count();

        $orders = $order->select(DB::raw('DATE_FORMAT(created_at, "%M-%Y") as date'), DB::raw('count(*) as total'), DB::raw('max(created_at) as createdAt'))->groupBy('date')->orderBy(DB::raw("createdAt"), 'ASC')->get();
            

            
        $orders_count = $order->select(DB::raw('DATE_FORMAT(created_at, "%M-%Y") as date'), DB::raw('SUM(total) as total'), DB::raw('max(created_at) as createdAt'))->where('order_status', 'delivered')->groupBy('date')->orderBy(DB::raw("createdAt"), 'ASC')->get();
        
        return view('admin.dashboard', [
            
            'total' =>  $totalAmount,
            'total_orders' =>  $totalOrders,
            'total_customers' =>  $totalCustomers,
            'orders' => $orders,
            'orders_count' => $orders_count,
           
        ]);
    }
}
