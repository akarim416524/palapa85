@extends('layouts.master-layout')

@section('title', 'Palapa 85 - Users')

@section('style')

  <link rel="stylesheet" href="/css/mymodal.css">

  <link rel="stylesheet" href="/css/style.css">

@endsection

@section('content-header')

  <div class="content-header-left col-md-6  breadcrumb-new">
    <h3 class="content-header-title mb-0 d-inline-block text-capitalize">Rekanan</h3>
    <div class="row breadcrumbs-top d-inline-block">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            Users
          </li>
          <li class="breadcrumb-item active">
            Rekanan
          </li>
        </ol>
      </div>
    </div>
  </div>

  <div class="content-header-right col-md-6 breadcrumb-new text-right">
    <button type="button" name="button" class="btn btn-success round btn-glow" id="tombolTambahUser"><i class="fa fa-user-plus"></i> Tambah Rekanan</button>
  </div>

@endsection

@section('content')

  <div class="card">
    <div class="card-header">
      <h4 class="card-title" id="basic-layout-form">Tabel Users</h4>
      <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
      <div class="heading-elements">
        <ul class="list-inline mb-0">
          <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
          <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
          <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
          <li><a data-action="close"><i class="ft-x"></i></a></li>
        </ul>
      </div>
    </div>
    <div class="card-content collapse show">
      <div class="card-body">
        <div class="container">
          <table class="table table-hover w-100 table-responsive" id="usersTable">
            <thead>
              <tr>
                <th><i class="fa fa-id-card"></i> ID</th>
                <th><i class="fa fa-image"></i> Foto Rekanan</th>
                <th><i class="fa fa-user"></i> Nama Rekanan</th>
                <th><i class="fa fa-store"></i> Jenis Toko</th>
                <th><i class="fa fa-envelope"></i> E-mail</th>
                <th><i class="fa fa-cog"></i> Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $item)
                <tr>
                  <td>{{ $item->id }}</td>
                  <td><img src="{{ $item->gambar_user ?? '/images/blank-user.jpg' }}" alt="userpic" class="profile-pic"> </td>
                  <td>{{ $item->nama_lengkap }}</td>
                  <td>{{ $item->jenis_toko }}</td>
                  <td>{{ $item->email }}</td>
                  <td>
                    <div class="action-button btn-group text-center">
                      <button type="button" class="btn btn-info round dropdown-toggle" data-toggle="dropdown">
                        <i class="la la-gear"></i>
                      </button>
                      <div class="dropdown-menu" x-placement="bottom-start">
                        <button class="dropdown-item tombolDetailUser" value="{{ $item->id }}">
                          <i class="ft-info"></i> Detail
                        </button>
                        <button class="dropdown-item tombolHapusUser" value="{{ $item->id }}">
                          <i class="la la-trash"></i> Hapus
                        </button>
                      </div>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal --}}

  {{-- Modal Tambah User --}}
  <div id="createUser" class="modal-create modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="{{ route('users.rekanan.store') }}" method="POST">

          <!-- Modal Header -->
          <div class="modal-create-header modal-header">
            <h4 class="modal-title text-white">Tambah User Anggota <i class="fa fa-user-plus"></i> </h4>
            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-create-body modal-body">
            <div class="container">
              @csrf
              <div class="form-group">
                <label class="label label-default"> <i class="fa fa-user"></i> Username</label>
                <input minlength="3" type="text" class="form-control" name="username" required>
              </div>
              <div class="form-group">
                <label class="label label-default"><i class="fa fa-user"></i> Nama Lengkap</label>
                <input minlength="3" type="text" class="form-control" name="nama_lengkap" required>
              </div>
              <div class="form-group">
                <label class="label label-default"><i class="fa fa-store"></i> Jenis Toko</label>
                <input type="text" class="form-control" name="jenis_toko">
              </div>
              <div class="form-group">
                <label class="label label-default"><i class="fa fa-home"></i> Alamat</label>
                <textarea name="alamat" rows="4" cols="86"></textarea>
              </div>
              <div class="form-group">
                <label class="label label-default"><i class="fa fa-phone"></i> No Telp</label>
                <input type="text" class="form-control" onkeydown="return ( event.ctrlKey || event.altKey
                || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                || (95<event.keyCode && event.keyCode<106)
                || (event.keyCode==8) || (event.keyCode==9)
                || (event.keyCode>34 && event.keyCode<40)
                || (event.keyCode==46) )" name="no_telp">
              </div>
              <div class="form-group">
                <label class="label label-default"><i class="fa fa-envelope"></i> Email</label>
                <input type="email" class="form-control" name="email" required>
              </div>
              <div class="form-group">
                <label class="label label-default"> <i class="fa fa-key"></i> Hak Akses</label>
                <input style="text-transform: capitalize;" type="text" class="form-control" value="rekanan" name="hak_akses" required readonly>
              </div>
              <div class="form-group">
                <label><i class="fa fa-lock"></i> Password</label>
                <input minlength="6" type="password" class="form-control" name="password" required>
              </div>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-create-footer modal-footer">
            <button type="submit" class="btn btn-success round">Tambah <i class="fa fa-plus"></i> </button>
          </div>

        </form>
      </div>
    </div>
  </div>
  {{-- End Modal --}}

  {{-- Modal Detail User --}}
  <div class="modal-detail modal fade" id="detailUser">
    <div class="modal-dialog modal-lg">
      <div class="modal-detail-content modal-content">

        <!-- Modal Header -->
        <div class="modal-detail-header modal-header">
          <h4 class="modal-title text-white">Detail User : <b id="id_user"></b> </h4>
          <button type="button" class="close text-black" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-detail-body modal-body">
          <i class="fa fa-info modal-detail-icon"></i><br><br>
          <p class="modal-detail-title">Data Toko Rekanan :</p><br><br>

          <div class="container">
            <div class="row">

              <div class="col-md-6">
                <img id="detail_foto_profil" src="" alt="userpic" class="detail-profile-pic">
              </div>

              <div class="col-md-6">
                <div class="container modal-detail-data">

                  <div class="row">
                    <div class="col-md-5 col-3 ">
                      <p> <i class="fa fa-user"></i> Nama Rekanan</p>
                    </div>
                    <div class="col-md-1 col-1">
                      <p>:</p>
                    </div>
                    <div class="col-md-5">
                      <p id="detail_nama_pegawai"></p>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5 col-3 ">
                      <p> <i class="fa fa-store"></i> Jenis Toko</p>
                    </div>
                    <div class="col-md-1 col-1">
                      <p>:</p>
                    </div>
                    <div class="col-md-5">
                      <p id="detail_jenis_toko"></p>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5 col-3 ">
                      <p> <i class="fa fa-phone"></i> No Telepon</p>
                    </div>
                    <div class="col-md-1 col-1">
                      <p>:</p>
                    </div>
                    <div class="col-md-5">
                      <p id="detail_no_telp"></p>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5 col-3 ">
                      <p> <i class="fa fa-envelope"></i> Email</p>
                    </div>
                    <div class="col-md-1 col-1">
                      <p>:</p>
                    </div>
                    <div class="col-md-5">
                      <p id="detail_email"></p>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5 col-3 ">
                      <p> <i class="fa fa-home"></i> Alamat</p>
                    </div>
                    <div class="col-md-1 col-1">
                      <p>:</p>
                    </div>
                    <div class="col-md-5">
                      <p id="detail_alamat"></p>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5 col-3 ">
                      <p> <i class="fa fa-key"></i> Hak Akses</p>
                    </div>
                    <div class="col-md-1 col-1">
                      <p>:</p>
                    </div>
                    <div class="col-md-5">
                      <p id="detail_hak_akses"></p>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div><br><br>
      </div>
    </div>
  </div>
  {{-- End Modal --}}

  {{-- Modal Hapus User --}}
  <div class="modal-delete modal fade" id="delete">
    <div class="modal-dialog modal-sm">
      <div class="modal-delete-content modal-content">
        <form action="{{ route('users.rekanan.destroy') }}" method="POST">
          @csrf
          <!-- Modal Header -->
          <div class="modal-delete-header modal-header">
            <h4 class="modal-title text-white">Peringatan !!!</h4>
            <button type="button" class="close text-black" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-delete-body modal-body">
            <div class="container">
              <i class="fa fa-trash-alt modal-delete-icon"></i><br><br>
              <p class="modal-delete-title">Hapus User</p>
              <p>Apakah anda yakin ingin menghapus user ini?</p>
              <p>User yang telah dihapus tidak dapat dikembalikan</p>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-delete-footer modal-footer">
            <button type="submit" name="id" id="deleteId" class="btn round">
              <i class="fa fa-check"></i> Ok
            </button>
            <button type="button" class="btn round" data-dismiss="modal">
              <i class="fa fa-times"></i> Close
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Modals -->

@endsection

@section('script')

  <script type="text/javascript">

    var token = $("meta[name=\"_token\"]").attr("content");
    $("#tombolTambahUser").on("click", function(){
      $("#createUser").modal();
    });

    $(".tombolDetailUser").on("click", function(){
      var id = $(this).val();
      $.ajax({
        method: "POST",
        url : "{{ route('users.rekanan.detail') }}",
        data: {
          _token: token,
          id: id
        }
      }).done(function (response) {
        $("#id_user").text(response.id);
        $("#detail_foto_profil").attr("src", response.gambar_user);
        $("#detail_nama_pegawai").text(response.nama_lengkap);
        $("#detail_jenis_toko").text(response.jenis_toko);
        $("#detail_no_telp").text(response.no_telp);
        $("#detail_email").text(response.email);
        $("#detail_alamat").text(response.alamat);
        $("#detail_hak_akses").text(response.hak_akses);
        $("#detailUser").modal();
      });
    });

    $(".tombolHapusUser").on("click", function(){
      var id = $(this).val();
      $("#deleteId").val(id);
      $("#delete").modal();
    });

    $(document).ready( function () {
      $('#usersTable').DataTable();
    });
  </script>

@endsection
