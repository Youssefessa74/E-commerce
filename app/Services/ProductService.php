<?php
namespace App\Services;

use App\Models\OrderProduct;
use App\Models\Product as ProductModel;
use App\Models\ProductImageGallery;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use App\Traits\upload_file;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductService
{
    use upload_file;
    public function storeProduct($request)
    {
        $product = new ProductModel();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->child_category_id = $request->child_category;
        $product->brand_id = $request->brand;

        // Assuming you have a method to upload files, handle the file upload here
        $product->thumb_image = $this->uploadFile($request, 'thumb_image');

        $product->qty = $request->qty;
        $product->short_info = $request->short_info;
        $product->long_info = $request->long_info;
        $product->video_link = $request->video_link;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->is_approved = 1;
        $product->product_type = $request->product_type;
        $product->is_featured = $request->is_featured;
        $product->status = $request->status;
        $product->seo_info = $request->seo_info;
        $product->seo_title = $request->seo_title;
        $product->save();
        return $product;
    }

    public function updateProduct($request,$id)
    {
        $product = ProductModel::findOrFail($id);
        $image = $this->uploadFile($request,'thumb_image',$product->thumb_image);
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->child_category_id = $request->child_category;
        $product->brand_id = $request->brand;
        $product->thumb_image = isset($image) ? $image : $product->thumb_image;
        $product->qty = $request->qty;
        $product->short_info = $request->short_info;
        $product->long_info = $request->long_info;
        $product->video_link = $request->video_link;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->product_type = $request->product_type;
        $product->is_featured = $request->is_featured;
        $product->status = $request->status;
        $product->seo_info = $request->seo_info;
        $product->seo_title = $request->seo_title;
        $product->save();
        return $product;
    }

    public function destroyProduct($id){
         $product = ProductModel::findOrFail($id);
         if(OrderProduct::where('product_id',$product->id)->count() > 0){
            toastr('This Product Has Been Ordered By Clients ,you can not delete it ','error');
            return redirect()->back();
         }
        // let's delete the images related to this product
        $gallery_images = ProductImageGallery::where('product_id',$product->id)->get();
        foreach($gallery_images as $image){
            $this->removeFile($image->image);
            $image->delete();
        }
         // let's delete the product image before we delete the product it self
        $this->removeFile($product->thumb_image);
        // let's delete the variants of the product if exists
        $variants = ProductVariant::where('product_id',$product->id)->get();
        foreach($variants as $variant){
          $variant->items()->delete();
          $variant->delete();
        }
        $product->delete();
        toastr("Data Saved Successfully");
    }

}


