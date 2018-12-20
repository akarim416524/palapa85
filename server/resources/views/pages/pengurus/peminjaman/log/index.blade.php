@extends('layouts.master-layout')

@section('title', 'Palapa 85 - Pengajuan Peminjaman')

@section('style')

  <link rel="stylesheet" href="/css/mymodal.css">
  <link rel="stylesheet" href="/css/style.css">

@endsection

@section('content-header')

  <div class="content-header-left col-md-6  breadcrumb-new">
    <h3 class="content-header-title mb-0 d-inline-block text-capitalize">Log Peminjaman</h3>
    <div class="row breadcrumbs-top d-inline-block">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            Peminjaman
          </li>
          <li class="breadcrumb-item active">
            Log Pengajuan Peminjaman
          </li>
        </ol>
      </div>
    </div>
  </div>

@endsection

@section('content')

  <div class="card">
    <div class="card-header">
      <h4 class="card-title" id="basic-layout-form">Tabel Pengajuan Peminjaman</h4>
      <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
      <div class="heading-elements">
        <ul class="list-inline mb-0">
          <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
          <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
          <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
        </ul>
      </div>
    </div>
    <div class="card-content collapse show">
      <div class="card-body">
        <div class="container">
          <table class="table table-hover w-100 table-responsive" id="PeminjamanTable">
            <thead>
              <tr>
                <th><i class="fa fa-id-card"> Nomor</th>
                <th><i class="fa fa-id-card"></i> ID Peminjaman</th>
                <th><i class="fa fa-shopping-bag"></i> Nama Anggota</th>
                <th><i class="fa fa-dollar-sign"></i> Jumlah Pinjaman </th>
                <th><i class="fa fa-calendar"></i> Tanggal Pengajuan</th>
                <th><i class="fa fa-clipboard-check"></i> Tanggal Akhir Pembayaran</th>
                <th><i class="fa fa-clipboard-check"></i> Jenis Angunan</th>
                <th><i class="fa fa-clipboard-check"></i> Status</th>
                <th><i class="fa fa-cog"></i> Action</th>
              </tr>
            </thead>
            <tbody>
            <?php $no=1; ?>
              @foreach ($peminjaman as $item)
                <tr>
                  <td>{{ $no }}</td>
                  <td>{{ $item->no_pinjaman }}</td>
                  <td>{{ $item->user->nama_lengkap }}</td>
                  <td>{{ $item->jumlah }}</td>
                  <td>{{ strftime('%d %B %Y', strtotime($item->created_at)) }}</td>
                  <td>{{ $item->periode_akhir }}</td>
                  <td>{{ $item->jenis_angunan }}</td>
                  <td>{{ $item->status }}</td>
                  <td>
                    <div class="action-button btn-group text-center">
                      <button type="button" class="btn btn-info round dropdown-toggle" data-toggle="dropdown">
                        <i class="la la-gear"></i>
                      </button>
                      <div class="dropdown-menu" x-placement="bottom-start">
                        <button class="dropdown-item tombolDetailAjuanPeminjaman" value="{{ $item->id }}">
                          <i class="ft-info"></i> Detail
                        </button>

                      </div>
                    </div>
                  </td>
                </tr>
                <?php $no++; ?>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

{{-- Modal --}}

