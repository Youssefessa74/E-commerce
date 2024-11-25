<div class="modal-body">
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
            class="far fa-times"></i></button>
    <div class="row">
        <div class="col-xl-6 col-12 col-sm-10 col-md-8 col-lg-6 m-auto display">
            <div class="wsus__quick_view_img">
                {{-- Video link --}}
                @if ($product->video_link)
                    <a class="venobox wsus__pro_det_video" data-autoplay="true" data-vbtype="video"
                        href="{{ $product->video_link }}">
                        <i class="fas fa-play"></i>
                    </a>
                @endif

                {{-- Image gallery --}}
                <div class="row modal_slider">
                    <div class="col-xl-12">
                        <div class="modal_slider_img">
                            <img src="{{ asset($product->thumb_image) }}" alt="product"
                                class="img-fluid w-100">
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-6 col-12 col-sm-12 col-md-12 col-lg-6">
            <div class="wsus__pro_details_text">
                {{-- Product Name --}}
                <a class="title" href="#">{{ $product->name }}</a>

                {{-- Stock Info --}}
                <p class="wsus__stock_area"><span class="in_stock">in stock</span>
                    ({{ $product->stock }} item)</p>

                {{-- Price & Discount --}}
                @if (checkDiscount($product))
                    <h4>{{ $settings->currency_icon }}{{ $product->offer_price }}
                        <del>{{ $settings->currency_icon }}{{ $product->price }}</del>
                    </h4>
                @else
                    <h4>{{ $settings->currency_icon }}{{ $product->price }}</h4>
                @endif

                {{-- Review Section --}}
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
                <span>({{count( $product->productReviews) }} review)</span>

                {{-- Product Description --}}
                <p class="description">{{ $product->short_info }}</p>

                <form class="shopping_cart_form" action="">
                    @csrf

                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="wsus__quentity">
                        <h5>Quantity:</h5>
                        <div class="select_number">
                            <input class="number_area" name="qty" type="number"
                                min="1" max="100" value="1" />
                        </div>
                        <h3>$50.00</h3>
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
                                                        {{ $item->name }} $({{ $item->price }})
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
                        <li><a class="buy_now" href="#">Buy now</a></li>
                        @auth
                            <li><a class="add_to_wishlist" data-id="{{ $product->id }}"><i
                                        class="far fa-heart"></i></a></li>
                        @endauth <li><a href="#"><i class="far fa-random"></i></a></li>
                    </ul>
                </form>

                {{-- Brand Information --}}
                <p class="brand_model"><span>brand :</span>{{ @$product->brand->name }}</p>

            </div>
        </div>
    </div>
</div>
