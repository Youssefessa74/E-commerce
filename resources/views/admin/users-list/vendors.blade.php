
@extends('admin.layout.master')
@section('title')
    Vendors
@endsection
@section('content')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Vendors</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Vendors</h4>

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




    <!-- CSRF Token Setup for AJAX requests -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <!-- Initialize DataTable with Ajax and pagination -->
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <!-- Optional: Additional AJAX setup for category status toggling (if needed) -->
    <script>
        $(document).ready(function() {
            $('body').on('click', '.toggle_status', function() {
                let id = $(this).data('id');
                let status = $(this).data('status');

                $.ajax({
                    method: 'PUT',
                    url: '{{ route("admin.vendor.list.change.status") }}',
                    data: { id: id, status: status },
                    beforeSend: function() {
                        // Optional: Show loading spinner
                    },
                    success: function(response) {

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
