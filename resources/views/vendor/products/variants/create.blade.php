@extends('vendor.layout.master')

@section('title')
    {{ Auth::user()->name }} | Create Variants
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
                        <h3><i class="far fa-user"></i>Create Variants</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <form action="{{ route('vendor.variant.store') }}" method="POST" >
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
        </div>
    </section>
    <!--=============================
            DASHBOARD END
        ==============================-->
@endsection
