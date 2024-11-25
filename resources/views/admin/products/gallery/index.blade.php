@extends('admin.layout.master')
@section('title')
    Product Gallery
@endsection
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="row">
                    <h1>Product Gallery</h1> &nbsp;  &nbsp;
                    <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Return </a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Product : {{ $product->name }}</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Image<code> (Multiple Image Support)</code></label>
                                        <div class="col-md-11 mg-t-5 mg-md-t-0">
                                            <!-- Allow multiple image selection -->
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
                        </div>

                    </div>
        </section>
    </div>
    <div class="main-content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>All Product Gallery</h4>
                        <div class="card-header-action">
                        </div>
                    </div>
                    <div class="card-body">
                        {{ $dataTable->table() }} </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        var loadFiles = function(event) {
            // Get the image-preview div to display selected images
            var imagePreview = document.getElementById('image-preview');
            imagePreview.innerHTML = "";  // Clear previous images

            // Loop through the selected files
            for (let i = 0; i < event.target.files.length; i++) {
                var file = event.target.files[i];

                // Create a new img element for each file
                var img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.style.width = '150px';
                img.style.height = '150px';
                img.style.borderRadius = '8px';  // Add some styling
                img.style.objectFit = 'cover';  // Ensure the image fits nicely
                img.onload = function() {
                    URL.revokeObjectURL(img.src); // Free memory once the image is loaded
                }

                // Append the img element to the preview container
                imagePreview.appendChild(img);
            }
        };
    </script>

@endpush
