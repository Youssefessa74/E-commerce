<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    function product()  {
        return $this->belongsTo(Product::class,'product_id');
    }

   public function items()  {
        return $this->hasMany(ProductVariantItem::class,'product_variant_id');
    }

}
