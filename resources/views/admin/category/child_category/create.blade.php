@extends('admin.layout.master')
@section('title')
    Create Child Categories
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
                                <h4>Create Child Categories</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.child-category.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control" name="name">
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
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                                            <!-- Options will be dynamically populated -->
                                        </select>
                                    </div>

                                    @if ($errors->has('category_id'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('category_id') }}</p>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <select name="status" id="inputState" class="form-control">
                                            <option selected disabled value="">Choose</option>
                                            <option value="1">Active</option>
                                            <option value="0">In Active</option>
                                        </select>
                                    </div>
                                    @if ($errors->has('status'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('status') }}</p>
                                        </div>
                                    @endif



                                    <button type="submit" class="btn btn-primary">submit</button>
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
            $(document).ready(function() {
                $('#categories_select').on('change', function() {
                    let category = $(this).val();
                    $.ajax({
                        method: 'GET',
                        url: '{{ route('admin.get_sub_categories', ':category') }}'.replace(
                            ":category", category),
                        beforeSend: function() {
                            // Optional: Show loading spinner
                        },
                        success: function(response) {
                            // Clear the subcategory select box
                            $('#sub_categories_select').empty();
                            $('#sub_categories_select').append(
                                '<option selected disabled value="">Choose</option>'
                                );

                            // Populate the subcategory select with new data
                            $.each(response, function(id, name) {
                                $('#sub_categories_select').append(
                                    '<option value="' + id + '">' + name +
                                    '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        },
                        complete: function() {
                            // Optional: Hide loading spinner
                        }
                    });
                });
            });

        });
    </script>
@endpush
