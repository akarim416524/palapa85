@extends('layouts.master-layout')

@section('title', 'Palapa 85 - Toko')

@section('style')

  <link rel="stylesheet" href="/css/mymodal.css">

  <link rel="stylesheet" href="/css/style.css">

@endsection

@section('content-header')

  <div class="content-header-left col-md-6  breadcrumb-new">
    <h3 class="content-header-title mb-0 d-inline-block text-capitalize">Toko</h3>
    <div class="row breadcrumbs-top d-inline-block">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            Marketplace
          </li>
          <li class="breadcrumb-item active">
            Toko
          </li>
        </ol>
      </div>
    </div>
  </div>

@endsection

@section('content')
  <div class="card">
    <div class="card-header">
      <h4 class="card-title" id="basic-layout-form">Table Toko yang tersedia</h4>
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
          <table class="table table-hover w-100 table-responsive" id="rekananTable">
            <thead>
              <tr>
                <th><i class="fa fa-id-card"></i> ID Toko</th>
                <th><i class="fa fa-image"></i> Foto Toko</th>
                <th><i class="fa fa-user"></i> Nama Toko</th>
                <th><i class="fa fa-store"></i> Jenis Toko</th>
                <th><i class="fa fa-home"></i> Alamat</th>
                <th><i class="fa fa-cog"></i> Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($rekanan as $item)
                <tr>
                  <td>{{ $item->id }}</td>
                  <td><img src="{{ $item->gambar_user ?? '/images/blank-user.jpg' }}" alt="userpic" class="profile-pic"></td>
                  <td>{{ $item->nama_lengkap }}</td>
                  <td>{{ $item->jenis_toko }}</td>
                  <td>{{ $item->alamat }}</td>
                  <td>
                    <div class="action-button btn-group text-center">
                      <button type="button" class="btn btn-info round dropdown-toggle" data-toggle="dropdown">
                        <i class="la la-gear"></i>
                      </button>
                      <div class="dropdown-menu" x-placement="bottom-start">
                        <button class="dropdown-item tombolDetailrekanan" value="{{ $item->id }}">
                          <i class="ft-info"></i> Detail Toko
                        </button>
                        <form action="/anggota/marketplace/toko/barang/{{ $item->id }}" method="GET">
                        <button class="dropdown-item LihatBarang">
                        <i class="fa fa-shopping-bag"></i> Lihat Barang
                      </button>
                    </form>
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


{{-- Modal Detail User --}}
<div class="modal-detail modal fade" id="detailrekanan">
  <div class="modal-dialog modal-lg">
    <div class="modal-detail-content modal-content">

      <!-- Modal Header -->
      <div class="modal-detail-header modal-header">
        <h4 class="modal-title text-white">Detail Toko : <b id="id_user"></b> </h4>
        <button type="button" class="close text-black" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-detail-body modal-body">
        <i class="fa fa-info modal-detail-icon"></i><br><br>
        <p class="modal-detail-title">Data Toko :</p><br><br>

        <div class="container">
          <div class="row">

            <div class="col-md-6">
              <img id="detail_foto_profil" src="" style="width: 250px; height: 250px" alt="userpic" class="profile-pic">
            </div>

            <div class="col-md-6">
              <div class="container modal-detail-data">

                <div class="row">
                  <div class="col-md-5 col-3 ">
                    <p> <i class="fa fa-user"></i> Nama Toko</p>
                  </div>
                  <div class="col-md-1 col-1">
                    <p>:</p>
                  </div>
                  <div class="col-md-5">
                    <p id="detail_nama_toko"></p>
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
@endsection

@section('script')
  <script type="text/javascript">

    var token = $("meta[name=\"_token\"]").attr("content");

    $("#tombolAjuanPendanaan").on("click", function(){
      $("#createPendanaan").modal();
    });

    $(".tombolDetailrekanan").on("click", function(){
      var id = $(this).val();
      $.ajax({
        method: "POST",
        url : "{{ route('anggota.marketplace.rekanan.detail') }}",
        data: {
          _token: token,
          id: id
        }
      }).done(function (response) {
        $("#id_user").text(response.id);
        $("#detail_foto_profil").attr("src", response.gambar_user);
        $("#detail_nama_toko").text(response.nama_lengkap);
        $("#detail_jenis_toko").text(response.jenis_toko);
        $("#detail_no_telp").text(response.no_telp);
        $("#detail_email").text(response.email);
        $("#detail_alamat").text(response.alamat);
        $("#detail_hak_akses").text(response.hak_akses);
        $("#detailrekanan").modal();
      });
    });

    $(document).ready( function () {
      $('#rekananTable').DataTable();
    });
  </script>

@endsection
