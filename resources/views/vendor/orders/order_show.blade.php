@php
    $address = json_decode($order->order_address);
@endphp
@extends('vendor.layout.master')
@section('title')
    {{ Auth::user()->name }} | Orders
@endsection

@section('content')
    <!--=============================
                                DASHBOARD START
                            ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layout.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i>Order</h3>
                        <div class="wsus__dashboard_profile">
                            <!--============================
                    INVOICE PAGE START
                ==============================-->
                            <section  class="invoice-print">
                                <div class="">
                                    <div class="wsus__invoice_area">
                                        <div class="wsus__invoice_header">
                                            <div class="wsus__invoice_content">
                                                <div class="row">
                                                    <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                                        <div class="wsus__invoice_single">
                                                            <h5>Billing Information</h5>
                                                            <h6>{{ $address->name }}</h6>
                                                            <p>{{ $address->email }}</p>
                                                            <p>{{ $address->phone }}</p>
                                                            <p>{{ $address->address }},
                                                                {{ $address->city }},{{ $address->country }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                                        <div class="wsus__invoice_single text-md-center">
                                                            <h5>Billing Information</h5>
                                                            <h6>{{ $address->name }}</h6>
                                                            <p>{{ $address->email }}</p>
                                                            <p>{{ $address->phone }}</p>
                                                            <p>{{ $address->address }},
                                                                {{ $address->city }},{{ $address->country }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-md-4">
                                                        <div class="wsus__invoice_single text-md-end">
                                                            <h5>Order Id : #{{ $order->invoice_id }}</h5>
                                                            <h6>Order Status: {{ $order->order_status }} </h6>
                                                            <p>Payment Method: {{ $order->payment_method }}</p>
                                                            <p>Payment Status: {{ $order->payment_status }}</p>
                                                            <p>Transaction Id: {{ $order->transaction->transaction_id }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wsus__invoice_description">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <th class="name">
                                                                product
                                                            </th>

                                                            <th class="amount">
                                                                amount
                                                            </th>

                                                            <th class="quentity">
                                                                quentity
                                                            </th>
                                                            <th class="total">
                                                                total
                                                            </th>
                                                        </tr>
                                                        @foreach ($order->OrderProducts as $product)
                                                            @if ($product->vendor_id == auth()->user()->vendor->id)
                                                                <tr>
                                                                    @php
                                                                        $variants = json_decode($product->variants);
                                                                        $total = $product->unit_price * $product->qty;
                                                                    @endphp
                                                                    <td class="name">
                                                                        <p>{{ $product->product_name }}</p>
                                                                        @foreach ($variants as $key => $item)
                                                                            <span>{{ $key }}:{{ $item->name }}({{ $settings->currency_icon }}
                                                                                {{ $item->price }})</span>
                                                                        @endforeach
                                                                    </td>
                                                                    <td class="amount">
                                                                        {{ $settings->currency_icon }}{{ $product->unit_price }}
                                                                    </td>

                                                                    <td class="quentity">
                                                                        {{ $product->qty }}
                                                                    </td>
                                                                    <td class="total">
                                                                        {{ $settings->currency_icon }} {{ $total }}
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach

                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wsus__invoice_footer">

                                            <p><span>Total Amount:</span> {{ $settings->currency_icon }}
                                                {{ $product->unit_price * $product->qty }} </p>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!--============================
                    INVOICE PAGE END
                ==============================-->
                            <div class="col-md-4">
                                <div class="form-group mt-5">
                                    <label for="">Order Status</label>
                                    <select name="order_status" id="order_status_select" class="form-control">
                                        @foreach (config('order_status.order_status_vendor') as $key => $item)
                                            <option @selected($key == $order->order_status) value="{{ $key }}">
                                                {{ $item['status'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <div class="mt-5 float-end"></div>
                                    <button class="btn btn-warning print_invoice">Print</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!--=============================
                                DASHBOARD END
                            ==============================-->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#order_status_select').on('change', function() {
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
                    url: '{{ route('vendor.order.change.status') }}',
                    beforeSend: function() {},
                    success: function(response) {
                        if (response.status == 'success') {
                            toastr.success(response.message);
                        }
                    },
                    error: function(xhr, status, error) {},

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