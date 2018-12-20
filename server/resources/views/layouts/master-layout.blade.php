<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Modern is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
  <meta name="keywords" content="admin template, modern admin template, dashboard template, flat template, responsive template, web app, crypto dashboard, bitcoin dashboard">
  <meta name="author" content="PIXINVENT">
  <meta name="_token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>

  <link rel="shortcut icon" type="image/x-icon" href="/images/palapa.png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="/app-assets/fonts/line-awesome/css/line-awesome.min.css">

  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="/app-assets/css/vendors.min.css">
  <!-- END VENDOR CSS-->

  <!-- BEGIN MODERN CSS-->
  <link rel="stylesheet" type="text/css" href="/app-assets/css/app.min.css">
  <!-- END MODERN CSS-->

  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/css/core/colors/palette-gradient.min.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/charts/morris.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/fonts/simple-line-icons/style.min.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/css/core/colors/palette-gradient.min.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/extensions/toastr.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/extensions/toastr.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <!-- END Page Level CSS-->

  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="/css/getorgchart.css">
  @yield('style')
  <!-- END Custom CSS-->

</head>

<body class="vertical-layout vertical-menu-modern 2-columns  menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern"
data-col="2-columns">

<!-- fixed-top-->
<nav style="background: url('/images/tribal5.jpg');" class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-shadow navbar-dark">
  <div class="navbar-wrapper">

    <div class="navbar-header">
      <ul class="nav navbar-nav flex-row">
        <li class="nav-item mobile-menu d-md-none mr-auto">
          <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
            <i class="ft-menu font-large-1"></i>
          </a>
        </li>

        <li class="nav-item mr-auto">
          <a class="navbar-brand" href="/roleCheck">
            <img class="brand-logo" alt="modern admin logo" src="/images/palapa.png">
            <h4 class="brand-text"><b>Koperasi Palapa</b> <b style="color: yellow;">85</b></h4>
          </a>
        </li>

        <li class="nav-item d-md-none">
          <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="la la-ellipsis-v"></i>
          </a>
        </li>
      </ul>
    </div>

    <div class="navbar-container content">
      <div class="collapse navbar-collapse" id="navbar-mobile">

        <ul class="nav navbar-nav mr-auto float-left">
          <li class="nav-item d-none d-md-block">
            <a class="nav-link nav-link-expand" href="#">
              <i class="ficon ft-maximize"></i>
            </a>
          </li>
        </ul>

        <ul class="nav navbar-nav float-right">
          <li class="dropdown dropdown-user nav-item">

            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
              <span class="mr-1">Hello,
                <span class="user-name text-bold-700" style="text-transform: capitalize;">{{ Auth::user()->hak_akses }}</span>
                <span class="user-name text-bold-700" style="text-transform: capitalize;">{{ Auth::user()->nama_lengkap }}</span>
              </span>
              <span class="avatar avatar-online">
                <img style="height: 40px !important" src="{{ Auth::user()->gambar_user ?? '/images/blank-user.jpg' }}" alt="avatar">
                <i></i>
              </span>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
              <a href="/profile/index">
                <button type="button" class="dropdown-item btn">
                  <i class="ft-user"></i> Your Profile
                </button>
              </a>

              <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="dropdown-item btn" onclick="return confirm(' Apakah anda yakin untuk Logout?')">
                  <i class="ft-power"></i> Logout
                </button>
              </form>

            </div>
          </li>
        </ul>

      </div>
    </div>
  </div>
</nav>
<!-- ////////////////////////////////////////////////////////////////////////////-->

