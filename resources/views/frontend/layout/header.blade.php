<!--============================
        HEADER START
    ==============================-->
    <style>
        /* Hide on larger screens */
@media (min-width: 768px) { /* Adjust width as per your layout */
    .wsus__mobile_menu_header_icon {
        display: none;
    }
}

/* Show on mobile screens */
@media (max-width: 767px) { /* Adjust width as per your layout */
    .wsus__mobile_menu_header_icon {
        display: flex;
    }
}

    </style>
<header>
    <div class="container">
        <div class="row">
            <div class="col-2 col-md-1 d-lg-none">
                <div class="wsus__mobile_menu_area">
                    <span class="wsus__mobile_menu_icon"><i class="fal fa-bars"></i></span>
                </div>
            </div>
            <div class="col-xl-2 col-7 col-md-8 col-lg-2">
                <div class="wsus_logo_area">
                    <a class="wsus__header_logo" href="{{ route('home') }}">
                        <img src="{{ asset($logo->logo) }}" alt="logo" class="img-fluid w-100">
                    </a>
                </div>
            </div>
            <div class="col-xl-5 col-md-6 col-lg-4 d-none d-lg-block">
                <div class="wsus__search">
                    <form action="{{ route('products.page') }}">
                        <input type="text" placeholder="Search..." name="search" value="{{ request()->search }}">
                        <button type="submit"><i class="far fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="col-xl-5 col-3 col-md-3 col-lg-6">
                <div class="wsus__call_icon_area">
                    <div class="wsus__call_area">
                        <div class="wsus__call">
                            <i class="fas fa-user-headset"></i>
                        </div>
                        <div class="wsus__call_text">
                            <p>{{ $settings->contact_mail }}</p>
                            <p>{{ $settings->contact_phone }}</p>
                        </div>
                    </div>
                    <ul class="wsus__icon_area">
                        @php
                            if (Auth::user()) {
                                $wishlist = App\Models\Wishlist::where('user_id', auth()->user()->id)->count();
                            }
                        @endphp
                        @auth
                            <li><a href="{{ route('wishlist') }}"><i class="fal fa-heart"></i><span
                                        class="wishlist_class_counter">{{ $wishlist }}</span></a></li>
                        @endauth
                        <li><a href="compare.html"><i class="fal fa-random"></i><span>03</span></a></li>
                        <li><a class="wsus__cart_icon" href="#"><i class="fal fa-shopping-bag "></i><span
                                    id="shopping_bag_count">{{ Cart::content()->count() }}</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="wsus__mini_cart">
        <h4>shopping cart <span class="wsus_close_mini_cart"><i class="far fa-times"></i></span></h4>
        <ul id="sidebar_cart_products_container">

            {{-- <li>
                <div class="wsus__cart_img">
                    <a href="#"><img src="{{ asset('frontend/images') }}/tab_2.jpg" alt="product"
                            class="img-fluid w-100"></a>
                    <a class="wsis__del_icon" href="#"><i class="fas fa-minus-circle"></i></a>
                </div>
                <div class="wsus__cart_text">
                    <a class="wsus__cart_title" href="#">apple 9.5" 7 serise tab with full view display</a>
                    <p>$140 <del>$150</del></p>
                </div>
            </li> --}}
            @if (Cart::content()->count() > 0)
                @foreach (Cart::content() as $product)
                    <li id="cart_mini_{{ $product->rowId }}" style="margin-bottom: 30px;">
                        <div class="wsus__cart_img">
                            <a href="{{ route('show.product.details', $product->options->slug) }}"><img
                                    src="{{ asset($product->options->image) }}" alt="product"
                                    class="img-fluid w-100"></a>
                            <a class="wsis__del_icon remove_sidebar_product" data-rowId="{{ $product->rowId }}"
                                href="#"><i class="fas fa-minus-circle"></i></a>
                        </div>
                        <div class="wsus__cart_text">
                            <a class="wsus__cart_title"
                                href="{{ route('show.product.details', $product->options->slug) }}">{{ $product->name }}</a>
                            <p>{{ $settings->currency_icon }}{{ $product->price + $product->options->variants_total }}
                            </p>
                            <code>Product Variants : {{ $product->options->variants_total }}</code>
                            <code>Quantity : {{ $product->qty }}</code>
                        </div>
                    </li>
                @endforeach

        </ul>
        <div class="cart_mini_actions">
            <h5>sub total <span id="sidbar_cart_total">{{ $settings->currency_icon . cartTotal() }}</span></h5>
            <div class="wsus__minicart_btn_area">
                <a class="common_btn" href="{{ route('show.cart.details') }}">view cart</a>
                <a class="common_btn" href="{{ route('checkout.index') }}">checkout</a>
            </div>
        </div>
    @else
        <li>This Cart Is Empty</li>
        @endif
    </div>

</header>
<!--============================
        HEADER END
    ==============================-->


