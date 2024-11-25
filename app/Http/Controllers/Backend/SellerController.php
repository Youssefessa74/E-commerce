<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\PendingSellerProductDataTable;
use App\DataTables\SellerProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    function index(SellerProductDataTable $sellerProductDataTable){
        return $sellerProductDataTable->render('admin.products.sellers.index');
    }

    function PendingSellerProductsIndex(PendingSellerProductDataTable $pendingSellerProductDataTable)  {
        return $pendingSellerProductDataTable->render('admin.products.sellers.pending_seller_products');
    }

    function ChangeSellerProductStatus(Request $request)  {
        $request->validate([
            'is_approved' => ['boolean','required'],
        ]);
        $product = Product::findOrFail($request->id);
        $product->is_approved = $request->is_approved;
        $product->save();
        return response()->json(['status'=>'success'],200);
    }
}
