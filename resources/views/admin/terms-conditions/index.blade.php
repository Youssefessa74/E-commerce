@extends('admin.layout.master')
@section('title')
Terms And Conditions
@endsection
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Terms And Conditions</h1>
      </div>
      <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Terms And Conditions</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.terms.and.condition.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="">Content</label>
                                <textarea name="content" class="summernote">{{ @$content->content }}</textarea>
                            </div>
                            @if ($errors->has('content'))
                            <div>
                                <p style="color: red;">
                                    {{ $errors->first('content') }}</p>
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
