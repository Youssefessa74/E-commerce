<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorVariantController extends Controller
{
    function index(Product $product){
        if (!$product) {
            return redirect()->back()->withErrors('Product not found');
        }
        if ($product->vendor_id != Auth::user()->vendor->id) {
            return abort('404','Un authorized');
        }

        $variants = $product->variants;
       // dd($variants);
        return view('vendor.products.variants.index', compact('product', 'variants'));
    }

    function create(Product $product){

        return view('vendor.products.variants.create',compact('product'));
    }

    public function store(Request $request)
    {
       $request->validate([
        'name' => ['required','max:255'],
        'product_id' => ['required','integer','exists:products,id'],
        'status' => ['required','boolean'],
       ]);

       $product_variant = new ProductVariant();
       $product_variant->name = $request->name;
       $product_variant->status = $request->status;
       $product_variant->product_id = $request->product_id;
       $product_variant->save();
       toastr('Data Saved Successfully');
       return to_route('vendor.variant.index',['product'=>$request->product_id]);
    }

    function VariantChangeStatus(Request $request) {
        $variant = ProductVariant::findOrFail($request->id);
        $variant->status = !$request->status;
        $variant->save();
        return response()->json(['status'=>'success'],200);
     }

     public function destroy(string $id)
     {
         $product_variant =  ProductVariant::findOrFail($id);
         $variant_items = $product_variant->items()->count();
        if($variant_items > 0){
         toastr()->error('You Can not delete This variant unless you delete its items');
         return redirect()->back();
        }
         $product_variant->delete();
         toastr('Data Saved Successfully');
         return redirect()->back();
     }
}
