@extends('admin.layout.master')
@section('title')
    Product Reviews
@endsection
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Product Reviews</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ $product->name }} Reviews</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Return</a>
                                </div>
                            </div>
                            <div class="card-body">
                                {{ $dataTable->table() }} </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        $(document).ready(function() {
            let csrfToken = $('meta[name="csrf-token"]').attr('content');

            $('body').on('click', '.toggle_status', function() {
                let checkbox = $(this);
                let id = checkbox.data('id');
                let currentStatus = checkbox.data('status');
                let newStatus = currentStatus === 1 ? 0 : 1; // Toggle status

                // Update the checkbox's data-status attribute and checked property
                checkbox.data('status', newStatus);
                checkbox.prop('checked', newStatus === 1);

                $.ajax({
                    method: 'PUT',
                    url: '{{ route('admin.review.change.status') }}',
                    data: {
                        id: id,
                        status: newStatus,
                        _token: '{{ csrf_token() }}'
                    },
                    beforeSend: function() {
                        // Optional: Show loading spinner
                    },
                    success: function(response) {
                        // Optional: Handle success (e.g., display success message)
                    },
                    error: function(xhr, status, error) {
                        // Optional: Handle error
                    },
                    complete: function() {
                        // Optional: Hide loading spinner
                    }
                });
            });

        });
    </script>
@endpush
