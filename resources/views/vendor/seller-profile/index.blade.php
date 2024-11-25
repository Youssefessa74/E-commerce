@extends('vendor.layout.master')
@section('title')
    {{ Auth::user()->name }} | Shop Profile
@endsection
@section('content')
<!--=============================
    DASHBOARD START
==============================-->
<section id="wsus__dashboard">
    <div class="container-fluid">
        @include('vendor.layout.sidebar')
        <div class="row">
            <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                <div class="dashboard_content mt-2 mt-md-0">
                    <h3><i class="far fa-user"></i>Shop Profile</h3>
                    <div class="wsus__dashboard_profile">
                        <div class="wsus__dash_pro_area">
                            <h4>basic information</h4>
                            <form action="{{ route('vendor.vendor-shop.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                                <!-- Image Section -->
                                <div class="col-xl-3 col-sm-6 col-md-6 mb-4">
                                    <div class="wsus__dash_pro_img">
                                        <img id="imagePreview" src="{{ asset($user->banner) ?: '' }}" alt="img"
                                            class="img-fluid w-100">
                                        <input type="file" name="banner" id="imageInput" onchange="previewImage(event)">
                                        @if ($errors->has('banner'))
                                            <div>
                                                <p style="color: red;">{{ $errors->first('banner') }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                  <!-- Shop Name Input -->
                                  <div>
                                    <div class="wsus__dash_pro_single">
                                        <i class="fal fa-store"></i>
                                        <input type="text" placeholder="Shop" name="shop_name"
                                            value="{{ @$user->shop_name }}">
                                    </div>
                                    @if ($errors->has('shop_name'))
                                        <div>
                                            <p style="color: red;">{{ $errors->first('shop_name') }}</p>
                                        </div>
                                    @endif
                                </div>


                                <!-- Phone Input -->
                                <div>
                                    <div class="wsus__dash_pro_single">
                                        <i class="fal fa-phone"></i>
                                        <input type="text" placeholder="Phone" name="phone"
                                            value="{{ @$user->phone }}">
                                    </div>
                                    @if ($errors->has('phone'))
                                        <div>
                                            <p style="color: red;">{{ $errors->first('phone') }}</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Email Input -->
                                <div>
                                    <div class="wsus__dash_pro_single">
                                        <i class="fal fa-envelope-open"></i>
                                        <input type="email" placeholder="Email" name="email"
                                            value="{{ @$user->email }}">
                                    </div>
                                    @if ($errors->has('email'))
                                        <div>
                                            <p style="color: red;">{{ $errors->first('email') }}</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Address Input -->
                                <div >
                                    <div class="wsus__dash_pro_single">
                                        <i class="fal fa-map-marker-alt"></i>
                                        <input type="text" placeholder="Address" name="address"
                                            value="{{ @$user->address }}">
                                    </div>
                                    @if ($errors->has('address'))
                                        <div>
                                            <p style="color: red;">{{ $errors->first('address') }}</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Facebook Link -->
                                <div >
                                    <div class="wsus__dash_pro_single">
                                        <i class="fab fa-facebook-f"></i>
                                        <input type="text" placeholder="Facebook Link" name="fb_link"
                                            value="{{ @$user->fb_link }}">
                                    </div>
                                    @if ($errors->has('fb_link'))
                                        <div>
                                            <p style="color: red;">{{ $errors->first('fb_link') }}</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Twitter Link -->
                                <div >
                                    <div class="wsus__dash_pro_single">
                                        <i class="fab fa-twitter"></i>
                                        <input type="text" placeholder="Twitter Link" name="tw_link"
                                            value="{{ @$user->tw_link }}">
                                    </div>
                                    @if ($errors->has('tw_link'))
                                        <div>
                                            <p style="color: red;">{{ $errors->first('tw_link') }}</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Instagram Link -->
                                <div >
                                    <div class="wsus__dash_pro_single">
                                        <i class="fab fa-instagram"></i>
                                        <input type="text" placeholder="Instagram Link" name="insta_link"
                                            value="{{ @$user->insta_link }}">
                                    </div>
                                    @if ($errors->has('insta_link'))
                                        <div>
                                            <p style="color: red;">{{ $errors->first('insta_link') }}</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Description -->
                                <div >
                                    <div class="wsus__dash_pro_single">
                                        <textarea name="description"  class="summernote">{{ @$user->description }}</textarea>
                                    </div>
                                    @if ($errors->has('description'))
                                        <div>
                                            <p style="color: red;">{{ $errors->first('description') }}</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Status -->
                                <div >
                                    <div class="wsus__dash_pro_single">
                                        <select name="status" class="form-control">
                                            <option selected disabled value="">Choose</option>
                                            <option @selected($user->status == 1) value="1">Active</option>
                                            <option @selected($user->status == 0) value="0">In Active</option>
                                        </select>
                                    </div>
                                    @if ($errors->has('status'))
                                        <div>
                                            <p style="color: red;">{{ $errors->first('status') }}</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=============================
    DASHBOARD END
==============================-->
@endsection
@push('scripts')
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagePreview').src = e.target.result;
        };
        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
@endpush

