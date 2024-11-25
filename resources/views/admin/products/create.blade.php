@extends('admin.layout.master')
@section('title')
    Create Products
@endsection
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Product</h1>

            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Create Product</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-11 mg-t-5 mg-md-t-0">
                                        <input class="form-control" type="file" accept="image/*" name="thumb_image" onchange="loadFile(event)">
                                        <img class="" style="border-radius:50%; margin-top: 8px; margin-bottom: 8px" width="150px" height="150px" id="output" />
                                    </div>
                                    @if ($errors->has('thumb_image'))
                                        <div>
                                            <p style="color: red;">{{ $errors->first('image') }}</p>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                            <div>
                                                <p style="color: red;">{{ $errors->first('name') }}</p>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="inputState">Category</label>
                                                <select id="inputState" class="form-control main-category" name="category">
                                                    <option value="">Select</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('category'))
                                                    <div>
                                                        <p style="color: red;">{{ $errors->first('category') }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="inputState">Sub Category</label>
                                                <select id="inputState" class="form-control sub-category" name="sub_category">
                                                    <option value="">Select</option>
                                                </select>
                                                @if ($errors->has('sub_category'))
                                                    <div>
                                                        <p style="color: red;">{{ $errors->first('sub_category') }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="inputState">Child Category</label>
                                                <select id="inputState" class="form-control child-category" name="child_category">
                                                    <option value="">Select</option>
                                                </select>
                                                @if ($errors->has('child_category'))
                                                    <div>
                                                        <p style="color: red;">{{ $errors->first('child_category') }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputState">Brand</label>
                                        <select id="inputState" class="form-control" name="brand">
                                            <option value="">Select</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('brand'))
                                            <div>
                                                <p style="color: red;">{{ $errors->first('brand') }}</p>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>SKU</label>
                                        <input type="text" class="form-control" name="sku" value="{{ old('sku') }}">
                                        @if ($errors->has('sku'))
                                            <div>
                                                <p style="color: red;">{{ $errors->first('sku') }}</p>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                                        @if ($errors->has('price'))
                                            <div>
                                                <p style="color: red;">{{ $errors->first('price') }}</p>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Offer Price</label>
                                        <input type="text" class="form-control" name="offer_price" value="{{ old('offer_price') }}">
                                        @if ($errors->has('offer_price'))
                                            <div>
                                                <p style="color: red;">{{ $errors->first('offer_price') }}</p>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Offer Start Date</label>
                                                <input type="text" class="form-control datepicker" name="offer_start_date" value="{{ old('offer_start_date') }}">
                                                @if ($errors->has('offer_start_date'))
                                                    <div>
                                                        <p style="color: red;">{{ $errors->first('offer_start_date') }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Offer End Date</label>
                                                <input type="text" class="form-control datepicker" name="offer_end_date" value="{{ old('offer_end_date') }}">
                                                @if ($errors->has('offer_end_date'))
                                                    <div>
                                                        <p style="color: red;">{{ $errors->first('offer_end_date') }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Stock Quantity</label>
                                        <input type="number" min="0" class="form-control" name="qty" value="{{ old('qty') }}">
                                        @if ($errors->has('qty'))
                                            <div>
                                                <p style="color: red;">{{ $errors->first('qty') }}</p>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Video Link</label>
                                        <input type="text" class="form-control" name="video_link" value="{{ old('video_link') }}">
                                        @if ($errors->has('video_link'))
                                            <div>
                                                <p style="color: red;">{{ $errors->first('video_link') }}</p>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Short Description</label>
                                        <textarea name="short_info" class="form-control">{{ old('short_info') }}</textarea>
                                        @if ($errors->has('short_info'))
                                            <div>
                                                <p style="color: red;">{{ $errors->first('short_info') }}</p>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Long Description</label>
                                        <textarea name="long_info" class="form-control summernote">{{ old('long_info') }}</textarea>
                                        @if ($errors->has('long_info'))
                                            <div>
                                                <p style="color: red;">{{ $errors->first('long_info') }}</p>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="inputState">Product Type</label>
                                        <select id="inputState" class="form-control" name="product_type">
                                            <option value="">Select</option>
                                            <option value="new_arrival">New Arrival</option>
                                            <option value="featured_product">Featured</option>
                                            <option value="top_product">Top Product</option>
                                            <option value="best_product">Best Product</option>
                                        </select>
                                        @if ($errors->has('product_type'))
                                            <div>
                                                <p style="color: red;">{{ $errors->first('product_type') }}</p>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Seo Title</label>
                                        <input type="text" class="form-control" name="seo_title" value="{{ old('seo_title') }}">
                                        @if ($errors->has('seo_title'))
                                            <div>
                                                <p style="color: red;">{{ $errors->first('seo_title') }}</p>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Seo Description</label>
                                        <textarea name="seo_info" class="form-control">{{ old('seo_info') }}</textarea>
                                        @if ($errors->has('seo_info'))
                                            <div>
                                                <p style="color: red;">{{ $errors->first('seo_info') }}</p>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="inputState">Status</label>
                                        <select id="inputState" class="form-control" name="status">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                        @if ($errors->has('status'))
                                            <div>
                                                <p style="color: red;">{{ $errors->first('status') }}</p>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="inputState">Is Featured</label>
                                        <select name="is_featured" id="inputState" class="form-control">
                                            <option selected disabled value="">Choose</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                        @if ($errors->has('is_featured'))
                                            <div>
                                                <p style="color: red;">{{ $errors->first('is_featured') }}</p>
                                            </div>
                                        @endif
                                    </div>

                                    <button type="submit" class="btn btn-primary">Create</button>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };

        $(document).ready(function() {
            $('.main-category').on('change', function() {
                category = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: '{{ route('admin.get_sub_categories', ':category') }}'.replace(
                        ":category", category),
                    beforeSend: function() {},
                    success: function(response) {
                        // Clear the subcategory select box
                        $('.sub-category').empty();
                        $('.sub-category').append(
                            '<option selected disabled value="">Choose</option>'
                        );

                        // Populate the subcategory select with new data
                        $.each(response, function(id, name) {
                            $('.sub-category').append(
                                '<option value="' + id + '">' + name +
                                '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    },

                    complete: function() {},
                })
            });
        });

        $(document).ready(function() {
            $('.sub-category').on('change', function() {
                sub_category = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: '{{ route('admin.get_child_categories', ':sub_category') }}'.replace(
                        ":sub_category", sub_category),
                    beforeSend: function() {},
                    success: function(response) {
                        // Clear the subcategory select box
                        $('.child-category').empty();
                        $('.child-category').append(
                            '<option selected disabled value="">Choose</option>'
                        );

                        // Populate the subcategory select with new data
                        $.each(response, function(id, name) {
                            $('.child-category').append(
                                '<option value="' + id + '">' + name +
                                '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    },

                    complete: function() {},
                })
            });
        });
    </script>
@endpush
