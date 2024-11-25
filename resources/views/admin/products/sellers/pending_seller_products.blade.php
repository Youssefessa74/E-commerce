@extends('admin.layout.master')
@section('title')
  Pending Sellers Products
@endsection
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pending Sellers Products</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Pending Sellers Products</h4>
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
        $(document).ready(function(){
            $('body').on('change','.approve_status',function(){
                let id = $(this).data('id');
                let is_approved = $(this).val();
                let csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    method: 'PUT',
                    url: '{{ route("admin.change_seller_status") }}',
                    data: {
                        id : id,
                        is_approved:is_approved,
                        _token: csrfToken
                    },
                    beforeSend: function() {
                    },
                    success: function(response) {
                    },
                    error: function(xhr, status, error) {

                    },
                    complete: function() {
                    }
                });
            });
        });
    </script>
@endpush
