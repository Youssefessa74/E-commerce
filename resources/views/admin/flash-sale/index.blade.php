@extends('admin.layout.master')
@section('title')
    Flash Sale
@endsection
@section('content')
    <div class="main-content">

        <section class="section">
            <div class="section-header">
                <h1>Flash Sale</h1>
            </div>
            {{-- Start Flash Sale End Date --}}
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Flash Sale End Date</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.flash.sale.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Sale End Date</label>
                                            <input type="text" class="form-control datepicker"
                                                value="{{ @$flashsale->end_date }}" name="end_date" id="">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End  Flash Sale End Date --}}

            {{-- Start Flash Sale Add new --}}
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Add Products To Flash Sale</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.flash.sale.add.product') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="flash_sale_id" value="{{ $flashsale->id }}">
                                    <div class="form-group">
                                        <label for="">Select A Flash Sale Product </label>
                                        <select name="product" class="form-control select2" id="">
                                            <option selected disabled value="">Choose</option>
                                            @foreach ($products as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('product'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('product') }}</p>
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Status</label>
                                                <select name="status" class="form-control" id="">
                                                    <option value="1">Active</option>
                                                    <option value="0">In Active</option>
                                                </select>
                                            </div>
                                            @if ($errors->has('status'))
                                                <div>
                                                    <p style="color: red;">
                                                        {{ $errors->first('status') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Show At Home</label>
                                                <select name="show_at_home" class="form-control" id="">
                                                    <option value="1">Active</option>
                                                    <option value="0">In Active</option>
                                                </select>
                                            </div>
                                            @if ($errors->has('show_at_home'))
                                                <div>
                                                    <p style="color: red;">
                                                        {{ $errors->first('show_at_home') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End  Flash Sale Add new --}}

            {{-- Start Flash Sale Data Table --}}
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Flash Sales</h4>
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
            {{-- End Flash Sale Data Table --}}
        </section>

    </div>
@endsection




@push('scripts')
    <!-- Initialize DataTable with Ajax and pagination -->
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $(document).ready(function() {
            let csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('body').on('click', '.toggle_status', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0; // Update status based on checkbox state
                $.ajax({
                    method: 'PUT',
                    url: '{{ url('admin/flash-sale-change-status') }}',
                    data: {
                        id: id,
                        status: status,
                        _token: csrfToken
                    },
                    beforeSend: function() {
                        // Optional: Show loading spinner
                    },
                    success: function(response) {
                        // Handle success
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

            $('body').on('click', '.toggle_show_at_home', function() {
                let id = $(this).data('id');
                let show_at_home = $(this).is(':checked') ? 1 : 0; // Update status based on checkbox state
                $.ajax({
                    method: 'PUT',
                    url: '{{ url('admin/flash-sale-change-show-at-home') }}',
                    data: {
                        id: id,
                        show_at_home: show_at_home,
                        _token: csrfToken
                    },
                    beforeSend: function() {
                        // Optional: Show loading spinner
                    },
                    success: function(response) {
                        // Handle success
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
