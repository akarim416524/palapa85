@extends('layouts.master-layout')

@section('title', 'Palapa 85 - Ajuan Pembelian')

@section('style')

  <link rel="stylesheet" href="/css/mymodal.css">
  <link rel="stylesheet" href="/css/style.css">

@endsection

@section('content-header')

  <div class="content-header-left col-md-6  breadcrumb-new">
    <h3 class="content-header-title mb-0 d-inline-block text-capitalize">Pembelian</h3>
    <div class="row breadcrumbs-top d-inline-block">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            Rekanan
          </li>
          <li class="breadcrumb-item">
            Marketplace
          </li>
          <li class="breadcrumb-item active">
            Ajuan Pembelian
          </li>
        </ol>
      </div>
    </div>
  </div>

@endsection

@section('content')

  <div class="card">
    <div class="card-header">
      <h4 class="card-title" id="basic-layout-form">Tabel Ajuan Pembelian</h4>
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
          <table class="table table-hover w-100 table-responsive" id="PendanaansTable">
            <thead>
              <tr>
                <th><i class="fa fa-money-check-alt"></i> ID Pembelian</th>
                <th><i class="fa fa-user"></i> Nama Pembeli</th>
                <th><i class="fa fa-id-card-alt"></i> Nomor Anggota</th>
                <th><i class="fa fa-shopping-bag"></i> Nama Barang</th>
                <th><i class="fa fa-dollar-sign"></i> Harga Barang</th>
                <th><i class="fa fa-clipboard-check"></i> Status</th>
                <th><i class="fa fa-cog"></i> Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($Pendanaans as $item)
                  <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->user->nama_lengkap }}</td>
                    <td>{{ $item->user->no_anggota }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>Rp{{ number_format($item->harga_barang, 2, ',', '.') }}</td>
                    <td class="status_process">{{ $item->status_rekanan }}</td>
                    <td>
                      <div class="action-button btn-group text-center">
                        <button type="button" class="btn btn-info round dropdown-toggle" data-toggle="dropdown">
                          <i class="la la-gear"></i>
                        </button>
                        <div class="dropdown-menu" x-placement="bottom-start">
                          <button class="dropdown-item tombolkonfirmasi" value="{{ $item->id }}">
                            <i class="fa fa-check-square"></i> Konfirmasi
                          </button>
                          <button class="dropdown-item tombolDetailAjuanPendanaan" value="{{ $item->id }}">
                            <i class="ft-info"></i> Detail
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

{{-- Modal Konfirmasi Ajuan Pembelian --}}

<div class="modal fade" id="modal_konfirmasi">
  <div class="modal-dialog modal-lg">
    <div class="modal-create modal-content">
      <form action="{{ route('rekanan.marketplace.konfirmasi') }}" method="POST">

        <!-- Modal Header -->
        <div class="modal-create-header modal-header bg-info">
          <h4 class="modal-title text-white">Konfirmasi Pembelian <i class="fa fa-clipboard-check"></i> </h4>
          <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-create-body modal-body">
          <div class="container">
            @csrf

            <input type="hidden" name="id" id="id">

            <label><i class="fa fa-clipboard-check"></i> Konfirmasi</label>
            <select name="status_rekanan" id="status_rekanan" class="form-control">
              <option  value="Diterima">Diterima</option>
              <option value="Ditolak">Ditolak</option>
            </select><br>

            <div class="form-group">
              <label><i class="fa fa-info"></i> Keterangan</label>
              <textarea id="catatan_rekanan" name="catatan_rekanan" rows="4" cols="86"></textarea>
            </div>

          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-create-footer modal-footer">
          <button type="submit" class="btn btn-success btn-glow">Konfirmasi <i class="fa fa-check"></i> </button>
        </div>

      </form>
    </div>
  </div>
</div>

{{-- End Modal --}}

{{-- Modal Detail User --}}
<div class="modal-detail modal fade" id="detailPembelian">
  <div class="modal-dialog modal-lg">
    <div class="modal-detail-content modal-content">

      <!-- Modal Header -->
      <div class="modal-detail-header modal-header">
        <h4 class="modal-title text-white">Detail Ajuan Pembelian : <b id="detail_id_pembelian"></b> </h4>
        <button type="button" class="close text-black" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-detail-body modal-body">
        <i class="fa fa-info modal-detail-icon"></i><br><br>
        <p class="modal-detail-title">Data Pembeli/Barang :</p><br><br>

        <div class="container">
          <div class="row">

            <div class="col-md-6">
              <div class="container modal-detail-data">

                <div class="row">
                  <div class="col-md-5 col-3 ">
                    <p> <i class="fa fa-id-card"></i> Id Pembeli</p>
                  </div>
                  <div class="col-md-1 col-1">
                    <p>:</p>
                  </div>
                  <div class="col-md-5">
                    <p id="detail_id_pembeli"></p>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-5 col-3 ">
                    <p> <i class="fa fa-user"></i> Nama Pembeli</p>
                  </div>
                  <div class="col-md-1 col-1">
                    <p>:</p>
                  </div>
                  <div class="col-md-5">
                    <p id="detail_nama_pembeli"></p>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-5 col-3 ">
                    <p> <i class="fa fa-id-card-alt"></i> No Anggota</p>
                  </div>
                  <div class="col-md-1 col-1">
                    <p>:</p>
                  </div>
                  <div class="col-md-5">
                    <p id="detail_no_anggota_pembeli"></p>
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
                    <p id="detail_email_pembeli"></p>
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
                    <p id="detail_no_telp_pembeli"></p>
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
                    <p id="detail_alamat_pembeli"></p>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-md-6">
              <div class="container modal-detail-data">

                <div class="row">
                  <div class="col-md-5 col-3 ">
                    <p> <i class="fa fa-shopping-bag"></i> Nama Barang</p>
                  </div>
                  <div class="col-md-1 col-1">
                    <p>:</p>
                  </div>
                  <div class="col-md-5">
                    <p id="detail_nama_barang"></p>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-5 col-3 ">
                    <p> <i class="fa fa-shopping-bag"></i> Jenis Barang</p>
                  </div>
                  <div class="col-md-1 col-1">
                    <p>:</p>
                  </div>
                  <div class="col-md-5">
                    <p id="detail_jenis_barang"></p>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-5 col-3 ">
                    <p> <i class="fa fa-dollar-sign"></i> Harga Barang</p>
                  </div>
                  <div class="col-md-1 col-1">
                    <p>:</p>
                  </div>
                  <div class="col-md-5">
                    <p id="detail_harga_barang"></p>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-5 col-3 ">
                    <p> <i class="fa fa-dollar-sign"></i>  Terbilang</p>
                  </div>
                  <div class="col-md-1 col-1">
                    <p>:</p>
                  </div>
                  <div class="col-md-5">
                    <p id="detail_terbilang_barang"></p>
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

    $(".tombolkonfirmasi").on("click", function(){
      var id = $(this).val();
      $.ajax({
        method: "POST",
        url: "{{ route('rekanan.marketplace.form.konfirmasi') }}",
        data: {
          _token: token,
          id: id,
        }
      }).done(function (response) {
        $("#id").val(response.id);
        $("#konfirmasi").val(response.status_rekanan);
        $("#catatan_rekanan").val(response.catatan_rekanan);
        $("#modal_konfirmasi").modal();
      });
    });

    $(".tombolDetailAjuanPendanaan").on("click", function(){
      var id = $(this).val();
      $.ajax({
        method: "POST",
        url : "{{ route('rekanan.marketplace.ajuanPendanaan.detail') }}",
        data: {
          _token: token,
          id: id
        }
      }).done(function (response) {
        $("#id_Pendanaan").text(response.id);
        $("#detail_id_pembeli").text(response.user.id);
        $("#detail_nama_pembeli").text(response.user.nama_lengkap);
        $("#detail_no_anggota_pembeli").text(response.user.no_anggota);
        $("#detail_email_pembeli").text(response.user.email);
        $("#detail_no_telp_pembeli").text(response.user.no_telp);
        $("#detail_alamat_pembeli").text(response.user.alamat);
        $("#detail_nama_barang").text(response.nama_barang);
        $("#detail_jenis_barang").text(response.jenis_barang);
        $("#detail_harga_barang").text(response.harga_barang);
        $("#detail_terbilang_barang").text(response.terbilang);
        $("#detailPembelian").modal();
      });
    });

    $(document).ready( function () {
      $('#PendanaansTable').DataTable();
    });

  </script>

@endsection
