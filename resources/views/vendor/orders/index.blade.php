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
                        <h3><i class="far fa-user"></i>Orders</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">

                                <table id="orders-table" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Invoice ID</th>
                                            <th>Customer</th>
                                            <th>Date</th>
                                            <th>Product Quantity</th>
                                            <th>Amount</th>
                                            <th>Order Status</th>
                                            <th>Payment Status</th>
                                            <th>Payment Method</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if($orders)
                                        @foreach ($orders as $order)
                                            <tr id="row_{{ $order->id }}">
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->invoice_id }}</td>
                                                <td>{{ $order->user->name }}</td> <!-- Assuming the relationship is set correctly -->
                                                <td>{{ date('Y-m-d', strtotime($order->created_at)) }}</td>
                                                <td>{{ $order->product_qty }}</td>
                                                <td>{{ $order->currency_icon }}{{ $order->amount }}</td>
                                                <td>
                                                    @switch($order->order_status)
                                                        @case('pending')
                                                            <span class="badge bg-warning">Pending</span>
                                                            @break
                                                        @case('processed_and_ready_to_ship')
                                                            <span class="badge bg-info">Processed</span>
                                                            @break
                                                        @case('shipped')
                                                            <span class="badge bg-info">Shipped</span>
                                                            @break
                                                        @case('out_for_delivery')
                                                            <span class="badge bg-primary">Out for Delivery</span>
                                                            @break
                                                        @case('delivered')
                                                            <span class="badge bg-success">Delivered</span>
                                                            @break
                                                        @case('canceled')
                                                            <span class="badge bg-danger">Canceled</span>
                                                            @break
                                                        @default
                                                            <span class="badge bg-secondary">Unknown</span>
                                                    @endswitch
                                                </td>
                                                <td>
                                                    @if ($order->payment_status === 0)
                                                        <span class="badge badge-warning">Pending</span>
                                                    @else
                                                        <span class="badge badge-success">Paid</span>
                                                    @endif
                                                </td>
                                                <td>{{ $order->payment_method }}</td>
                                                <td>
                                                    <a href="{{ route('vendor.order.show',$order->id) }}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @else
                                        <p style="text-align: center">there is no Orders</p>
                                        @endif
                                    </tbody>

                                </table>

                                <!-- Pagination -->
                                <div class="d-flex justify-content-between">
                                    <div>
                                        Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} entries
                                    </div>
                                    <div>
                                        {{ $orders->links() }} <!-- This will generate pagination links -->
                                    </div>
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

@endpush
