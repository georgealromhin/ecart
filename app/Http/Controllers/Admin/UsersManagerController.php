<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Resources\UserResourceCollection;
use App\Http\Resources\UserResource;

class UsersManagerController extends Controller
{
    //
    public function index(){
        if(Auth::check()){
            return view('admin.users_manager');
        }
        return abort(404);
    }
    public function getUsers(){
        if(Auth::check()){
            $users = User::get();
            return new UserResourceCollection($users);
        }
        return abort(404);
    }
}
