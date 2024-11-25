<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    function index()
    {

        $orders = Order::with('OrderProducts')->where('user_id',auth()->user()->id)->paginate(10);
        return view('frontend.dashboard.orders.index', compact('orders'));
    }

    function OrderShow($id){
        $order = Order::findOrFail($id);
        return view('frontend.dashboard.orders.order_show', compact('order'));
    }
}
