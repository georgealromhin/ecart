<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CategoryResourceCollection;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    //
    public function show(){
        if(Auth::check()){
            return new CategoryResourceCollection(Category::paginate(10));
        }
        return abort(404);
       
    }
}
