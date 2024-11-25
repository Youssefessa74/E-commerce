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
                        <h4>check out</h4>
                        <ul>
                            <li><a href="{{ route('home') }}">home</a></li>
                            <li><a href="#">peoduct</a></li>
                            <li><a href="{{ route('checkout.index') }}">check out</a></li>
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
                CHECK OUT PAGE START
            ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="wsus__check_form">
                        <h5>Billing Details <a class="common_btn" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">add
                                new address</a></h5>
                        <div class="row">
                            @foreach ($userAddresses as $item)
                                <div class="col-xl-6">
                                    <div class="wsus__checkout_single_address">
                                        <div class="form-check">
                                            <input class="form-check-input address_method" type="radio"
                                                value="{{ $item->id }}" name="flexRadioDefault" id="flexRadioDefault1"
                                                checked>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Select Address
                                            </label>
                                        </div>
                                        <ul>
                                            <li><span>Name :</span>{{ $item->name }}</li>
                                            <li><span>Phone :</span>{{ $item->phone }}</li>
                                            <li><span>Email :</span> {{ $item->email }}</li>
                                            <li><span>Country :</span>{{ $item->country }}</li>
                                            <li><span>City :</span> {{ $item->city }}</li>
                                            <li><span>Zip Code :</span> {{ $item->zip }}</li>
                                            <li><span>Address :</span> {{ $item->address }}</li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="wsus__order_details" id="sticky_sidebar">
                        <p class="wsus__product">shipping Methods</p>
                        @foreach ($shipping as $item)
                            @if ($item->type == 'min_cost' && CartTotal() >= $item->min_cost)
                                <div class="form-check">
                                    <input class="form-check-input shipping_method" type="radio" name="exampleRadios"
                                        id="exampleRadios1" value="{{ $item->id }}" data-cost="{{ $item->cost }}">
                                    <label class="form-check-label" for="exampleRadios1">
                                        {{ $item->name }}
                                        <span>cost :{{ $settings->currency_icon }}{{ $item->cost }}</span>
                                    </label>
                                </div>
                            @elseif($item->type == 'flat_cost')
                                <div class="form-check">
                                    <input class="form-check-input shipping_method" type="radio" name="exampleRadios"
                                        id="exampleRadios1" value="{{ $item->id }}" data-cost="{{ $item->cost }}">
                                    <label class="form-check-label" for="exampleRadios1">
                                        {{ $item->name }}
                                        <span>cost :{{ $settings->currency_icon }}{{ $item->cost }}</span>
                                    </label>
                                </div>
                            @endif
                        @endforeach

                        <div class="wsus__order_details_summery">
                            <p>subtotal: <span>{{ $settings->currency_icon }}{{ CartTotal() }}</span></p>
                            <p>shipping fee: <span id="shipping_fee">$0</span></p>
                            <p>Coupon: <span id="coupon_amount"
                                    data-cost="{{ GetDiscount() }}">{{ $settings->currency_icon }}{{ GetDiscount() > 0 ? GetDiscount() : 0 }}</span>
                            </p>
                            <p><b>total:</b> <span id="total_amount"
                                    data-cost="{{ CartTotal() }}"><b></b>{{ $settings->currency_icon }}{{ GetMainCartTotal() }}</span>
                            </p>
                        </div>
                        <div class="terms_area">
                            <div class="form-check">
                                <input class="form-check-input agree_terms_check" type="checkbox" value="" id="flexCheckChecked3"
                                    checked>
                                <label class="form-check-label" for="flexCheckChecked3">
                                    I have read and agree to the website <a href="#">terms and conditions *</a>
                                </label>
                            </div>
                        </div>
                        <form action="" id="checkOutForm">
                            <input type="hidden" name="shipping_method_id" id="shipping_method_id" value="">
                            <input type="hidden" name="shipping_address_id" id="shipping_address_id" value="">
                            <button type="submit" id="checkOutFormBtn" class="common_btn">Place Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="wsus__popup_address">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('checkout.create.address') }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Address</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <div class="wsus__check_form p-3">
                                <div class="row">
                                    <!-- Name Input -->
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" name="name" placeholder="Name"
                                                value="{{ old('name') }}">
                                            @if ($errors->has('name'))
                                                <div>
                                                    <p style="color: red;">
                                                        {{ $errors->first('name') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Phone Input -->
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" name="phone" placeholder="Phone"
                                                value="{{ old('phone') }}">
                                            @if ($errors->has('phone'))
                                                <div>
                                                    <p style="color: red;">
                                                        {{ $errors->first('phone') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Email Input -->
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="email" name="email" placeholder="Email"
                                                value="{{ old('email') }}">
                                            @if ($errors->has('email'))
                                                <div>
                                                    <p style="color: red;">
                                                        {{ $errors->first('email') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Country Input -->
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <select class="select_2" name="country">
                                                <option value="">Select Country</option>
                                                <option value="Country1">Country1</option>
                                                <option value="Country2">Country2</option>
                                                <!-- Add more country options as needed -->
                                            </select>
                                            @if ($errors->has('country'))
                                                <div>
                                                    <p style="color: red;">
                                                        {{ $errors->first('country') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Address Input -->
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" name="address" placeholder="Address"
                                                value="{{ old('address') }}">
                                            @if ($errors->has('address'))
                                                <div>
                                                    <p style="color: red;">
                                                        {{ $errors->first('address') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- City Input -->
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" name="city" placeholder="City"
                                                value="{{ old('city') }}">
                                            @if ($errors->has('city'))
                                                <div>
                                                    <p style="color: red;">
                                                        {{ $errors->first('city') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Zip Input -->
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" name="zip" placeholder="Zip"
                                                value="{{ old('zip') }}">
                                            @if ($errors->has('zip'))
                                                <div>
                                                    <p style="color: red;">
                                                        {{ $errors->first('zip') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Save Changes Button -->
                                    <div class="col-xl-12">
                                        <div class="wsus__check_single_form">
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!--============================
                CHECK OUT PAGE END
            ==============================-->
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('input[type="radio"]').prop('checked', false);
            // let's grap the IDs and make some calculations
            $('.shipping_method').on('click', function() {
                let currency_icon = "{{ $settings->currency_icon }}";
                let shippingId = $(this).val();
                let shippingCost = $(this).data('cost');
                let couponAmount = $('#coupon_amount').data('cost');
                let totalAmount = $('#total_amount').data('cost');
                let sum = (totalAmount + shippingCost) - couponAmount;
                $('#shipping_method_id').val(shippingId);
                $('#shipping_fee').text(currency_icon + shippingCost);
                $('#total_amount').text(currency_icon + sum);
            });
            // let's grap the address
            $('.address_method').on('click', function() {
                let addressId = $(this).val();
                $('#shipping_address_id').val(addressId);
            });
            // let's send a form
            $('#checkOutForm').on('submit', function(e) {
                e.preventDefault();
                if ($('#shipping_address_id').val() == '') {
                    toastr.error('Please select address');
                } else if ($('#shipping_method_id').val() == '') {
                    toastr.error('Please select Shipping method');
                } else if(!$('.agree_terms_check').prop('checked')){
                    toastr.error('You Have to agree our Terms');
                }
                 else {
                    let formData = $(this).serialize();
                    $.ajax({
                        method: 'POST',
                        url: '{{ route('checkout') }}',
                        headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         },
                        data:formData,
                        beforeSend: function(){
                            $('#checkOutFormBtn').html('<i class="fas fa-spinner fa-spin fa-1x"><i/>');
                        },
                        success: function(response) {
                            $('#checkOutFormBtn').html('Place Order');
                            if(response.status == 'success'){
                                window.location.href = response.redirect_url;
                            }
                        },
                        error: function(xhr, status, error) {}
                    });
                }
            });
        });
    </script>
@endpush
