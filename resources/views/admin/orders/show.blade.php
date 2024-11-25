@php
    $address = json_decode($order->order_address);
    $shipping = json_decode($order->shpping_method);
    $coupon = json_decode($order->coupon);
@endphp
@extends('admin.layout.master')
@section('title')
    Order Details
@endsection
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Order Details</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Order Name</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">Retrun</a>
                                </div>
                            </div>
                            <div class="section-body">
                                <div class="invoice">
                                    <div class="invoice-print">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="invoice-title">
                                                    <h2>Invoice</h2>
                                                    <div class="invoice-number">Order #{{ $order->invoice_id }}</div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <address>
                                                            <strong>Billed To:</strong><br>
                                                            <b> Name :</b> {{ $address->name }}<br>
                                                            <b> Email :</b>{{ $address->email }}<br>
                                                            <b> Phone :</b> {{ $address->phone }}<br>
                                                            <b> Address :</b> {{ $address->address }}<br>
                                                            <b> City :</b>{{ $address->city }},{{ $address->zip }}<br>
                                                            <b> Country :</b>{{ $address->country }}
                                                        </address>
                                                    </div>
                                                    <div class="col-md-6 text-md-right">
                                                        <address>
                                                            <strong>Billed To:</strong><br>
                                                            <b> Name :</b> {{ $address->name }}<br>
                                                            <b> Email :</b>{{ $address->email }}<br>
                                                            <b> Phone :</b> {{ $address->phone }}<br>
                                                            <b> Address :</b> {{ $address->address }}<br>
                                                            <b> City :</b>{{ $address->city }},{{ $address->zip }}<br>
                                                            <b> Country :</b>{{ $address->country }}
                                                        </address>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <address>
                                                            <strong>Payment Information:</strong><br>
                                                            <b>Method:</b>{{ $order->payment_method }}<br>
                                                            <b>Transaction Id:
                                                                {{ @$order->transaction->transaction_id }}</b>
                                                            <b>Status:
                                                            </b>{{ $order->payment_status == 1 ? 'Compeletd' : 'Pending' }}
                                                        </address>
                                                    </div>
                                                    <div class="col-md-6 text-md-right">
                                                        <address>
                                                            <strong>Order Date:</strong><br>
                                                            {{ date('d F , Y', strtotime($order->created_at)) }}<br><br>
                                                        </address>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <div class="section-title">Order Summary</div>
                                                <p class="section-lead">All items here cannot be deleted.</p>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover table-md">
                                                        <tr>
                                                            <th data-width="40">#</th>
                                                            <th>Item</th>
                                                            <th>Vendor Name</th>
                                                            <th>Variant</th>
                                                            <th class="text-center">Price</th>
                                                            <th class="text-center">Quantity</th>
                                                            <th class="text-right">Totals</th>
                                                        </tr>
                                                        {{-- Start For Each Loop --}}
                                                        @foreach ($order->OrderProducts as $product)
                                                            @php
                                                                $variants = json_decode($product->variants);
                                                            @endphp
                                                            <tr>
                                                                <td>{{ ++$loop->index }}</td>
                                                                <td><a target="_blank"
                                                                        href="{{ route('show.product.details', $product->product->slug) }}">{{ $product->product_name }}</a>
                                                                </td>
                                                                <td>{{ $product->vendor->shop_name }}</td>
                                                                <td>
                                                                    @if ($variants)
                                                                        @foreach ($variants as $key => $variant)
                                                                            <b>{{ $key }}:</b>
                                                                            {{ $variant->name }}({{ $settings->currency_icon }}{{ $variant->price }})
                                                                        @endforeach
                                                                    @else
                                                                        <p>there is no variants for this product</p>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ $settings->currency_icon }}{{ $product->unit_price }}
                                                                </td>
                                                                <td class="text-center">{{ $product->qty }}</td>
                                                                <td class="text-right">
                                                                    {{ $settings->currency_icon }}{{ ($product->unit_price + $product->variant_total) * $product->qty }}
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </table>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-lg-8">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="">Order Status</label>
                                                                    <select class="form-control" name="order_status"
                                                                        id="order_status">
                                                                        @foreach (config('order_status.order_status_admin') as $key => $orderStatus)
                                                                            <option @selected($order->order_status == $key)
                                                                                value="{{ $key }}">
                                                                                {{ $orderStatus['status'] }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Payment Status</label>
                                                                <select class="form-control" name="payment_status"
                                                                    id="payment_status">
                                                                   <option @selected($order->payment_status == 1) value="1">Compeleted</option>
                                                                   <option @selected($order->payment_status == 0) value="0">Pending</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 text-right">
                                                        <div class="invoice-detail-item">
                                                            <div class="invoice-detail-name">Subtotal</div>
                                                            <div class="invoice-detail-value">
                                                                {{ $settings->currency_icon }}{{ $order->sub_total }}
                                                            </div>
                                                        </div>
                                                        <div class="invoice-detail-item">
                                                            <div class="invoice-detail-name">Shipping (+)</div>
                                                            <div class="invoice-detail-value">
                                                                {{ $settings->currency_icon }}{{ $shipping->cost }}</div>
                                                        </div>
                                                        <div class="invoice-detail-item">
                                                            <div class="invoice-detail-name">Coupon (-)</div>
                                                            <div class="invoice-detail-value">
                                                                {{ $coupon ? $settings->currency_icon : '' }}{{ $coupon ? $coupon->discount : 'there is no coupon' }}
                                                            </div>
                                                        </div>
                                                        <hr class="mt-2 mb-2">
                                                        <div class="invoice-detail-item">
                                                            <div class="invoice-detail-name">Total</div>
                                                            <div class="invoice-detail-value invoice-detail-value-lg">
                                                                {{ $settings->currency_icon }}{{ $order->amount }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="text-md-right">

                                        <button class="btn btn-warning btn-icon icon-left print_invoice"><i class="fas fa-print"></i>
                                            Print</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#order_status').on('change', function() {
                let orderId = "{{ $order->id }}";
                let orderStatus = $(this).val();
                $.ajax({
                    method: 'PUT',
                    data: {
                        orderId: orderId,
                        orderStatus: orderStatus,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('admin.order.change.status') }}',
                    beforeSend: function() {},
                    success: function(response) {
                        if(response.status == 'success'){
                            toastr.success(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                    },

                    complete: function() {},
                })
            });
            $('#payment_status').on('change', function() {
                let orderId = "{{ $order->id }}";
                let paymentStatus = $(this).val();
                $.ajax({
                    method: 'PUT',
                    data: {
                        orderId: orderId,
                        paymentStatus: paymentStatus,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('admin.payment.change.status') }}',
                    beforeSend: function() {},
                    success: function(response) {
                        if(response.status == 'success'){
                            toastr.success(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                    },

                    complete: function() {},
                })
            });

            // Print Invoice
            $('.print_invoice').on('click',function(e){
                e.preventDefault();
               let printBody = $('invoice-print');
               let originalContents = $('body').html();
               $('body').html(printBody.html());
               window.print();
               $('body').html(originalContents);
            });
        });
    </script>
@endpush
