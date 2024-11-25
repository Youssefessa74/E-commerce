
@extends('admin.layout.master')
@section('title')
    WithDraws Methods
@endsection
@section('content')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Vendor WithDraws Methods</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Vendor WithDraws Methods</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('admin.with-draws.create') }}" class="btn btn-primary">Add new</a>
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
@endpush
