@extends('admin.layout.master')
@section('title')
    Home Page
@endsection
@section('content')
<div class="main-content">
   <section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{ route('admin.orders.index') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-cart-plus"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Todays Orders</h4>
                        </div>
                        <div class="card-body">
                            {{ $todayOrders }}
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{ route('admin.pending.orders') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-cart-plus"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Todays Pending Orders</h4>
                        </div>
                        <div class="card-body">
                            {{ $todayPendingOrders }}
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{ route('admin.pending.orders') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-cart-plus"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Todays Pending Orders</h4>
                        </div>
                        <div class="card-body">
                            {{ $todayPendingOrders }}
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{ route('admin.orders.index') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-cart-plus"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Orders</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalOrders }}
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{ route('admin.pending.orders') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-cart-plus"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pending Orders</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalPendingOrders }}
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{ route('admin.delivered.orders') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-cart-plus"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Todays Delivered Orders</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalCompeleteOrders }}
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="#">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-money-bill-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Today Earnings Orders</h4>
                        </div>
                        <div class="card-body">
                            {{ $settings->currency_icon }}  {{ $todayEarnings }}
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-money-bill-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>This Month Earnings</h4>
                        </div>
                        <div class="card-body">
                            {{ $settings->currency_icon }}  {{ $thisMonthEarnings }}
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-money-bill-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>This Year Earnings</h4>
                        </div>
                        <div class="card-body">
                            {{ $settings->currency_icon }} {{ $thisYearEarnings }}
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-money-bill-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Reviews</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalReviews }}
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{route('admin.brands.index')}}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-copyright"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Brands</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalBrands }}
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{route('admin.category.index')}}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-list"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Categories</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalCategories }}
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
           <a href="{{route('admin.blogs.index')}}">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Blogs</h4>
                    </div>
                    <div class="card-body">
                        {{$totalBlogs}}
                    </div>
                </div>
            </div>
        </a>
        </div>

     <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{route('admin.subscribers')}}">
             <div class="card card-statistic-1">
                 <div class="card-icon bg-warning">
                     <i class="far fa-file"></i>
                 </div>
                 <div class="card-wrap">
                     <div class="card-header">
                         <h4>Total Subscribers</h4>
                     </div>
                     <div class="card-body">
                         {{$totalSubscriber}}
                     </div>
                 </div>
             </div>
         </a>
         </div>

         <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{route('admin.vendor.list')}}">
             <div class="card card-statistic-1">
                 <div class="card-icon bg-warning">
                     <i class="far fa-file"></i>
                 </div>
                 <div class="card-wrap">
                     <div class="card-header">
                         <h4>Total Vendors</h4>
                     </div>
                     <div class="card-body">
                         {{$totalVendors}}
                     </div>
                 </div>
             </div>
         </a>
         </div>

         <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{route('admin.customer.list')}}">
             <div class="card card-statistic-1">
                 <div class="card-icon bg-warning">
                     <i class="far fa-file"></i>
                 </div>
                 <div class="card-wrap">
                     <div class="card-header">
                         <h4>Total Users</h4>
                     </div>
                     <div class="card-body">
                         {{$totalUsers}}
                     </div>
                 </div>
             </div>
         </a>
         </div>

    </div>

    </div>

   </section>
  </div>
@endsection
