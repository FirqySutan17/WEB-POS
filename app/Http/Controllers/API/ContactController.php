<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Contact;

class ContactController extends Controller
{
    public function ContactForm(Request $request) {
 
        // Form validation
         $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone_number'=>'required',
            'messages' => 'required'
         ]);
         if ($validator->fails()) {return response()->json(['error'=>$validator->errors()], 401);}
        //  Store data in database
        Contact::create($request->all());
 
        //  Send mail to Application Admin
        \Mail::send('admin.emails.contactemail', array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone_number' => $request->get('phone_number'),
            'messages' => $request->get('messages'),
        ), function($message) use ($request){
            $message->from($request->email);
            $message->to('firqy.sutan@gmail.com', 'Koontjie - Contact')->subject('Notification - Contact');
        });
        return response()->json(['success' => 'The email has been sent.']);
    }
}
