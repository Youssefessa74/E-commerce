@extends('admin.layout.master')
@section('title')
Edit Sub Categories
@endsection
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Sub Categories</h1>
      </div>
      <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Sub Categories</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.sub-category.update',$sub_category->id) }}" method="POST" >
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" value="{{ $sub_category->name }}" name="name">
                            </div>
                            @if ($errors->has('name'))
                            <div>
                                <p style="color: red;">
                                    {{ $errors->first('name') }}</p>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="">Category</label>
                            <select name="category_id" id="inputState" class="form-control">
                                <option selected disabled value="">Choose</option>
                                @foreach ($categories as $item)
                                <option @selected($sub_category->category_id == $item->id) value="{{ $item->id }}">{{ $item->name }}</option>                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('category_id'))
                        <div>
                            <p style="color: red;">
                                {{ $errors->first('category_id') }}</p>
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

