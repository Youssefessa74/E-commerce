@extends('admin.layout.master')
@section('title')
    Create Coupons
@endsection
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Coupons</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Create Coupons</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.coupon.store') }}" method="POST">
                                    @csrf

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
                                        <label for="">Code</label>
                                        <input type="text" class="form-control" name="code">
                                    </div>
                                    @if ($errors->has('code'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('code') }}</p>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">Quantity</label>
                                        <input type="number" class="form-control" name="quantity">
                                    </div>
                                    @if ($errors->has('quantity'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('quantity') }}</p>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">Max Use Per Person</label>
                                        <input type="number" class="form-control" name="max_use_per_person">
                                    </div>
                                    @if ($errors->has('max_use_per_person'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('max_use_per_person') }}</p>
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Start Date</label>
                                                <input type="text" class="form-control datepicker" name="start_date">
                                            </div>
                                            @if ($errors->has('start_date'))
                                                <div>
                                                    <p style="color: red;">
                                                        {{ $errors->first('start_date') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">End Date</label>
                                                <input type="text" class="form-control datepicker" name="end_date">
                                            </div>
                                            @if ($errors->has('end_date'))
                                                <div>
                                                    <p style="color: red;">
                                                        {{ $errors->first('end_date') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Discount Type</label>
                                                <select name="discount_type" id="inputState" class="form-control">
                                                    <option selected disabled value="">Choose</option>
                                                    <option value="percent">Percentage (%)</option>
                                                    <option value="amount">Amount ({{ $settings->currency_icon }})</option>
                                                </select>
                                            </div>
                                            @if ($errors->has('discount_type'))
                                                <div>
                                                    <p style="color: red;">
                                                        {{ $errors->first('discount_type') }}</p>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Discount Value</label>
                                                <input type="number" class="form-control" name="discount">
                                            </div>
                                            @if ($errors->has('discount'))
                                                <div>
                                                    <p style="color: red;">
                                                        {{ $errors->first('discount') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <select name="status" id="inputState" class="form-control">
                                            <option selected disabled value="">Choose</option>
                                            <option value="1">Active</option>
                                            <option value="0">In Active</option>
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
