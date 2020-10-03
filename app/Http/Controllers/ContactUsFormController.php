<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Contact;
use Mail;

class ContactUsFormController extends Controller {

    public function __construct(){
		$this->middleware('auth');
    }
    
    // Create Contact Form
    public function createForm(Request $request) {
      return view('AFFAIRE.contact');
    }

    // Store Contact Form data
    public function ContactUsForm(Request $request) {

        // Form validation
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'subject'=>'required',
            'message' => 'required'
         ]);

        //  Store data in database
        Contact::create($request->all());

        //  Send mail to admin
        \Mail::send('AFFAIRE.mail',
        array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone_number' => $request->get('phone_number'),
            'subject' => $request->get('subject'),
            'user_message' => $request->get('message'),
        ), function($message) use ($request)
        {
            $message->from($request->email);
            $message->to('barhoum0000@hotmail.com');//, 'Admin')->subject($request->get('subject'));
        });

        session()->flash('success_sendingMail', 'We have received your message and would like to thank you for writing to us.');
        return back();
    }

}