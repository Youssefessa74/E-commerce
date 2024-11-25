@extends('admin.layout.master')
@section('title')
Create Brands
@endsection
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Brands</h1>
      </div>
      <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Brands</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="col-md-11 mg-t-5 mg-md-t-0">
                                <input class="form-control" type="file" accept="image/*" name="logo" onchange="loadFile(event)">
                                <img class="" style="border-radius:50% ; margin-top: 8px ; margin-bottom: 8px" width="150px" height="150px" id="output"/>
                            </div>
                            @if ($errors->has('logo'))
                            <div>
                                <p style="color: red;">
                                    {{ $errors->first('logo') }}</p>
                            </div>
                        @endif



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
                                <label for="">Is Featured</label>
                                <select name="is_featured" id="inputState" class="form-control">
                                    <option selected disabled value="">Choose</option>
                                    <option  value="1">Yes</option>
                                    <option  value="0">No</option>
                                </select>
                            </div>
                            @if ($errors->has('is_featured'))
                            <div>
                                <p style="color: red;">
                                    {{ $errors->first('is_featured') }}</p>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" id="inputState" class="form-control">
                                <option selected disabled value="">Choose</option>
                                <option  value="1">Active</option>
                                <option  value="0">In active</option>
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
