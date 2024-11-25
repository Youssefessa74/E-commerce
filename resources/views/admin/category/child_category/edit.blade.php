@extends('admin.layout.master')
@section('title')
    Edit Child Categories
@endsection
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Child Categories</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Child Categories</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.child-category.update',$child_category->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control" value="{{ $child_category->name }}" name="name">
                                    </div>
                                    @if ($errors->has('name'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('name') }}</p>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">Category</label>
                                        <select name="category_id" id="categories_select" class="form-control">
                                            <option selected disabled value="">Choose</option>
                                            @foreach ($categories as $item)
                                                <option @selected($child_category->category_id == $item->id) value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('category_id'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('category_id') }}</p>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="sub_categories_select">Sub Category</label>
                                        <select name="sub_category_id" id="sub_categories_select" class="form-control">
                                            <option selected disabled value="">Choose</option>
                                            @foreach ($sub_categories as $item)
                                                <option @selected($child_category->sub_category_id == $item->id) value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @if ($errors->has('sub_category_id'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('sub_category_id') }}</p>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <select name="status" id="inputState" class="form-control">
                                            <option selected disabled value="">Choose</option>
                                            <option @selected($child_category->status == 1) value="1">Active</option>
                                            <option @selected($child_category->status == 0) value="0">Inactive</option>
                                        </select>
                                    </div>
                                    @if ($errors->has('status'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('status') }}</p>
                                        </div>
                                    @endif

                                    <button type="submit" class="btn btn-primary">Submit</button>
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
    $(document).ready(function() {
        // Trigger subcategory load when page loads if a category is selected
        let initialCategory = $('#categories_select').val();
        if(initialCategory) {
            loadSubcategories(initialCategory);
        }

        // When the category changes, load new subcategories
        $('#categories_select').on('change', function() {
            let category = $(this).val();
            loadSubcategories(category);
        });

        function loadSubcategories(category) {
            $.ajax({
                method: 'GET',
                url: '{{ route("admin.get_sub_categories", ":category") }}'.replace(":category", category),
                beforeSend: function() {
                    // Optional: Show loading spinner
                },
                success: function(response) {
                    // Clear the subcategory select box
                    $('#sub_categories_select').empty();
                    $('#sub_categories_select').append('<option selected disabled value="">Choose</option>');

                    // Populate the subcategory select with new data
                    $.each(response, function(id, name) {
                        $('#sub_categories_select').append('<option value="' + id + '">' + name + '</option>');
                    });

                    // Pre-select the existing subcategory if editing
                    let existingSubCategory = '{{ $child_category->sub_category_id }}';
                    if (existingSubCategory) {
                        $('#sub_categories_select').val(existingSubCategory);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                },
                complete: function() {
                    // Optional: Hide loading spinner
                }
            });
        }
    });
</script>
@endpush
