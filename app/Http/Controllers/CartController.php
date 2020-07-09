<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use Session;
use App;


class CartController extends Controller
{
    //

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

        if(!Session::has('cart')){
            return view('cart', [
                'cart_items' => null,
            ]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('cart', [
            'cart_items' =>  $cart->products,
        ]);
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
            return back();
    }
}
