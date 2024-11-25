@extends('admin.layout.master')
@section('title')
    Admin Vendor
@endsection
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Vendor</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Update Vendors</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.vendor.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                                    <div class="col-md-11 mg-t-5 mg-md-t-0">
                                        <!-- Image File Input -->
                                        <input class="form-control" name="banner" type="file"  value="{{ $user->banner }}" accept="image/*"
                                            onchange="loadFile(event)">

                                        <!-- Image Preview -->
                                        <img class="" style="border-radius:50%; margin-top: 8px; margin-bottom: 8px"
                                            width="150px" height="150px" id="output" src="{{ $user->banner ?  asset($user->banner) : '' }}"
                                            alt="Current Image">
                                    </div>
                                    @if ($errors->has('banner'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('banner') }}</p>
                                        </div>
                                    @endif


                                    <div class="form-group">
                                        <label for="">Phone</label>
                                        <input type="text" class="form-control" value="{{ @$user->phone }}" name="phone">
                                    </div>
                                    @if ($errors->has('phone'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('phone') }}</p>
                                        </div>
                                    @endif


                                    <div class="form-group">
                                        <label for="">Shop Name</label>
                                        <input type="text" class="form-control" value="{{ @$user->shop_name }}" name="shop name">
                                    </div>
                                    @if ($errors->has('shop_name'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('shop_name') }}</p>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="text" class="form-control" value="{{ @$user->email }}" name="email">
                                    </div>
                                    @if ($errors->has('email'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('email') }}</p>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">Address</label>
                                        <input type="text" class="form-control" value="{{ @$user->address }}" name="address">
                                    </div>
                                    @if ($errors->has('address'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('address') }}</p>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">FaceBook Link</label>
                                        <input type="text" class="form-control" value="{{ @$user->fb_link }}" name="fb_link">
                                    </div>
                                    @if ($errors->has('fb_link'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('fb_link') }}</p>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">Twitter Link</label>
                                        <input type="text" class="form-control" value="{{ @$user->tw_link }}" name="tw_link">
                                    </div>
                                    @if ($errors->has('tw_link'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('tw_link') }}</p>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">Instagram Link</label>
                                        <input type="text" class="form-control" value="{{ @$user->insta_link }}" name="insta_link">
                                    </div>
                                    @if ($errors->has('insta_link'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('insta_link') }}</p>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name="description" id="" class="summernote">{{ @$user->description }} </textarea>
                                    </div>
                                    @if ($errors->has('description'))
                                        <div>
                                            <p style="color: red;">
                                                {{ $errors->first('description') }}</p>
                                        </div>
                                    @endif


                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <select name="status" id="inputState" class="form-control">
                                            <option selected disabled value="">Choose</option>
                                            <option @selected($user->status == 1) value="1">Active</option>
                                            <option  @selected($user->status == 0) value="0">In Active</option>
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
@push('scripts')
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
@endpush
