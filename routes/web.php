<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Frontend\AddressController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\FrontEnd\MessengerController;
use App\Http\Controllers\Frontend\NewLettersController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\PagesController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\TrackOrderController;
use App\Http\Controllers\FrontEnd\UserVendorRequestController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/clear', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
});

Route::controller(HomeController::class)->group(function(){
    Route::get('show-product-modal/{id}','ShowProductModal')->name('show.product.modal');
    Route::get('/', 'index')->name('home');
});

 // User Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('admin/login',[AdminController::class,'AdminLogin'])->name('admin.login');
Route::post('admin/login/store',[AdminController::class,'store'])->name('admin.login.auth');

// Flash Sale Routes
Route::controller(FlashSaleController::class)->group(function(){
    Route::get('flash-sale','index')->name('flash.sale.page');
});


// Product Routes
Route::controller(ProductController::class)->group(function(){
    Route::get('products','ProductsPage')->name('products.page');
    Route::get('product-details/{slug}','showProduct')->name('show.product.details');
    Route::get('change-product-list-view','ChangeProductListView')->name('change.product.list.view');
    Route::post('product-review','ProductReview')->name('product.review');
});

/* Cart Routes */
Route::controller(CartController::class)->group(function(){
    Route::post('add-to-cart','AddToCart')->name('add.to.cart');
    Route::get('cart-details','CartDetailsPage')->name('show.cart.details');
    Route::post('cart-update-qty','CartUpdateQty')->name('cart.update.qty');
    Route::post('cart-clear-cart','ClearCart')->name('clear.cart');
    Route::get('cart-remove-product/{rowId}','RemoveProduct')->name('cart.remove.product');
    Route::get('show-cart-count','ShowCartCount')->name('show.cart.count');
    Route::get('get-sidebar-cart-products','fetchSidebarCartProduct')->name('get.sidebar.cart.products');
    Route::post('remove-sidecart-product','RemoveCartProduct')->name('remove.side.cart.product');
    Route::get('get-cart-total','GetCartTotal')->name('get.cart.total');
    Route::get('get-quantity-price','GetQuantityPrice')->name('get.quantity.price');
    // Coupon Routes
    Route::get('apply-coupon','ApplyCoupon')->name('apply.coupon');
    Route::get('calc-coupon','CalcCoupon')->name('calc.coupon');
});

//Vendors Page
Route::get('vendors',[HomeController::class,'VendorsPage'])->name('vendors.page');
Route::get('vendor-products/{vendor}',[HomeController::class,'VendorProducts'])->name('vendor.products');


// User Routes
Route::group(['middleware'=>['auth','verified','role:user']],function(){
    Route::get('/dashboard',[UserProfileController::class,'index'])->name('dashboard');
    Route::get('/user-profile',[UserProfileController::class,'MyProfile'])->name('user_profile');
    Route::put('/user-profile-update',[UserProfileController::class,'UpdateUserProfile'])->name('update_user_profile');
    Route::post( '/user-profile-update-password',[UserProfileController::class,'UpdateUserPassword'])->name('update_user_password');
    // User Reviews Routes
    Route::get('user-reviews',[UserProfileController::class,'UserReviews'])->name('user.reviews');
    // Address Routes
    Route::resource('address',AddressController::class);
    // Orders Routes
    Route::get('orders',[OrderController::class,'index'])->name('user.orders.index');
    Route::get('order/show/{id}',[OrderController::class,'OrderShow'])->name('user.order.show');
    // Request To be A vendor routes
    Route::get('vendor-request',[UserVendorRequestController::class,'index'])->name('vendor.request');
    Route::post('vendor-request-create',[UserVendorRequestController::class,'create'])->name('vendor.request.create');

});

// Pages Routes
Route::controller(PagesController::class)->group(function(){
    Route::get('about','about')->name('about');
    Route::get('terms-conditions','termsConditions')->name('terms_and_conditions');
    Route::get('contact','contact')->name('contact');
    Route::post('send-contact-mail','SendContactMail')->name('send.contact.mail');

});

// Track Order Routes
Route::controller(TrackOrderController::class)->group(function(){
    Route::get('order-track','index')->name('order.track.index');
});

// Blog Routes
Route::get('blog-details/{slug}',[BlogController::class,'index'])->name('blog.details');
Route::get('blogs',[BlogController::class,'blogs'])->name('blogs');
Route::get('blog-suggestions', [BlogController::class, 'Suggestions'])->name('blog.suggestions');
Route::post('blog-comment',[BlogController::class,'BlogComment'])->name('blog.comment')->middleware('auth');


// New Letters Routes
Route::post('newsletters-subscribe',[NewLettersController::class,'Subscribe'])->name('newsletters.subscribe');
Route::get('newsletters-verify/{token}',[NewLettersController::class,'SubscribeVerify'])->name('subscribe.verify');


Route::group(['middleware'=>['auth','verified']],function(){
     //Check out Routes
     Route::controller(CheckoutController::class)->group(function(){
         Route::get('checkout','index')->name('checkout.index');
        Route::post('checkout-create-address','CreateNewAddress')->name('checkout.create.address');
        Route::post('checkout','Checkout')->name('checkout');
    });
    // Payment Routes
    Route::controller(PaymentController::class)->group(function(){
        Route::get('payment','index')->name('payment.page');
        // Paypal Routes
        Route::get('pay-with-paypal','PayWithPaypal')->name('pay.with.paypal');
        Route::get('paypal-success','PaypalSuccess')->name('paypal.success');
        Route::get('paypal-cancel','PaypalCancel')->name('paypal.cancel');
        // End Paypal Routes
        // Stripe routes
        Route::get('pay-with-stripe','PayWithStripe')->name('pay.with.stripe');
        // End Stripe Routes
        Route::get('payment-success','PaymentSuccess')->name('payment.success');
        // Cash On Delivery
        Route::get('cash-on-delivery-submit','CashOnDelivery')->name('cash.on.delivery.submit');
        // Wishlist Routes
        Route::controller(WishlistController::class)->group(function(){
            Route::get('wishlist','index')->name('wishlist');
            Route::get('add-to-wishlist','AddToWishlist')->name('add.to.wishlist');
            Route::get('delete-wishlist-product/{id}','destroy')->name('delete.wishlist.product');
        });

    });
    // Messenger Routes
    Route::controller(MessengerController::class)->group(function(){
        Route::get('messenger','index')->name('messenger.index');
        Route::post('send-fast-message','SendMessageFromProductPage')->name('send.fast.message');
        Route::get('fetch-user-chat','FetchUserChat')->name('fetch.user.chat');
        Route::post('send-message','SendMessage')->name('send.message');

    });
});
