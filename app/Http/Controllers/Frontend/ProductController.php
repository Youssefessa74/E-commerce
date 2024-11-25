<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Adeverisment;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    function ProductsPage(Request $request)
    {
        // Default query
        $products = Product::where(['status' => 1, 'is_approved' => 1]);

        // Modify the query if specific parameters are provided
        if ($request->has('category')) {
            $category = Category::where('slug', $request->category)->firstOrFail();
            if ($category) {
                $products = $products->where('category_id', $category->id);
            }
        }

        if ($request->has('sub_category')) {
            $sub_category = Subcategory::where('slug', $request->sub_category)->firstOrFail();
            if ($sub_category) {
                $products = $products->where('sub_category_id', $sub_category->id);
            }
        }

        if ($request->has('child_category')) {
            $child_category = ChildCategory::where('slug', $request->child_category)->firstOrFail();
            if ($child_category) {
                $products = $products->where('child_category_id', $child_category->id);
            }
        }

        if ($request->has('brand')) {
            $brand = Brand::where('slug', $request->brand)->firstOrFail();
            $products = Product::where('brand_id', $brand->id);
        }

        if ($request->has('search')) {
            $products = Product::where(['status' => 1, 'is_approved' => 1])->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('long_info', 'like', '%' . $request->search . '%')
                    ->orWhereHas('category', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->search . '%');
                    });
            });
        }

        $products = $products->with(['productReviews', 'category', 'variants.items'])->when($request->has('range'), function ($query) use ($request) {
            $price = explode(';', $request->range);
            $from = $price[0];
            $to = $price[1];
            return $query->where('price', '>=', $from)->where('price', '<=', $to);
        })
        ->paginate(12);
        
        $brands = Brand::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $product_page_banner_section = Adeverisment::where('key', 'product_page_banner_section')->first();
        $product_page_banner_section = json_decode($product_page_banner_section?->value);
        return view('frontend.pages.products', compact('products', 'categories', 'brands', 'product_page_banner_section'));
    }

    function showProduct($slug)
    {
        $product = Product::withAvg('productReviews', 'rating')->with(['brand', 'variants', 'gallery', 'vendor'])->where('slug', $slug)->where('status', 1)->first();
        $productReviews = ProductReview::where(['product_id'=>$product->id,'status'=>1])->paginate(4);
        return view('frontend.pages.product-details', compact('product','productReviews'));
    }

    function ChangeProductListView(Request $request)
    {
        Session::put('product_style_list', $request->id);
    }

    function ProductReview(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'vendor_id' => ['required', 'integer', 'exists:vendors,id'],
            'review' => ['max:1000'],
            'rating' => ['required', 'integer', 'max:5'],
        ]);

        if ($request->rating == 0) {
            return response(['status' => 'error', 'message' => 'You have to choose a rating from 1 to 5'], 403);
        }

        // Check if the user has purchased the product
        $hasPurchased = Order::where('user_id', $request->user_id)
            ->whereHas('OrderProducts', function ($query) use ($request) {
                $query->where('product_id', $request->product_id);
            })
            ->exists();


        if (!$hasPurchased) {
            return response(['status' => 'error', 'message' => 'You can only review products you have purchased'], 403);
        }

        // Check if the product is already reviewed by the user
        $is_reviewed = ProductReview::where([
            'product_id' => $request->product_id,
            'user_id' => $request->user_id,
        ])->exists();

        if ($is_reviewed) {
            return response(['status' => 'error', 'message' => 'You already reviewed this product'], 403);
        }

        // Save the review
        $review = new ProductReview();
        $review->product_id = $request->product_id;
        $review->user_id = $request->user_id;
        $review->vendor_id = $request->vendor_id;
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->status = 0;
        $review->save();

        return response(['status' => 'success', 'message' => 'Your review has been submitted and is awaiting approval'], 200);
    }
}