<div style="" class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">

  <div class="main-menu-content">

    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

      @if (Auth::user()->hak_akses == 'pelaksana')

        <li class=" nav-item"><a href="#"><i class="fa fa-users"></i><span class="menu-title" data-i18n="nav.dash.main">Users</span></a>
          <ul class="menu-content">

            <li class="nav-item menu-navigasi" id="users_pegawai">
              <a href="/pelaksana/users/pegawai">
                <i class="fa fa-user-tie"></i>
                <span class="menu-title">Pegawai Koperasi</span>
              </a>
            </li>

            <li class="nav-item menu-navigasi" id="users_pegawai">
              <a href="/pelaksana/users/anggota">
                <i class="fa fa-user"></i>
                <span class="menu-title">Anggota Koperasi</span>
              </a>
            </li>

            <li class="nav-item menu-navigasi" id="users_rekanan">
              <a href="/pelaksana/users/rekanan">
                <i class="fa fa-store"></i>
                <span class="menu-title">Toko Rekanan</span>
              </a>
            </li>

          </ul>
        </li>
      @endif

      @if (Auth::user()->hak_akses == 'pengurus')

        <li class=" nav-item"><a href="#"><i class="fa fa-store"></i><span class="menu-title" data-i18n="nav.dash.main">Marketplace</span></a>
          <ul class="menu-content">

            <li class="nav-item menu-navigasi" id="market_pengurus">
              <a href="/pengurus/marketplace/ajuanpendanaan">
                <i class="fa fa-hand-holding-usd"></i>
                <span class="menu-title">Pengajuan Pendanaan</span>
              </a>
            </li>

            <li class="nav-item menu-navigasi" id="market_pengurus">
              <a href="/pengurus/marketplace/ajuanpendanaan/proses">
                <i class="fa fa-hand-holding-usd"></i>
                <span class="menu-title">Proses Pendanaan</span>
              </a>
            </li>

            <li class="nav-item menu-navigasi" id="log_transaksi_pengurus">
              <a href="/pengurus/marketplace/ajuanpendanaan/log">
                <i class="fa fa-history"></i>
                <span class="menu-title">Log Pendanaan</span>
              </a>
            </li>

          </ul>
        </li>
        <li class=" nav-item">
        <a href="#"><i class="fa fa-hand-holding-usd"></i>
        <span class="menu-title" data-i18n="nav.dash.main">Peminjaman</span></a>
          <ul class="menu-content">
            <li class="nav-item menu-navigasi" id="tanpa">
              <a href="/pengurus/peminjaman/TanpaAngunan">
                <i class="fa fa-hand-holding-usd"></i>
                <span class="menu-title">Pengajuan Peminjaman</span>
                </a>
            </li>
            <li class="nav-item menu-navigasi" id="log_Peminjaman">
              <a href="/pengurus/peminjaman/log">
                <i class="fa fa-history"></i>
                <span class="menu-title">Log Peminjaman</span>
              </a>
            </li>
          </ul>
        </li>
      @endif

      @if (Auth::user()->hak_akses == 'anggota')
        <li class=" nav-item"><a href="#"><i class="fa fa-store"></i><span class="menu-title" data-i18n="nav.dash.main">Marketplace</span></a>
          <ul class="menu-content">

            <li class="nav-item menu-navigasi" id="Toko">
              <a href="/anggota/marketplace/ajuanpendanaan">
                <i class="fa fa-shopping-cart"></i>
                <span class="menu-title">Toko</span>
              </a>
            </li>

            <li class="nav-item menu-navigasi" id="Pengajuan_Pendanaan">
              <a href="/anggota/marketplace/pengajuanpendanaan">
                <i class="fa fa-hand-holding-usd"></i>
                <span class="menu-title">Pengajuan Pendanaan</span>
              </a>
            </li>

            <li class="nav-item menu-navigasi" id="log_Pendanaan">
              <a href="/anggota/marketplace/pengajuanpendanaan/log">
                <i class="fa fa-history"></i>
                <span class="menu-title">Log Pendanaan</span>
              </a>
            </li>

          </ul>
        </li>

        <li class=" nav-item"><a href="#"><i class="fa fa-hand-holding-usd">
        </i><span class="menu-title" data-i18n="nav.dash.main">Peminjaman</span></a>
          <ul class="menu-content">
            <li class="nav-item menu-navigasi" id="tanpa">
              <a href="/anggota/peminjaman/TanpaAngunan">
                <i class="fa fa-file-alt"></i>
                <span class="menu-title">Tanpa Angunan</span>
              </a>
            </li>
            <li class="nav-item menu-navigasi" id="bpkb">
              <a href="/anggota/peminjaman/AngunanBpkb">
                <i class="fa fa-file-signature"></i>
                <span class="menu-title">Angunan BPKB</span>
              </a>
            </li>
            <li class="nav-item menu-navigasi" id="sertifikat">
              <a href="/anggota/peminjaman/AngunanSertifikat">
                <i class="fa fa-file-signature"></i>
                <span class="menu-title">Angunan Sertifikat</span>
              </a>
            </li>
            <li class="nav-item menu-navigasi" id="log_Pendanaan">
              <a href="/anggota/peminjaman/log">
                <i class="fa fa-history"></i>
                <span class="menu-title">Log Peminjaman</span>
              </a>
            </li>
          </ul>
        </li>
      @endif

      @if (Auth::user()->hak_akses == 'rekanan')

        <li class="nav-item menu-navigasi" id="barang">
          <a href="/rekanan/barang">
            <i class="fa fa-shopping-bag"></i>
            <span class="menu-title">Barang</span>
          </a>
        </li>

        <li class=" nav-item"><a href="#"><i class="fa fa-store"></i><span class="menu-title" data-i18n="nav.dash.main">Marketplace</span></a>
          <ul class="menu-content">

            <li class="nav-item menu-navigasi" id="ajuan_pendanaan_toko">
              <a href="/rekanan/marketplace/ajuanpendanaan">
                <i class="fa fa-cart-arrow-down"></i>
                <span class="menu-title">Ajuan Pembelian</span>
              </a>
            </li>

            <li class="nav-item menu-navigasi" id="log_pendanaan_toko">
              <a href="/rekanan/marketplace/ajuanpendanaan/log">
                <i class="fa fa-history"></i>
                <span class="menu-title">Log Pembelian</span>
              </a>
            </li>

          </ul>
        </li>
      @endif

      @if (Auth::user()->hak_akses != 'toko')

        <li class="nav-item menu-navigasi" id="barang">
          <a href="/cloud/index">
            <i class="fa fa-cloud"></i>
            <span class="menu-title">Cloud Storage</span>
          </a>
        </li>

      @endif

    </ul>
  </div>
