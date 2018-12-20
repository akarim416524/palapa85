<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
  <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
  <meta name="author" content="Reyza Zhakarriya S">
  <title>Palapa 85</title>
  <link rel="apple-touch-icon" href="images/palapa.png">
  <link rel="shortcut icon" type="image/x-icon" href="images/palapa.png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
  rel="stylesheet">
  <link href="maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.html"
  rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="/app-assets/css/vendors.min.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/icheck/icheck.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/icheck/custom.css">
  <!-- END VENDOR CSS-->
  <!-- BEGIN MODERN CSS-->
  <link rel="stylesheet" type="text/css" href="/app-assets/css/app.min.css">
  <!-- END MODERN CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/css/core/colors/palette-gradient.min.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/login-register.min.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/extensions/toastr.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/extensions/toastr.min.css">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
  <!-- END Custom CSS-->
  <style>
    body{
      background: url('/images/login.jpg');
      background-position: center;
      background-size: cover;
    }

  </style>
</head>
<body class="vertical-layout vertical-menu-modern 1-column   menu-expanded blank-page blank-page"
data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
<!-- ////////////////////////////////////////////////////////////////////////////-->
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
      <section class="flexbox-container">
        <div class="col-12 d-flex align-items-center justify-content-center">
          <div class="col-md-4 col-10 box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 m-0">
              <div class="card-header border-0">
                <div class="card-title text-center">
                  <div class="p-1">
                    <img src="/images/palapa-text.png" width="200px" height="230px" alt="branding logo">
                  </div>
                </div>
                <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                  <span>Login Form</span>
                </h6>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <form method="post" action="{{ route('login') }}" class="form-horizontal form-simple">
                    @csrf
                    <fieldset class="form-group position-relative has-icon-left mb-0">
                      <input type="text" class="form-control form-control-lg input-lg" id="username" name="username" placeholder="Your Username" value="{{ old('username') }}" required>
                      <div class="form-control-position">
                        <i class="ft-user"></i>
                      </div>
                    </fieldset>
                    <fieldset class="form-group position-relative has-icon-left">
                      <input name="password" type="password" class="form-control form-control-lg input-lg" id="password"
                      placeholder="Enter Password" required>
                      <div class="form-control-position">
                        <i class="ft-lock"></i>
                      </div>
                    </fieldset>
                    <div class="form-group row">
                      <div class="col-md-6 col-12 text-center text-md-left">
                        <fieldset>
                          <input type="checkbox" id="remember-me" class="chk-remember" checked>
                          <label for="remember-me"> Remember Me</label>
                        </fieldset>
                      </div>
                      <div class="col-md-6 col-12 text-center text-md-right"><a href="/password" class="card-link">Forgot Password?</a></div>
                    </div>
                    <button type="submit" value="Login" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i> Login</button>
                  </form>
                </div>
              </div>

            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <!-- BEGIN VENDOR JS-->
  <script src="/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script src="/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
  <script src="/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"
  type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN MODERN JS-->
  <script src="/app-assets/js/core/app-menu.min.js" type="text/javascript"></script>
  <script src="/app-assets/js/core/app.min.js" type="text/javascript"></script>
  <script src="/app-assets/vendors/js/extensions/toastr.min.js" type="text/javascript"></script>
  <script src="/app-assets/js/scripts/extensions/toastr.min.js" type="text/javascript"></script>
  <!-- END MODERN JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <script src="/app-assets/js/scripts/forms/form-login-register.min.js" type="text/javascript"></script>
  <!-- END PAGE LEVEL JS-->
  <!-- custom -->
  <script src="asset/js/main.js"></script>

  @if(session('OK'))
    <script>
      toastr.success('{{ session("OK") }}', 'Success!');
    </script>
  @endif
  @if(session('ERR'))
    <script>
      toastr.error('{{ session("ERR") }}', 'Error!');
    </script>
  @endif

</body>

<!-- Mirrored from pixinvent.com/modern-admin-clean-bootstrap-4-dashboard-html-template/html/ltr/vertical-modern-menu-template/login-simple.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Sep 2018 11:23:48 GMT -->
</html>
