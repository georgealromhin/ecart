<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Banner;
use App\Http\Resources\BannerResourceCollection;
use App\Http\Resources\BannerResource;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
    //
    public function index(){
        return view('admin.banners');
    }
    public function showBanners(){
        $banners = Banner::orderBy('id', 'DESC')->get();
        return new BannerResourceCollection($banners);
    }
    public function store(Request $request){
        if(Auth::user()->role == 'main'){
            $banner = new Banner();

            if($request->hasFile('image'))
            {
                $image_name = time().'_'.rand(999,9999).''.rand(999,99999).'.'.$request->image->getClientOriginalExtension();
                $request->image->move('images/banners', $image_name);
                $banner->image = 'images/banners/'.$image_name;
                if($banner->save()){
                    return response()->json(['msg' => 'added']);
                }
            }
            return response()->json(['msg'=> 'No image'], 404);
        }
        return response()->json(['msg'=> 'unauthorized action'], 401);
    }
    public function destroy($id){
        if(Auth::user()->role == 'main'){
            $banner = Banner::findOrFail($id);
            if($banner->delete()){
                return response()->json(['msg'=> 'deleted']);
            }
        }
        return response()->json(['msg'=> 'unauthorized action'], 401);
    }
}
