<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashSale extends Model
{
    use HasFactory;

    protected $guarded = [];

    function FlashSaleItem(){
        return $this->hasOne(FlashSaleItem::class,'flash_sale_id');
    }
}
