<?php

namespace App\Http\Controllers\Frontend;

use App\Helper\MailHelper;
use App\Http\Controllers\Controller;
use App\Mail\SubscriptionVerification;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class NewLettersController extends Controller
{
    function Subscribe(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $subscriber = NewsletterSubscriber::where('email', $request->email)->first();

        if ($subscriber) {
            if ($subscriber->is_verified == 0) {
                $subscriber->verified_token = Str::random(25);
                $subscriber->save();
                MailHelper::setMailConfig();
                Mail::to($subscriber->email)->send(new SubscriptionVerification($subscriber));
                return response(['status' => 'success', 'message' => 'Check your email to verify!'], 200);

            } elseif ($subscriber->is_verified == 1) {
                return response(['status' => 'error', 'message' => 'You Already Subscribed With this email'], 403);
            }
        } else {
            $subscriber = new NewsletterSubscriber();
            $subscriber->email = $request->email;
            $subscriber->verified_token = Str::random(25);
            $subscriber->is_verified = 0;
            $subscriber->save();
            // set mail config
            MailHelper::setMailConfig();
            // Ensure the email exists
            if ($subscriber->email) {
                try {
                    Mail::to($subscriber->email)->send(new SubscriptionVerification($subscriber));
                } catch (\Exception $e) {
                    return response(['status' => 'error', 'message' => 'Failed to send email. Please try again later.'], 500);
                }
            } else {
                return response(['status' => 'error', 'message' => 'Invalid email address.'], 400);
            }

            return response(['status' => 'success', 'message' => 'Check your email to verify!'], 200);
        }
    }



    function SubscribeVerify($token)
    {
       $verify = NewsletterSubscriber::where('verified_token',$token)->first();
       if($verify){
        $verify->verified_token = 'verified';
        $verify->is_verified = 1;
        $verify->save();
        toastr('You Subscribed Successfully','success');
        return redirect()->route('home');
       } else {
        toastr('Something Went wrong , please subscribe again','error');
        return redirect()->route('home');
       }
    }
}
