@extends('frontend.layout.master')
@section('title')
    Product Details
@endsection
@section('content')
    <style>
        .rating i {
            cursor: pointer;
            color: #ccc;
        }

        .rating i.active {
            color: #f39c12;
            /* Yellow color for active stars */
        }
    </style>


    <!--============================
                              BREADCRUMB START
                         ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>products details</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">peoduct</a></li>
                            <li><a href="#">product details</a></li>
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
                                                                                                PRODUCT DETAILS START
                                                                                            ==============================-->
    <section id="wsus__product_details">
        <div class="container">
            <div class="wsus__details_bg">
                <div class="row">
                    <div class="col-xl-4 col-md-5 col-lg-5" style="z-index: 999 !important">
                        <div id="sticky_pro_zoom">
                            <div class="exzoom hidden" id="exzoom">
                                <div class="exzoom_img_box">
                                    @if ($product->video_link)
                                        <a class="venobox wsus__pro_det_video" data-autoplay="true" data-vbtype="video"
                                            href="{{ $product->video_link }}">
                                            <i class="fas fa-play"></i>
                                        </a>
                                    @endif
                                    <ul class='exzoom_img_ul'>
                                        <li><img class="zoom ing-fluid w-100" src="{{ asset($product->thumb_image) }}"
                                                alt="product"></li>
                                        @foreach ($product->gallery as $item)
                                            <li><img class="zoom ing-fluid w-100" src="{{ asset($item->image) }}"
                                                    alt="product"></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="exzoom_nav"></div>
                                <p class="exzoom_btn">
                                    <a href="javascript:void(0);" class="exzoom_prev_btn"> <i
                                            class="far fa-chevron-left"></i> </a>
                                    <a href="javascript:void(0);" class="exzoom_next_btn"> <i
                                            class="far fa-chevron-right"></i> </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-md-7 col-lg-7">
                        <div class="wsus__pro_details_text">
                            <a class="title" href="javascript:;">{{ $product->name }}</a>
                            @if ($product->qty > 0)
                                <p class="wsus__stock_area">
                                    <span class="in_stock">in stock</span>({{ $product->qty }}) items
                                </p>
                            @else
                                <p class="wsus__stock_area">
                                    <span class="in_stock">out of stock</span>
                                </p>
                            @endif

                            @if (checkDiscount($product))
                                <h4>{{ $settings->currency_icon }}{{ $product->offer_price }}
                                    <del>{{ $settings->currency_icon }}{{ $product->price }}</del>
                                </h4>
                            @else
                                <h4>{{ $settings->currency_icon }}{{ $product->price }}</h4>
                            @endif
                            @php
                                $avgRating = $product->productReviews()->avg('rating');
                                $fullStars = round($avgRating);
                            @endphp
                            <p class="wsus__pro_rating">
                                @for ($i = 0; $i <= 5; $i++)
                                    @if ($i <= $fullStars)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                                <span>({{ count($product->productReviews) }} review)</span>
                            <p class="description">{{ $product->short_info }}</p>

                            <form class="shopping_cart_form" action="">
                                @csrf

                                <input type="hidden" id="get_product_id" name="product_id" value="{{ $product->id }}">

                                <div class="wsus__quentity">
                                    <h5>Quantity:</h5>
                                    <div class="select_number">
                                        <input class="number_area" id="quantity_selector" name="qty" type="number"
                                            min="1" max="100" value="1" />
                                    </div>
                                </div>
                                <div class="wsus__selectbox">
                                    <div class="row">
                                        @foreach ($product->variants as $variant)
                                            @if ($variant->status != 0)
                                                <div class="col-xl-6 col-sm-6">
                                                    <h5 class="mb-2">{{ $variant->name }}</h5>
                                                    <select class="select_2" name="variants_items[]">
                                                        <option selected disabled>Choose</option>
                                                        @foreach ($variant->items as $item)
                                                            @if ($item->status != 0)
                                                                <option @selected($item->is_default == 1)
                                                                    value="{{ $item->id }}">
                                                                    {{ $item->name }}
                                                                    {{ $settings->currency_icon }}({{ $item->price }})
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <ul class="wsus__button_area">
                                    <li><button type="submit" class="add_cart">Add to cart</button></li>
                                    <li><a class="buy_now" id="test_test" href="#">Buy now</a></li>
                                    <li><a href="javascript:;"><i class="fal fa-heart"></i></a></li>
                                    <li>
                                        @auth
                                            <button type="button"
                                                style="border: 1px solid gray;
                                  padding: 7px 11px;
                                  margin-left: 7px;
                                  border-radius: 100%; background-color: #0088cc"
                                                class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <i class="far fa-comment-alt text-light"></i>
                                            </button>
                                        @endauth

                                </ul>
                            </form>

                            <p class="brand_model"><span>brand :</span>{{ @$product->brand->name }}</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-12 mt-md-5 mt-lg-0">
                        <div class="wsus_pro_det_sidebar" id="sticky_sidebar">
                            <ul>
                                <li>
                                    <span><i class="fal fa-truck"></i></span>
                                    <div class="text">
                                        <h4>Return Available</h4>
                                        <!-- <p>Lorem Ipsum is simply dummy text of the printing</p> -->
                                    </div>
                                </li>
                                <li>
                                    <span><i class="far fa-shield-check"></i></span>
                                    <div class="text">
                                        <h4>Secure Payment</h4>
                                        <!-- <p>Lorem Ipsum is simply dummy text of the printing</p> -->
                                    </div>
                                </li>
                                <li>
                                    <span><i class="fal fa-envelope-open-dollar"></i></span>
                                    <div class="text">
                                        <h4>Warranty Available</h4>
                                        <!-- <p>Lorem Ipsum is simply dummy text of the printing</p> -->
                                    </div>
                                </li>
                            </ul>
                            <div class="wsus__det_sidebar_banner">
                                <img src="{{ asset('frontend') }}/images/blog_1.jpg" alt="banner"
                                    class="img-fluid w-100">
                                <div class="wsus__det_sidebar_banner_text_overlay">
                                    <div class="wsus__det_sidebar_banner_text">
                                        <p>Black Friday Sale</p>
                                        <h4>Up To 70% Off</h4>
                                        <a href="#" class="common_btn">shope now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__pro_det_description">
                        <div class="wsus__details_bg">
                            <ul class="nav nav-pills mb-3" id="pills-tab3" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab7" data-bs-toggle="pill"
                                        data-bs-target="#pills-home22" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true">Description</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact" type="button" role="tab"
                                        aria-controls="pills-contact" aria-selected="false">Vendor Info</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab2" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact2" type="button" role="tab"
                                        aria-controls="pills-contact2" aria-selected="false">Reviews</button>
                                </li>

                            </ul>
                            <div class="tab-content" id="pills-tabContent4">
                                <div class="tab-pane fade  show active " id="pills-home22" role="tabpanel"
                                    aria-labelledby="pills-home-tab7">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="wsus__description_area">
                                                <p> {{ $product->long_info }}
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                    aria-labelledby="pills-contact-tab">
                                    <div class="wsus__pro_det_vendor">
                                        <div class="row">
                                            <div class="col-xl-6 col-xxl-5 col-md-6">
                                                <div class="wsus__vebdor_img">
                                                    <img src="{{ asset($product->vendor->banner) }}" alt="vensor"
                                                        class="img-fluid w-100">
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-xxl-7 col-md-6 mt-4 mt-md-0">
                                                <div class="wsus__pro_det_vendor_text">
                                                    <h4>{{ $product->vendor->user->name }}</h4>
                                                    <p class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <span>(41 review)</span>
                                                    </p>
                                                    <p><span>Store Name:</span> {{ $product->vendor->shop_name }}</p>
                                                    <p><span>Address:</span> {{ $product->vendor->address }}
                                                    </p>
                                                    <p><span>Phone:</span>{{ $product->vendor->phone }}</p>
                                                    <p><span>mail:</span> {{ $product->vendor->email }}</p>
                                                    <a href="vendor_details.html" class="see_btn">visit store</a>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="wsus__vendor_details">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-contact2" role="tabpanel"
                                    aria-labelledby="pills-contact-tab2">
                                    <div class="wsus__pro_det_review">
                                        <div class="wsus__pro_det_review_single">
                                            <div class="row">
                                                <div class="col-xl-8 col-lg-7">
                                                    <div class="wsus__comment_area">
                                                        <h4>Reviews <span>{{ $productReviews->count() }}</span></h4>
                                                        @if ($productReviews->count() > 0)
                                                            @foreach ($productReviews as $reviews)
                                                                <div class="wsus__main_comment">
                                                                    <div class="wsus__comment_img">
                                                                        <img src="{{ asset($reviews->user->image) }}"
                                                                            alt="user" class="img-fluid w-100">
                                                                    </div>
                                                                    <div class="wsus__comment_text reply">
                                                                        <h6>{{ $reviews->user->name }}
                                                                            <span>
                                                                                @for ($i = 1; $i <= $reviews->rating; $i++)
                                                                                    <i class="fas fa-star"></i>
                                                                                @endfor
                                                                            </span>
                                                                        </h6>
                                                                        <span>{{ date('Y m-d', strtotime($reviews->created_at)) }}</span>
                                                                        <p>{{ $reviews->review ? $reviews->review : 'just rated' }}
                                                                        </p>

                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                            @if ($productReviews->hasPages())
                                                                {{ $productReviews->links('frontend.layout.custom-pagination') }}
                                                            @endif
                                                        @else
                                                            <p style="text-align: center">there is no reviews yet</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                @auth
                                                    <div class="col-xl-4 col-lg-5 mt-4 mt-lg-0">
                                                        <div class="wsus__post_comment rev_mar" id="sticky_sidebar3">
                                                            <h4>write a Review</h4>
                                                            <form id="product_review_form" action="" method="POST">
                                                                @csrf
                                                                <p class="rating">
                                                                    <span>Select your rating: </span>
                                                                    <i class="fas fa-star" data-value="1"></i>
                                                                    <i class="fas fa-star" data-value="2"></i>
                                                                    <i class="fas fa-star" data-value="3"></i>
                                                                    <i class="fas fa-star" data-value="4"></i>
                                                                    <i class="fas fa-star" data-value="5"></i>
                                                                </p>

                                                                <!-- Hidden input to store the rating value -->
                                                                <input type="hidden" name="rating" id="rating"
                                                                    value="0">
                                                                <!-- Hidden input to store the product Id -->
                                                                <input type="hidden" name="product_id"
                                                                    value="{{ $product->id }}" value="0">
                                                                <!-- Hidden input to store the user Id -->

                                                                <input type="hidden" name="user_id"
                                                                    value="{{ Auth::user()->id }}" value="0">
                                                                <!-- Hidden input to store the vendor Id -->
                                                                <input type="hidden" name="vendor_id"
                                                                    value="{{ $product->vendor->id }}" value="0">

                                                                <div class="col-xl-12">
                                                                    <div class="col-xl-12">
                                                                        <div class="wsus__single_com">
                                                                            <textarea cols="3" rows="3" name="review" placeholder="Write your review"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <button class="common_btn mt-3 review_submit_btn"
                                                                    type="submit">Submit
                                                                    Review</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Send Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" class="message_modal">
                        @csrf
                        <div class="form-group">
                            <label for="">Message</label>
                            <textarea name="message"  class="form-control mt-2 message-box"></textarea>
                            <input type="hidden" name="receiver_id" value="{{ $product->vendor->user_id }}">
                            <p style="color: green" class="success_chat_message d-none">message sent successfully , to go to chat <a href="{{ route('messenger.index') }}">click here</a></p>
                        </div>
                        <button type="submit" class="btn add_cart submit_message_btn mt-4 send-button">Send</button>

                    </form>

                </div>

            </div>
        </div>
    </div>
    <!--============================
                     PRODUCT DETAILS END
                 ==============================-->


    <!--============================
                  RELATED PRODUCT START
                 ==============================-->
    {{-- <section id="wsus__flash_sell">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__section_header">
                        <h3>Related Products</h3>
                        <a class="see_btn" href="#">see more <i class="fas fa-caret-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row flash_sell_slider">
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <div class="wsus__product_item">
                        <span class="wsus__new">New</span>
                        <span class="wsus__minus">-20%</span>
                        <a class="wsus__pro_link" href="product_details.html">
                            <img src="{{ asset('frontend') }}/images/pro3.jpg" alt="product"
                                class="img-fluid w-100 img_1" />
                            <img src="{{ asset('frontend') }}/images/pro3_3.jpg" alt="product"
                                class="img-fluid w-100 img_2" />
                        </a>
                        <ul class="wsus__single_pro_icon">
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i
                                        class="far fa-eye"></i></a></li>
                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                            <li><a href="#"><i class="far fa-random"></i></a>
                        </ul>
                        <div class="wsus__product_details">
                            <a class="wsus__category" href="#">Electronics </a>
                            <p class="wsus__pro_rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(133 review)</span>
                            </p>
                            <a class="wsus__pro_name" href="#">hp 24" FHD monitore</a>
                            <p class="wsus__price">$159 <del>$200</del></p>
                            <a class="add_cart" href="#">add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <div class="wsus__product_item">
                        <span class="wsus__new">New</span>
                        <a class="wsus__pro_link" href="product_details.html">
                            <img src="{{ asset('frontend') }}/images/pro4.jpg" alt="product"
                                class="img-fluid w-100 img_1" />
                            <img src="{{ asset('frontend') }}/images/pro4_4.jpg" alt="product"
                                class="img-fluid w-100 img_2" />
                        </a>
                        <ul class="wsus__single_pro_icon">
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i
                                        class="far fa-eye"></i></a></li>
                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                            <li><a href="#"><i class="far fa-random"></i></a>
                        </ul>
                        <div class="wsus__product_details">
                            <a class="wsus__category" href="#">fashion </a>
                            <p class="wsus__pro_rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(17 review)</span>
                            </p>
                            <a class="wsus__pro_name" href="#">men's casual fashion watch</a>
                            <p class="wsus__price">$159 <del>$200</del></p>
                            <a class="add_cart" href="#">add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <div class="wsus__product_item">
                        <span class="wsus__minus">-20%</span>
                        <a class="wsus__pro_link" href="product_details.html">
                            <img src="{{ asset('frontend') }}/images/pro9.jpg" alt="product"
                                class="img-fluid w-100 img_1" />
                            <img src="{{ asset('frontend') }}/images/pro9_9.jpg" alt="product"
                                class="img-fluid w-100 img_2" />
                        </a>
                        <ul class="wsus__single_pro_icon">
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i
                                        class="far fa-eye"></i></a></li>
                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                            <li><a href="#"><i class="far fa-random"></i></a>
                        </ul>
                        <div class="wsus__product_details">
                            <a class="wsus__category" href="#">fashion </a>
                            <p class="wsus__pro_rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(120 review)</span>
                            </p>
                            <a class="wsus__pro_name" href="#">men's fashion sholder bag</a>
                            <p class="wsus__price">$159 <del>$200</del></p>
                            <a class="add_cart" href="#">add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <div class="wsus__product_item">
                        <span class="wsus__new">New</span>
                        <span class="wsus__minus">-20%</span>
                        <a class="wsus__pro_link" href="product_details.html">
                            <img src="{{ asset('frontend') }}/images/pro2.jpg" alt="product"
                                class="img-fluid w-100 img_1" />
                            <img src="{{ asset('frontend') }}/images/pro2_2.jpg" alt="product"
                                class="img-fluid w-100 img_2" />
                        </a>
                        <ul class="wsus__single_pro_icon">
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i
                                        class="far fa-eye"></i></a></li>
                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                            <li><a href="#"><i class="far fa-random"></i></a>
                        </ul>
                        <div class="wsus__product_details">
                            <a class="wsus__category" href="#">fashion </a>
                            <p class="wsus__pro_rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(72 review)</span>
                            </p>
                            <a class="wsus__pro_name" href="#">men's casual shoes</a>
                            <p class="wsus__price">$159 <del>$200</del></p>
                            <a class="add_cart" href="#">add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <div class="wsus__product_item">
                        <span class="wsus__minus">-20%</span>
                        <a class="wsus__pro_link" href="product_details.html">
                            <img src="{{ asset('frontend') }}/images/pro4.jpg" alt="product"
                                class="img-fluid w-100 img_1" />
                            <img src="{{ asset('frontend') }}/images/pro4_4.jpg" alt="product"
                                class="img-fluid w-100 img_2" />
                        </a>
                        <ul class="wsus__single_pro_icon">
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i
                                        class="far fa-eye"></i></a></li>
                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                            <li><a href="#"><i class="far fa-random"></i></a>
                        </ul>
                        <div class="wsus__product_details">
                            <a class="wsus__category" href="#">fashion </a>
                            <p class="wsus__pro_rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(17 review)</span>
                            </p>
                            <a class="wsus__pro_name" href="#">men's casual fashion watch</a>
                            <p class="wsus__price">$159 <del>$200</del></p>
                            <a class="add_cart" href="#">add to cart</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section> --}}
    <!--============================
                    RELATED PRODUCT END
                 ==============================-->
