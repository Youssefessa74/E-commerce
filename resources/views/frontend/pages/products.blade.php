@extends('frontend.layout.master')
@section('title')
    Products
@endsection
@section('content')
    <!--============================
                        BREADCRUMB START
                    ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>products</h4>
                        <ul>
                            <li><a href="{{ route('home') }}">home</a></li>
                            <li><a href="#">product</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
                        BREADCRUMB END
                    ==============================-->


    <!--============================
                        PRODUCT PAGE START
                    ==============================-->
    <section id="wsus__product_page">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    @if ($product_page_banner_section)
                    <div class="wsus__pro_page_bammer">
                        <img src="{{ asset($product_page_banner_section->product_banner->banner_image) }}" alt="banner" class="img-fluid w-100">
                        <div class="wsus__pro_page_bammer_text">
                            <div class="wsus__pro_page_bammer_text_center">
                                <p>up to <span>70% off</span></p>
                                <h5>wemen's jeans Collection</h5>
                                <h3>fashion for wemen's</h3>
                                <a href="#" class="add_cart">Discover Now</a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="wsus__sidebar_filter ">
                        <p>filter</p>
                        <span class="wsus__filter_icon">
                            <i class="far fa-minus" id="minus"></i>
                            <i class="far fa-plus" id="plus"></i>
                        </span>
                    </div>
                    <div class="wsus__product_sidebar" id="sticky_sidebar">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        All Categories
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            @foreach ($categories as $item)
                                                <li><a
                                                        href="{{ route('products.page', ['category' => $item->slug]) }}">{{ $item->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Price
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="price_ranger">
                                            <form action="{{ url()->current() }}">
                                                @foreach (request()->query() as $key => $value)
                                                    @if ($key != 'range')
                                                        <input type="hidden" name="{{ $key }}"
                                                            value="{{ $value }}" />
                                                    @endif
                                                @endforeach
                                                <input type="hidden" id="slider_range" name="range"
                                                    class="flat-slider" />
                                                <button type="submit" class="common_btn">filter</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree3">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree3" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        brand
                                    </button>
                                </h2>
                                <div id="collapseThree3" class="accordion-collapse collapse show"
                                    aria-labelledby="headingThree3" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        @foreach ($brands as $item)
                                            <li><a
                                                    href="{{ route('products.page', ['brand' => $item->slug]) }}">{{ $item->name }}</a>
                                            </li>
                                        @endforeach

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="row">
                        <div class="col-xl-12 d-none d-md-block mt-md-4 mt-lg-0">
                            <div class="wsus__product_topbar">
                                <div class="wsus__product_topbar_left">
                                    <div class="nav nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <button
                                            class="nav-link {{ session()->has('product_style_list') && session()->get('product_style_list') == 'list' ? 'active' : '' }} toggle_tab"
                                            data-id="list" id="v-pills-home-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-home" type="button" role="tab"
                                            aria-controls="v-pills-home" aria-selected="true">
                                            <i class="fas fa-th"></i>
                                        </button>
                                        <button
                                            class="nav-link  {{ session()->has('product_style_list') && session()->get('product_style_list') == 'grid' ? 'active' : '' }} toggle_tab"
                                            data-id="grid" id="v-pills-profile-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-profile" type="button" role="tab"
                                            aria-controls="v-pills-profile" aria-selected="false">
                                            <i class="fas fa-list-ul"></i>
                                        </button>
                                    </div>
                                    <div class="wsus__topbar_select">
                                        <select class="select_2" name="state">
                                            <option>default shorting</option>
                                            <option>short by rating</option>
                                            <option>short by latest</option>
                                            <option>low to high </option>
                                            <option>high to low</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="wsus__topbar_select">
                                    <select class="select_2" name="state">
                                        <option>show 12</option>
                                        <option>show 15</option>
                                        <option>show 18</option>
                                        <option>show 21</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade  {{ session()->has('product_style_list') && session()->get('product_style_list') == 'list' ? 'show active' : '' }} {{ !session()->get('product_style_list') ? 'show active' : '' }}"
                                id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <div class="row">
                                    @foreach ($products as $product)
                                       <x-product-card :product="$product"/>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade  {{ session()->has('product_style_list') && session()->get('product_style_list') == 'grid' ? 'show active' : '' }}"
                                id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                <div class="row">
                                    @foreach ($products as $product)
                                        <div class="col-xl-12">
                                            <div class="wsus__product_item wsus__list_view">
                                                <span
                                                    class="wsus__new">{{ getProductType($product->product_type) }}</span>

                                                @if (checkDiscount($product))
                                                    <span
                                                        class="wsus__minus">-{{ discountPercentage($product->price, $product->offer_price) }}%</span>
                                                @endif

                                                <a class="wsus__pro_link"
                                                    href="{{ route('show.product.details', $product->slug) }}">
                                                    <img src="{{ asset($product->thumb_image) }}" alt="product"
                                                        class="img-fluid w-100 img_1" />
                                                    <img src="{{ $product->gallery[0]->image ?? $product->thumb_image }}"
                                                        alt="product" class="img-fluid w-100 img_2" />
                                                </a>

                                                <div class="wsus__product_details">
                                                    <a class="wsus__category"
                                                        href="#">{{ $product->category->name }}</a>

                                                    <p class="wsus__pro_rating">
                                                        @for ($i = 0; $i <= 5; $i++)
                                                        @if ($i <= $product->reviews_avg_rating)
                                                        <i class="fas fa-star"></i>
                                                        @else
                                                        <i class="far fa-star"></i>
                                                        @endif
                                                        @endfor
                                                        <span>({{count( $product->productReviews) }} review)</span>
                                                    <a class="wsus__pro_name" href="#">{{ $product->name }}</a>

                                                    @if (checkDiscount($product))
                                                        <p class="wsus__price">
                                                            {{ $settings->currency_icon }}{{ $product->offer_price }}
                                                            <del>{{ $settings->currency_icon }}{{ $product->price }}</del>
                                                        </p>
                                                    @else
                                                        <p class="wsus__price">
                                                            {{ $settings->currency_icon }}{{ $product->price }}</p>
                                                    @endif

                                                    <p class="list_description">
                                                        {{ Str::limit($product->description, 120) }}
                                                    </p>

                                                    <ul class="wsus__single_pro_icon">
                                                        <li>
                                                            <form class="shopping_cart_form">
                                                                <input type="hidden" name="product_id"
                                                                    value="{{ $product->id }}">
                                                                <input name="qty" type="hidden" value="1"
                                                                    min="1">
                                                                @foreach ($product->variants as $variant)
                                                                    <select class="d-none" name="variants_items[]">
                                                                        <option selected disabled>Choose</option>
                                                                        @foreach ($variant->items as $item)
                                                                            <option @selected($item->is_default == 1)
                                                                                value="{{ $item->id }}">
                                                                                {{ $item->name }} $({{ $item->price }})
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                @endforeach
                                                                <button type="submit" class="add_cart">add to
                                                                    cart</button>
                                                            </form>
                                                        </li>
                                                        @auth
                                                            <li><a class="add_to_wishlist" data-id="{{ $product->id }}"><i
                                                                        class="far fa-heart"></i></a></li>
                                                        @endauth <li><a href="#"><i class="far fa-random"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($products->hasPages())
                    {{ $products->links('frontend.layout.custom-pagination') }}
                @endif
            </div>
        </div>
    </section>

    <!--============================
                        PRODUCT PAGE END
     ==============================-->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.toggle_tab').on('click', function() {
                let id = $(this).data('id');
                $.ajax({
                    method: 'GET',
                    url: "{{ route('change.product.list.view') }}",
                    data: {
                        id: id,
                    },
                    success: function(response) {

                    },
                    error: function(xhr, status, error) {
                        toastr.error('An error occurred, please try again.');
                    }
                });
            });
        });
        @php
            if (request()->has('range')) {
                $price = explode(';', request()->range);
                $from = $price[0];
                $to = $price[1];
            } else {
                $from = 0;
                $to = 8000;
            }
        @endphp
        jQuery(function() {
            jQuery("#slider_range").flatslider({
                min: 0,
                max: 10000,
                step: 100,
                values: [{{ $from }}, {{ $to }}],
                range: true,
                einheit: '$'
            });
        });
    </script>
@endpush
