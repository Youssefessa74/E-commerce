@extends('frontend.dashboard.layout.master')
@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
       @include('frontend.dashboard.layout.sidebar')
        <div class="row">
            <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                <div class="dashboard_content">
                    <div class="wsus__dashboard">
                        <div class="row">
                            <div class="col-xl-2 col-6 col-md-4">
                                <a class="wsus__dashboard_item purple" href="{{ route('user.orders.index') }}">
                                    <i class="fad fa-shopping-cart"></i>
                                    <p>Total Orders</p>
                                    <h4 style="color: #fff">{{ $totalOrders }}</h4>
                                </a>
                            </div>
                            <div class="col-xl-2 col-6 col-md-4">
                                <a class="wsus__dashboard_item green" href="{{ route('user.orders.index') }}">
                                    <i class="fad fa-shopping-cart"></i>
                                    <p>Total Orders</p>
                                    <h4 style="color: #fff">{{ $compeleteOrders }}</h4>
                                </a>
                            </div>
                            <div class="col-xl-2 col-6 col-md-4">
                                <a class="wsus__dashboard_item red" href="{{ route('user.orders.index') }}">
                                    <i class="fal fa-map-marker-alt"></i>
                                    <p>Pending Orders</p>
                                    <h4 style="color: #fff">{{ $pendingOrders }}</h4>
                                </a>
                            </div>
                            <div class="col-xl-2 col-6 col-md-4">
                                <a class="wsus__dashboard_item sky" href="dsahboard_review.html">
                                    <i class="fas fa-star"></i>
                                    <p>Total Reviews</p>
                                    <h4 style="color: #fff">{{ $totalReviews }}</h4>

                                </a>
                            </div>
                            <div class="col-xl-2 col-6 col-md-4">
                                <a class="wsus__dashboard_item blue" href="{{ route('wishlist') }}">
                                    <i class="far fa-heart"></i>
                                    <p>Total WishLists</p>
                                    <h4 style="color: #fff">{{ $totalWishlists }}</h4>

                                </a>
                            </div>
                            <div class="col-xl-2 col-6 col-md-4">
                                <a class="wsus__dashboard_item orange" href="{{ route('user_profile') }}">
                                    <i class="fas fa-user-shield"></i>
                                    <p>profile</p>
                                    <h4 style="color: #fff">Go To</h4>

                                </a>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section
@endsection
