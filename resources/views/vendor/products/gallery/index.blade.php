@extends('vendor.layout.master')

@section('title')
    {{ Auth::user()->name }} | Product Image
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
                        <h3><i class="far fa-user"></i>Product Gallery </h3>
                        <p>Product : {{ $product->name }}</p>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <!-- Create Button -->
                                <div class="mb-3">
                                    <form action="{{ route('vendor.gallery.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Upload Images<code> (Multiple Image Support)</code></label>
                                            <div class="col-md-11 mg-t-5 mg-md-t-0">
                                                <input class="form-control" type="file" accept="image/*" name="images[]" multiple onchange="loadFiles(event)">
                                                <!-- Container for displaying selected images -->
                                                <div id="image-preview" style="display: flex; gap: 10px; flex-wrap: wrap; margin-top: 8px;"></div>
                                            </div>
                                            @if ($errors->has('images'))
                                                <div>
                                                    <p style="color: red;">{{ $errors->first('images') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>

                                <!-- Table Start -->
                                <table class="table table-bordered mt-3">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product->gallery as $image)
                                            <tr id="row_{{ $image->id }}">
                                                <td>{{ $image->id }}</td>
                                                <td>
                                                    @if(!empty($image->image))
                                                        <img width="120px" src="{{ asset($image->image) }}">
                                                    @else
                                                        <span>No Image</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('vendor.gallery.destroy', $image->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger ml-2">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Table End -->
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
        var loadFiles = function(event) {
            var imagePreview = document.getElementById('image-preview');
            imagePreview.innerHTML = "";  // Clear previous images

            for (let i = 0; i < event.target.files.length; i++) {
                var file = event.target.files[i];

                var img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.style.width = '150px';
                img.style.height = '150px';
                img.style.borderRadius = '8px';
                img.style.objectFit = 'cover';
                img.onload = function() {
                    URL.revokeObjectURL(img.src);
                }

                imagePreview.appendChild(img);
            }
        };
    </script>
@endpush
