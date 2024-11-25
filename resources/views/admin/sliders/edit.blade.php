@extends('admin.layout.master')
@section('title')
    Create Sliders
@endsection
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Sliders</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Create Sliders</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.sliders.update',$slider->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-11 mg-t-5 mg-md-t-0">
                                        <!-- Image File Input -->
                                        <input class="form-control" name="image" type="file"  value="{{ $slider->image }}" accept="image/*"
                                            onchange="loadFile(event)">

                                        <!-- Image Preview -->
                                        <img class="" style="border-radius:50%; margin-top: 8px; margin-bottom: 8px"
                                            width="150px" height="150px" id="output" src="{{ asset($slider->image) }}"
                                            alt="Current Image">
                                    </div>
                                    @if ($errors->has('image'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('image') }}</p>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="">Type</label>
                                        <input type="text" class="form-control" value="{{ $slider->type }}"
                                            name="type">
                                    </div>
                                    @if ($errors->has('type'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('type') }}</p>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">title</label>
                                        <input type="text" class="form-control" value="{{ $slider->title }}"
                                            name="title">
                                    </div>
                                    @if ($errors->has('title'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('title') }}</p>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">Starting Price</label>
                                        <input type="text" class="form-control" value="{{ $slider->starting_price }}"
                                            name="starting_price">
                                    </div>
                                    @if ($errors->has('starting_price'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('starting_price') }}</p>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">Button Url</label>
                                        <input type="text" class="form-control" value="{{ $slider->button_url }}"
                                            name="button_url">
                                    </div>
                                    @if ($errors->has('button_url'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('button_url') }}</p>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">Serial</label>
                                        <input type="text" class="form-control" value="{{ $slider->serial }}"
                                            name="serial">
                                    </div>
                                    @if ($errors->has('serial'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('serial') }}</p>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <select name="status" id="inputState" class="form-control">
                                            <option selected disabled value="">Choose</option>
                                            <option @selected($slider->status == 1) value="1">Active</option>
                                            <option @selected($slider->status == 0) value="0">In Active</option>
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
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src); // Free memory
            }
        };
    </script>
@endpush
