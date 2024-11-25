@extends('vendor.layout.master')

@section('title')
    {{ Auth::user()->name }} | Variants
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
                        <h3><i class="far fa-user"></i>Product : {{ $product->name }}</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <!-- Create Button -->
                                <div class="mb-3">
                                    <a href="{{ route('vendor.variant.create',['product'=>$product->id]) }}" class="btn btn-info">
                                        <i class="fas fa-plus"></i> Create New Variant
                                    </a>
                                </div>
                                <table id="products-table" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($variants as $variant)
                                            <tr id="row_{{ $variant->id }}">
                                                <td>{{ $variant->id }}</td>
                                                <td>{{ $variant->name }}</td>
                                                <td>
                                                    <div class="form-group">
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" {{ $variant->status ? 'checked' : '' }}
                                                                data-id="{{ $variant->id }}"
                                                                data-status="{{ $variant->status }}"
                                                                class="custom-switch-input toggle_status">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    </div>                                                </td>
                                                <td>
                                                    <a href="{{ route('vendor.variant.item.index', ['product'=>$product->id,'variant' => $variant->id]) }}" class="btn btn-warning"><i class="fas fa-eye"></i></a>
                                                    <form action="{{ route('vendor.variant.destroy', $variant->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>


                                         {{-- Pagination --}}
                            {{-- @if ($variants->hasPages())
                                <div class="d-flex justify-content-center">
                                    {{ $variants->links() }}
                                </div>
                                @endif --}}
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
                    url: '{{ route('vendor.variant_change_status') }}',
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
