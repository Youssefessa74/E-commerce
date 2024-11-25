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
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <!-- Create Button -->
                                <div class="mb-3">
                                    <a href="{{ route('vendor.request-with-draw.index') }}" class="btn btn-info">
                                        <i class="fas fa-arraw"></i> return
                                    </a>
                                </div>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td><b>Withdraw Method</b></td>
                                            <td>{{ $withdraw->method }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Withdraw Charge</b></td>
                                            <td>{{ ($withdraw->withdraw_charge / $withdraw->total_amount) * 100 }}%</td>
                                        </tr>

                                        <tr>
                                            <td><b>Total Amount</b></td>
                                            <td>{{ $settings->currency_icon }}{{ $withdraw->total_amount }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Status</b></td>
                                            <td>
                                                @if ($withdraw->status == 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                                @elseif($withdraw->status =='decline')
                                                <span class="badge badge-danger">Canceled</span>
                                                @else
                                                <span class="badge badge-success">Paid</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Account Information</b></td>
                                            <td>{{ $withdraw->account_info }}</td>
                                        </tr>
                                    </tbody>
                                </table>
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
