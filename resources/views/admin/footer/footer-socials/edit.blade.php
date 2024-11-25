@extends('admin.layout.master')
@section('title')
Edit Footer Socials
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
                        <h4>Edit Footer Socials</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.footer-socials.update',$footer->id) }}" method="POST" >
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" value="{{ $footer->name }}" name="name">
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
                                value="{{ $footer->icon }}"
                                data-icon="{{ $footer->icon }}"
                                data-selected-class="btn-danger"
                                data-unselected-class="btn-info"
                                name="icon"
                                role="iconpicker">
                                {{ $footer->icon }}
                            </button>
                        </div>

                        @if ($errors->has('icon'))
                            <div>
                                <p style="color: red;">{{ $errors->first('icon') }}</p>
                            </div>
                        @endif

                    <div class="form-group">

                        <label for="">Url</label>
                        <input type="text" class="form-control" value="{{ $footer->url }}" name="url">
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
                                    <option @selected($footer->status == 1)  value="1">Active</option>
                                    <option @selected($footer->status == 0) value="0">In Active</option>
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

