@extends('admin.layout.master')
@section('title')
    WithDraw Requests
@endsection
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1> WithDraw Requests </h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4> WithDraw Requests </h4>
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
@endpush
