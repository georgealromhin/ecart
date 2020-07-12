<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //

    public function index(){
        return Auth::user()->unreadNotifications->count();
    }

    public function markAsRead(){
        return Auth::user()->unreadNotifications->markAsRead();
    }

}
