@extends('layouts.master-layout')

@section('title', 'Palapa 85 - Barang')

@section('style')

  <link rel="stylesheet" href="/css/mymodal.css">
  <link rel="stylesheet" href="/css/style.css">

@endsection

@section('content-header')

  <div class="content-header-left col-md-6  breadcrumb-new">
    <h3 class="content-header-title mb-0 d-inline-block text-capitalize">Log Pendanaan</h3>
    <div class="row breadcrumbs-top d-inline-block">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            Marketplace
          </li>
          <li class="breadcrumb-item active">
            Log Pendanaan
          </li>
        </ol>
      </div>
    </div>
  </div>

@endsection

@section('content')

  <div class="card">
    <div class="card-header">
      <h4 class="card-title" id="basic-layout-form">Tabel Log Pendanaan</h4>
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
          <table class="table table-hover w-100 table-responsive" id="Pendanaans2Table">
            <thead>
              <tr>
                <th><i class="fa fa-id-card"></i> ID Pendanaan</th>
                <th><i class="fa fa-user"></i> Nama Pembeli</th>
                <th><i class="fa fa-shopping-bag"></i> Nama Barang</th>
                <th><i class="fa fa-dollar-sign"></i> Harga Barang</th>
                <th><i class="fa fa-clipboard-check"></i> Status Rekanan</th>
                <th><i class="fa fa-clipboard-check"></i> Status Persetujuan HR</th>
                <th><i class="fa fa-clipboard-check"></i> Status Pengurus</th>
                <th><i class="fa fa-cog"></i> Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($Pendanaans as $item)
                <tr>
                  <td>{{ $item->id }}</td>
                  <td>{{ $item->user->nama_lengkap }}</td>
                  <td>{{ $item->nama_barang }}</td>
                  <td>Rp{{ number_format($item->harga_barang, 2, ',', '.') }}</td>
                  <td class="status_diterima">{{ $item->status_rekanan }}</td>

                  @if ($item->status_hr == 'Diterima')
                    <td class="status_diterima">{{ $item->status_hr }}</td>
                  @else
                    <td class="status_ditolak">{{ $item->status_hr }}</td>
                  @endif

                  @if ($item->status_hr == 'Diterima')
                    @if ($item->status_pengurus == 'Diterima')
                      <td class="status_diterima">{{ $item->status_pengurus }}</td>
                    @elseif ($item->status_pengurus == 'Sedang di Proses')
                      <td class="status_process">{{ $item->status_pengurus }}</td>
                    @else
                      <td class="status_ditolak">{{ $item->status_pengurus }}</td>
                    @endif

                  @else
                    @if ($item->status_pengurus == 'Diterima')
                      <td class="status_diterima">{{ $item->status_pengurus }}</td>
                    @else
                      <td class="status_ditolak">Ditolak</td>
                    @endif

                  @endif

                  <td>
                    <div class="action-button btn-group text-center">
                      <button type="button" class="btn btn-info round dropdown-toggle" data-toggle="dropdown">
                        <i class="la la-gear"></i>
                      </button>
                      <div class="dropdown-menu" x-placement="bottom-start">
                        <button class="dropdown-item tombolInvoice" value="{{ $item->id }}">
                          <i class="fa fa-file-invoice-dollar"></i> Invoice
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

  <!-- Modal Invoice -->
  <div class="modal fade" id="Invoice">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-body">
          <div class="container">

            <div class="row" style="border-bottom: 2px solid grey;">
              <div class="col-sm-6">
                <img src="/images/palapa-text.png" alt="pic" width="150px" height="120px">
              </div>
              <div class="col-sm-6" style="text-align: right">
                <p style="font-weight:bold">Koperasi Palapa 85</p>
                <p>Jalan Belakang RSU III No. 11 A, Klojen</p>
                <p>Malang, Jawa Timur 65111</p>
                <p>Indonesia</p>
              </div>
            </div><br>

            <div class="row" style="border-bottom: 2px solid grey;">
              <div class="col-sm-6">
                <p>Bill To:</p>
                <p style="font-weight:bold;" id="invoice_nama_pembeli"></b>
                  <p id="invoice_alamat"></p>
                  <p>Indonesia</p>
                </div>
                <div class="col-sm-6" style="text-align: right">
                  <p>Invoice Number: <b id="id_invoice"></b> </p>
                  <p>Invoice Date: <b id="invoice_tanggal_awal"></b></p>
                  <p>Due Date: <b id="invoice_tanggal_akhir"></b></p>
                  <p>Amount Due: <b class="invoice_harga_barang"></b></p>
                </div>
              </div><br>

              <table style="border: 1px solid white !important" class="table table-hover d-md-table w-100 table-responsive">
                <tr>
                  <th>Nama Barang</th>
                  <th>Jenis Barang</th>
                  <th>Harga Barang</th>
                  <th>Terbilang</th>
                </tr>
                <tr style="background: rgba(220,220,220,0.5)">
                  <td id="invoice_nama_barang"></td>
                  <td id="invoice_jenis_barang"></td>
                  <td class="invoice_harga_barang"></td>
                  <td id="invoice_terbilang"></td>
                </tr>
              </table><br>

              <p>Total Harga:</p>
              <p style="font-weight:bold; font-size: 40px !important;" class="invoice_harga_barang">Rp</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- End Modal --}}

    {{-- Modal Detail User --}}
    <div class="modal-detail modal fade" id="detailAjuanPendanaan">
      <div class="modal-dialog modal-lg">
        <div class="modal-detail-content modal-content">

          <!-- Modal Header -->
          <div class="modal-detail-header modal-header">
            <h4 class="modal-title text-white">Detail Pengajuan Pembelian : <b id="detail_id_pembelian"></b> </h4>
            <button type="button" class="close text-black" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-detail-body modal-body">
            <i class="fa fa-info modal-detail-icon"></i><br><br>
            <p class="modal-detail-title">Data Pembeli/Pembelian :</p><br><br>

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

                    <div class="row">
                      <div class="col-md-5 col-3 ">
                        <p> <i class="fa fa-calendar"></i>  Waktu Pembayaran</p>
                      </div>
                      <div class="col-md-1 col-1">
                        <p>:</p>
                      </div>
                      <div class="col-md-5">
                        <p id="detail_tanggal_awal"></p>
                        <p>Sampai Dengan</p>
                        <p id="detail_tanggal_akhir"></p>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-5 col-3 ">
                        <p> <i class="fa fa-money-check-alt "></i>  Cara Pembayaran</p>
                      </div>
                      <div class="col-md-1 col-1">
                        <p>:</p>
                      </div>
                      <div class="col-md-5">
                        <p id="detail_cara_pembayaran"></p>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-5 col-3 ">
                        <p> <i class="fa fa-user-tie "></i>  Petugas Yang Menyetujui</p>
                      </div>
                      <div class="col-md-1 col-1">
                        <p>:</p>
                      </div>
                      <div class="col-md-5">
                        <p id="detail_pengurus"></p>
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

      $(".tombolDetailAjuanPendanaan").on("click", function(){
        var id = $(this).val();
        $.ajax({
          method: "POST",
          url : "{{ route('pengurus.marketplace.ajuanPendanaan.detail') }}",
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
          $("#detail_pengurus").text(response.pengurus.nama_lengkap);
          $("#detail_nama_barang").text(response.nama_barang);
          $("#detail_jenis_barang").text(response.jenis_barang);
          $("#detail_harga_barang").text(response.harga_barang);
          $("#detail_terbilang_barang").text(response.terbilang);
          $("#detail_tanggal_awal").text(response.tanggal_awal);
          $("#detail_tanggal_akhir").text(response.tanggal_akhir);
          $("#detail_cara_pembayaran").text(response.cara_pembayaran);
          $("#detailAjuanPendanaan").modal();
        });
      });

      $(".tombolInvoice").on("click", function(){
        var id = $(this).val();
        $.ajax({
          method: "POST",
          url : "{{ route('pengurus.marketplace.ajuanPendanaan.invoice') }}",
          data: {
            _token: token,
            id: id
          }
        }).done(function (response) {
          $("#id_Invoice").text(response.id);
          $("#invoice_tanggal_awal").text(response.tanggal_awal);
          $("#invoice_tanggal_akhir").text(response.tanggal_akhir);
          $("#invoice_nama_pembeli").text(response.user.nama_lengkap);
          $("#invoice_no_anggota").text(response.user.no_anggota);
          $("#invoice_alamat").text(response.user.alamat);
          $("#invoice_nama_barang").text(response.nama_barang);
          $("#invoice_jenis_barang").text(response.jenis_barang);
          $("#invoice_terbilang").text(response.terbilang);
          $(".invoice_harga_barang").text(response.harga_barang);
          $("#Invoice").modal();
        });
      });

      $(document).ready( function () {
        $('#Pendanaans2Table').DataTable();
      });

    </script>

  @endsection
