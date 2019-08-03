<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Panel- {{ __('Reset Password') }}</title>

    <!-- Bootstrap core CSS-->
    <link href="{{ asset('admin_asset/register_asset/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin_asset/register_asset/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin_asset/register_asset/css/sb-admin.css') }}" rel="stylesheet">

  </head>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">{{ __('Reset Password') }}</div>
        <div class="card-body">
          <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
              <div class="form-label-group">
                <input type="email" id="inputEmail" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email address" value="{{ old('email') }}" required autocomplete="email">
                <label for="inputEmail">Email address</label>
              </div>
              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>


            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="inputPassword" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required="required" autocomplete="new-password">
                <label for="inputPassword">Password</label>
              </div>
              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="confirmPassword" name="password_confirmation" class="form-control" placeholder="Confirm password" required autocomplete="new-password">
                <label for="confirmPassword">Confirm password</label>
              </div>
            </div>
            {{-- <a class="btn btn-primary btn-block" href="login.html">Register</a> --}}
            <button type="submit" class="btn btn-primary btn-block">
                {{ __('Reset Password') }}
            </button>
          </form>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin_asset/register_asset/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_asset/register_asset/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin_asset/register_asset/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  </body>

</html>
