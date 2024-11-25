<section id="wsus__hot_deals" class="wsus__hot_deals_2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__section_header">
                    <h3>hot deals of the day</h3>
                </div>
            </div>
        </div>

        <div class="wsus__hot_large_item">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__section_header justify-content-start">
                        <div class="monthly_top_filter2 mb-1">
                            <button class="active auto_click" data-filter=".new_arrival">New Arrival</button>
                            <button data-filter=".top_product">Top Product</button>
                            <button data-filter=".best_product">Best Product</button>
                            <button data-filter=".featured_product">Featured</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row grid2">
                @foreach ($typeProducts as $key => $products)
                    @foreach ($products as $product)
                       <x-product-card :product="$product" :key="$key" />
                    @endforeach
                @endforeach
            </div>
        </div>

        <section id="wsus__single_banner" class="home_2_single_banner">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        @if ($homepage_secion_banner_three->banner_one)
                        <div class="wsus__single_banner_content banner_1">
                            <div class="wsus__single_banner_img">
                                <img src="{{ asset($homepage_secion_banner_three->banner_one->banner_one_image) }}" alt="banner"
                                    class="img-fluid w-100">
                            </div>
                            <div class="wsus__single_banner_text">
                                <h6>sell on <span>35% off</span></h6>
                                <h3>smart watch</h3>
                                <a class="shop_btn" href="#">shop now</a>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="row">
                            <div class="col-12">
                                @if($homepage_secion_banner_three->banner_two)
                                <div class="wsus__single_banner_content single_banner_2">
                                    <div class="wsus__single_banner_img">
                                        <img src="{{ asset($homepage_secion_banner_three->banner_two->banner_two_image) }}" alt="banner"
                                            class="img-fluid w-100">
                                    </div>
                                    <div class="wsus__single_banner_text">
                                        <h6>New Collection</h6>
                                        <h3>kid's fashion</h3>
                                        <a class="shop_btn" href="#">shop now</a>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="col-12 mt-lg-4">
                                <div class="wsus__single_banner_content">
                                    <div class="wsus__single_banner_img">
                                        <img src="{{ asset('frontend/images') }}/single_banner_66.jpg" alt="banner"
                                            class="img-fluid w-100">
                                    </div>
                                    <div class="wsus__single_banner_text">
                                        <h6>sell on <span>42% off</span></h6>
                                        <h3>winter collection</h3>
                                        <a class="shop_btn" href="#">shop now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</section>
