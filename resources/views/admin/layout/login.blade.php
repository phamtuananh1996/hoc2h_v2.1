<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1"/>
    <meta name="msapplication-tap-highlight" content="no">
    
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="Milestone">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Milestone">

    <meta name="theme-color" content="#4C7FF0">
    
    <title>Milestone - Bootstrap 4 Dashboard Template</title>

    <!-- page stylesheets -->
    <!-- end page stylesheets -->
    <!-- build:css({.tmp,app}) styles/app.min.css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/bootstrap/dist/css/bootstrap.css') }} "/>
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/pace/themes/blue/pace-theme-minimal.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/font-awesome/css/font-awesome.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/animate.css/animate.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/admin/styles/app.css') }}" id="load_styles_before"/>
    <!-- endbuild -->
  </head>
  <body>

    <div class="app no-padding no-footer layout-static">
      <div class="session-panel">
        <div class="session">
          <div class="session-content">
            <div class="card card-block form-layout">
              <form role="form" action="{{ url('/admin/login') }}" id="validate" method="POST">
                {{csrf_field()}}
                <div class="text-xs-center m-b-3">
                  <img src="{{ asset('assets/admin/images/logo-icon.png') }}" height="80" alt="" class="m-b-1"/>
                  <h5>
                    Welcome back!
                  </h5>
                  <p class="text-muted">
                    Sign in with your app id to continue.
                  </p>
                </div>
                <fieldset class="form-group">
                  <label for="username">
                    Enter your Email
                  </label>
                  <input type="email" class="form-control form-control-lg" id="email" placeholder="email" required name="email" />
                </fieldset>
                <fieldset class="form-group">
                  <label for="password">
                    Enter your password
                  </label>
                  <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="********" required/>
                </fieldset>
                <label class="custom-control custom-checkbox m-b-1">
                  <input type="checkbox" class="custom-control-input" name="remember">
                  <span class="custom-control-indicator"></span>
                  <span class="custom-control-description">Stay logged in</span>
                </label>
                <button class="btn btn-primary btn-block btn-lg" type="submit">
                  Login
                </button>
                <div class="divider">
                  <span>
                    OR
                  </span>
                </div>
                <div class="text-xs-center">
                  <p>
                    Login with your social account
                  </p>
                  <button href="javascript:;" class="btn btn-icon-icon btn-facebook btn-lg m-b-1 m-r-1">
                    <i class="fa fa-facebook">
                    </i>
                  </button>
                  <button href="javascript:;" class="btn btn-icon-icon btn-github btn-lg m-b-1 m-r-1">
                    <i class="fa fa-github">
                    </i>
                  </button>
                  <button href="javascript:;" class="btn btn-icon-icon btn-google btn-lg m-b-1 m-r-1">
                    <i class="fa fa-google-plus">
                    </i>
                  </button>
                  <button href="javascript:;" class="btn btn-icon-icon btn-linkedin btn-lg m-b-1 m-r-1">
                    <i class="fa fa-linkedin">
                    </i>
                  </button>
                </div>
              </form>
            </div>
          </div>
          <footer class="text-xs-center p-y-1">
            <p>
              <a href="extra-forgot.html">
                Forgot password?
              </a>
              &nbsp;&nbsp;·&nbsp;&nbsp;
              <a href="extra-signup.html">
                Create an account
              </a>
            </p>
          </footer>
        </div>

      </div>
    </div>
    <!-- build:js({.tmp,app}) scripts/app.min.js -->
    <script src="{{ asset('assets/admin/vendor/jquery/dist/jquery.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/pace/pace.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/tether/dist/js/tether.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/bootstrap/dist/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('assets/admin/scripts/constants.js') }}"></script>
    <!-- endbuild -->

    <!-- page scripts -->
    <script src="{{ asset('vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <!-- end page scripts -->

    <!-- initialize page scripts -->
    <script type="text/javascript">
      $('#validate').validate();
    </script>
    <!-- end initialize page scripts -->
    
  </body>
</html>
