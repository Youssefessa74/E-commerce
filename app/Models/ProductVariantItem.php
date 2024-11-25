<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantItem extends Model
{
    use HasFactory;

    function ProductVariant()  {
        return $this->belongsTo(ProductVariant::class,'product_variant_id');
    }
}
