
@extends('admin.layout.master')
@section('title')
    Admins
@endsection
@section('content')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Admins</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Admins</h4>

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

                // Toggle the status value before sending
                let newStatus = status === 'active' ? 'inactive' : 'active';

                $.ajax({
                    method: 'PUT',
                    url: '{{ route("admin.admin.list.change.status") }}',
                    data: { id: id, status: newStatus, _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        // Update the status in the data attribute to the new status
                        $(`input[data-id="${id}"]`).data('status', newStatus);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error updating status:", error);
                    }
                });
            });
        });
    </script>

@endpush
