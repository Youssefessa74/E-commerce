<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login &mdash; Stisla</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('backend/assets')}}//modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('backend/assets')}}//modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{asset('backend/assets')}}//modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('backend/assets')}}//css/style.css">
  <link rel="stylesheet" href="{{asset('backend/assets')}}//css/components.css">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="{{asset('backend/assets')}}//img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>

              <div class="card-body">
                <form method="POST" action="{{ route('admin.login.auth') }}" class="needs-validation" novalidate="">
                    @csrf
                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" tabindex="1" required autofocus autocomplete="username">
                        <div class="invalid-feedback">
                            Please fill in your email
                        </div>
                        <br>
                       @error('email')
                       <div class="alert alert-danger">{{ $message }}</div>
                       @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <div class="d-block">
                            <label for="password" class="control-label">Password</label>
                            @if (Route::has('password.request'))
                                <div class="float-right">
                                    <a href="{{ route('password.request') }}" class="text-small">
                                        Forgot Password?
                                    </a>
                                </div>
                            @endif
                        </div>
                        <input id="password" type="password" class="form-control" name="password" tabindex="2" required autocomplete="current-password">
                        <div class="invalid-feedback">
                            Please fill in your password
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                            <label class="custom-control-label" for="remember-me">Remember Me</label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                            Login
                        </button>
                    </div>
                </form>
                <div class="text-center mt-4 mb-3">
                  <div class="text-job text-muted">Login With Social</div>
                </div>
                <div class="row sm-gutters">
                  <div class="col-6">
                    <a class="btn btn-block btn-social btn-facebook">
                      <span class="fab fa-facebook"></span> Facebook
                    </a>
                  </div>
                  <div class="col-6">
                    <a class="btn btn-block btn-social btn-twitter">
                      <span class="fab fa-twitter"></span> Twitter
                    </a>
                  </div>
                </div>

              </div>
            </div>
            <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="auth-register.html">Create One</a>
            </div>
            <div class="simple-footer">
              Copyright &copy; Stisla 2018
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="{{asset('backend/assets')}}//modules/jquery.min.js"></script>
  <script src="{{asset('backend/assets')}}//modules/popper.js"></script>
  <script src="{{asset('backend/assets')}}//modules/tooltip.js"></script>
  <script src="{{asset('backend/assets')}}//modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="{{asset('backend/assets')}}//modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="{{asset('backend/assets')}}//modules/moment.min.js"></script>
  <script src="{{asset('backend/assets')}}//js/stisla.js"></script>

  <!-- JS Libraies -->

  <!-- Page Specific JS File -->

  <!-- Template JS File -->
  <script src="{{asset('backend/assets')}}//js/scripts.js"></script>
  <script src="{{asset('backend/assets')}}//js/custom.js"></script>
</body>
</html>