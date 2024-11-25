@extends('admin.layout.master')
@section('title')
Edit Variants Items
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
                        <h4>Edit Variants Items</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.variant-item.update',$variant_item->id) }}" method="POST" >
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="product_variant_id" value="{{ $variant_item->ProductVariant->id }}">

                            <div class="form-group">
                                <label for="">Variant Name</label>
                                <input type="text" class="form-control" value="{{ $variant_item->ProductVariant->name }}" disabled>
                            </div>
                            @if ($errors->has('variant_name'))
                            <div>
                                <p style="color: red;">
                                    {{ $errors->first('variant_name') }}</p>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="">Item Name</label>
                            <input type="text" class="form-control" value="{{ $variant_item->name }}" name="name">
                        </div>
                        @if ($errors->has('name'))
                        <div>
                            <p style="color: red;">
                                {{ $errors->first('name') }}</p>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="">Price <code>(Make it 0 if you want it for free)</code></label>
                        <input type="number" class="form-control" value="{{ $variant_item->price }}" name="price">
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
                                    <option @selected($variant_item->status == 1)  value="1">Active</option>
                                    <option @selected($variant_item->status == 0) value="0">In Active</option>
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
                                <option @selected($variant_item->is_default == 1)  value="1">Yes</option>
                                <option @selected($variant_item->is_default == 0)  value="0">No</option>
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

