@extends('admin.layout.master')
@section('title')
Updating WithDraw Methods
@endsection
@section('content')
<div class="main-content">
       <!-- Main Content -->
       <section class="section">
        <div class="section-header">
          <h1>Withdrow Methods</h1>
        </div>

        <div class="section-body">

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Updating Method</h4>

                </div>
                <div class="card-body">
                  <form action="{{route('admin.with-draws.update',$method->id)}}" method="POST">
                      @csrf
                      @method('PUT')

                      <div class="form-group">
                          <label>Name</label>
                          <input type="text" class="form-control" value="{{ $method->name }}" name="name">
                      </div>
                      @if ($errors->has('name'))
                      <div>
                          <p style="color: red;">
                              {{ $errors->first('name') }}</p>
                      </div>
                  @endif


                      <div class="form-group">
                          <label>Minimum Amount</label>
                          <input type="number" class="form-control" value="{{ $method->minimum_amount }}" name="minimum_amount" value="">
                      </div>
                      @if ($errors->has('minimum_amount'))
                      <div>
                          <p style="color: red;">
                              {{ $errors->first('minimum_amount') }}</p>
                      </div>
                  @endif


                      <div class="form-group">
                          <label>Maximum Amount</label>
                          <input type="number" class="form-control" value="{{ $method->maximum_amount }}" name="maximum_amount" value="">
                      </div>
                      @if ($errors->has('maximum_amount'))
                      <div>
                          <p style="color: red;">
                              {{ $errors->first('maximum_amount') }}</p>
                      </div>
                  @endif


                      <div class="form-group">
                          <label>Withdraw charge (%)</label>
                          <input type="number" class="form-control" value="{{ $method->withdraw_charge }}" name="withdraw_charge" value="">
                      </div>
                      @if ($errors->has('withdraw_charge'))
                      <div>
                          <p style="color: red;">
                              {{ $errors->first('withdraw_charge') }}</p>
                      </div>
                  @endif
                      <div class="form-group">
                          <label>Description</label>
                          <textarea name="description" class="summernote">{{ $method->description }}"</textarea>
                      </div>

                      @if ($errors->has('description'))
                      <div>
                          <p style="color: red;">
                              {{ $errors->first('description') }}</p>
                      </div>
                  @endif


                      <button type="submmit" class="btn btn-primary">Update</button>
                  </form>
                </div>

              </div>
            </div>
          </div>

        </div>
      </section>
  </div>
@endsection