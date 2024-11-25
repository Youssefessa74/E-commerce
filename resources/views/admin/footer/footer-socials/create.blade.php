@extends('admin.layout.master')
@section('title')
Create Footer Socials
@endsection
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Footer Socials</h1>
      </div>
      <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Footer Socials</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.footer-socials.store') }}" method="POST" >
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

                            <label for="">Icon</label>
                            <button class="btn btn-primary" data-selected-class="btn-danger" data-selected-class="btn-info" name="icon" role="iconpicker"></button>
                        </div>
                        @if ($errors->has('icon'))
                        <div>
                            <p style="color: red;">
                                {{ $errors->first('icon') }}</p>
                        </div>
                    @endif

                    <div class="form-group">

                        <label for="">Url</label>
                        <input type="text" class="form-control" name="url">
                    </div>
                    @if ($errors->has('url'))
                    <div>
                        <p style="color: red;">
                            {{ $errors->first('url') }}</p>
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

