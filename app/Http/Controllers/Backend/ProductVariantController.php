<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,ProductVariantDataTable $productVariantDataTable)
    {
        $product = Product::findOrFail($request->product);
        return $productVariantDataTable->render('admin.products.variant.index',['product'=>$product]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $product = Product::findOrFail($request->product);
        return view('admin.products.variant.create',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
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
       return to_route('admin.variant.index',['product'=>$request->product_id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $variant = ProductVariant::findOrFail($id);
        return view('admin.products.variant.edit',compact('variant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required','max:255'],
            'product_id' => ['required','integer','exists:products,id'],
            'status' => ['required','boolean'],
           ]);

           $product_variant =  ProductVariant::findOrFail($id);
           $product_variant->name = $request->name;
           $product_variant->status = $request->status;
           $product_variant->product_id = $request->product_id;
           $product_variant->save();
           toastr('Data Saved Successfully');
           return to_route('admin.variant.index',['product'=>$product_variant->product_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
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
