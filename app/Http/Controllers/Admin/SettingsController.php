<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SettingsResourceCollection;
use App\Http\Resources\SettingsResource;
use App\Settings;
use Illuminate\Support\Facades\Auth;


class SettingsController extends Controller
{
    public function index(){
        
        return view('admin.settings');
    
    }

    public function showSettings(){
        
        return new SettingsResourceCollection(Settings::orderBy('id', 'asc')->get());
    
    }


    public function updateSettings(Request $request){
        //$settings = new Settings();

        if(Auth::user()->role == 'main'){
            for($i = 1; $i <= count($request->all()); $i++){
                $settings = Settings::findOrFail($i);
                $settings->value = $request->input($i);
                $settings->save();
            }
            return response()->json(['msg' => 'saved']);
        }
        return response()->json(['msg'=> 'unauthorized action'], 401);
    
    }
}
