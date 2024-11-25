@extends('vendor.layout.master')

@section('title')
    {{ Auth::user()->name }} | Variant Items
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
                        <h3><i class="far fa-user"></i>Variant : {{ $variant->name }}</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <!-- Create Button -->
                                <div class="mb-3">
                                    <a href="{{ route('vendor.variant.item.create',['product'=>$product->id,'variant'=>$variant->id]) }}" class="btn btn-info">
                                        <i class="fas fa-plus"></i> Create New Variant Item
                                    </a>
                                </div>
                                <table class="table table-bordered" id="variant-items-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Product Variant</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Default</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($variantItems as $item)
                                            <tr id="row_{{ $item->id }}">
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->productVariant->name }}</td>
                                                <td>{{ number_format($item->price, 2) }}</td>
                                                <td>
                                                    {!! $item->status ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>' !!}
                                                </td>
                                                <td>
                                                    {!! $item->is_default ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-danger">No</span>' !!}
                                                </td>
                                                <td>
                                                    <a href="{{ route('vendor.variant.item.edit',['product'=>$product->id,'variant'=>$variant->id,'id'=>$item->id]) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                    <form action="{{ route('vendor.variant.item.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
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