<!--============================
        MAIN MENU START
    ==============================-->
@php
    $categories = App\Models\Category::where('status', 1)->orderBy('created_at', 'desc')->get();
@endphp
<nav class="wsus__main_menu d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="relative_contect d-flex">
                    <div class="wsus_menu_category_bar">
                        <i class="far fa-bars"></i>
                    </div>

                    <ul class="wsus_menu_cat_item show_home toggle_menu">
                        @if ($categories->isNotEmpty())
                            @foreach ($categories as $category)
                                <li>
                                    <a class="{{ $category->SubCategories->count() > 0 ? 'wsus__droap_arrow' : '' }}"
                                        href="{{ route('products.page', ['category' => $category->slug]) }}">
                                        <i class="{{ $category->icon }}"></i> {{ $category->name }}
                                    </a>
                                    <ul class="wsus_menu_cat_droapdown">
                                        @php
                                            // Eager load subcategories and their child categories
                                            $sub_categories = $category
                                                ->SubCategories()
                                                ->where('status', 1)
                                                ->with('child_categories')
                                                ->get();
                                        @endphp
                                        @if ($sub_categories->isNotEmpty())
                                            @foreach ($sub_categories as $sub_category)
                                                <li>
                                                    <a
                                                        href="{{ route('products.page', ['sub_category' => $sub_category->slug]) }}">{{ $sub_category->name }}<i
                                                            class="{{ $sub_category->child_categories->count() > 0 ? 'fas fa-angle-right' : '' }}"></i></a>
                                                    @if ($sub_category->child_categories->isNotEmpty())
                                                        <ul class="wsus__sub_category">
                                                            @foreach ($sub_category->child_categories as $child_category)
                                                                <li><a
                                                                        href="{{ route('products.page', ['child_category' => $child_category->slug]) }}">{{ $child_category->name }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </li>
                            @endforeach
                            <li><a href="#"><i class="fal fa-gem"></i> View All Categories</a></li>
                        @endif
                    </ul>



                    </ul>

                    <ul class="wsus__menu_item">
                        <li><a class="active" href="index.html">home</a></li>
                        <li><a href="product_grid_view.html">shop <i class="fas fa-caret-down"></i></a>
                            <div class="wsus__mega_menu">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-3">
                                        <div class="wsus__mega_menu_colum">
                                            <h4>women</h4>
                                            <ul class="wsis__mega_menu_item">
                                                <li><a href="#">New Arrivals</a></li>
                                                <li><a href="#">Best Sellers</a></li>
                                                <li><a href="#">Trending</a></li>
                                                <li><a href="#">Clothing</a></li>
                                                <li><a href="#">Shoes</a></li>
                                                <li><a href="#">Bags</a></li>
                                                <li><a href="#">Accessories</a></li>
                                                <li><a href="#">Jewlery & Watches</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3">
                                        <div class="wsus__mega_menu_colum">
                                            <h4>men</h4>
                                            <ul class="wsis__mega_menu_item">
                                                <li><a href="#">New Arrivals</a></li>
                                                <li><a href="#">Best Sellers</a></li>
                                                <li><a href="#">Trending</a></li>
                                                <li><a href="#">Clothing</a></li>
                                                <li><a href="#">Shoes</a></li>
                                                <li><a href="#">Bags</a></li>
                                                <li><a href="#">Accessories</a></li>
                                                <li><a href="#">Jewlery & Watches</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3">
                                        <div class="wsus__mega_menu_colum">
                                            <h4>category</h4>
                                            <ul class="wsis__mega_menu_item">
                                                <li><a href="#"> Healthy & Beauty</a></li>
                                                <li><a href="#">Gift Ideas</a></li>
                                                <li><a href="#">Toy & Games</a></li>
                                                <li><a href="#">Cooking</a></li>
                                                <li><a href="#">Smart Phones</a></li>
                                                <li><a href="#">Cameras & Photo</a></li>
                                                <li><a href="#">Accessories</a></li>
                                                <li><a href="#">View All Categories</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3">
                                        <div class="wsus__mega_menu_colum">
                                            <h4>women</h4>
                                            <ul class="wsis__mega_menu_item">
                                                <li><a href="#">New Arrivals</a></li>
                                                <li><a href="#">Best Sellers</a></li>
                                                <li><a href="#">Trending</a></li>
                                                <li><a href="#">Clothing</a></li>
                                                <li><a href="#">Shoes</a></li>
                                                <li><a href="#">Bags</a></li>
                                                <li><a href="#">Accessories</a></li>
                                                <li><a href="#">Jewlery & Watches</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li><a href="{{ route('vendors.page') }}">vendor</a></li>
                        <li><a href="{{ route('blogs') }}">blog</a></li>
                        <li><a href="daily_deals.html">campain</a></li>
                        <li class="wsus__relative_li"><a href="#">pages <i class="fas fa-caret-down"></i></a>
                            <ul class="wsus__menu_droapdown">
                                <li><a href="404.html">404</a></li>
                                <li><a href="faqs.html">faq</a></li>
                                <li><a href="invoice.html">invoice</a></li>
                                <li><a href="{{ route('about') }}">about</a></li>
                                <li><a href="{{ route('terms_and_conditions') }}">terms and conditions</a></li>
                                <li><a href="{{ route('products.page') }}">product</a></li>
                                <li><a href="check_out.html">check out</a></li>
                                <li><a href="team.html">team</a></li>
                                <li><a href="change_password.html">change password</a></li>
                                <li><a href="custom_page.html">custom page</a></li>
                                <li><a href="forget_password.html">forget password</a></li>
                                <li><a href="privacy_policy.html">privacy policy</a></li>
                                <li><a href="product_category.html">product category</a></li>
                                <li><a href="brands.html">brands</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('order.track.index') }}">track order</a></li>
                        <li><a href="daily_deals.html">daily deals</a></li>
                    </ul>
                    <ul class="wsus__menu_item wsus__menu_item_right">
                        <li><a href="{{ route('contact') }}">contact</a></li>
                        @if (Auth::check())
                            <li>
                                <a
                                    href="
                                    @if (Auth::user()->role == 'user') {{ route('dashboard') }}
                                    @elseif(Auth::user()->role == 'admin')
                                        {{ route('admin.dashboard') }}
                                    @elseif(Auth::user()->role == 'vendor')
                                        {{ route('vendor.dashboard') }} @endif
                                ">
                                    my account</a>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}">login</a></li>
                        @endif
                    </ul>

                </div>
            </div>
        </div>
    </div>
