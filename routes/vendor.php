<?php

use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorGalleryController;
use App\Http\Controllers\Backend\VendorMessengerController;
use App\Http\Controllers\Backend\VendorOrderController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProductGalleryController;
use App\Http\Controllers\Backend\VendorProductImagesController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorRequestWithDrawController;
use App\Http\Controllers\Backend\VendorVariantController;
use App\Http\Controllers\Backend\VendorVariantItemsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\VendotShopProfileController;

Route::get('/dashboard',[VendorController::class ,'dashboard'])->name('vendor.dashboard');

Route::controller(VendorProfileController::class)->group(function(){
    Route::get('/vendor-profile','VendorProfile')->name('vendor_profile');
    Route::put('/vendor-profile-update','UpdateVendorProfile')->name('vendor_profile_update');
    Route::post('/vendor-profile-update-password','UpdateVendorPassword')->name('vendor_profile_update_password');
});
Route::name('vendor.')->group(function(){
  // Vendor Shop Profile Routes
Route::resource('vendor-shop', VendotShopProfileController::class);

  // Product Routes
Route::get('reviews',[VendorProductController::class,'ProductReviews'])->name('reviews');
Route::put('product-change-status',[VendorProductController::class,'ProductChangeStatus'])->name('product_change_status');
Route::get('get-sub-categories/{category}',[VendorProductController::class,'GetSubCategories'])->name('get_sub_categories');
Route::get('get-child-categories/{sub_category}',[VendorProductController::class,'GetChildCategories'])->name('get_child_categories');
Route::resource('products', VendorProductController::class);

  // Product Images Routes
  Route::get('/gallery/{product}', [VendorGalleryController::class, 'index'])->name('gallery.index');
  Route::post('/gallery/store', [VendorGalleryController::class, 'store'])->name('gallery.store');
  Route::delete('/gallery/delete/{id}', [VendorGalleryController::class, 'destroy'])->name('gallery.destroy');

  // Product Variants Routes
  Route::get('/variant/{product}', [VendorVariantController::class, 'index'])->name('variant.index');
 Route::get('/variant/create/{product}', [VendorVariantController::class, 'create'])->name('variant.create');
 Route::post('/variant/store', [VendorVariantController::class, 'store'])->name('variant.store');
 Route::put('/variant-change-status', [VendorVariantController::class, 'VariantChangeStatus'])->name('variant_change_status');
 Route::delete('/variant/delete/{id}', [VendorVariantController::class, 'destroy'])->name('variant.destroy');

  // Product Variant Items Routes
Route::get('/variant-item/{product}/{variant}',[VendorVariantItemsController::class,'index'])->name('variant.item.index');
Route::get('/variant-item/create/{product}/{variant}',[VendorVariantItemsController::class,'create'])->name('variant.item.create');
Route::post('/variant-item/store',[VendorVariantItemsController::class,'store'])->name('variant.item.store');
Route::get('/variant-item/edit/{product}/{variant}/{id}',[VendorVariantItemsController::class,'edit'])->name('variant.item.edit');
Route::put('/variant-item/update/{id}',[VendorVariantItemsController::class,'update'])->name('variant.item.update');
Route::delete('/variant-item/delete/{id}',[VendorVariantItemsController::class,'destroy'])->name('variant.item.destroy');

// Orders Routes
Route::put('order-change-status',[VendorOrderController::class,'OrderChangeStatus'])->name('order.change.status');
Route::get('orders',[VendorOrderController::class,'index'])->name('orders.index');
Route::get('order/show/{id}',[VendorOrderController::class,'OrderShow'])->name('order.show');

// Request WithDraw
Route::get('show-withdraw-request/{id}',[VendorRequestWithDrawController::class,'ShowWithDrawRequest'])->name('show.withdraw.request');
Route::resource('request-with-draw',VendorRequestWithDrawController::class);
  // Messenger Routes
  Route::controller(VendorMessengerController::class)->group(function(){
    Route::get('messenger','index')->name('messenger.index');
    Route::get('fetch-user-chat','FetchUserChat')->name('fetch.user.chat');
    Route::post('send-message','SendMessage')->name('send.message');
});
});




