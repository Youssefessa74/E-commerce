@php
    $productSliderSectionThree = json_decode($product_slider_section_three->value);
@endphp
<div class="tab-pane fade" id="list-product-slider-section-three" role="tabpanel"
    aria-labelledby="list-product-slider-section-three-list">
    <div class="card border">
        <div class="card-header">
            <h5>Popular Slider Section Three</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.product.slider.section.three') }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Start Category 1 --}}
                <h5>Category 1</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Category</label>
                            <select name="cat_one" class="form-control main_category" data-id="1">
                                @foreach ($categories as $category)
                                    <option @selected($category->id == $productSliderSectionThree->category) value="{{ $category->id }}">
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('cat_one'))
                            <div>
                                <p style="color: red;">{{ $errors->first('cat_one') }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">

                            <label for="">Sub Category</label>
                            @php
                                $subCategories = App\Models\Subcategory::where(
                                    'category_id',
                                    $productSliderSectionThree->category,
                                )->get();
                            @endphp
                            <label for="">Sub Category</label>
                            <select name="sub_cat_one" class="form-control" id="sub_category_id_2">
                                @foreach ($subCategories as $subCategory)
                                    <option @selected($subCategory->id == $productSliderSectionThree->sub_category)>{{ $subCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('sub_cat_one'))
                            <div>
                                <p style="color: red;">{{ $errors->first('sub_cat_one') }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4">

                        <div class="form-group">
                            @php
                                $childCategories = App\Models\ChildCategory::where(
                                    'sub_category_id',
                                    $productSliderSectionThree->sub_category,
                                )->get();
                            @endphp
                            <label for="">Child Category</label>
                            <select name="child_cat_one" class="form-control" id="child_category_id_2">
                                @foreach ($childCategories as $childCategory)
                                    <option @selected($childCategory->id == $productSliderSectionThree->child_category)>{{ $childCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('child_cat_one'))
                            <div>
                                <p style="color: red;">{{ $errors->first('child_cat_one') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
                {{-- End Category 1 --}}

                {{-- Start Category 2 --}}
                <h5>Category 2</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">

                            <label for="">Category</label>
                            <select name="cat_two" class="form-control main_category" data-id="2">
                                @foreach ($categories as $category)
                                    <option @selected($category->id == $productSliderSectionThree->category) value="{{ $category->id }}">
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('category'))
                            <div>
                                <p style="color: red;">{{ $errors->first('category') }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">

                            <label for="">Sub Category</label>
                            @php
                                $subCategories = App\Models\Subcategory::where(
                                    'category_id',
                                    $productSliderSectionThree->category,
                                )->get();
                            @endphp
                            <select name="sub_cat_two" class="form-control sub_category" data-id="2">
                                @foreach ($subCategories as $subCategory)
                                    <option @selected($subCategory->id == $productSliderSectionThree->sub_category)>{{ $subCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('sub_category'))
                            <div>
                                <p style="color: red;">{{ $errors->first('sub_category') }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                                $childCategories = App\Models\ChildCategory::where(
                                    'sub_category_id',
                                    $productSliderSectionThree->sub_category,
                                )->get();
                            @endphp
                            <label for="">Child Category</label>
                            <select name="child_cat_two" class="form-control child-category" id="">
                                @foreach ($childCategories as $childCategory)
                                    <option @selected($childCategory->id == $productSliderSectionThree->child_category)>{{ $childCategory->name }}</option>
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
                {{-- End Category 2 --}}


                <!-- Submit Button -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.main_category').on('change', function() {
                const selectorID = $(this).data('id');
                let category = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.get_sub_category_for_home_settings') }}",
                    data: {
                        category: category,
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            // Clear the sub_category select
                            $('.sub_category[data-id="' + selectorID + '"]').empty().append(
                                '<option value="">Select a subcategory</option>');

                            // Populate the sub_category select with new options
                            $.each(response.subCategories, function(index, subCategory) {
                                $('.sub_category[data-id="' + selectorID + '"]').append(
                                    '<option value="' + subCategory.id + '">' +
                                    subCategory.name + '</option>');
                            });
                        }
                    },
                    error: function(xhr, status, error) {}
                });
            });
            //
            $('.sub_category').on('change', function() {
                sub_category = $(this).val();
                let row = $(this).closest('.row');
                $.ajax({
                    method: 'GET',
                    url: '{{ route('admin.get_child_categories', ':sub_category') }}'.replace(
                        ":sub_category", sub_category),
                    beforeSend: function() {},
                    success: function(response) {
                        // Clear the subcategory select box
                        let childCategory = row.find('.child-category');
                        childCategory.empty();
                        childCategory.append(
                            '<option selected disabled value="">Choose</option>'
                        );

                        // Populate the subcategory select with new data
                        $.each(response, function(id, name) {
                            childCategory.append(
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
        })
    </script>
@endpush
