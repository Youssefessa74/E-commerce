@extends('admin.layout.master')
@section('title')
    Product Variants
@endsection
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Product Variants</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <h4>Product : {{ $product->name }}</h4>
                                    <a href="{{ route('admin.products.index') }}" class="btn btn-danger">Return </a>
                                    &nbsp;  &nbsp;  &nbsp;
                                </div>

                                <div class="card-header-action">
                                    <a href="{{ route('admin.variant.create',['product'=>$product]) }}" class="btn btn-primary">Add new</a>
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
@endpush
