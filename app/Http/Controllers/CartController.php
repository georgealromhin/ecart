<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use Session;
use App;
use App\Http\Resources\CartResource;



class CartController extends Controller
{
    //
    public function index(){
        return view('cart');
    }


    public function store(Request $request, $id, $qty){
        $product = Product::findOrFail($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id, $qty);

        $request->session()->put('cart', $cart);
        
        return response(['msg'=>'Added to cart']);
    }

    public function getTotal(){
        return Session::has('cart') ? Session::get('cart')->total : 0;
    }

    public function getCart(){
        $cart_items = null;
        if(Session::has('cart')){
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $cart_items = $cart->products;
        }
       
        return new CartResource($cart_items);
    }
    public function remove(Request $request, $id){
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->remove($id);
            if(Session::has('cart')){
                if(count($cart->products) > 0){
                    Session::put('cart', $cart);
                }else{
                    Session::forget('cart');
                }
            }
            return response(['msg'=>'Removed from cart']);
    }
}
