<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Banner;

class HomeController extends Controller
{
    //
    public function index(){
        $category = new Category();
        $categories = $category->with(array('products' =>  function($query){
            $query->where('status', 'visible')->orderBy('name', 'asc');
         }))->where('status', 'visible')->orderBy('id', 'asc')->get();

        $banners = Banner::orderBy('id', 'DESC')->get();
        return view('home', [
            'categories' => $categories,
            'banners' => $banners,
        ]);
    }
}
