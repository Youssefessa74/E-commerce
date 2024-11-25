<?php
use App\Http\Controllers\Backend\AdeverismentController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminListController;
use App\Http\Controllers\Backend\AdminMessengerController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\AdminWithDrawRequestsController;
use App\Http\Controllers\Backend\BlogCategoryController;
use App\Http\Controllers\Backend\BlogCommentController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CashOnDeliveryContoller;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\CustomerListController;
use App\Http\Controllers\Backend\FlashSaleController;
use App\Http\Controllers\Backend\FooterInfoController;
use App\Http\Controllers\Backend\FooterSocialController;
use App\Http\Controllers\Backend\HomePageSettingController;
use App\Http\Controllers\Backend\ManageUserController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PagesController;
use App\Http\Controllers\Backend\PaymentSettingController;
use App\Http\Controllers\Backend\PaypalSettingController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductReviewController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\SellerController;
use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\Backend\ShippingRuleController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\StripeSettingController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\Backend\SubscribersController;
use App\Http\Controllers\Backend\TransactionController;
use App\Http\Controllers\Backend\VendorListController;
use App\Http\Controllers\Backend\VendorRequestController;
use App\Http\Controllers\Backend\VendorWithDrawController;
use Illuminate\Support\Facades\Route;

// Admin Profile Routes
Route::controller(AdminController::class)->group(function () {
    Route::get('/dashboard', 'dashboard')->name('admin.dashboard');
    Route::get('/profile', 'profile')->name('admin.profile');
    Route::post('/profile/update', 'ProfileUpdate')->name('admin.profile.update');
    Route::post('/profile/update-passoword', 'ProfileUpdatePassword')->name('admin.update.password');
});

