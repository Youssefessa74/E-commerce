@extends('admin.layout.master')
@section('title')
Create Variants
@endsection
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Product Variants</h1>
      </div>
      <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Variants</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.variant.store') }}" method="POST" >
                            @csrf

                            <input type="hidden" name="product_id" value="{{ $product->id }}">

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

