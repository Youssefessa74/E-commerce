<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Adeverisment;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use App\Services\CartService;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    function CartDetailsPage()
    {
        $cartItems = Cart::content();
        if (count($cartItems) == 0) {
            Session::forget('coupon');
            toastr('Please add some products in your cart for view cart page', 'warning', 'Cart is Empty !');
            return to_route('home');
        }
        $cart_page_banners = Adeverisment::where('key', 'cart_page_banners')->first();
        $cart_page_banners = json_decode($cart_page_banners?->value);
        return view('frontend.pages.cart-details', compact('cartItems','cart_page_banners'));
    }

    public function AddToCart(Request $request)
    {
        $result = $this->cartService->AddToCart($request);
        if ($result['status'] === 'stock_out') {
            return response($result, 200);  // Send the stock out response
        }
        return response(['status' => 'success', 'message' => 'Product Added To Cart Successfully'], 200);
    }


    function CartUpdateQty(Request $request)
    {
        return $this->cartService->cartUpdateQty($request);
    }

    /* Calc The product Total After increment of decrement the qty */
    function GetProductTotal($rowId)
    {
        $product = Cart::Get($rowId);
        $total = ($product->price + $product->options->variants_total) * $product->qty;
        return $total;
    }

    /* Calc Cart Total Products */
    function GetCartTotal()
    {
        $total = 0;
        foreach (Cart::content() as $product) {
            $total += $this->GetProductTotal($product->rowId);
        }
        return response(['total' => $total], 200);
    }

    function GetQuantityPrice(Request $request)
    {
        dd($request->all());
    }
    function ClearCart()
    {
        Cart::destroy();
        return response(['status' => 'success', 'message' => 'Cart Cleared Successfully'], 200);
    }

    function RemoveProduct($rowId)
    {
        Cart::remove($rowId);
        toastr()->success('Product Has Been Removed Successfully !');
        return redirect()->back();
    }

    function ShowCartCount()
    {
        $count =  Cart::content()->count();
        return response(['count' => $count], 200);
    }

    function fetchSidebarCartProduct()
    {
        $products = Cart::content();
        return response(['products' => $products], 200);
    }

    function RemoveCartProduct(Request $request)
    {
        $rowId = $request->rowId;
        if (!$rowId) {
            return response(['status' => 'error', 'message' => 'Row ID not found'], 400);
        }

        Cart::remove($rowId);
        return response(['status' => 'success', 'message' => 'Product Removed Successfully!'], 200);
    }

    public function ApplyCoupon(Request $request)
    {
        return $this->cartService->applyCoupon($request);
    }

    public function CalcCoupon()
    {
        return $this->cartService->calcCoupon();
    }
}
