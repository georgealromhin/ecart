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
        
            return view('admin.categories');
        
    }

    public function getCategories(){
        
            return new CategoryResourceCollection(Category::whereIn('status', ['visible', 'hidden'])->orderBy('id', 'asc')->get());
        
    }
    
    public function getCategory($id){
        
            $category = Category::find($id);
            return new CategoryResource($category);
        
    }
    public function store(Request $request){
        
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
    public function destroy($id){
        
            $category = Category::findOrFail($id);
            if($category->delete()){
                return response()->json(['msg'=> 'deleted']);
            }
        
    }
    public function update(Request $request, $id){
        if(Auth::user()->role == 'main'){
                $category = Category::findOrFail($id);
                $category->name = $request->name;
                if($category->save()){
                        return response()->json(['msg'=> 'updated']);
                }
        }
        return response()->json(['msg'=> 'unauthorized action'], 401);
        
    }

    public function updateStatus($status, $id){
            $category = Category::find($id);
            $category->status = $status;
            $category->save();
            return new CategoryResource($category);
    }
}
