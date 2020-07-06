<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    //
    public function index(){
        if(Auth::check()){
            return view('admin.settings');
        }
        return abort(404);
    }

    public function changeName(Request $request){
        if(Auth::check()){
            $validatedData = $request->validate([
                'name' => 'required|max:50',
            ]);
            $user = User::find(Auth::user()->id);
            $user->name = $request->name;
            $user->save();
            return back()->with('success', 'Name Changed successfully');
        }
        return abort(404);
    }


    public function changeUsername(Request $request){
        if(Auth::check()){
            $validatedData = $request->validate([
                'username' => 'required|unique:users|max:50',
            ]);
            $user = User::find(Auth::user()->id);
            $user->username = $request->username;
            $user->save();
            return back()->with('success', 'Username Changed successfully');
        }
        return abort(404);
    }

    public function changePassword(Request $request){
        if(Auth::check()){
            $validatedData = $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8',
            ]);
            $new_password = bcrypt($request->new_password);

            if(Hash::check($request->current_password, Auth::user()->password)){
                $user_id = Auth::user()->id;                       
                $objUser = User::find($user_id);
                $objUser->password = $new_password;
                $objUser->save();
                return back()->with('success', 'Password Changed successfully');
            }
            return back()->with('error', 'Wrong Password');
            
        }
        return abort(404);
    }
}
