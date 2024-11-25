<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Traits\upload_file;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorGalleryController extends Controller
{
    use upload_file;
    public function index(Product $product)
    {
        if (!$product) {
            return redirect()->back()->withErrors('Product not found');
        }
        // Check Product Vendor if is he or not
        if ($product->vendor_id != Auth::user()->vendor->id) {
            return abort('404','Un authorized');
        }

        $images = $product->gallery;
        return view('vendor.products.gallery.index', compact('product', 'images'));
    }

    public function store(Request $request){
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

    public function destroy(string $id)
    {
        $ProductImage = ProductImageGallery::findOrFail($id);
        // Check Product Vendor if is he or not
        if($ProductImage->product->id !=Auth::user()->vendor->id){
            return abort('404');
        }
        $this->removeFile($ProductImage->image);
        $ProductImage->delete();
        toastr('Data Saved Successfully');
        return redirect()->back();
    }


}
