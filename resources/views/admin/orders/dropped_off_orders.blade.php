@extends('admin.layout.master')
@section('title')
Dropped Off Orders
@endsection
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dropped Off Orders
                </h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Dropped Off Orders
                                </h4>

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
@endpush