{{-- Modal Detail User --}}
<div class="modal-detail modal fade" id="detailAjuanPeminjaman">
  <div class="modal-dialog modal-lg">
    <div class="modal-detail-content modal-content">

      <!-- Modal Header -->
      <div class="modal-detail-header modal-header">
        <h4 class="modal-title text-white">Detail Pengajuan Peminjaman : <b id="detail_id_pembelian"></b> </h4>
        <button type="button" class="close text-black" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-detail-body modal-body">
        <i class="fa fa-info modal-detail-icon"></i><br><br>
        <p class="modal-detail-title">Data Peminjaman :</p><br><br>

        <div class="container">
          <div class="row">

            <div class="col-md-6">
              <div class="container modal-detail-data">

                <div class="row">
                  <div class="col-md-5 col-3 ">
                    <p> <i class="fa fa-shopping-bag"></i> Nama Lengkap</p>
                  </div>
                  <div class="col-md-1 col-1">
                    <p>:</p>
                  </div>
                  <div class="col-md-5">
                    <p id="nama"></p>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-5 col-3 ">
                    <p> <i class="fa fa-shopping-bag"></i> Alamat Anggota</p>
                  </div>
                  <div class="col-md-1 col-1">
                    <p>:</p>
                  </div>
                  <div class="col-md-5">
                    <p id="alamat"></p>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-5 col-3 ">
                    <p> <i class="fa fa-dollar-sign"></i> NO TELEPON</p>
                  </div>
                  <div class="col-md-1 col-1">
                    <p>:</p>
                  </div>
                  <div class="col-md-5">
                    <p id="no_telp"></p>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-5 col-3 ">
                    <p> <i class="fa fa-dollar-sign"></i>  Jenis Angunan</p>
                  </div>
                  <div class="col-md-1 col-1">
                    <p>:</p>
                  </div>
                  <div class="col-md-5">
                    <p id="jenis_angunan"></p>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-5 col-3 ">
                    <p> <i class="fa fa-calendar"></i>  Waktu Pembayaran</p>
                  </div>
                  <div class="col-md-1 col-1">
                    <p>:</p>
                  </div>
                  <div class="col-md-5">
                    <p id="periode_awal"></p>
                    <p>Sampai Dengan</p>
                    <p id="periode_akhir"></p>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-5 col-3 ">
                    <p> <i class="fa fa-money-check-alt "></i>  Jumlah Pinjaman</p>
                  </div>
                  <div class="col-md-1 col-1">
                    <p>:</p>
                  </div>
                  <div class="col-md-5">
                    <p id="jumlah"></p>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-5 col-3 ">
                    <p> <i class="fa fa-clipboard-check"></i> Terbilang</p>
                  </div>
                  <div class="col-md-1 col-1">
                    <p>:</p>
                  </div>
                  <div class="col-md-5">
                    <p id="terbilang"></p>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-5 col-3 ">
                    <p> <i class="fa fa-calendar"></i> Tanggal Pengajuan</p>
                  </div>
                  <div class="col-md-1 col-1">
                    <p>:</p>
                  </div>
                  <div class="col-md-5">
                    <p id="tanggal_pengajuan"></p>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-5 col-3 ">
                    <p> <i class="fa fa-clipboard-check"></i> Status Peminjaman</p>
                  </div>
                  <div class="col-md-1 col-1">
                    <p>:</p>
                  </div>
                  <div class="col-md-5">
                    <p id="status"></p>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-5 col-3 ">
                    <p> <i class="fa fa-info"></i> Cara Pembayaran</p>
                  </div>
                  <div class="col-md-1 col-1">
                    <p>:</p>
                  </div>
                  <div class="col-md-5">
                    <p id="cara_pembayaran"></p>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-5 col-3 ">
                    <p> <i class="fa fa-clipboard-check"></i> Surat Kuasa</p>
                  </div>
                  <div class="col-md-1 col-1">
                    <p>:</p>
                  </div>
                  <div class="col-md-5">
                    <img src="" id="surat" class="img-fluid">
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

    $(".tombolDetailAjuanPeminjaman").on("click", function(){
      var id = $(this).val();
      $.ajax({
        method: "POST",
        url : "{{ route('petugas.peminjaman.detailPeminjaman') }}",
        data: {
          _token: token,
          id: id
        }
      }).done(function (response) {
        $("#nama").text(response.user.nama_lengkap);
        $("#alamat").text(response.user.alamat);
        $("#no_telp").text(response.user.no_telp);
        $("#jenis_angunan").text(response.jenis_angunan);
        $("#jumlah").text(response.jumlah);
        $("#no_pinjaman").text(response.no_pinjaman);
        $("#terbilang").text(response.terbilang);
        $("#tanggal_pengajuan").text(response.created_at)
        $("#jangka_waktu").text(response.jangka_waktu);
        $("#periode_awal").text(response.periode_awal);
        $("#periode_akhir").text(response.periode_akhir);
        $("#cara_pembayaran").text(response.cara_pembayaran);
        $("#status").text(response.status);
        $("#surat").attr('src', response.surat_kuasa);
        $("#detailAjuanPeminjaman").modal();
      });
    });

  </script>

@endsection
