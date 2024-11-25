<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Adeverisment;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\HomePageSetting;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Subcategory;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    function index()
    {
        $sliders = Cache::rememberForever('sliders',function(){
           return Slider::where('status', 1)->orderBy('serial', 'asc')->get();
        });
        $flashSaleDate = FlashSale::first();
        $flashSaleItems = FlashSaleItem::where('show_at_home', 1)->where('status', 1)->pluck('product_id')->toArray();
        $popularCategories = HomePageSetting::where('key', 'popular_category_settings')->first();
        $brands = Brand::where('status', 1)->get();
        $typeProducts = $this->GetProductType();
        $blogs = Blog::with(['user','category'])->where('status', 1)->take(5)->get();

        $product_slider_section_one = HomePageSetting::where('key', 'product-slider-section-one')->first();
        $product_slider_section_two = HomePageSetting::where('key', 'product-slider-section-two')->first();
        $product_slider_section_three = HomePageSetting::where('key', 'product-slider-section-three')->first();

        $homepage_secion_banner_one = Adeverisment::where('key', 'home_page_section_one')->first();
        $homepage_secion_banner_one = json_decode($homepage_secion_banner_one?->value);

        $homepage_secion_banner_two = Adeverisment::where('key', 'home_page_section_two')->first();
        $homepage_secion_banner_two = json_decode($homepage_secion_banner_two?->value);

        $homepage_secion_banner_three = Adeverisment::where('key', 'home_page_section_three')->first();
        $homepage_secion_banner_three = json_decode($homepage_secion_banner_three?->value);

        return view('frontend.home.index', compact(
            'sliders',
            'flashSaleDate',
            'flashSaleItems',
            'popularCategories',
            'brands',
            'typeProducts',
            'product_slider_section_one',
            'product_slider_section_two',
            'product_slider_section_three',
            'homepage_secion_banner_one',
            'homepage_secion_banner_two',
            'homepage_secion_banner_three',
            'blogs',
        ));
    }
    function GetProductType()
    {
        $typeProduct = [];
        $commonRelations = [
            'productReviews',
            'category',
            'gallery',
            'variants.items' // Eager load both variants and their items
        ];

        $typeProduct['new_arrival'] = Product::withAvg('productReviews', 'rating')
            ->with($commonRelations)
            ->where(['product_type' => 'new_arrival', 'is_approved' => 1, 'status' => 1])
            ->orderBy('id', 'DESC')
            ->take(8)
            ->get();

        $typeProduct['best_product'] = Product::withAvg('productReviews', 'rating')
            ->with($commonRelations)
            ->where(['product_type' => 'best_product', 'is_approved' => 1, 'status' => 1])
            ->orderBy('id', 'DESC')
            ->take(8)
            ->get();

        $typeProduct['top_product'] = Product::withAvg('productReviews', 'rating')
            ->with($commonRelations)
            ->where(['product_type' => 'top_product', 'is_approved' => 1, 'status' => 1])
            ->orderBy('id', 'DESC')
            ->take(8)
            ->get();

        $typeProduct['featured_product'] = Product::withAvg('productReviews', 'rating')
            ->with($commonRelations)
            ->where(['product_type' => 'featured_product', 'is_approved' => 1, 'status' => 1])
            ->orderBy('id', 'DESC')
            ->take(8)
            ->get();

        return $typeProduct;
    }


    function VendorsPage()
    {
        $vendors = Vendor::where('status', 1)->paginate(10);
        return view('frontend.pages.vendors', compact('vendors'));
    }

    function VendorProducts(Request $request)
    {
        // Default query
        $products = Product::where(['status' => 1, 'is_approved' => 1, 'vendor_id' => $request->vendor]);

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

        $products = $products->when($request->has('range'), function ($query) use ($request) {
            $price = explode(';', $request->range);
            $from = $price[0];
            $to = $price[1];
            return $query->where('price', '>=', $from)->where('price', '<=', $to);
        })
            ->paginate(12);
        $brands = Brand::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $vendor = Vendor::findOrFail($request->vendor);
        return view('frontend.pages.vendor-products', compact('products', 'categories', 'brands', 'vendor'));
    }

    function ShowProductModal($id)
    {
        $product = Product::findOrFail($id);
        $content =  view('frontend.layout.modal', compact('product'))->render();
        return Response::make($content, 200, ['Content-Type' => 'text/html']);
    }
}
