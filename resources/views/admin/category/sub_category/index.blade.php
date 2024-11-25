@extends('admin.layout.master')
@section('title')
  Sub  Categories
@endsection
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Sub Categories</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Sub Categories</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('admin.sub-category.create') }}" class="btn btn-primary">Add new</a>
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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').on('click', '.toggle_status', function() {
        let id = $(this).data('id');
        $.ajax({
            method: 'PUT',
            data: {
                id: id,
                status: $(this).data('status') // Assuming you have a data-status attribute
            },
            url: '{{ url("admin/sub-category-change-status") }}',
            beforeSend: function() {
                // Optional: Show loading spinner
            },
            success: function(response) {

            },
            error: function(xhr, status, error) {

            },
            complete: function() {
                // Optional: Hide loading spinner
            },
        });
    });
});
  </script>
@endpush
