<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class ProductVariantItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,ProductVariantItemDataTable $productVariantItemDataTable)
    {
        $variant = ProductVariant::findOrFail($request->variant);
      return  $productVariantItemDataTable->render('admin.products.variant.items.index',['variant'=>$variant]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $variant = ProductVariant::findOrFail($request->variant);
        return view('admin.products.variant.items.create',compact('variant'));
    }

    /**
     * Store a newly created resource in storage.
     */
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
       return to_route('admin.variant-item.index',['variant'=>$request->product_variant_id]);
    }

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $variant_item = ProductVariantItem::findOrFail($id);
        return view('admin.products.variant.items.edit',compact('variant_item'));
    }

    /**
     * Update the specified resource in storage.
     */
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
           return to_route('admin.variant-item.index',['variant'=>$request->product_variant_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $variant_item =  ProductVariantItem::findOrFail($id);
        $variant_item->delete();
        toastr('Data Saved Successfully');
        return redirect()->back();
    }
}
