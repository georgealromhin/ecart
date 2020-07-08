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
    public function index(){
        if(Auth::check()){
            return view('admin.categories');
        }
        return abort(404);
    }

    public function getCategories(){
        if(Auth::check()){
            return new CategoryResourceCollection(Category::whereIn('status', ['visible', 'hidden'])->orderBy('id', 'asc')->get());
        }
        return abort(404);
    }
    
    public function getCategory($id){
        if(Auth::check()){
            $category = Category::find($id);
            return new CategoryResource($category);
        }
        return abort(404);
    }
    public function addCategory(Request $request){
        if(Auth::check()){
            $validatedData = $request->validate([
                'name' => 'required|max:255',
            ]);
            $category = new Category();
            $category->name = $request->name;
            $category->status = 'visible';
            if($category->save()){
                return response()->json(['name'=> $request->name]);
            }
        }
        return abort(404);
    }
    public function deleteCategory($id){
        if(Auth::check()){
            $category = Category::findOrFail($id);
            if($category->delete()){
                return response()->json(['msg'=> 'deleted']);
            }
        }
        return abort(404);
    }
    public function editCategory(Request $request, $id){
        if(Auth::check()){
            $category = Category::findOrFail($id);
            $category->name = $request->name;
            if($category->save()){
                return response()->json(['msg'=> 'updated']);
            }
        }
        return abort(404);
    }

    public function changeStatus($status, $id){
        $category = Category::find($id);
        $category->status = $status;
        $category->save();
        return new CategoryResource($category);
    }
}
