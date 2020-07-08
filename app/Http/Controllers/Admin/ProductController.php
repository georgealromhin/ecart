<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProductResourceCollection;
use App\Http\Resources\ProductResource;


class ProductController extends Controller
{
    //
    public function index(){
        if(Auth::check()){
            return view('admin.products');
        }
        return abort(404);
    }

    public function getproducts(){
        if(Auth::check()){
            return new ProductResourceCollection(Product::whereIn('status', ['visible', 'hidden'])->orderBy('id', 'asc')->get());
        }
        return abort(404);
    }
    public function addProduct(Request $request){

        if(Auth::check()){

            $product = new Product();
            $product->name = $request->name;
           // $product->image = $request->image;

            if($request->hasFile('image'))
            {
                $image_name = time().'_'.rand(999,9999).''.rand(999,99999).''.rand(999,99999).'.'.$request->image->getClientOriginalExtension();
                $request->image->move('images/products', $image_name);
                $product->image = 'images/products/'.$image_name;
            }else{     
                $product->image = 'images/default.jpg';
            }

            $product->des = $request->des;
            $product->price = $request->price;
            $product->status = 'visible';
            $product->category_id = $request->category_id;

            if($product->save()){
                return response()->json(['msg' => 'added']);
            }
        }
        return abort(404);
    }
}
