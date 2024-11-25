@extends('admin.layout.master')
@section('title')
Create Variants Items
@endsection
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Product Variant Items</h1>
      </div>
      <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Variants Items</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.variant-item.store') }}" method="POST" >
                            @csrf

                            <input type="hidden" name="product_variant_id" value="{{ $variant->id }}">

                            <div class="form-group">
                                <label for="">Variant Name</label>
                                <input type="text" class="form-control" value="{{ $variant->name }}" disabled>
                            </div>
                            @if ($errors->has('variant_name'))
                            <div>
                                <p style="color: red;">
                                    {{ $errors->first('variant_name') }}</p>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="">Item Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        @if ($errors->has('name'))
                        <div>
                            <p style="color: red;">
                                {{ $errors->first('name') }}</p>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="">Price <code>(Make it 0 if you want it for free)</code></label>
                        <input type="number" class="form-control" name="price">
                    </div>
                    @if ($errors->has('price'))
                    <div>
                        <p style="color: red;">
                            {{ $errors->first('price') }}</p>
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

                        <div class="form-group">
                            <label for="">Is Default</label>
                            <select name="is_default" id="inputState" class="form-control">
                                <option selected disabled value="">Choose</option>
                                <option  value="1">Yes</option>
                                <option  value="0">No</option>
                            </select>
                        </div>
                        @if ($errors->has('is_default'))
                        <div>
                            <p style="color: red;">
                                {{ $errors->first('is_default') }}</p>
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

