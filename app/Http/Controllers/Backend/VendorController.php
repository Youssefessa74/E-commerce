<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    function dashboard(){
        $now = Carbon::now();

        $totalOrders = Order::whereHas('orderProducts',function($query){
            return $query->where('vendor_id',auth()->user()->vendor->id);
        })->count();

        $totalCompeleteOrders = Order::where('order_status','delivered')->whereHas('orderProducts',function($query){
            return $query->where('vendor_id',auth()->user()->vendor->id);
        })->count();

        $totalPendingOrders = Order::where('order_status','pending')->whereHas('orderProducts',function($query){
            return $query->where('vendor_id',auth()->user()->vendor->id);
        })->count();

        $todayOrders = Order::whereDate('created_at',Carbon::today())->whereHas('orderProducts',function($query){
            return $query->where('vendor_id',auth()->user()->vendor->id);
        })->count();

        $todayPendingOrders = Order::whereDate('created_at',Carbon::today())->where('order_status','pending')->whereHas('orderProducts',function($query){
            return $query->where('vendor_id',auth()->user()->vendor->id);
        })->count();

        $totalProducts =Product::where('vendor_id',auth()->user()->vendor_id)->count();

        $todayEarnings = Order::whereDate('created_at',Carbon::today())->where('order_status','delivered')->whereHas('orderProducts',function($query){
            return $query->where('vendor_id',auth()->user()->vendor->id);
        })->sum('sub_total');
        $thisMonthEarnings = Order::whereDate('created_at',$now->month)->where('order_status','delivered')->whereHas('orderProducts',function($query){
            return $query->where('vendor_id',auth()->user()->vendor->id);
        })->sum('sub_total');

        $thisYearEarnings = Order::whereDate('created_at',$now->year)->where('order_status','delivered')->whereHas('orderProducts',function($query){
            return $query->where('vendor_id',auth()->user()->vendor->id);
        })->sum('sub_total');

        $totalEarnings = Order::where('order_status','delivered')->whereHas('orderProducts',function($query){
            return $query->where('vendor_id',auth()->user()->vendor->id);
        })->sum('sub_total');

        $totalReviews = ProductReview::whereHas('product',function($query){
            return $query->where('vendor_id',auth()->user()->vendor->id);
        })->count();

        return view('vendor.dashboard.dashboard',compact('todayOrders','todayPendingOrders','totalOrders','totalPendingOrders','totalCompeleteOrders',
    'totalProducts','todayEarnings','thisMonthEarnings','thisYearEarnings','totalEarnings','totalReviews'));
    }
}
