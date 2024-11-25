@extends('admin.layout.master')
@section('title')
Manage Users
@endsection
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Manage Users</h1>
      </div>

      <div class="section-body">

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Create User</h4>

              </div>
              <div class="card-body">
                <form action="{{ route('admin.manage.users.create') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="">
                    </div>
                    @if ($errors->has('name'))
                    <div>
                        <p style="color: red;">
                            {{ $errors->first('name') }}</p>
                    </div>
                @endif


                <div class="form-group">
                    <label>User Name</label>
                    <input type="text" class="form-control" name="username" value="">
                </div>
                @if ($errors->has('username'))
                <div>
                    <p style="color: red;">
                        {{ $errors->first('username') }}</p>
                </div>
            @endif

                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" value="">
                    </div>
                    @if ($errors->has('email'))
                    <div>
                        <p style="color: red;">
                            {{ $errors->first('email') }}</p>
                    </div>
                @endif
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" value="">
                            </div>
                            @if ($errors->has('password'))
                            <div>
                                <p style="color: red;">
                                    {{ $errors->first('password') }}</p>
                            </div>
                        @endif
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Confirm password</label>
                                <input type="password" class="form-control" name="password_confirmation" value="">
                            </div>
                            @if ($errors->has('password_confirmation'))
                            <div>
                                <p style="color: red;">
                                    {{ $errors->first('password_confirmation') }}</p>
                            </div>
                        @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputState">Role</label>
                        <select id="inputState" class="form-control" name="role">
                            <option value="">Select</option>
                          <option value="user">User</option>
                          <option value="vendor">Vendor</option>
                          <option value="admin">Admin</option>
                        </select>
                    </div>
                    @if ($errors->has('role'))
                    <div>
                        <p style="color: red;">
                            {{ $errors->first('role') }}</p>
                    </div>
                @endif
                    <button type="submmit" class="btn btn-primary">Create</button>
                </form>
              </div>

            </div>
          </div>
        </div>

      </div>
    </section>
  </div>
@endsection

