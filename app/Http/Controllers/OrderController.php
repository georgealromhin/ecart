<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Customer;
use App\Order;
use App\OrderDetails;
use App\Cart;
use Session;
use App\Http\Resources\OrderResourceCollection;

class OrderController extends Controller
{

    
    public function store(Request $request){
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
    
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        if(Session::has('cart')){
            $customer = new Customer();
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->save();
            $customer_id = $customer->id;

            $order = new Order();
            $rnd =  rand(999999,9999999);#generte 7 random number
            $order->order_number = $rnd;

            if($request->order_type == 'Delivery'){ # if delivery
                $order->delivery_address = $request->delivery_address;
            }

            $order->total =  $cart->total;
            
            $order->comments = $request->comments;
            $order->order_status = "Pending";
            $order->order_type = $request->order_type; #delivery or Pickup

            $order->customer_id = $customer_id;
            $order->save();
            $order_id = $order->id;
            
            #get cart items
            foreach($cart->products as $product){
                $order_details = new OrderDetails();
                $order_details->product_id = $product['product']['id'];
                $order_details->qty = $product['qty'];
                $order_details->order_id = $order_id;
                $order_details->save();
            }
            // Mail::to('baitydelicias@gmail.com')->send(new NewOrderAdminMail($order));
            // if(!empty($request->email)){
            //     Mail::to($request->email)->send(new NewOrderMail($order));
            // }
            
            Session::forget('cart'); #empty cart
            return view('success')->with( ['order_number' => $order->order_number, 'email'=> $customer->email]);
        }
        return redirect()->action('HomeController@index');
    }
}
