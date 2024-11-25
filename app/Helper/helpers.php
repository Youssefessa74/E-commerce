<?php

/* Set Sidebar Item Active */

use App\Models\GeneralSetting;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

function setActive(array $route)
{
    // Loop through the array of routes
    foreach ($route as $r) {
        // Debug the current route matching
        if (request()->routeIs($r)) {
            return 'active'; // Return 'active' if a match is found
        }
    }
    return ''; // Return an empty string if no match
}

/* Check Discount */
function checkDiscount($product)
{
    $currentDate = date('Y-m-d');
    if ($product->offer_price > 0 && $currentDate >= $product->offer_start_date && $currentDate <= $product->offer_end_date) {
        return true;
    }
    return false;
}

/* calculate Discount Percentage */
function discountPercentage($origianlPrice, $discountPrice)
{
    $discountAmount =  $origianlPrice - $discountPrice;
    $percent = ($discountAmount / $origianlPrice) * 100;
    return ceil($percent);
}

/* Product Type */
function getProductType($type)
{
    switch ($type) {
        case 'new_arrival':
            return 'New';
            break;

        case 'featured_product':
            return 'Featured';
            break;

        case 'top_product':
            return 'Top';
            break;

        case 'best_product':
            return 'Best';
            break;

        default:
            return '';
            break;
    }
    return $type;
}

/* Get Cart Total Amount */
function CartTotal(){
    $total = 0 ;
    foreach(Cart::content() as $product){
        $sum = ($product->price + $product->options->variants_total) * $product->qty;
        $total+= $sum;
    }
    return $total;
}

/* Get Total Cart Price After Discount */

function GetMainCartTotal(){
    if (Session::has('coupon')) {
        $coupon = Session::get('coupon');
        $cartTotal = CartTotal();
        if ($coupon['discount_type'] == 'amount') {
            $total = $cartTotal - $coupon['discount'];
            return $total;
        } elseif($coupon['discount_type'] == 'percent'){
            $discount = $cartTotal - ($cartTotal * $coupon['discount'] / 100);
            $total = $cartTotal - $discount;
            return $total;
        }
    } else {
      return  CartTotal();
    }
}

/* Get Discount  */

function GetDiscount(){
    if (Session::has('coupon')) {
        $coupon = Session::get('coupon');
        $cartTotal = CartTotal();
        if ($coupon['discount_type'] == 'amount') {
            return $coupon['discount'];
        } elseif($coupon['discount_type'] == 'percent'){
            $discount = $cartTotal - ($cartTotal * $coupon['discount'] / 100);
            return $discount;
        } else{
            return 0;
        }
    }else {
        return 0;
    }
}

/* Get Shipping fee for payment page  */

function ShippingFee(){
    if(Session::has('shipping_method')){
        return Session::get('shipping_method')['cost'];
    }else {
        return 0 ;
    }
}

/* Get Final Price to go to any payment method  */

function GetFinalPaymentTotal(){
 return GetMainCartTotal() + ShippingFee();
}

/* Limit Text */

function limitText($text,$limit = 20){
    return Str::limit($text,$limit);
}

/* Get website currency icon */
function CurrencyIcon(){
    $icon = GeneralSetting::first();
    return $icon->currency_icon ;
}

