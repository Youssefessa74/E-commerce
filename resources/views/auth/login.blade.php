@extends('frontend.layout.master')
@section('title')
    {{ __('Login') }}
@endsection
@section('content')
    <!--============================
             BREADCRUMB START
        ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>{{ __('login / register') }}</h4>
                        <ul>
                            <li><a href="#">{{ __('home') }}</a></li>
                            <li><a href="#">{{ __('login / register') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
            BREADCRUMB END
        ==============================-->

    <!--============================
           LOGIN/REGISTER PAGE START
        ==============================-->
        <section id="wsus__login_register">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 m-auto">
                        <div class="wsus__login_reg_area">
                            <ul class="nav nav-pills mb-3" id="pills-tab2" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab2" data-bs-toggle="pill"
                                        data-bs-target="#pills-homes" type="button" role="tab" aria-controls="pills-homes"
                                        aria-selected="true">{{ __('login') }}</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-profile-tab2" data-bs-toggle="pill"
                                        data-bs-target="#pills-profiles" type="button" role="tab" aria-controls="pills-profiles"
                                        aria-selected="true">{{ __('signup') }}</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent2">
                                <!-- Login Tab Content -->
                                <div class="tab-pane fade show active" id="pills-homes" role="tabpanel"
                                    aria-labelledby="pills-home-tab2">
                                    <div class="wsus__login">
                                        <!-- Login Form -->
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <!-- Email Input -->
                                            <div class="wsus__login_input">
                                                <i class="fas fa-user-tie"></i>
                                                <input type="email" name="email" value="{{ old('email') }}" required
                                                    autofocus autocomplete="username" placeholder="{{ __('Email') }}">
                                                <br>
                                                @if ($errors->has('email'))
                                                    <p style="color: red;">{{ $errors->first('email') }}</p>
                                                @endif
                                            </div>

                                            <!-- Password Input -->
                                            <div class="wsus__login_input">
                                                <i class="fas fa-key"></i>
                                                <input type="password" name="password" required autocomplete="current-password"
                                                    placeholder="{{ __('Password') }}">
                                                <br>
                                                @if ($errors->has('password'))
                                                    <p style="color: red;">{{ $errors->first('password') }}</p>
                                                @endif
                                            </div>

                                            <!-- Remember Me -->
                                            <div class="wsus__login_save">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="remember_me"
                                                        name="remember">
                                                    <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>
                                                </div>
                                                <a class="forget_p" href="{{ route('password.request') }}">{{ __('forget password ?') }}</a>
                                            </div>

                                            <!-- Submit Button -->
                                            <button class="common_btn" type="submit">{{ __('login') }}</button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Signup Tab Content -->
                                <div class="tab-pane fade" id="pills-profiles" role="tabpanel"
                                    aria-labelledby="pills-profile-tab2">
                                    <div class="wsus__login">
                                        <!-- Signup Form -->
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <!-- Name Input -->
                                            <div class="wsus__login_input">
                                                <i class="fas fa-user-tie"></i>
                                                <input type="text" name="name" value="{{ old('name') }}" required autofocus
                                                    autocomplete="name" placeholder="{{ __('Name') }}">

                                                @if ($errors->has('name'))
                                                    <p style="color: red;">{{ $errors->first('name') }}</p>
                                                @endif
                                            </div>

                                            <!-- Email Input -->
                                            <div class="wsus__login_input">
                                                <i class="far fa-envelope"></i>
                                                <input type="email" name="email" value="{{ old('email') }}" required
                                                    autocomplete="email" placeholder="{{ __('Email') }}">

                                                @if ($errors->has('email'))
                                                    <p style="color: red;">{{ $errors->first('email') }}</p>
                                                @endif
                                            </div>

                                            <!-- Password Input -->
                                            <div class="wsus__login_input">
                                                <i class="fas fa-key"></i>
                                                <input type="password" name="password" required autocomplete="new-password"
                                                    placeholder="{{ __('messages.Password') }}">

                                                @if ($errors->has('password'))
                                                    <p style="color: red;">{{ $errors->first('password') }}</p>
                                                @endif
                                            </div>

                                            <!-- Confirm Password Input -->
                                            <div class="wsus__login_input">
                                                <i class="fas fa-key"></i>
                                                <input type="password" name="password_confirmation" required
                                                    autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">

                                                @if ($errors->has('password_confirmation'))
                                                    <p style="color: red;">{{ $errors->first('password_confirmation') }}</p>
                                                @endif
                                            </div>

                                            <!-- Terms and Privacy Checkbox -->
                                            <div class="wsus__login_save">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault03" required>
                                                    <label class="form-check-label" for="flexSwitchCheckDefault03">
                                                        {{ __('I consent to the privacy policy') }}
                                                    </label>
                                                </div>
                                            </div>

                                            <!-- Submit Button -->
                                            <button class="common_btn" type="submit">{{ __('Sign Up') }}</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <!--============================
           LOGIN/REGISTER PAGE END
        ==============================-->
@endsection
