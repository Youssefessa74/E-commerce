<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    function category()  {
        return $this->belongsTo(Category::class,'category_id');
    }
    function child_categories()  {
        return $this->hasMany(ChildCategory::class,'sub_category_id');
    }
}
