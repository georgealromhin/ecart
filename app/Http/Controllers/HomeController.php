<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Banner;
use App\Http\Resources\GeneralResource;

class HomeController extends Controller
{
    //
    public function index(){
        $banners = Banner::orderBy('id', 'DESC')->get();
        return view('home', [
            
            'banners' => $banners,
        ]);
    }

    public function getProducts(){

        $category = new Category();
        $categories = $category->with(array('products' =>  function($query){
            $query->where('status', 'visible')->orderBy('name', 'asc');
         }))->where('status', 'visible')->orderBy('id', 'asc')->get();

         return new GeneralResource($categories);
    }
}
