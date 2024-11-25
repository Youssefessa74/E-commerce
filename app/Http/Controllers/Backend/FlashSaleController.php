<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FlashSaleDataTable;
use App\DataTables\FlashSaleItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Product;
use Illuminate\Http\Request;


class FlashSaleController extends Controller
{
    function index(FlashSaleItemDataTable $flashSaleDataTable)  {
        $flashsale = FlashSale::first();
        $products = Product::where('is_approved',1)->where('status',1)->orderBy('id','DESC')->get();
        return $flashSaleDataTable->render('admin.flash-sale.index',compact('flashsale','products'));
    }

    function update(Request $request) {
        $request->validate([
            'end_date' => ['required'],
        ]);
        FlashSale::updateOrCreate(
            ['id' => 1],
            ['end_date'=> $request->end_date],
        );
        toastr('Data Saved Successfully');
        return redirect()->back();
    }

    function AddProduct(Request $request) {
   $request->validate([
    'product' => ['required','exists:products,id'],
    'status' => ['required','boolean'],
    'show_at_home' => ['required','boolean'],
   ],
      ['product.unique'=> 'This Product Exists Already']
    );
   $FlashSaleItem = new FlashSaleItem();
   $FlashSaleItem->product_id = $request->product;
   $FlashSaleItem->status = $request->status;
   $FlashSaleItem->flash_sale_id = $request->flash_sale_id;
   $FlashSaleItem->show_at_home = $request->show_at_home;
   $FlashSaleItem->save();

   toastr('Data Saved Successfully');
   return redirect()->back();
  }

  function ChangeStatus(Request $request) {
    $request->validate([
        'status' => ['required','boolean'],
    ]);
    $flash_sale = FlashSaleItem::findOrFail($request->id);
    $flash_sale->status = $request->status ;
    $flash_sale->save();
    return response(['status' => 'success'],200);

  }
  function ChangeShowAtHome(Request $request) {
    $request->validate([
        'show_at_home' => ['required','boolean'],
    ]);
    $flash_sale = FlashSaleItem::findOrFail($request->id);
    $flash_sale->show_at_home = $request->show_at_home ;
    $flash_sale->save();
    return response(['status' => 'success'],200);

    }

    function destroy($id){
        $flash_sale = FlashSaleItem::findOrFail($id);
        $flash_sale->delete();
        toastr('Data Deleted Successfully');
        return redirect()->back();
    }
}
