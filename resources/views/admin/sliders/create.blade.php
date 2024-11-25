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
                        <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="col-md-11 mg-t-5 mg-md-t-0">
                                <input class="form-control" type="file" accept="image/*" name="image" onchange="loadFile(event)">
                                <img class="" style="border-radius:50% ; margin-top: 8px ; margin-bottom: 8px" width="150px" height="150px" id="output"/>
                            </div>
                            @if ($errors->has('image'))
                            <div>
                                <p style="color: red;">
                                    {{ $errors->first('image') }}</p>
                            </div>
                        @endif


                            <div class="form-group">
                                <label for="">Type</label>
                                <input type="text" class="form-control" name="type">
                            </div>
                            @if ($errors->has('type'))
                            <div>
                                <p style="color: red;">
                                    {{ $errors->first('type') }}</p>
                            </div>
                        @endif

                            <div class="form-group">
                                <label for="">title</label>
                                <input type="text" class="form-control" name="title">
                            </div>
                            @if ($errors->has('title'))
                            <div>
                                <p style="color: red;">
                                    {{ $errors->first('title') }}</p>
                            </div>
                        @endif

                            <div class="form-group">
                                <label for="">Starting Price</label>
                                <input type="text" class="form-control" name="starting_price">
                            </div>
                            @if ($errors->has('starting_price'))
                            <div>
                                <p style="color: red;">
                                    {{ $errors->first('starting_price') }}</p>
                            </div>
                        @endif

                            <div class="form-group">
                                <label for="">Button Url</label>
                                <input type="text" class="form-control" name="button_url">
                            </div>
                            @if ($errors->has('button_url'))
                            <div>
                                <p style="color: red;">
                                    {{ $errors->first('button_url') }}</p>
                            </div>
                        @endif

                            <div class="form-group">
                                <label for="">Serial</label>
                                <input type="text" class="form-control" name="serial">
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
                                    <option  value="1">Active</option>
                                    <option  value="0">In Active</option>
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
            URL.revokeObjectURL(output.src) // free memory
        }
    };
  </script>

@endpush
