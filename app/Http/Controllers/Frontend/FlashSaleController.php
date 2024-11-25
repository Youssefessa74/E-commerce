<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    function index() {
        $flashSaleDate = FlashSale::first();
        $flashSaleItems = FlashSaleItem::where('status',1)->orderBy('created_at','DESC')->pluck('product_id')->toArray();

        return view('frontend.pages.flash-sale',compact('flashSaleDate','flashSaleItems'));
    }
}
