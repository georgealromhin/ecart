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
        if(Auth::check()){
            return view('admin.user_manager', [ 'users' => $this->getUsers() ]);
        }
        return abort(404);
    }

    public function addUserView(){
        if(Auth::check()){
            return view('admin.add_user');
        }
        return abort(404);
    }

    public function addUser(Request $request){
        if(Auth::check()){
            $validatedData = $request->validate([
                'name' => 'required|max:25',
                'username' => 'required|unique:users|max:25',
                'password' => 'required|min:8',
                'role' => 'required',
            ]);
                $user = new User();
                $user->name = $request->input('name');
                $user->username = $request->input('username');
                $user->password = $request->input('password');
                $user->role = $request->input('role');
                if($user->save()){
                    return back()->with('success', 'User added successfully');
                }
                return back()->with('error', 'Error adding user');
        }
        return abort(404);
    }

    public function deleteUser($user_id){
       
        if(Auth::check()){
            $user = User::findOrFail($user_id);
            
            if($user->delete()){
                return back()->with('success', 'User deleted');
            }
            return back()->with('error', 'Error deleting user');
        }
        return abort(404);
    }

    public function getUsers(){
        if(Auth::check()){
            $users = User::orderBy('id', 'asc')->get();
            return $users;
        }
        return abort(404);
    }

}
