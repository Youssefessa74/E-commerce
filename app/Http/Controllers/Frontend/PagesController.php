<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\Contact;
use App\Models\About;
use App\Models\MailConfiguration;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PagesController extends Controller
{
    function about(){
        $about = About::first();
        return view('frontend.pages.about',compact('about'));
    }

    function termsConditions(){
        $content  = TermsAndCondition::first();
        return view('frontend.pages.terms-and-conditions',compact('content'));
    }

    function contact(){
        return view('frontend.pages.contact');
    }

    function SendContactMail(Request $request){
        $request->validate([
            'name' => ['required','max:100'],
            'email'=>['required','email','max:100'],
            'subject' =>['required','max:300'],
            'message' => ['required','max:1000']
        ]);
        $settings = MailConfiguration::first();
        Mail::to($settings->email)->send(new Contact($request->subject,$request->message,$request->email));
        return response(['status' =>'success','message' => 'Your Email Send Successfully'],200);
    }
}
