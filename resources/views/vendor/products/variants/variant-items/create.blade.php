@extends('vendor.layout.master')

@section('title')
    {{ Auth::user()->name }} | Create Variants Items
@endsection

@section('content')
    <!--=============================
            DASHBOARD START
        ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layout.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i>Create Variants Items</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <form action="{{ route('vendor.variant.item.store') }}" method="POST" >
                                    @csrf

                                    <input type="hidden" name="product_variant_id" value="{{ $variant->id }}">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
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
        </div>
    </section>
    <!--=============================
            DASHBOARD END
        ==============================-->
@endsection
