@extends('admin.layout.master')
@section('title')
    Create Blogs
@endsection
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Blogs</h1>

            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Create Blogs</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-11 mg-t-5 mg-md-t-0">
                                        <input class="form-control" type="file" accept="image/*" name="image" onchange="loadFile(event)">
                                        <img class="" style="border-radius:50%; margin-top: 8px; margin-bottom: 8px" width="150px" height="150px" id="output" />
                                    </div>
                                    @if ($errors->has('image'))
                                        <div>
                                            <p style="color: red;">{{ $errors->first('image') }}</p>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="title" >
                                        @if ($errors->has('title'))
                                            <div>
                                                <p style="color: red;">{{ $errors->first('title') }}</p>
                                            </div>
                                        @endif
                                    </div>


                                    <div class="form-group">
                                        <label for="inputState">Blog Category</label>
                                        <select id="inputState" class="form-control" name="category">
                                            @foreach ($blogCategory as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach

                                        </select>
                                        @if ($errors->has('category'))
                                            <div>
                                                <p style="color: red;">{{ $errors->first('category') }}</p>
                                            </div>
                                        @endif
                                    </div>


                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control summernote">{{ old('description') }}</textarea>
                                        @if ($errors->has('description'))
                                            <div>
                                                <p style="color: red;">{{ $errors->first('description') }}</p>
                                            </div>
                                        @endif
                                    </div>


                                    <div class="form-group">
                                        <label>Seo Description</label>
                                        <input type="text" class="form-control" name="seo_description" >
                                        @if ($errors->has('seo_description'))
                                            <div>
                                                <p style="color: red;">{{ $errors->first('seo_description') }}</p>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Seo Title</label>
                                        <textarea name="seo_title" class="form-control">{{ old('seo_title') }}</textarea>
                                        @if ($errors->has('seo_title'))
                                            <div>
                                                <p style="color: red;">{{ $errors->first('seo_title') }}</p>
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
