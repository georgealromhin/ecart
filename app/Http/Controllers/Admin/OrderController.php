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
    
            $order = Order::with(array('customer', 'order_details' =>  function($query){
                $query->with('products');
             }))->findOrFail($id);
            //$res = new OrderResource($order);
            return view('admin.order_details', [ 'order' => $order]);
    
    }
    public function showOrders(){
        return new OrderResourceCollection(Order::with('customer')->orderBy('created_at', 'desc')->get());
    }
    public function destroy($id){
            Customer::findOrFail($id)->delete();
            return response()->json();
    }

    public function updateStatus($status, $id){
        $order =  Order::findOrFail($id);
        $order->order_status = $status;
        
        if($order->save()){
            return response()->json(['msg' => 'Updated']);
        }
        return response()->json(['msg' => 'Error updating']);
    }
}
