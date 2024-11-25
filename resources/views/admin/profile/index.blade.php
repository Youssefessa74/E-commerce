@extends('admin.layout.master')
@section('title')
    {{ auth()->user()->name }} | Profile
@endsection
@section('content')
<div class="main-content">
<section class="section">
    <div class="section-header">
      <h1>Profile</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">Profile</div>
      </div>
    </div>
    <div class="section-body">
      <h2 class="section-title">Hi, {{ Auth::user()->name }}!</h2>
      <p class="section-lead">
        Change information about yourself on this page.
      </p>

      <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-7">
          <div class="card">
            <form method="POST" action="{{ route('admin.profile.update') }}" class="needs-validation" enctype="multipart/form-data">
                @csrf
              <div class="card-header">
                <h4>Update Profile</h4>
              </div>
              <div class="card-body">
                  <div class="row">
                    <div class="form-group">
                    <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                    <div class="form-group col-12">
                        <div class="mb-4">
                            <img src="{{ asset(Auth::user()->image) }}" width="100px" alt="">

                        </div>
                    <label>Image</label>
                    <input type="file" class="form-control" name="image" value="{{ auth()->user()->image }}">
                    @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                    </div>

                  <div class="form-group col-md-6 col-12">
                      <label> Name</label>
                      <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}" required="">
                      @error('name')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group col-md-6 col-12">
                      <label>email</label>
                      <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" required="">
                      @error('email')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                  </div>
                </div>



              </div>
              <div class="card-footer text-right">
                <button class="btn btn-primary">Save Changes</button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-12 col-md-12 col-lg-7">
            <div class="card">
              <form method="POST" action="{{ route('admin.update.password') }}" class="needs-validation" >
                  @csrf
                <div class="card-header">
                  <h4>Update Password</h4>
                </div>
                <div class="card-body">
                    <div class="row">

                    <div class="form-group col-md-6 col-12">
                        <label>Current Password</label>
                        <input type="password" class="form-control" name="current_password"  required="">
                        @error('current_password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group col-md-6 col-12">
                      <label>New Password</label>
                      <input type="password" class="form-control" name="password"  required="">
                      @error('password')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group col-md-6 col-12">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation"  required="">
                        @error('password_confirmation')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>



                </div>
                <div class="card-footer text-right">
                  <button class="btn btn-primary">Save Changes</button>
                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  </section>
  </div>
@endsection
