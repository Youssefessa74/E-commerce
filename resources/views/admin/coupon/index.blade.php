
@extends('admin.layout.master')
@section('title')
    Coupons
@endsection
@section('content')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Coupons</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Coupons</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('admin.coupon.create') }}" class="btn btn-primary">Add new</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- DataTable to display categories -->
                                {{ $dataTable->table() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection




@push('scripts')
    <!-- Initialize DataTable with Ajax and pagination -->
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $(document).ready(function() {
            let csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('body').on('click', '.toggle_status', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0; // Update status based on checkbox state
                $.ajax({
                    method: 'PUT',
                    url: '{{ url('admin/flash-sale-change-status') }}',
                    data: {
                        id: id,
                        status: status,
                        _token: csrfToken
                    },
                    beforeSend: function() {
                        // Optional: Show loading spinner
                    },
                    success: function(response) {
                        // Handle success
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error('Error:', error);
                    },
                    complete: function() {
                        // Optional: Hide loading spinner
                    }
                });
            });

            $('body').on('click', '.toggle_status', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0; // Update status based on checkbox state
                $.ajax({
                    method: 'PUT',
                    url: '{{ url('admin/coupon-change-status') }}',
                    data: {
                        id: id,
                        status: status,
                        _token: csrfToken
                    },
                    beforeSend: function() {
                        // Optional: Show loading spinner
                    },
                    success: function(response) {
                        // Handle success
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error('Error:', error);
                    },
                    complete: function() {
                        // Optional: Hide loading spinner
                    }
                });
            });

        });
    </script>
@endpush
