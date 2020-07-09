<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Resources\UserResourceCollection;
use App\Http\Resources\UserResource;

class UserManagerController extends Controller
{
    //
    public function index(){
        
            return view('admin.user_manager', [ 'users' => $this->show() ]);
       
    }

    public function userView(){
        
            return view('admin.add_user');
       
    }

    public function store(Request $request){
        
            $validatedData = $request->validate([
                'name' => 'required|max:50',
                'username' => 'required|unique:users|max:50',
                'password' => 'required|min:8',
                'role' => 'required',
            ]);
                $user = new User();
                $user->name = $request->input('name');
                $user->username = $request->input('username');
                $user->password = bcrypt($request->input('password'));
                $user->role = $request->input('role');
                if($user->save()){
                    return back()->with('success', 'User added successfully');
                }
                return back()->with('error', 'Error adding user');
       
    }

    public function destroy($user_id){
       
        
            $user = User::findOrFail($user_id);
            
            if($user->delete()){
                return back()->with('success', 'User deleted');
            }
            return back()->with('error', 'Error deleting user');
       
    }

    public function show(){
        
            $users = User::orderBy('id', 'asc')->get();
            return $users;
       
    }

}
