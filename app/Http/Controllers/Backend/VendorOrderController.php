<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorOrderController extends Controller
{
    function index()
    {
        $vendorId = auth()->user()->vendor->id;

        // Fetch orders with pagination
        $orders = Order::whereHas('OrderProducts', function($query) use ($vendorId) {
            $query->where('vendor_id', $vendorId);
        })->with('OrderProducts')->paginate(10); // Change 10 to the number of items per page

        return view('vendor.orders.index', compact('orders'));
    }

    function OrderShow($id){
        $order = Order::findOrFail($id);
        return view('vendor.orders.order_show', compact('order'));
    }

    function OrderChangeStatus(Request $request) {
        $request->validate([
            'orderId' => ['required','exists:orders,id'],
            'orderStatus' => ['required'],
        ]);
        $order = Order::findOrFail($request->orderId);
        $order->order_status = $request->orderStatus;
        $order->save();
        return response(['status'=>'success','message' => 'Order Status Updated Successfully'],200);
    }

}
