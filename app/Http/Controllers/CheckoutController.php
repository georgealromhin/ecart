<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
class CheckoutController extends Controller
{
    public function index(){

        if(Session::has('cart')){
            return view('checkout');
        }
        return redirect()->action('HomeController@index');
    
    }
}
