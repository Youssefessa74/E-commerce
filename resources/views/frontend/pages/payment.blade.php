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
                        <h4>payment</h4>
                        <ul>
                            <li><a href="{{ route('home') }}">home</a></li>
                            <li><a href="#">peoduct</a></li>
                            <li><a href="#">payment</a></li>
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
            <div class="wsus__pay_info_area">
                <div class="row">
                    <div class="col-xl-3 col-lg-3">
                        <div class="wsus__payment_menu" id="sticky_sidebar">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <button class="nav-link common_btn active" id="v-pills-paypal-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-paypal" type="button" role="tab"
                                    aria-controls="v-pills-paypal" aria-selected="true">Paypal</button>

                                <button class="nav-link common_btn" id="v-pills-stripe-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-stripe" type="button" role="tab"
                                    aria-controls="v-pills-stripe" aria-selected="false">Stripe</button>

                                    <button class="nav-link common_btn" id="v-pills-cod-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-cod" type="button" role="tab"
                                    aria-controls="v-pills-cod" aria-selected="false">Cash On Delivery</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <div class="tab-content" id="v-pills-tabContent" id="sticky_sidebar">

                            <div class="tab-pane fade show active" id="v-pills-paypal" role="tabpanel"
                                aria-labelledby="v-pills-home-tab">
                                <div class="row">
                                    <div class="col-xl-12 m-auto">
                                        <div class="wsus__payment_area">
                                            <a style="text-align: center" href="{{ route('pay.with.paypal') }}" class="nav-link common_btn">Pay With Paypal</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                           @include('frontend.pages.payment-gateways.stripe')
                           @include('frontend.pages.payment-gateways.cash-on-delivery')


                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4">
                        <div class="wsus__pay_booking_summary" id="sticky_sidebar2">
                            <h5>Booking Summary</h5>
                            <p>subtotal: <span>{{ $settings->currency_icon }}{{ CartTotal() }}</span></p>
                            <p>shipping fee: <span>{{ $settings->currency_icon }}{{ ShippingFee() }}</span></p>
                            <p>Coupon: <span>{{ $settings->currency_icon }}{{ GetDiscount() }}</span></p>
                            <h6>total <span>{{ $settings->currency_icon }}{{ GetFinalPaymentTotal() }}</span></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
                PAYMENT PAGE END
            ==============================-->
@endsection
