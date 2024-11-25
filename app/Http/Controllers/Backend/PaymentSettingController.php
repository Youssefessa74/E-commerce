<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CashOnDelivery;
use App\Models\PaypalSetting;
use App\Models\StripeSetting;
use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{
    function index(){
        $paypal = PaypalSetting::first();
        $stripe = StripeSetting::first();
        $cod = CashOnDelivery::first();
        return view('admin.payment-settings.index',compact('paypal','stripe','cod'));
    }
}
