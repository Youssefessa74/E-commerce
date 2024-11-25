<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class TrackOrderController extends Controller
{
    function index(Request $request){

        if($request->has('invoice_id')){
            $request->validate([
                'invoice_id' => ['required'],
            ]);
            $order = Order::where('invoice_id',$request->invoice_id)->first();
            return view('frontend.pages.order-track',compact('order'));
        }else{
            return view('frontend.pages.order-track');
        }

    }

}
