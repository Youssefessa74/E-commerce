@extends('admin.layout.master')
@section('title')
    Products
@endsection
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Products</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Products</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add new</a>
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
           let id  = $(this).data('id');
           let status = $(this).data('status');

           $.ajax({
                    method: 'PUT',
                    url: '{{ route("admin.get_product_status") }}',
                    data: { id: id, status: status ,_token: csrfToken // Pass the CSRF token
                    },
                    beforeSend: function() {
                        // Optional: Show loading spinner
                    },
                    success: function(response) {
                        // Handle success, maybe reload the DataTable
                        $('#categoriesTable').DataTable().ajax.reload();
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