@endsection
@push('scripts')
    <script>
        // product Stars
        document.querySelectorAll('.rating i').forEach(star => {
            star.addEventListener('click', function() {
                const rating = this.getAttribute('data-value');
                document.getElementById('rating').value = rating;

                // Highlight stars up to the clicked one
                document.querySelectorAll('.rating i').forEach(s => {
                    s.classList.toggle('active', s.getAttribute('data-value') <= rating);
                });
            });
        });
        // Submit Product Review
        $(document).ready(function() {
            $('#product_review_form').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                $.ajax({
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    url: '{{ route('product.review') }}',
                    beforeSend: function() {
                        $('.review_submit_btn').text('Loading...')
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            toastr.success(response.message);
                        }
                    },
                    error: function(xhr) {
                        // Check if there is a JSON response and handle the 'message' directly
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            toastr.error(xhr.responseJSON.message);
                        } else {
                            // Loop through validation errors if they exist
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(index, value) {
                                toastr.error(value);
                            });
                        }
                    },
                    complete: function() {
                        $('.review_submit_btn').text('Submit Review')
                    },
                })
            });
        });
        // Send Message
        $(document).ready(function() {
            $(document).on('submit', '.message_modal', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                $.ajax({
                    method: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('send.fast.message') }}',
                    beforeSend: function() {
                        $('.submit_message_btn').html('Sending...');
                    },
                    success: function(response) {
                        if(response.status == 'success'){
                            $('.success_chat_message').removeClass('d-none');
                            $('.message-box').val('');
                        }
                    },
                    error: function(xhr, status, error) {},

                    complete: function() {
                        $('.submit_message_btn').addClass('d-none');
                    },
                });
            });
        });
    </script>
@endpush
