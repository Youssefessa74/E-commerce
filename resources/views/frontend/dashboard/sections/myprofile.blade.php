@extends('frontend.dashboard.layout.master')
@section('title')
    {{ Auth::user()->name }} | My Profile
@endsection
@section('content')
    <!--=============================
                DASHBOARD START
              ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('frontend.dashboard.layout.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> profile</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <h4>basic information</h4>
                                <div class="row">
                                    {{-- Start User Update Account Data  --}}
                                    <form action="{{ route('update_user_profile') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                                        <div class="col-xl-9">
                                            <div class="col-xl-3 col-sm-6 col-md-6 mb-4">
                                                <div class="wsus__dash_pro_img">
                                                    <img id="imagePreview" src="{{ asset(auth()->user()->image) }}"
                                                        alt="img" class="img-fluid w-100">
                                                    <input type="file" name="image" id="imageInput"
                                                        onchange="previewImage(event)">
                                                    @if ($errors->has('image'))
                                                        <div>
                                                            <p style="color: red;">{{ $errors->first('image') }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="wsus__dash_pro_single">
                                                        <i class="fas fa-user-tie"></i>
                                                        <input type="text" placeholder="Full Name" name="name"
                                                            value="{{ auth()->user()->name }}">
                                                        @if ($errors->has('name'))
                                                            <div>
                                                                <p style="color: red;">{{ $errors->first('name') }}</p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>


                                                <div class="col-xl-6 col-md-6">
                                                    <div class="wsus__dash_pro_single">
                                                        <i class="fal fa-envelope-open"></i>
                                                        <input type="email" placeholder="Email" name="email"
                                                            value="{{ auth()->user()->email }}">
                                                    </div>
                                                    @if ($errors->has('email'))
                                                        <div>
                                                            <p style="color: red;">{{ $errors->first('email') }}</p>
                                                        </div>
                                                    @endif
                                                </div>


                                            </div>
                                        </div>

                                        <div class="col-xl-12">
                                            <button type="submit" class="common_btn mb-4 mt-2"
                                                type="submit">upload</button>
                                        </div>
                                    </form>
                                    {{-- End User Update Account Data  --}}

                                    {{-- Start User Update Password --}}
                                    <form action="{{ route('update_user_password') }}" method="POST">
                                        @csrf
                                        <div class="wsus__dash_pass_change mt-2">
                                            <div class="row">
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="wsus__dash_pro_single">
                                                        <i class="fas fa-unlock-alt"></i>
                                                        <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                                                        <input type="password" name="current_password"
                                                            placeholder="Current Password">
                                                        @if ($errors->has('current_password'))
                                                            <div>
                                                                <p style="color: red;">
                                                                    {{ $errors->first('current_password') }}</p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="wsus__dash_pro_single">
                                                        <i class="fas fa-lock-alt"></i>
                                                        <input type="password" placeholder="New Password" name="password">
                                                        @if ($errors->has('password'))
                                                        <div>
                                                            <p style="color: red;">
                                                                {{ $errors->first('password') }}</p>
                                                        </div>
                                                    @endif
                                                    </div>
                                                </div>
                                                <div class="col-xl-4">
                                                    <div class="wsus__dash_pro_single">
                                                        <i class="fas fa-lock-alt"></i>
                                                        <input type="password" placeholder="Confirm Password"
                                                            name="password_confirmation">
                                                            @if ($errors->has('password_confirmation'))
                                                            <div>
                                                                <p style="color: red;">
                                                                    {{ $errors->first('password_confirmation') }}</p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <button type="submit" class="common_btn" type="submit">upload</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    {{-- End User Update Password --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
                DASHBOARD START
       ==============================-->
@endsection
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            const img = document.getElementById('imagePreview');
            img.src = e.target.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
