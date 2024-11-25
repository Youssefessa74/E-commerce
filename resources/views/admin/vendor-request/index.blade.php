
@extends('admin.layout.master')
@section('title')
    Vendor Requests
@endsection
@section('content')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Vendor Requests</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Vendor Requests</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('admin.category.create') }}" class="btn btn-primary">Add new</a>
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

@endpush
