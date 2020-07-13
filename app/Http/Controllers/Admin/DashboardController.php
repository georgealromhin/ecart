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

        // PostgreSQL
        $orders = $order->select(DB::raw("to_char(created_at ,'Month YYYY') as date"), DB::raw('count(*) as total'))
        ->groupBy('date')
        ->orderBy(DB::raw("max(created_at)"), 'ASC')
        ->get();
     
        // MySQL
        // $orders = $order->select(DB::raw('DATE_FORMAT(created_at, "%M-%Y") as date'), DB::raw('count(*) as total'))
        // ->groupBy('date')->orderBy(DB::raw("max(created_at)"), 'ASC')
        // ->get();

        // PostgreSQL
        $sales = $order->select(DB::raw("to_char(created_at ,'Month YYYY') as date"), DB::raw('SUM(total) as total'))
        ->where('order_status', 'Delivered')
        ->groupBy('date')
        ->orderBy(DB::raw("max(created_at)"), 'ASC')
        ->get();


        // MySQL
        // $sales = $order->select(DB::raw('DATE_FORMAT(created_at, "%M-%Y") as date'), DB::raw('SUM(total) as total'))
        // ->where('order_status', 'Delivered')
        // ->groupBy('date')
        // ->orderBy(DB::raw("max(created_at)"), 'ASC')
        // ->get();

        
        $latest_orders = $order->where('created_at','>=', Carbon::today())->orderBy('id', 'DESC')->get();

        return view('admin.dashboard', [
            
            'total' =>  $totalAmount,
            'total_orders' =>  $totalOrders,
            'total_customers' =>  $totalCustomers,
            'orders' => $orders,
            'sales' => $sales,
            'latest_orders' =>  $latest_orders,
           
        ]);
    }
}
