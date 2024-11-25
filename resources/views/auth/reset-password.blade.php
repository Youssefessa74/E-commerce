@extends('frontend.layout.master')
@section('title')
    Reset Password
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
                        <h4>Reset Password</h4>
                        <ul>
                            <li><a href="#">Login</a></li>
                            <li><a href="#">Reset Password</a></li>
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
            RESET PASSWORD START
        ==============================-->
    <section id="wsus__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 m-auto">
                    <div class="wsus__forget_area">
                        <span class="qiestion_icon"><i class="fal fa-question-circle"></i></span>
                        <h4>Reset Password</h4>
                        <p>Please enter your new password and confirm it to reset.</p>
                        <div class="wsus__login">
                            <form method="POST" action="{{ route('password.store') }}">
                                @csrf

                                <!-- Password Reset Token -->
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                <!-- Email Address Input -->
                                <div class="wsus__login_input">
                                    <i class="fal fa-envelope"></i>
                                    <input type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus placeholder="Your Email">
                                    @if ($errors->has('email'))
                                        <p style="color: red;">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>

                                <!-- Password Input -->
                                <div class="wsus__login_input">
                                    <i class="fas fa-key"></i>
                                    <input type="password" name="password" required autocomplete="new-password" placeholder="New Password">
                                    @if ($errors->has('password'))
                                        <p style="color: red;">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>

                                <!-- Confirm Password Input -->
                                <div class="wsus__login_input">
                                    <i class="fas fa-key"></i>
                                    <input type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm New Password">
                                    @if ($errors->has('password_confirmation'))
                                        <p style="color: red;">{{ $errors->first('password_confirmation') }}</p>
                                    @endif
                                </div>

                                <!-- Submit Button -->
                                <button class="common_btn" type="submit">Reset Password</button>
                            </form>
                        </div>

                        <!-- Link to Login Page -->
                        <a class="see_btn mt-4" href="{{ route('login') }}">Go to login</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
            RESET PASSWORD END
        ==============================-->
@endsection
