@extends('vendor.layout.master')

@section('title')
    {{ Auth::user()->name }} | Products
@endsection

@section('content')
    <!--=============================
                    DASHBOARD START
                ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layout.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i>Product</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <!-- Create Button -->
                                <div class="mb-3">
                                    <a href="{{ route('vendor.products.create') }}" class="btn btn-info">
                                        <i class="fas fa-plus"></i> Create New Product
                                    </a>
                                </div>
                                <table id="products-table" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Product Type</th>
                                            <th>Is Approved</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr id="row_{{ $product->id }}">
                                                <td>{{ $product->id }}</td>
                                                <td><img width="70px" src="{{ asset($product->thumb_image) }}"></td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->price }}</td>
                                                <td>
                                                    @switch($product->product_type)
                                                        @case('new_arrival')
                                                            <span class="badge badge-success">New Arrival</span>
                                                        @break

                                                        @case('featured_product')
                                                            <span class="badge badge-warning">Featured Product</span>
                                                        @break

                                                        @case('top_product')
                                                            <span class="badge badge-info">Top Product</span>
                                                        @break

                                                        @case('best_product')
                                                            <span class="badge badge-danger">Best Product</span>
                                                        @break

                                                        @default
                                                            <span class="badge badge-danger">Nothing</span>
                                                    @endswitch
                                                </td>
                                                    <td>
                                                        {!! $product->is_approved ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-danger">Pending</span>' !!}
                                                    </td>
                                                <td>
                                                    <div class="form-group">
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" {{ $product->status ? 'checked' : '' }}
                                                                data-id="{{ $product->id }}"
                                                                data-status="{{ $product->status }}"
                                                                class="custom-switch-input toggle_status">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td style="width: 200px">
                                                    <a href="{{ route('vendor.products.edit', $product->id) }}"
                                                        class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                    <form action="{{ route('vendor.products.destroy', $product->id) }}"
                                                        method="POST" style="display:inline;"
                                                        onsubmit="return confirm('Are you sure?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger ml-2"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                    <div class="dropdown d-inline">
                                                        <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton{{ $product->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-cog"></i>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $product->id }}">
                                                            <a class="dropdown-item has-icon" href="{{ route('vendor.gallery.index',['product'=>$product->id])}}">Gallery</a>
                                                            <a class="dropdown-item has-icon" href="{{ route('vendor.variant.index', ['product' => $product->id]) }}">Variants</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-between">
                                    <div>
                                        Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of
                                        {{ $products->total() }} entries
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
                    DASHBOARD END
                ==============================-->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#products-table').DataTable({
                // If using server-side pagination, set this option to true
                processing: true,
                serverSide: false,
                // You can customize the pagination settings here if needed
            });
        });

        $(document).ready(function() {
            $('.toggle_status').on('click', function() {
                let id = $(this).data('id');
                let status = $(this).data('status');
                let csrfToken = $('meta[name="csrf-token"]').attr('content')
                $.ajax({
                    method: 'PUT',
                    data: {
                        id: id,
                        status: status,
                        _token: csrfToken
                    },
                    url: '{{ route('vendor.product_change_status') }}',
                    beforeSend: function() {},
                    success: function(response) {

                    },
                    error: function(xhr, status, error) {},

                    complete: function() {},
                })
            });
        });
    </script>
@endpush
