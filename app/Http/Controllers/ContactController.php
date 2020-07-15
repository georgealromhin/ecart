<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;


class ContactController extends Controller
{
    //
    public function send_mail(Request $request){

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);
        $emailAddress = config('app.email_address'); // get email address 
        Mail::to($emailAddress)->send(new ContactMail($request));

        if (Mail::failures()) {
            return back()->with('error', 'Error Sending Message, Please try again later');
            return response()->json(['msg' =>  'Error Sending Message, Please try again later']);
        }
        return response()->json(['msg' =>  'Message sent successfully']);

    }
}
