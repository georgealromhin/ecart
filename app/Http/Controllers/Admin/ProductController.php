<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProductResourceCollection;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    //
    public function index(){
        
            return view('admin.products');
        
    }

    public function getproducts(){
        
            return new ProductResourceCollection(Product::whereIn('status', ['visible', 'hidden'])->orderBy('id', 'asc')->get());
        
    }
    public function stroe(Request $request){

        

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
                return response()->json(['msg' => 'Added']);
            }
        
    }

    public function destroy($id){
        
            $product = Product::findOrFail($id);
            $imagePath = $product->image;
            if($product->delete()){
                // delete image from folder
                if(File::exists($imagePath)) {
                    File::delete($imagePath);
                }
                return response()->json(['msg' => 'Deleted']);
            }
            return response()->json(['msg' => 'Error Deleting']);
        
    }
    public function updateStatus($status, $id){
        
            $product = Product::findOrFail($id);
            $product->status = $status;
            $product->save();
            return new ProductResource($product);
        
    }
}
