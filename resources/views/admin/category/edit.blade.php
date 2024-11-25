@extends('admin.layout.master')
@section('title')
Edit Categories
@endsection
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Categories</h1>
      </div>
      <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Categories</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.category.update',$category->id) }}" method="POST" >
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" value="{{ $category->name }}" name="name">
                            </div>
                            @if ($errors->has('name'))
                            <div>
                                <p style="color: red;">
                                    {{ $errors->first('name') }}</p>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="">Icon</label>
                            <button
                                class="btn btn-primary"
                                value="{{ $category->icon }}"
                                data-icon="{{ $category->icon }}"
                                data-selected-class="btn-danger"
                                data-unselected-class="btn-info"
                                name="icon"
                                role="iconpicker">
                                {{ $category->icon }}
                            </button>
                        </div>

                        @if ($errors->has('icon'))
                            <div>
                                <p style="color: red;">{{ $errors->first('icon') }}</p>
                            </div>
                        @endif



                            <div class="form-group">
                                <label for="">Status</label>
                                <select name="status" id="inputState" class="form-control">
                                    <option selected disabled value="">Choose</option>
                                    <option @selected($category->status == 1)  value="1">Active</option>
                                    <option @selected($category->status == 0)   value="0">In Active</option>
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

