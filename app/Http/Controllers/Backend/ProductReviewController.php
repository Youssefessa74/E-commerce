<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductReviewDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    function index(ProductReviewDataTable $productReviewDataTable, $product){
        $product = Product::findOrFail($product);
        return $productReviewDataTable->render('admin.products.reviews.index',compact('product'));
    }

    function ChangeStatus(Request $request) {
       // dd($request->all());
        $request->validate([
            'status' => ['required','boolean'],
        ]);
        $review = ProductReview::findOrFail($request->id);
        $review->status = $request->status;
        $review->save();
        return response(['status' => 'success'],200);
      }
}
