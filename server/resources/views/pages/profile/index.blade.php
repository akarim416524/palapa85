@extends('layouts.master-layout')

@section('title', 'Palapa 85 - Profile')

@section('style')
  <style>
  .profile-info b{
    font-size: 20px;
    color: rgb(70,70,70);
  }

  .profile-info p{
    font-size: 17px;
    text-transform: capitalize;
  }

  .profile-pic{
    width: 400px;
    height: 400px;
    border: 10px white solid;
    outline: solid grey 1px;
    box-shadow: black 5px 10px 5px;
  }
  </style>
@endsection

@section('content-header')

  <div class="content-header-left col-md-6  breadcrumb-new">
    <h3 class="content-header-title mb-0 d-inline-block text-capitalize">Profile</h3>
    <div class="row breadcrumbs-top d-inline-block">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            Home
          </li>
          <li class="breadcrumb-item active">
            Profile
          </li>
        </ol>
      </div>
    </div>
  </div>

  <div class="content-header-right col-md-6 breadcrumb-new text-right">
    <button type="button" name="button" class="btn btn-info round btn-glow" value="{{ Auth::user()->id }}" id="tombolEditProfile"><i class="ft-edit"></i> Edit Profile</button>
    <button type="button" name="button" class="btn btn-info round btn-glow tombolUbahPassword"><i class="ft-lock"></i> Ubah Password</button>
  </div>

@endsection

@section('content')

  <div class="card">
    <div class="card-header">
      <h4 class="card-title" id="basic-layout-form">Profile</h4>
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
          <div class="row">
            <div class="col-sm-6">
              <img class="profile-pic" src="{{ $profile->gambar_user ?? '/images/blank-user.jpg' }}" alt="userpic">
            </div>
            <div class="profile-info col-sm-6">
              <b>Username :</b>
              <p>{{ $profile->username }}</p>

              <b>Nama Lengkap:</b>
              <p>{{ $profile->nama_lengkap}}</p>

              @if (Auth::user()->hak_akses == 'anggota')
                <b>Tanggal Lahir:</b>
                <p>{{ $profile->tanggal_lahir}}</p>

                <b>No Pegawai:</b>
                <p>{{ $profile->no_pegawai}}</p>

                <b>No Anggota:</b>
                <p>{{ $profile->no_anggota}}</p>
              @endif

              <b>Alamat:</b>
              <p>{{ $profile->alamat}}</p>

              <b>No Telp:</b>
              <p> {{ $profile->no_telp}}</p>

              <b>Email:</b>
              <p>{{ $profile->email}}</p>

              <b>Hak Akses:</b>
              <p> {{ $profile->hak_akses}}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal --}}

  {{-- Modal Edit Profile --}}
  <div id="editprofile" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">

          <!-- Modal Header -->
          <div class="modal-header bg-info">
            <h4 class="modal-title text-white">Edit Profile</h4>
            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <div class="container">
              @csrf
              <input type="hidden" value="{{ Auth::user()->id }}" name="id">

              <div class="form-group">
                <label>Gambar Profile</label>
                <br>
                <input type="file" name="gambar_user" class="form-control">
              </div>

              <div class="form-group">
                <label class="label label-default">Username</label>
                <input type="text" class="form-control" name="username" id="editusername" minlength="3" required>
              </div>

              <div class="form-group">
                <label class="label label-default">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama_lengkap" id="editnamalengkap" minlength="3" required>
              </div>

              @if (Auth::user()->hak_akses == 'anggota')

                <div class="form-group">
                  <label class="label label-default">Tanggal Lahir</label>
                  <input type="date" class="form-control" name="tanggal_lahir" id="edittanggal_lahir" required>
                </div>

                <div class="form-group">
                  <label class="label label-default">No Pegawai</label>
                  <input type="text" class="form-control" name="no_pegawai" id="editno_pegawai" required>
                </div>

                <div class="form-group">
                  <label class="label label-default">No Anggota</label>
                  <input type="text" class="form-control" name="no_anggota" id="editno_anggota" required>
                </div>

              @endif

              <div class="form-group">
                <label class="label label-default">Alamat</label>
                <input type="text" class="form-control" name="alamat" id="editalamat">
              </div>

              <div class="form-group">
                <label class="label label-default">No Telp</label>
                <input type="text" class="form-control" name="no_telp" id="editnotelp" onkeydown="return ( event.ctrlKey || event.altKey
                || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                || (95<event.keyCode && event.keyCode<106)
                || (event.keyCode==8) || (event.keyCode==9)
                || (event.keyCode>34 && event.keyCode<40)
                || (event.keyCode==46) )" name="no_telp">
              </div>

              <div class="form-group">
                <label class="label label-default">Email</label>
                <input type="email" class="form-control" name="email" id="editemail" minlength="3" required>
              </div>

              <div class="form-group">
                <label class="label label-default">Hak Akses</label>
                <input type="text"  class="form-control" id="hakakses" readonly>
              </div>

            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-info round">Edit</button>
          </div>

        </form>
      </div>
    </div>
  </div>
  {{-- End Modal --}}

  {{--Modal Ubah Password--}}
  <div id="changepass" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="{{ route('profile.changepassword') }}" method="POST">

          <!-- Modal Header -->
          <div class="modal-header bg-info">
            <h4 class="modal-title text-white">Ubah Password</h4>
            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <div class="container">
              @csrf
              <div class="form-group">
                <label class="label label-default">Password Baru</label>
                <input type="password" class="form-control" name="password" minlength="6" required>
              </div>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-info round">Ubah Password</button>
          </div>

        </form>
      </div>
    </div>
  </div>
  {{-- End Modal --}}

@endsection

@section('script')

  <script type="text/javascript">

    var token = $("meta[name=\"_token\"]").attr("content");
    $("#tombolEditProfile").on("click", function(){
      var id = $(this).val();
      $.ajax({
        method: "POST",
        url: "{{ route('profile.edit') }}",
        data: {
          _token: token,
          id: id,
        }
      }).done(function(response){
        $("#editusername").val(response.username);
        $("#editnamalengkap").val(response.nama_lengkap);
        $("#edittanggal_lahir").val(response.tanggal_lahir);
        $("#editno_pegawai").val(response.no_pegawai);
        $("#editno_anggota").val(response.no_anggota);
        $("#editalamat").val(response.alamat);
        $("#editnotelp").val(response.no_telp);
        $("#editemail").val(response.email);
        $("#hakakses").val(response.hak_akses);
        $("#editprofile").modal();
      });
    });

    $(".tombolUbahPassword").on("click", function(){
      var id = $(this).val();
      $("#changepass").modal();
    });

  </script>

@endsection
