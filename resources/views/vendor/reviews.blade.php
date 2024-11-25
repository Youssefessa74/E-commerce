@extends('vendor.layout.master')

@section('title')
    {{ Auth::user()->name }} | Reviews
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
                        <h3><i class="far fa-user"></i>Reviews</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">

                                <table id="orders-table" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product</th>
                                            <th>User</th>
                                            <th>Rating</th>
                                            <th>Review</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if ($reviews)
                                            @foreach ($reviews as $review)
                                                <tr id="row_{{ $review->id }}">
                                                    <td>{{ $review->id }}</td>
                                                    <td>{{ $review->product->name }}</td>
                                                    <td>{{ $review->user->name }}</td>
                                                    <!-- Assuming the relationship is set correctly -->
                                                    <td>{{ $review->rating }}</td>
                                                    <td>{{ $review->review }}</td>
                                                    <td>
                                                    @if ($review->status == 1)
                                                    <span class="badge bg-success">Approved</span>
                                                    @else
                                                    <span class="badge bg-warning">Pending</span>
                                                    @endif
                                                    </td>

                                                </tr>
                                            @endforeach
                                        @else
                                            <p style="text-align: center">there is no Reviews</p>
                                        @endif
                                    </tbody>

                                </table>

                                <!-- Pagination -->
                                <div class="d-flex justify-content-between">
                                    <div>
                                        Showing {{ $reviews->firstItem() }} to {{ $reviews->lastItem() }} of
                                        {{ $reviews->total() }} entries
                                    </div>
                                    <div>
                                        {{ $reviews->links() }} <!-- This will generate pagination links -->
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
