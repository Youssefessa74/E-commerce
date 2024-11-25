<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    function SubCategories()  {
        return $this->hasMany(Subcategory::class,'category_id');
    }
    function ChildCategories()  {
        return $this->hasMany(ChildCategory::class,'category_id');
    }
}
