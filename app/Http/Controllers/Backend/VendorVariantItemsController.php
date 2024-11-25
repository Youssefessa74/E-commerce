<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorVariantItemsController extends Controller
{
    function index(Product $product ,ProductVariant $variant){
        $variantItems = $variant->items;
        if ($product->vendor_id != Auth::user()->vendor->id) {
            return abort('404','Un authorized');
        }
        return view('vendor.products.variants.variant-items.index',compact('product','variant','variantItems'));
    }
    function create(Product $product ,ProductVariant $variant){
        return view('vendor.products.variants.variant-items.create',compact('product','variant'));
    }

    public function store(Request $request)
    {
       $request->validate([
        'product_variant_id' => ['required','integer'],
        'name' => ['required','max:200'],
        'price'=>['required','integer'],
        'is_default'=>['required'],
        'status' => ['required'],
       ]);

       $variant_item = new ProductVariantItem();
       $variant_item->product_variant_id = $request->product_variant_id;
       $variant_item->name = $request->name;
       $variant_item->price = $request->price;
       $variant_item->status = $request->status;
       $variant_item->is_default = $request->is_default;
       $variant_item->save();
       toastr('Data Saved Successfully');
       return to_route('vendor.variant.item.index',['product'=>$request->product_id,'variant'=>$request->product_variant_id]);
    }

    public function edit(Product $product ,ProductVariant $variant,$id){
        $variant_item = ProductVariantItem::findOrFail($id);
        return view('vendor.products.variants.variant-items.edit',compact('product','variant','variant_item'));
    }



    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required','max:200'],
            'price'=>['required','integer'],
            'is_default'=>['required'],
            'status' => ['required'],
           ]);

           $variant_item =  ProductVariantItem::findOrFail($id);
           $variant_item->name = $request->name;
           $variant_item->price = $request->price;
           $variant_item->status = $request->status;
           $variant_item->is_default = $request->is_default;
           $variant_item->save();
           toastr('Data Saved Successfully');
           return to_route('vendor.variant.item.index',['product'=>$request->product_id,'variant'=>$request->product_variant_id]);
    }

    public function destroy(string $id)
    {
        $variant_item =  ProductVariantItem::findOrFail($id);
        $variant_item->delete();
        toastr('Data Saved Successfully');
        return redirect()->back();
    }

}
