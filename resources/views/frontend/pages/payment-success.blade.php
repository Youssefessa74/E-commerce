@extends('frontend.layout.master')
@section('title')
    Check out
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
                        <h4>Vendors</h4>
                        <ul>
                            <li><a href="{{ route('home') }}">home</a></li>
                            <li><a href="#">vendors</a></li>
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
                PAYMENT PAGE START
            ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
          Payment Is Success !
        </div>
    </section>
    <!--============================
                PAYMENT PAGE END
            ==============================-->
@endsection
