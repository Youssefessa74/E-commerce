@extends('frontend.layout.master')
@section('title')
    Cart Details
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
                        <h4>cart View</h4>
                        <ul>
                            <li><a href="{{ route('home') }}">home</a></li>
                            <li><a href="#">peoduct</a></li>
                            <li><a href="#">cart view</a></li>
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
                                                            CART VIEW PAGE START
                                                        ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <div class="wsus__cart_list">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    <tr class="d-flex">
                                        <th class="wsus__pro_img">
                                            Product item
                                        </th>

                                        <th class="wsus__pro_name">
                                            Product details
                                        </th>



                                        <th class="wsus__pro_tk">
                                            Product price
                                        </th>

                                        <th class="wsus__pro_tk">
                                            Total price
                                        </th>
                                        <th class="wsus__pro_select">
                                            Quantity
                                        </th>

                                        <th class="wsus__pro_icon">
                                            <a href="#" class="common_btn clear_cart">clear cart</a>
                                        </th>
                                    </tr>
                                    @foreach ($cartItems as $item)
                                        <tr class="d-flex">
                                            <td class="wsus__pro_img"><img src="{{ asset($item->options->image) }}"
                                                    alt="product" class="img-fluid w-100">
                                            </td>

                                            <td class="wsus__pro_name">
                                                <p>{{ $item->name }}</p>
                                                @foreach ($item->options->variants as $key => $option)
                                                    <span>{{ $key }} : {{ $option['name'] }} -
                                                        ({{ $settings->currency_icon }}{{ $option['price'] }})
                                                    </span>
                                                @endforeach
                                            </td>



                                            <td class="wsus__pro_tk">
                                                <h6>{{ $settings->currency_icon }}{{ $item->price }}</h6>
                                            </td>

                                            <td class="wsus__pro_tk">
                                                <h6 id="{{ $item->rowId }}">
                                                    {{ $settings->currency_icon }}{{ ($item->price + $item->options->variants_total) * $item->qty }}
                                                </h6>
                                            </td>
                                            <td class="wsus__pro_select">
                                                <div class="product_qty_wrapper">
                                                    <button class="btn btn-danger product-decrement">-</button>
                                                    <input class="product-qty" data-rowId="{{ $item->rowId }}"
                                                        type="text" min="1" max="100"
                                                        value="{{ $item->qty }}" />
                                                    <button class="btn btn-success product-increment">+</button>
                                                </div>
                                            </td>

                                            <td class="wsus__pro_icon">
                                                <a href="{{ route('cart.remove.product', $item->rowId) }}"
                                                    onclick="return confirm('Are you sure you want to remove this item?')">
                                                    <i class="far fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if ($cartItems->count() == 0)
                                        <tr class="d-flex">
                                            <td class="wsus__pro_icon" rowspan="2" style="width: 100%">
                                                Cart Is Empty!
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="wsus__cart_list_footer_button" id="sticky_sidebar">
                        <h6>total cart</h6>
                        <p>subtotal: <span id="sub_total_span">{{ $settings->currency_icon }}{{ CartTotal() }}</span>
                        </p>
                        <p>Coupon(-): <span id="coupon_discount">{{ $settings->currency_icon }}{{ GetDiscount() }}</span>
                        </p>
                        <p class="total"><span>total:</span> <span
                                id="total_after_discount">{{ $settings->currency_icon }}{{ GetMainCartTotal() }}</span>
                        </p>

                        <form id="coupon_form">
                            @csrf
                            <input type="text"
                                value="{{ session()->has('coupon') ? session()->get('coupon')['coupon_code'] : '' }}"
                                name="coupon_code" placeholder="Coupon Code">
                            <button type="submit" class="common_btn">apply</button>
                        </form>
                        <a class="common_btn mt-4 w-100 text-center" href="{{ route('checkout.index') }}">checkout</a>
                        <a class="common_btn mt-1 w-100 text-center" href="{{ route('home') }}"><i
                                class="fab fa-shopify"></i>Keep Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="wsus__single_banner">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    @if ($cart_page_banners)
                    <div class="wsus__single_banner_content">
                        <div class="wsus__single_banner_img">
                            <img src="{{ asset($cart_page_banners->banner_one->banner_image)}}" alt="banner" class="img-fluid w-100">
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
                    <div class="wsus__single_banner_content single_banner_2">
                        <div class="wsus__single_banner_img">
                            <img src="{{ asset($cart_page_banners->banner_two->banner_image)}}" alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>New Collection</h6>
                            <h3>Cosmetics</h3>
                            <a class="shop_btn" href="#">shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
                                                              CART VIEW PAGE END
                                                        ==============================-->
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            // Decrement functionality
            $('.product-decrement').on('click', function() {
                let input = $(this).siblings('.product-qty');
                let qty = parseInt(input.val()) - 1;
                let rowId = input.attr('data-rowid'); // Retrieve rowId

                // Prevent decrementing below 1
                if (qty < 1) {
                    qty = 1;
                }

                input.val(qty);

                // AJAX request for decrement
                $.ajax({
                    method: 'POST',
                    data: {
                        qty: qty,
                        rowId: rowId,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('cart.update.qty') }}',
                    success: function(response) {
                        let productTotal = '#' + rowId;
                        $(productTotal).html('{{ $settings->currency_icon }}' + response
                            .product_total);
                        GetSubTotal();
                        CalcCoupon();
                        if (response.status == 'stock_out') {
                            toastr.error(response.message);
                        }

                    },
                    error: function(xhr, status, error) {}
                });
            });
            // Increment functionality
            $('.product-increment').on('click', function() {
                let input = $(this).siblings('.product-qty');
                let qty = parseInt(input.val()) + 1;
                let rowId = input.attr('data-rowid'); // Using attr() to retrieve the exact attribute
                input.val(qty);
                $.ajax({
                    method: 'POST',
                    data: {
                        qty: qty,
                        rowId: rowId,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('cart.update.qty') }}',
                    beforeSend: function() {},
                    success: function(response) {
                        let productTotal = '#' + rowId;
                        $(productTotal).html('{{ $settings->currency_icon }}' + response
                            .product_total);
                        GetSubTotal();
                        CalcCoupon();
                        if (response.status == 'stock_out') {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {},

                    complete: function() {},
                })
            });
            // Clear Cart functionality
            $('.clear_cart').on('click', function(e) {
                e.preventDefault();

                let confirmClear = confirm("Are you sure you want to clear the cart?");

                if (confirmClear) {
                    $.ajax({
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route('clear.cart') }}',
                        success: function(response) {
                            alert("Cart has been cleared successfully!");
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.error('Error clearing cart:', error);
                            alert("There was an error clearing the cart. Please try again.");
                        }
                    });
                }
            });
            // Calc Coupon
            $('#coupon_form').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                $.ajax({
                    method: 'GET',
                    data: formData,
                    url: '{{ route('apply.coupon') }}',
                    success: function(response) {
                        if (response.status == 'success') {
                            toastr.success(response.message);
                            CalcCoupon();
                        }
                        if (response.status == 'error') {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {}
                });
            });
            // Calc Coupon
            function CalcCoupon() {
                let currency_icon = "{{ $settings->currency_icon }}";
                $.ajax({
                    method: 'GET',
                    url: '{{ route('calc.coupon') }}',
                    success: function(response) {
                        $('#coupon_discount').html(currency_icon + response.discount);
                        $('#total_after_discount').html(currency_icon + response.total);
                    },
                    error: function(xhr, status, error) {}
                });
            }
            // Calc Sub Total
            function GetSubTotal() {
                let currency = "{{ $settings->currency_icon }}";
                $.ajax({
                    method: 'GET',
                    url: '{{ route('get.cart.total') }}',
                    success: function(response) {
                        $('#sub_total_span').html(currency + response.total);
                    },
                    error: function(xhr, status, error) {}
                });
            }

        });
    </script>
@endpush
,
