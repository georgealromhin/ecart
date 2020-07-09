<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Entities\Models\User;

class LoginController extends Controller
{
    //
    public function index(){
        if(Auth::check()){
            return redirect('dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request){
        
        $validatedData = $request->validate([
            'inputUsername' => 'required',
            'inputPassword' => 'required',
        ]);

        $userData = array('username'=>$request->input('inputUsername'), 'password'=>$request->input('inputPassword'));
        $rememberMe = false;
        if($request->remember == 'on'){
            $rememberMe = true;
        }    
        if(Auth::attempt($userData, $rememberMe)){
            //Mail::to('ex@gmail.com')->send(new LoginMail($userData['username']));
            return redirect('dashboard');
        }//else
            return back()->with('error', 'Wrong username or password');
        
    }
}
