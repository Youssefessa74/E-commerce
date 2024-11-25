<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    function category(){
        return $this->belongsTo(BlogCategory::class,'category_id');
    }

    function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    function comments(){
        return $this->hasMany(BlogComment::class,'blog_id');
    }
}
