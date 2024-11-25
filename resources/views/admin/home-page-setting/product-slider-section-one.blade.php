@php
    $productSliderSectionOne = json_decode($product_slider_section_one->value);
@endphp
<div class="tab-pane fade" id="list-product-slider-section-one" role="tabpanel"
    aria-labelledby="list-product-slider-section-one-list">
    <div class="card border">
        <div class="card-header">
            <h5>Popular Slider Section One</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.product.slider.section.one') }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Start Category  --}}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Category</label>
                            <select name="cat_one" class="form-control" id="main_category_id">
                                @foreach ($categories as $category)
                                    <option @selected($category->id == $productSliderSectionOne->category ) value="{{ $category->id }}">{{ $category->name }}</option>
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
                            @php
                                $subCategories =App\Models\Subcategory::where('category_id',$productSliderSectionOne->category)->get();
                            @endphp
                            <label for="">Sub Category</label>
                            <select name="sub_cat_one" class="form-control" id="sub_category_id">
                                @foreach ($subCategories as $subCategory)
                                <option @selected($subCategory->id == $productSliderSectionOne->sub_category) >{{ $subCategory->name }}</option>
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
                            $childCategories =App\Models\ChildCategory::where('sub_category_id',$productSliderSectionOne->sub_category)->get();
                        @endphp
                            <label for="">Child Category</label>
                            <select name="child_cat_one" class="form-control" id="child_category_id">
                                @foreach ($childCategories as $childCategory)
                                <option @selected($childCategory->id == $productSliderSectionOne->child_category) >{{ $childCategory->name }}</option>
                                @endforeach                            </select>
                        </div>
                        @if ($errors->has('child_cat_one'))
                            <div>
                                <p style="color: red;">{{ $errors->first('child_cat_one') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
                {{-- End Category 1 --}}

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
            $('#main_category_id').on('change', function() {
                let category = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.get_sub_categories', 'category') }}".replace('category',
                        category),
                    success: function(response) {
                        $('#sub_category_id').empty().append(
                            '<option value="">Select a subcategory</option>'
                        );

                        // Iterate over the subCategories array in the response
                        $.each(response, function(id, name) {
                            $('#sub_category_id').append(
                                '<option value="' + id + '">' +
                                name + '</option>'
                            );
                        });

                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
            //
            $('#sub_category_id').on('change', function() {
                sub_category = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: '{{ route('admin.get_child_categories', ':sub_category') }}'.replace(
                        ":sub_category", sub_category),
                    beforeSend: function() {},
                    success: function(response) {

                        $('#child_category_id').empty();
                        $('#child_category_id').append(
                            '<option selected disabled value="">Choose</option>'
                        );

                        // Populate the subcategory select with new data
                        $.each(response, function(id, name) {
                            $('#child_category_id').append(
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
