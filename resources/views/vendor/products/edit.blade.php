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
                            <h3><i class="far fa-user"></i> Edit Product</h3>
                            <div class="wsus__dashboard_profile">
                                <div class="wsus__dash_pro_area">
                                    <form action="{{ route('vendor.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- Thumbnail Image Input -->
                                        <input type="file" name="thumb_image" id="imageInput" onchange="previewImage(event)">
                                        <div class="col-xl-3 col-sm-6 col-md-6 mb-4">
                                            <div class="wsus__dash_pro_img">
                                                <img id="imagePreview" src="{{ asset($product->thumb_image) }}" alt="img" class="img-fluid w-100" style="{{ $product->thumb_image ? '' : 'display: none;' }}">
                                                @if ($errors->has('thumb_image'))
                                                    <div>
                                                        <p style="color: red;">{{ $errors->first('thumb_image') }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Name Input -->
                                        <div>
                                            <div class="wsus__dash_pro_single">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}">
                                            </div>
                                            @if ($errors->has('name'))
                                                <div>
                                                    <p style="color: red;">{{ $errors->first('name') }}</p>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <!-- Category Input -->
                                                <div>
                                                    <div class="wsus__dash_pro_single">
                                                        <label for="inputState">Category</label>
                                                        <select id="inputState" class="form-control main-category" name="category">
                                                            <option value="">Select</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @if ($errors->has('category'))
                                                        <div>
                                                            <p style="color: red;">{{ $errors->first('category') }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <!-- Sub Category Input -->
                                                <div>
                                                    <div class="wsus__dash_pro_single">
                                                        <label for="inputState">Sub Category</label>
                                                        <select id="inputState" class="form-control sub-category" name="sub_category">
                                                            <option value="">Select</option>
                                                            @foreach ($subCategories as $subCategory)
                                                                <option value="{{ $subCategory->id }}" {{ $subCategory->id == $product->sub_category_id ? 'selected' : '' }}>{{ $subCategory->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @if ($errors->has('sub_category'))
                                                        <div>
                                                            <p style="color: red;">{{ $errors->first('sub_category') }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <!-- Child Category Input -->
                                                <div>
                                                    <div class="wsus__dash_pro_single">
                                                        <label for="inputState">Child Category</label>
                                                        <select id="inputState" class="form-control child-category" name="child_category">
                                                            <option value="">Select</option>
                                                            @foreach ($childCategories as $childCategory)
                                                                <option value="{{ $childCategory->id }}" {{ $childCategory->id == $product->child_category_id ? 'selected' : '' }}>{{ $childCategory->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @if ($errors->has('child_category'))
                                                        <div>
                                                            <p style="color: red;">{{ $errors->first('child_category') }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Brand Input -->
                                        <div>
                                            <div class="wsus__dash_pro_single">
                                                <label for="inputState">Brand</label>
                                                <select id="inputState" class="form-control" name="brand">
                                                    <option value="">Select</option>
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @if ($errors->has('brand'))
                                                <div>
                                                    <p style="color: red;">{{ $errors->first('brand') }}</p>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- SKU Input -->
                                        <div>
                                            <div class="wsus__dash_pro_single">
                                                <label>SKU</label>
                                                <input type="text" class="form-control" name="sku" value="{{ old('sku', $product->sku) }}">
                                            </div>
                                            @if ($errors->has('sku'))
                                                <div>
                                                    <p style="color: red;">{{ $errors->first('sku') }}</p>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Price Input -->
                                        <div>
                                            <div class="wsus__dash_pro_single">
                                                <label>Price</label>
                                                <input type="text" class="form-control" name="price" value="{{ old('price', $product->price) }}">
                                            </div>
                                            @if ($errors->has('price'))
                                                <div>
                                                    <p style="color: red;">{{ $errors->first('price') }}</p>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Offer Price Input -->
                                        <div>
                                            <div class="wsus__dash_pro_single">
                                                <label>Offer Price</label>
                                                <input type="text" class="form-control" name="offer_price" value="{{ old('offer_price', $product->offer_price) }}">
                                            </div>
                                            @if ($errors->has('offer_price'))
                                                <div>
                                                    <p style="color: red;">{{ $errors->first('offer_price') }}</p>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <!-- Offer Start Date Input -->
                                                <div>
                                                    <div class="wsus__dash_pro_single">
                                                        <label>Offer Start Date</label>
                                                        <input type="text" class="form-control datepicker" name="offer_start_date" value="{{ old('offer_start_date', $product->offer_start_date) }}">
                                                    </div>
                                                    @if ($errors->has('offer_start_date'))
                                                        <div>
                                                            <p style="color: red;">{{ $errors->first('offer_start_date') }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- Offer End Date Input -->
                                                <div>
                                                    <div class="wsus__dash_pro_single">
                                                        <label>Offer End Date</label>
                                                        <input type="text" class="form-control datepicker" name="offer_end_date" value="{{ old('offer_end_date', $product->offer_end_date) }}">
                                                    </div>
                                                    @if ($errors->has('offer_end_date'))
                                                        <div>
                                                            <p style="color: red;">{{ $errors->first('offer_end_date') }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Stock Quantity Input -->
                                        <div>
                                            <div class="wsus__dash_pro_single">
                                                <label>Stock Quantity</label>
                                                <input type="number" min="0" class="form-control" name="qty" value="{{ old('qty', $product->qty) }}">
                                            </div>
                                            @if ($errors->has('qty'))
                                                <div>
                                                    <p style="color: red;">{{ $errors->first('qty') }}</p>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Video Link Input -->
                                        <div>
                                            <div class="wsus__dash_pro_single">
                                                <label>Video Link</label>
                                                <input type="text" class="form-control" name="video_link" value="{{ old('video_link', $product->video_link) }}">
                                            </div>
                                            @if ($errors->has('video_link'))
                                                <div>
                                                    <p style="color: red;">{{ $errors->first('video_link') }}</p>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Short Description Input -->
                                        <div>
                                            <div class="wsus__dash_pro_single">
                                                <label>Short Description</label>
                                                <textarea name="short_info" class="form-control">{{ old('short_info', $product->short_info) }}</textarea>
                                            </div>
                                            @if ($errors->has('short_info'))
                                                <div>
                                                    <p style="color: red;">{{ $errors->first('short_info') }}</p>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Long Description Input -->
                                        <div>
                                            <div class="wsus__dash_pro_single">
                                                <label>Long Description</label>
                                                <textarea name="long_info" class="form-control summernote">{{ old('long_info', $product->long_info) }}</textarea>
                                            </div>
                                            @if ($errors->has('long_info'))
                                                <div>
                                                    <p style="color: red;">{{ $errors->first('long_info') }}</p>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Product Type Input -->
                                        <div>
                                            <div class="wsus__dash_pro_single">
                                                <label for="inputState">Product Type</label>
                                                <select id="inputState" class="form-control" name="product_type">
                                                    <option value="">Select</option>
                                                    <option value="new_arrival" {{ $product->product_type == 'new_arrival' ? 'selected' : '' }}>New Arrival</option>
                                                    <option value="featured_product" {{ $product->product_type == 'featured_product' ? 'selected' : '' }}>Featured</option>
                                                    <option value="top_product" {{ $product->product_type == 'top_product' ? 'selected' : '' }}>Top Product</option>
                                                    <option value="best_product" {{ $product->product_type == 'best_product' ? 'selected' : '' }}>Best Product</option>
                                                </select>
                                            </div>
                                            @if ($errors->has('product_type'))
                                                <div>
                                                    <p style="color: red;">{{ $errors->first('product_type') }}</p>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- SEO Title Input -->
                                        <div>
                                            <div class="wsus__dash_pro_single">
                                                <label>Seo Title</label>
                                                <input type="text" class="form-control" name="seo_title" value="{{ old('seo_title', $product->seo_title) }}">
                                            </div>
                                            @if ($errors->has('seo_title'))
                                                <div>
                                                    <p style="color: red;">{{ $errors->first('seo_title') }}</p>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- SEO Description Input -->
                                        <div>
                                            <div class="wsus__dash_pro_single">
                                                <label>Seo Description</label>
                                                <textarea name="seo_info" class="form-control">{{ old('seo_info', $product->seo_info) }}</textarea>
                                            </div>
                                            @if ($errors->has('seo_info'))
                                                <div>
                                                    <p style="color: red;">{{ $errors->first('seo_info') }}</p>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Status Input -->
                                        <div>
                                            <div class="wsus__dash_pro_single">
                                                <label for="inputState">Status</label>
                                                <select id="inputState" class="form-control" name="status">
                                                    <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Active</option>
                                                    <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                            </div>
                                            @if ($errors->has('status'))
                                                <div>
                                                    <p style="color: red;">{{ $errors->first('status') }}</p>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Is Featured Input -->
                                        <div>
                                            <div class="wsus__dash_pro_single">
                                                <label for="inputState">Is Featured</label>
                                                <select name="is_featured" id="inputState" class="form-control">
                                                    <option selected disabled value="">Choose</option>
                                                    <option value="1" {{ $product->is_featured == 1 ? 'selected' : '' }}>Yes</option>
                                                    <option value="0" {{ $product->is_featured == 0 ? 'selected' : '' }}>No</option>
                                                </select>
                                            </div>
                                            @if ($errors->has('is_featured'))
                                                <div>
                                                    <p style="color: red;">{{ $errors->first('is_featured') }}</p>
                                                </div>
                                            @endif
                                        </div>

                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>

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

            function previewImage(event) {
                const file = event.target.files[0];
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imagePreview = document.getElementById('imagePreview');
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                };
                if (file) {
                    reader.readAsDataURL(file);
                }
            }

    $(document).ready(function() {
            $('.main-category').on('change', function() {
                category = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: '{{ route('vendor.get_sub_categories', ':category') }}'.replace(
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
                    url: '{{ route('vendor.get_child_categories', ':sub_category') }}'.replace(
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
