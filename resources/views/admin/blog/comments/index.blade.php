
@extends('admin.layout.master')
@section('title')
   Blog Comments
@endsection
@section('content')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>   Blog Comments
                </h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All    Blog Comments
                                </h4>
                               
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
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
