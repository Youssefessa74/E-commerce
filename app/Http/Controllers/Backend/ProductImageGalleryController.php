<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductImageGalleryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Traits\upload_file;
use Illuminate\Http\Request;

class ProductImageGalleryController extends Controller
{
    use upload_file;
    public function index(Request $request, ProductImageGalleryDataTable $productImageGalleryDataTable)
    {
        $product = Product::findOrFail($request->product);
        return $productImageGalleryDataTable->render('admin.products.gallery.index',['product'=>$product]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'images' => ['required', 'array'],
            'images.*' => ['file', 'max:2048'], // Each image should be a file and limited to 2MB
            'product_id' => ['required', 'integer', 'exists:products,id']
        ]);
        $images = $this->UploadMultiFile($request,'images','uploads');
        foreach($images as $image){
          $productImageGallery = new ProductImageGallery();
          $productImageGallery->image = $image;
          $productImageGallery->product_id = $request->product_id;
          $productImageGallery->save();
        }

        toastr('Data Saved Successfully');
        return redirect()->back();
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ProductImage = ProductImageGallery::findOrFail($id);
        $this->removeFile($ProductImage->image);
        $ProductImage->delete();
        toastr('Data Saved Successfully');
        return redirect()->back();
    }
}
