<?php

namespace App\Services;

use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Flasher\Laravel\Http\Request;
use Cart;
use Illuminate\Support\Facades\Session;

class CartService
{

    function AddToCart($request)
    {
        $product = Product::findOrFail($request->product_id);

            // Check if the product is out of stock
            if ($product->qty == 0) {
                return ['status' => 'stock_out', 'message' => 'Out Of Stock'];
            }

            // Check if the requested quantity exceeds available stock
            if ($request->qty > $product->qty) {
                return ['status' => 'stock_out', 'message' => 'There are only ' . $product->qty . ' units of this product available.'];
            }
        $variants = [];
        $variantsTotalAmount = 0;
        if ($request->has('variants_items')) {
            foreach ($request->variants_items as $items) {
                $variantsItems = ProductVariantItem::find($items);
                $variants[$variantsItems->ProductVariant->name]['name'] = $variantsItems->name;
                $variants[$variantsItems->ProductVariant->name]['price'] = $variantsItems->price;
                $variantsTotalAmount += $variantsItems->price;
            }
        }
        /* Start Check if the product has offer price or not  */
        $productPrice = 0;
        if (checkDiscount($product)) {
            $productPrice = $product->offer_price;
        } else {
            $productPrice = $product->price;
        }
        /* End Check if the product has offer price or not  */

        $cartData = [];
        $cartData['id'] = $product->id;
        $cartData['name'] = $product->name;
        $cartData['qty'] = $request->qty;
        $cartData['price'] = $productPrice;
        $cartData['weight'] = 10;
        $cartData['options']['variants'] = $variants;
        $cartData['options']['variants_total'] = $variantsTotalAmount;
        $cartData['options']['image'] = $product->thumb_image;
        $cartData['options']['slug'] = $product->slug;
        Cart::add($cartData);
        return ['status' => 'success', 'message' => 'Product added to cart successfully!'];

    }

    public function applyCoupon($request)
    {
        if ($request->coupon_code == null) {
        return response(['status' => 'error', 'message' => 'Coupon Field is required !']);
        }
        $coupon = Coupon::where(['code' => $request->coupon_code, 'status' => 1])->first();
        if ($coupon == null) {
            return response(['status' => 'error', 'message' => 'Coupon does not exist!']);
        } elseif ($coupon->start_date >= date('Y-m-d')) {
            return response(['status' => 'error', 'message' => 'Coupon is not available yet!']);
        } elseif ($coupon->end_date <= date('Y-m-d')) {
            return response(['status' => 'error', 'message' => 'Coupon is expired!']);
        } elseif ($coupon->total_used > $coupon->quantity) {
            return response(['status' => 'error', 'message' => 'Coupon is fully used!']);
        }

        if ($coupon->discount_type == 'amount') {
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'amount',
                'discount' => $coupon->discount,
            ]);
        } elseif ($coupon->discount_type == 'percent') {
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'percent',
                'discount' => $coupon->discount,
            ]);
        }

        return response(['status' => 'success', 'message' => 'Coupon Applied Successfully!']);
    }

    public function calcCoupon()
    {
        if (Session::has('coupon')) {
            $coupon = Session::get('coupon');
            $cartTotal = CartTotal();  // Assuming this is a method in your service

            if ($coupon['discount_type'] == 'amount') {
                $total = $cartTotal - $coupon['discount'];
                return response(['total' => $total, 'discount' => $coupon['discount']]);
            } else if($coupon['discount_type'] == 'percent') {
                $discount = ($cartTotal * $coupon['discount'] / 100);
                $total = $cartTotal - $discount;
                return response(['total' => $total, 'discount' => $discount]);
            }
        } else {
            $total = CartTotal();
            return response(['total' => $total, 'discount' => 0], 200);
        }
    }

    public function cartUpdateQty($request)
    {
        $productId = Cart::get($request->rowId)->id;
        $product = Product::findOrFail($productId);

        // Check if the product is out of stock
        if ($product->qty == 0) {
            return ['status' => 'stock_out', 'message' => 'Out Of Stock'];
        }

        // Check if the requested quantity exceeds available stock
        if ($request->qty > $product->qty) {
            return ['status' => 'stock_out', 'message' => 'There are only ' . $product->qty . ' units of this product available.'];
        }

        // Update Cart
        Cart::update($request->rowId, $request->qty);
        $total = $this->GetProductTotal($request->rowId);  // Assuming GetProductTotal is a method in your service

        return response(['status' => 'success', 'message' => 'Quantity Updated Successfully', 'product_total' => $total], 200);
    }

    function GetProductTotal($rowId)
    {
        $product = Cart::Get($rowId);
        $total = ($product->price + $product->options->variants_total) * $product->qty;
        return $total;
    }



}
