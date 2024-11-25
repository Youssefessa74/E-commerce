@extends('vendor.layout.master')
@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
       @include('vendor.layout.sidebar')
        <div class="row">
            <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                <div class="dashboard_content">
                    <div class="wsus__dashboard">
                        <div class="row">
                            <div class="col-xl-2 col-6 col-md-4">
                                <a class="wsus__dashboard_item sky" href="{{ route('vendor.orders.index') }}">
                                    <i class="fad fa-shopping-cart"></i>
                                    <p>Total Orders</p>
                                    <h4 style="color: #fff">{{ $totalOrders }}</h4>
                                </a>
                            </div>
                            <div class="col-xl-2 col-6 col-md-4">
                                <a class="wsus__dashboard_item sky" href="{{ route('vendor.orders.index') }}">
                                    <i class="fad fa-shopping-cart"></i>
                                    <p>Total Pending Orders</p>
                                    <h4 style="color: #fff">{{ $totalPendingOrders }}</h4>
                                </a>
                            </div>
                            <div class="col-xl-2 col-6 col-md-4">
                                <a class="wsus__dashboard_item sky" href="{{ route('vendor.orders.index') }}">
                                    <i class="fad fa-shopping-cart"></i>
                                    <p>Total Compelete Orders</p>
                                    <h4 style="color: #fff">{{ $totalCompeleteOrders }}</h4>
                                </a>
                            </div>
                            <div class="col-xl-2 col-6 col-md-4">
                                <a class="wsus__dashboard_item sky" href="{{ route('vendor.orders.index') }}">
                                    <i class="fad fa-shopping-cart"></i>
                                    <p>Today Orders</p>
                                    <h4 style="color: #fff">{{ $todayOrders }}</h4>
                                </a>
                            </div>
                            <div class="col-xl-2 col-6 col-md-4">
                                <a class="wsus__dashboard_item sky" href="{{ route('vendor.orders.index') }}">
                                    <i class="fad fa-shopping-cart"></i>
                                    <p>Today Pending Orders</p>
                                    <h4 style="color: #fff">{{ $todayPendingOrders }}</h4>
                                </a>
                            </div>
                            <div class="col-xl-2 col-6 col-md-4">
                                <a class="wsus__dashboard_item red" href="{{ route('vendor.orders.index') }}">
                                    <i class="fad fa-shopping-cart"></i>
                                    <p>Today Products</p>
                                    <h4 style="color: #fff">{{ $totalProducts }}</h4>
                                </a>
                            </div>
                            <div class="col-xl-2 col-6 col-md-4">
                                <a class="wsus__dashboard_item purple" href="{{ route('vendor.orders.index') }}">
                                    <i class="fad fa-shopping-cart"></i>
                                    <p>Total Earnings</p>
                                    <h4 style="color: #fff">{{ $settings->currency_icon }}{{ $totalEarnings }}</h4>
                                </a>
                            </div>
                            <div class="col-xl-2 col-6 col-md-4">
                                <a class="wsus__dashboard_item purple" href="{{ route('vendor.orders.index') }}">
                                    <i class="fad fa-shopping-cart"></i>
                                    <p>Today Earnings</p>
                                    <h4 style="color: #fff">{{ $settings->currency_icon }}{{ $todayEarnings }}</h4>
                                </a>
                            </div>

                            <div class="col-xl-2 col-6 col-md-4">
                                <a class="wsus__dashboard_item purple" href="{{ route('vendor.orders.index') }}">
                                    <i class="fad fa-shopping-cart"></i>
                                    <p>This Month Earnings</p>
                                    <h4 style="color: #fff">{{ $settings->currency_icon }}{{ $thisMonthEarnings }}</h4>
                                </a>
                            </div>

                            <div class="col-xl-2 col-6 col-md-4">
                                <a class="wsus__dashboard_item purple" href="{{ route('vendor.orders.index') }}">
                                    <i class="fad fa-shopping-cart"></i>
                                    <p>This Year Earnings</p>
                                    <h4 style="color: #fff">{{ $settings->currency_icon }}{{ $thisYearEarnings }}</h4>
                                </a>
                            </div>

                            <div class="col-xl-2 col-6 col-md-4">
                                <a class="wsus__dashboard_item orange" href="#">
                                    <i class="fad fa-shopping-cart"></i>
                                    <p>Total Reviews</p>
                                    <h4 style="color: #fff">{{ $totalReviews }}</h4>
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
