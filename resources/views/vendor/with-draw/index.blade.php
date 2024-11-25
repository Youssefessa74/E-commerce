@extends('vendor.layout.master')

@section('title')
    {{ Auth::user()->name }} | Withdraw Request
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
                        <h3><i class="far fa-user"></i>Withdraw Request</h3>
                        <div class="wsus__dashboard">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="wsus__dashboard_item red" href="">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Current Balance</p>
                                        <h4 style="color:#ffff">{{ $settings->currency_icon }}{{ $currentBalance }}</h4>
                                    </a>
                                </div>

                                <div class="col-md-4">
                                    <a class="wsus__dashboard_item red" href="">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Pending Amount</p>
                                        <h4 style="color:#ffff">{{ $settings->currency_icon }}{{ $pendingWithDrawAmount }}</h4>
                                    </a>
                                </div>

                                <div class="col-md-4">
                                    <a class="wsus__dashboard_item red" href="">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Total Withdraw</p>
                                        <h4 style="color:#ffff">{{ $settings->currency_icon }}{{ $withDrawAmount }}</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <!-- Create Button -->
                                <div class="mb-3">
                                    <a href="{{ route('vendor.request-with-draw.create') }}" class="btn btn-info">
                                        <i class="fas fa-plus"></i> Create New withdraw request
                                    </a>
                                </div>
                                <table id="orders-table" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Method</th>
                                            <th>Total Amount</th>
                                            <th>Withdraw Amount</th>
                                            <th>Withdraw Charge</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if ($withdraw)
                                            @foreach ($withdraw as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->method }}</td>
                                                    <td>{{ $settings->currency_icon }}{{ $item->total_amount }}</td>
                                                    <td>{{ $settings->currency_icon }}{{ $item->withdraw_amount }}</td>
                                                    <td>{{ $settings->currency_icon }}{{ $item->withdraw_charge }}</td>
                                                    <td>
                                                        @if ($item->status == 'pending')
                                                        <span class="badge badge-warning">Pending</span>
                                                        @elseif($item->status =='decline')
                                                        <span class="badge badge-danger">Canceled</span>
                                                        @else
                                                        <span class="badge badge-success">Paid</span>
                                                        @endif
                                                    </td>
                                                    <td> <a href="{{ route('vendor.show.withdraw.request', $item->id) }}"
                                                            class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <p style="text-align: center">there is no WithDraw Requests</p>
                                        @endif
                                    </tbody>

                                </table>

                                <!-- Pagination -->
                                <div class="d-flex justify-content-between">
                                    <div>
                                        Showing {{ $withdraw->firstItem() }} to {{ $withdraw->lastItem() }} of
                                        {{ $withdraw->total() }} entries
                                    </div>
                                    <div>
                                        {{ $withdraw->links() }} <!-- This will generate pagination links -->
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
