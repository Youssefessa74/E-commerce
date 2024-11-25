<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    use HasFactory;

    function category()  {
        return $this->belongsTo(Category::class,'category_id');
    }
    function SubCategory()  {
        return $this->belongsTo(Subcategory::class,'sub_category_id');
    }
}
