<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    function vendor() {
        return $this->belongsTo(Vendor::class,'vendor_id');
    }

    function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    function gallery()  {
        return $this->hasMany(ProductImageGallery::class,'product_id');
    }

    function variants()  {
        return $this->hasMany(ProductVariant::class,'product_id');
    }

    function FlashSale() {
        return $this->belongsTo(FlashSaleItem::class,'product_id');
    }

    function brand() {
        return $this->belongsTo(Brand::class,'brand_id');
    }

    function productReviews(){
        return $this->hasMany(ProductReview::class,'product_id');
    }
}
