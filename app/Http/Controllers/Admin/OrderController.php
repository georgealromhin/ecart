<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResourceCollection;
use App\Http\Resources\OrderResource;
use App\Order;
use App\Customer;

class OrderController extends Controller
{
    //
    public function index(){
        return view('admin.orders');
    }
    public function show($id){
    
            $order = Order::findOrFail($id);
            $res = new OrderResource($order);
            return view('admin.order_details', [ 'order' => $order]);
            //return $res;
    
    }
    public function showOrders(){
        return new OrderResourceCollection(Order::with('customer')->orderBy('created_at', 'desc')->get());
    }
    public function destroy($id){
            Customer::findOrFail($id)->delete();
            return response()->json();
    }
}