</div>

<div class="app-content content">
  <div class="content-wrapper">

    <div class="content-header mb-3">
      <div class="row">
        @yield('content-header')
      </div>
    </div>

    <div class="content-body">
      @yield('content')
    </div>

  </div>
</div>


<!-- ////////////////////////////////////////////////////////////////////////////-->

<footer class="footer footer-static footer-light navbar-border navbar-shadow">
  <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
    <span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2018
      <a class="text-bold-800 grey darken-2" href="http://101creative.id" target="_blank">101Creative </a>, All rights reserved. </span>
      <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">Hand-crafted & Made with
        <i class="fa fa-heart pink"></i>
      </span>
    </p>
  </footer>

  <!-- BEGIN VENDOR JS-->
  <script src="/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>

  <!-- BEGIN VENDOR JS-->

  <!-- BEGIN PAGE VENDOR JS-->
  <script src="/app-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script>
  <script src="/app-assets/vendors/js/charts/raphael-min.js" type="text/javascript"></script>
  <script src="/app-assets/vendors/js/charts/morris.min.js" type="text/javascript"></script>
  <script src="/app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js" type="text/javascript"></script>
  <script src="/app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js" type="text/javascript"></script>
  <script src="/app-assets/vendors/js/extensions/toastr.min.js" type="text/javascript"></script>
  <script src="/app-assets/js/scripts/extensions/toastr.min.js" type="text/javascript"></script>
  <script src="/app-assets/data/jvector/visitor-data.js" type="text/javascript"></script>
  <script src="/ckeditor/ckeditor.js"></script>
  <!-- END PAGE VENDOR JS-->

  <!-- BEGIN MODERN JS-->
  <script src="/app-assets/js/core/app-menu.min.js" type="text/javascript"></script>
  <script src="/app-assets/js/core/app.min.js" type="text/javascript"></script>
  <script src="/app-assets/js/scripts/customizer.min.js" type="text/javascript"></script>
  <!-- END MODERN JS-->

  <!-- BEGIN PAGE LEVEL JS-->

  {{-- <script src="/app-assets/js/scripts/pages/dashboard-sales.min.js" type="text/javascript"></script> --}}
  <script src="/app-assets/vendors/js/tables/datatable/dataTables.min.js"></script>
  <script src="/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
  <script src="/js/getorgchart.js"></script>

  <!-- BEGIN CUSTOM JS-->
  @yield('script')

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

  <script>
    $(document).ready(function() {
      var pathname = window.location.pathname;
      $(".nav-item a[href=\""+pathname+"\"]").parent().addClass("active");
    })
  </script>
  <!-- END CUSTOM JS-->

</body>

</html>
