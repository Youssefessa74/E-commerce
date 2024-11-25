@extends('admin.layout.master')
@section('title')
 Vendor Conditons
@endsection
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Vendor Conditons</h1>
      </div>
      <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Vendor Conditons</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.vendor.request.conditions.submit') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Condtion</label>
                                <textarea name="content" class="summernote">{{ $content->content }}</textarea>
                            </div>
                            @if ($errors->has('content'))
                            <div>
                                <p style="color: red;">
                                    {{ $errors->first('content') }}</p>
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
