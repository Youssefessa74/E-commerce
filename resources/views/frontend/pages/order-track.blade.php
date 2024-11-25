@extends('frontend.layout.master')
@section('title')
    Order Track
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
                        <h4>order tracking</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">order tracking</a></li>
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
            TRACKING ORDER START
        ==============================-->
    <section id="wsus__login_register">
        <div class="container">
            <div class="wsus__track_area">
                <div class="row">
                    <div class="col-xl-5 col-md-10 col-lg-8 m-auto">
                        <form action="{{ route('order.track.index') }}" method="GET" class="tack_form">
                            <h4 class="text-center">order tracking</h4>
                            <p class="text-center">tracking your order status</p>
                            <div class="wsus__track_input">
                                <label class="d-block mb-2">Invoice id</label>
                                <input type="text" placeholder="#H25-21578455" value="{{ @$order->invoice_id }}"
                                    name="invoice_id">
                            </div>
                            @if ($errors->has('invoice_id'))
                                <div>
                                    <p style="color: red;">
                                        {{ $errors->first('invoice_id') }}</p>
                                </div>
                            @endif

                            <button type="submit" class="common_btn">track</button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="wsus__track_header">
                            <div class="wsus__track_header_text">
                                <div class="row">
                                    <div class="col-xl-3 col-sm-6 col-lg-3">
                                        <div class="wsus__track_header_single">
                                            <h5>Order Date</h5>
                                            <p>{{ date('d M Y', strtotime(@$order->created_at)) }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-lg-3">
                                        <div class="wsus__track_header_single">
                                            <h5>shopping by:</h5>
                                            <p>{{ @$order->user->name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-lg-3">
                                        <div class="wsus__track_header_single">
                                            <h5>status:</h5>
                                            <p>{{ @$order->order_status }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-lg-3">
                                        <div class="wsus__track_header_single border_none">
                                            <h5>tracking:</h5>
                                            <p>{{ @$order->invoice_id }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <ul class="progtrckr" data-progtrckr-steps="4">
                            <li style="width:23%" class="progtrckr_done icon_one check_mark">order pending</li>
                            <li style="width:23%" class="progtrckr_done icon_two @if(@$order->order_status == 'processed_and_ready_to_ship' || @$order->order_status == 'dropped_off' || @$order->order_status == 'shipped' || @$order->order_status == 'out_for_delivery' || @$order->order_status == 'delivered') check_mark @endif ">
                                order Processing</li>
                            <li style="width:23%" class="progtrckr_done icon_three  @if (@$order->order_status == 'shipped' || @$order->order_status == 'out_for_delivery' || @$order->order_status == 'delivered') check_mark @endif ">on the way</li>
                            <li style="width:23%" class="progtrckr_done icon_three mark  @if (@$order->order_status == 'delivered') check_mark @endif ">delivered</li>
                            {{-- <li class="progtrckr_done icon_four red_mark  @if (@$order->order_status == 'canceled') check_mark @endif  ">Canceled</li> --}}
                        </ul>
                    </div>
                    <div class="col-xl-12">
                        <a href="#" class="common_btn"><i class="fas fa-chevron-left"></i> back to order</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
            TRACKING ORDER END
        ==============================-->
@endsection