Route::name('admin.')->group(function () {
    // Slider Routes
    Route::resource('sliders', SliderController::class);

    // Category Routes
    Route::put('category-change-status', [CategoryController::class, 'ChangeStatus'])->name('category_change_status');
    Route::resource('category', CategoryController::class);

    // Sub Category Routes
    Route::put('sub-category-change-status', [SubcategoryController::class, 'ChangeStatus'])->name('sub_category_change_status');
    Route::resource('sub-category', SubcategoryController::class);

    // Child Category Routes
    Route::put('child-category-change-status', [ChildCategoryController::class, 'ChangeStatus'])->name('child_category_change_status');
    Route::get('get-sub-categories/{category}', [ChildCategoryController::class, 'GetSubCategories'])->name('get_sub_categories');
    Route::resource('child-category', ChildCategoryController::class);

    // Brand Routes
    Route::resource('brands', BrandController::class);

    // Vendor Profile Routes
    Route::resource('profile/vendor', AdminVendorProfileController::class);

    // Product Routes
    Route::get('get-child-categories/{sub_category}', [ProductController::class, 'GetChildCategories'])->name('get_child_categories');
    Route::put('get-product-status', [ProductController::class, 'GetProductStatus'])->name('get_product_status');
    Route::resource('products', ProductController::class);
    // Product Review Routes
    Route::get('product-reviews/{product}',[ProductReviewController::class,'index'])->name('product.reviews');
    Route::put('review-change-status',[ProductReviewController::class,'ChangeStatus'])->name('review.change.status');

    // Product Gallery Routes
    Route::resource('product/gallery', ProductImageGalleryController::class);

    // Product Variant Routes
    Route::resource('product/variant', ProductVariantController::class);

    // Product Variant Item Routes
    Route::resource('product/variant-item', ProductVariantItemController::class);

    // Vendor Requests Routes
    Route::get('vendor-requests',[VendorRequestController::class,'index'])->name('vendor.requests');
    Route::get('vendor-request-show/{id}',[VendorRequestController::class,'show'])->name('vendor.request.show');
    Route::put('vendor-requests-status/{id}',[VendorRequestController::class,'ChangeStatus'])->name('vendor.requests.change.status');
    Route::get('vendor-request-conditions',[VendorRequestController::class,'VendorCondition'])->name('vendor.request.conditions');
    Route::put('vendor-request-condition-submit',[VendorRequestController::class,'VendorConditionSubmit'])->name('vendor.request.conditions.submit');
    // Customer List
    Route::put('customers-change-status',[CustomerListController::class,'ChangeStatus'])->name('customers.change.status');
    Route::get('customers',[CustomerListController::class,'index'])->name('customer.list');

    // Vendor List
    Route::put('vendor-list-change-status',[VendorListController::class,'ChangeStatus'])->name('vendor.list.change.status');
    Route::get('vendor-list',[VendorListController::class,'index'])->name('vendor.list');

    // Admin List
     Route::put('admin-list-change-status',[AdminListController::class,'ChangeStatus'])->name('admin.list.change.status');
     Route::get('admin-list',[AdminListController::class,'index'])->name('admin.list');
     Route::delete('admin-list-delete/{id}',[AdminListController::class,'destroy'])->name('admin.list.destroy');

     // Blog Routes
     Route::resource('blog-category',BlogCategoryController::class);
     Route::put('blog-change-status',[BlogController::class,'ChangeStatus'])->name('blog.change.status');
     Route::resource('blogs',BlogController::class);
     // Blog Comment Routes
     Route::resource('blog-comment',BlogCommentController::class);


    //Pages Routes
    Route::get('about',[PagesController::class,'about'])->name('about.index');
    Route::put('about-update',[PagesController::class,'updateAbout'])->name('about.update');
    Route::get('terms-condition',[PagesController::class,'TermsAndConditions'])->name('terms.and.condition');
    Route::put('terms-condition-update',[PagesController::class,'TermsAndConditionsUpdate'])->name('terms.and.condition.update');
    // Product Seller Item Routes
    Route::get('sellers', [SellerController::class, 'index'])->name('seller.index');
    Route::get('pending-sellers', [SellerController::class, 'PendingSellerProductsIndex'])->name('pending.seller.index');
    Route::put('sellers-change-status', [SellerController::class, 'ChangeSellerProductStatus'])->name('change_seller_status');

    // Flash Sale Routes
    Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash.sale.index');
    Route::put('flash-sale', [FlashSaleController::class, 'update'])->name('flash.sale.update');
    Route::post('flash-sale-add-product', [FlashSaleController::class, 'AddProduct'])->name('flash.sale.add.product');
    Route::put('flash-sale-change-status', [FlashSaleController::class, 'ChangeStatus'])->name('flash.sale.change.status');
    Route::put('flash-sale-change-show-at-home', [FlashSaleController::class, 'ChangeShowAtHome'])->name('flash.sale.change.show.at.home');
    Route::delete('flash-sale-delete/{id}', [FlashSaleController::class, 'destroy'])->name('flash.sale.destroy');

    // Coupon Routes
    Route::put('coupon-change-status', [CouponController::class, 'ChangeStatus'])->name('coupon.change.status');
    Route::resource('coupon', CouponController::class);

    // Shipping Rule Routes
    Route::put('shipping-rule-change-status', [ShippingRuleController::class, 'ChangeStatus'])->name('shipping-rule.change.status');
    Route::resource('shipping-rule', ShippingRuleController::class);

    // Orders Routes

    Route::get('pending-orders',[OrderController::class,'PendingOrders'])->name('pending.orders');
    Route::get('processed-and-ready-to-ship-orders',[OrderController::class,'ProcessedAndReadyToShip'])->name('processed_and_ready_to_ship_orders.orders');
    Route::get('dropped-off-orders',[OrderController::class,'DroppedOff'])->name('dropped_off.orders');
    Route::get('shipped-orders',[OrderController::class,'ShippedOrders'])->name('shipped.orders');
    Route::get('out-for-delivery-orders',[OrderController::class,'OutForDeliveryOrders'])->name('out_for_delivery.orders');
    Route::get('delivered-orders',[OrderController::class,'DeliveredOrders'])->name('delivered.orders');
    Route::get('canceled-orders',[OrderController::class,'CanceledOrders'])->name('canceled.orders');
    Route::put('payment-change-status',[OrderController::class,'PaymentChangeStatus'])->name('payment.change.status');
    Route::put('order-change-status',[OrderController::class,'OrderChangeStatus'])->name('order.change.status');
    Route::resource('orders',OrderController::class);

    // Settings Routes
    Route::get('general-settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('general-settings-update', [SettingsController::class, 'GeneralSettingUpdate'])->name('general.settings.update');
    Route::put('mail-configuration', [SettingsController::class, 'MailConfigurationUpdate'])->name('mail.configuration');
    Route::put('logo-settings', [SettingsController::class, 'UpdateLogoSettings'])->name('update.logo.settings');
    Route::put('pusher-settings', [SettingsController::class, 'PusherSettings'])->name('update.pusher.settings');

    /* Start All Payment Routes */
    // Payment Setting Routes
    Route::controller(PaymentSettingController::class)->group(function () {
        Route::get('payment-settings', 'index')->name('payment.settings.index');
    });
    // Paypal Settings Routes
    Route::put('paypal-settings-update/{id}',[PaypalSettingController::class,'update'])->name('paypal.setting.update');
     // Stripe Settings Routes
     Route::put('stripe-settings-update/{id}',[StripeSettingController::class,'update'])->name('stripe.setting.update');
     // Cash On Delivery Routes
     Route::put('cash-on-delivery',[CashOnDeliveryContoller::class,'update'])->name('cash.on.delivery.update');
    /* End All Payment Routes */
    // Transaction Routes
    Route::resource('transactions',TransactionController::class);
    // Home Page Setting Routes
    Route::get('home-page-settings',[HomePageSettingController::class,'index'])->name('home.settings');
    Route::get('home-settings-get-subcategory',[HomePageSettingController::class,'GetSubCategory'])->name('get_sub_category_for_home_settings');
    Route::put('popular-category-section',[HomePageSettingController::class,'PopularCategorySection'])->name('popular_category_section');
    Route::put('product-slider-section-one',[HomePageSettingController::class,'ProductSliderSectionOne'])->name('product.slider.section.one');
    Route::put('product-slider-section-two',[HomePageSettingController::class,'ProductSliderSectionTwo'])->name('product.slider.section.two');
    Route::put('product-slider-section-three',[HomePageSettingController::class,'ProductSliderSectionThree'])->name('product.slider.section.three');

    //Footer Routes
    Route::resource('footer-info',FooterInfoController::class);
    Route::put('footer-social-change-status',[FooterSocialController::class,'FooterChangeStatus'])->name('footer-social-change-status');
    Route::resource('footer-socials',FooterSocialController::class);

    //Newsletters Routes
    Route::get('subscribers',[SubscribersController::class,'index'])->name('subscribers');
    Route::delete('delete-subscriber/{id}',[SubscribersController::class,'destroy'])->name('subscriber.destroy');
    Route::post('mail-subscribers',[SubscribersController::class,'SendMail'])->name('mail.subscribers');

    // Adverisments Routes
    Route::get('adverisments',[AdeverismentController::class,'index'])->name('adverisment.index');
    Route::put('adverisment-banner-one',[AdeverismentController::class,'UpdateBannerOne'])->name('update.banner.one');
    Route::put('adverisment-banner-two',[AdeverismentController::class,'UpdateBannerTwo'])->name('update.banner.two');
    Route::put('adverisment-banner-three',[AdeverismentController::class,'UpdateBannerThree'])->name('update.banner.three');
    Route::put('adverisment-product-page',[AdeverismentController::class,'UpdateProductBanner'])->name('update.product.banner');
    Route::put('adverisment-cart-page',[AdeverismentController::class,'UpdateCartBanner'])->name('update.cart.banner');

    // Manage User Routes
    Route::get('manage-users',[ManageUserController::class,'index'])->name('manage.users.index');
    Route::post('manage-users-create',[ManageUserController::class,'create'])->name('manage.users.create');

    //Vendor WithDraw Routes
    Route::resource('with-draws',VendorWithDrawController::class);
    // WithDraw Requests Routes
    Route::put('with-draw-request-status/{id}',[AdminWithDrawRequestsController::class,'ChangeStatus'])->name('with.draw.request.status');
    Route::resource('with-draw-requests',AdminWithDrawRequestsController::class);

  // Messenger Routes
  Route::controller(AdminMessengerController::class)->group(function(){
    Route::get('messenger','index')->name('messenger.index');
    Route::get('fetch-user-chat','FetchUserChat')->name('fetch.user.chat');
    Route::post('send-message','SendMessage')->name('send.message');

    });
});