</nav>
<!--============================
        MAIN MENU END
    ==============================-->


<!--============================
        MOBILE MENU START
    ==============================-->
<section id="wsus__mobile_menu">
    <span class="wsus__mobile_menu_close"><i class="fal fa-times"></i></span>
    <ul class="wsus__mobile_menu_header_icon d-inline-flex">
        {{-- @auth
            @if (auth()->user()->role == 'user')
                <li><a href="{{ route('dashboard') }}"><i class="fal fa-user"></a></li>
            @elseif(auth()->user()->role == 'admin')
                <li><a href="{{ route('admin.dashboard') }}"><i class="fal fa-user"></a></li>
            @elseif(auth()->user()->role == 'vendor')
                <li><a href="{{ route('vendor.dashboard') }}"><i class="fal fa-user"></a></li>
            @endif
        @endauth
        <li><a href="{{ route('login') }}">login</a></li> --}}
        @php
            if (Auth::user()) {
                $wishlist = App\Models\Wishlist::where('user_id', auth()->user()->id)->count();
            }
        @endphp
        @auth
            <li><a href="{{ route('wishlist') }}"><i class="fal fa-heart"></i><span
                        class="wishlist_class_counter">{{ $wishlist }}</span></a></li>
        @endauth

    </ul>
    <form  method="GET" action="{{ route('products.page') }}">
        <input type="text" name="search" value="{{ request()->search }}" placeholder="Search">
        <button type="submit"><i class="far fa-search"></i></button>
    </form>

    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                role="tab" aria-controls="pills-home" aria-selected="true">Categories</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                role="tab" aria-controls="pills-profile" aria-selected="false">main menu</button>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="wsus__mobile_menu_main_menu">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <ul class="wsus_mobile_menu_category">
                        {{-- <li><a href="#"><i class="fas fa-star"></i> hot promotions</a></li> --}}
                        @foreach ($categories as $category)
                            <li><a href="#"
                                    class="{{ $category->SubCategories->count() > 0 ? 'accordion-button' : '' }} collapsed"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseThreew-{{ $loop->index }}" aria-expanded="false"
                                    aria-controls="flush-collapseThreew-{{ $loop->index }}"><i
                                        class="{{ $category->icon }}"></i>{{ $category->name }}</a>
                                <div id="flush-collapseThreew-{{ $loop->index }}"
                                    class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    @if ($category->SubCategories->count() > 0)
                                        @foreach ($category->SubCategories as $sub_category)
                                            <div class="accordion-body">
                                                <ul>
                                                    <li><a
                                                            href="{{ $sub_category->slug }}">{{ $sub_category->name }}</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </li>
                        @endforeach

                        <li><a href="#"><i class="fal fa-gem"></i> View All Categories</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="wsus__mobile_menu_main_menu">
                <div class="accordion accordion-flush" id="accordionFlushExample2">
                    <ul>
                        <li><a href="{{ route('home') }}">home</a></li>
                        <li><a href="{{ route('vendors.page') }}">vendors</a></li>
                        <li><a href="{{ route('blogs') }}">blog</a></li>
                        <li><a href="{{ route('order.track.index') }}">track order</a></li>
                        <li><a href="{{ route('flash.sale.page') }}">flash sale</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--============================
        MOBILE MENU END
    ==============================-->

