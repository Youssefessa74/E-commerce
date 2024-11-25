<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\NewsletterSubscriberDataTable;
use App\Http\Controllers\Controller;
use App\Mail\SendMailToSubscribers;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscribersController extends Controller
{
    function index(NewsletterSubscriberDataTable $newsletterSubscriberDataTable){
        return $newsletterSubscriberDataTable->render('admin.subscribers.index');
    }

    function destroy($id){
        $subscriber = NewsletterSubscriber::findOrFail($id);
        $subscriber->delete();
        toastr('Subscriber Deleted Successfully','success');
        return redirect()->back();
    }

    function SendMail(Request $request){
        $request->validate([
            'subject' => ['required','max:200'],
            'message' => ['required','max:1000'],
        ]);
        $subscribers = NewsletterSubscriber::where('is_verified',1)->pluck('email')->toArray();
        Mail::to($subscribers)->send(new SendMailToSubscribers($request->subject,$request->message));
        toastr('Mail Send Successfully','success');
        return redirect()->back();
    }
}
