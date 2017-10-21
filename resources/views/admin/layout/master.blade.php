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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Milestone - Bootstrap 4 Dashboard Template</title>

    <!-- page stylesheets -->
     <link rel="stylesheet" href="{{ asset('assets/admin/vendor/sweetalert/dist/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/bower-jvectormap/jquery-jvectormap-1.2.2.css') }}"/>
    <!-- end page stylesheets -->
   <link rel="stylesheet" href="{{ asset('assets/admin/vendor/datatables/media/css/dataTables.bootstrap4.css') }}">
    <!-- build:css({.tmp,app}) styles/app.min.css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/bootstrap/dist/css/bootstrap.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/pace/themes/blue/pace-theme-minimal.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/font-awesome/css/font-awesome.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/animate.css/animate.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/admin/styles/app.css') }}" id="load_styles_before"/>
    <link rel="stylesheet" href="{{ asset('assets/admin/styles/app.skins.css') }}"/>
     <script src="{{ asset('assets/admin/vendor/jquery/dist/jquery.js') }}"></script>
     <script src="{{asset('js/flugin/angular/angular.min.js')}}"></script> 
     <script src="{{asset('js/flugin/bootstrap/ui-bootstrap-tpls-2.5.0.min.js')}}"></script>
     <script src="{{asset('js/controllers/admin/app.js')}}"></script>
     <script src="{{asset('js/controllers/admin/user.js')}}"></script>
     <script src="{{asset('js/controllers/admin/role.js')}}"></script>
       <script src="{{asset('js/controllers/admin/permission.js')}}"></script>
     <style type="text/css">
     .loading{
      background:center no-repeat #fff;
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999
      }
    </style>
    <!-- endbuild -->
  </head>
  <body>
    <div class="loading"></div>
    <div class="app">
      <!--sidebar panel-->
      @include('admin.layout.menu')
      <!-- /sidebar panel -->
      <!-- content panel -->
      <div class="main-panel">
        <!-- top header -->
       @include('admin.layout.header')
        <!-- /top header -->

        <!-- main area -->
        <div class="main-content" ng-app="Hoc2h">
          @yield('content')
        </div>
        <!-- /main area -->
      </div>
      <!-- /content panel -->
    </div>

    <script type="text/javascript">
      window.paceOptions = {
        document: true,
        eventLag: true,
        restartOnPushState: true,
        restartOnRequestAfter: true,
        ajax: {
          trackMethods: [ 'POST','GET']
        }
      };
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    </script>

    <!-- build:js({.tmp,app}) scripts/app.min.js -->
    <script src="{{ asset('assets/admin/vendor/pace/pace.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/tether/dist/js/tether.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/bootstrap/dist/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('assets/admin/scripts/constants.js') }}"></script>
    <script src="{{ asset('assets/admin/scripts/main.js')}}"></script>
    <!-- endbuild -->

    <!-- page scripts -->
    <script src="{{ asset('assets/admin/vendor/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/flot-spline/js/jquery.flot.spline.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/bower-jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('assets/admin/data/maps/jquery-jvectormap-us-aea.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/jquery.easy-pie-chart/dist/jquery.easypiechart.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/noty/js/noty/packaged/jquery.noty.packaged.min.js') }}"></script>
    <script src="{{ asset('assets/admin/scripts/helpers/noty-defaults.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/sweetalert/dist/sweetalert.min.js') }}"></script>
    <!-- end page scripts -->

    <!-- initialize page scripts -->
    <script src="{{ asset('assets/admin/scripts/dashboard/dashboard.js') }}"></script>
    <!-- end initialize page scripts -->
    
  </body>
</html>
