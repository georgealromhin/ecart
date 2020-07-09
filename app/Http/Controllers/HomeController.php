<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class HomeController extends Controller
{
    //
    public function index(){
        $category = new Category();
        $categories = $category->with(array('products' =>  function($query){
            $query->where('status', 'visible')->orderBy('name', 'asc');
         }))->where('status', 'visible')->orderBy('id', 'asc')->get();
        return view('home', [
            'categories' => $categories,
        ]);
    }
}
