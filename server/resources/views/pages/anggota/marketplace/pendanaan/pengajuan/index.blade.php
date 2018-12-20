@extends('layouts.master-layout')

@section('title', 'Palapa 85 - Pengajuan Pendanaan')

@section('style')

  <link rel="stylesheet" href="/css/mymodal.css">
  <link rel="stylesheet" href="/css/style.css">

@endsection

@section('content-header')

  <div class="content-header-left col-md-6  breadcrumb-new">
    <h3 class="content-header-title mb-0 d-inline-block text-capitalize">Pendanaan</h3>
    <div class="row breadcrumbs-top d-inline-block">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            Marketplace
          </li>
          <li class="breadcrumb-item active">
            Pengajuan Pendanaan
          </li>
        </ol>
      </div>
    </div>
  </div>

  <div class="content-header-right col-md-6 breadcrumb-new text-right">
    <a href="{{ asset('/storage/surat/surat.docx') }}" download>
      <button type="button" name="button" class="btn btn-info round btn-glow"><i class="fa fa-file-signature"></i> Unduh Surat Persetujuan HR</button>
    </a>
  </div>

@endsection

@section('content')

  <div class="card">
    <div class="card-header">
      <h4 class="card-title" id="basic-layout-form">Tabel Pengajuan Pendanaan</h4>
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
                <th><i class="fa fa-id-card"></i> ID Pendanaan</th>
                <th><i class="fa fa-shopping-bag"></i> Nama Barang</th>
                <th><i class="fa fa-dollar-sign"></i> Harga Barang</th>
                <th><i class="fa fa-calendar"></i> Tanggal Pengajuan</th>
                <th><i class="fa fa-clipboard-check"></i> Status Toko</th>
                <th><i class="fa fa-clipboard-check"></i> Status Persetujuan HR</th>
                <th><i class="fa fa-clipboard-check"></i> Status Pengurus</th>
                <th><i class="fa fa-cog"></i> Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($Pendanaans as $item)
                <tr>
                  <td>{{ $item->id }}</td>
                  <td>{{ $item->nama_barang }}</td>
                  <td>Rp{{ number_format($item->harga_barang, 2, ',', '.') }}</td>
                  <td>{{ strftime('%d %B %Y', strtotime($item->created_at)) }}</td>

                  @if ($item->status_rekanan == 'Menunggu Konfirmasi')
                    <td class="status_process">{{ $item->status_rekanan }}</td>
                  @elseif ($item->status_rekanan == 'Diterima')
                    <td class="status_diterima">{{ $item->status_rekanan }}</td>
                  @elseif ($item->status_rekanan == 'Ditolak')
                    <td class="status_ditolak">{{ $item->status_rekanan }}</td>
                  @endif

                  @if ($item->status_hr == 'Menunggu Persetujuan HR')
                    <td class="status_process">{{ $item->status_hr }}</td>
                  @elseif ($item->status_hr == 'Diterima')
                    <td class="status_diterima">{{ $item->status_hr }}</td>
                  @elseif ($item->status_hr == 'Ditolak')
                    <td class="status_ditolak">{{ $item->status_hr }}</td>
                  @endif

                  @if ($item->status_pengurus == 'Sedang di Proses')
                    <td class="status_process">{{ $item->status_pengurus }}</td>
                  @elseif ($item->status_pengurus == 'Diterima')
                    <td class="status_diterima">{{ $item->status_pengurus }}</td>
                  @elseif ($item->status_pengurus == 'Ditolak')
                    <td class="status_ditolak">{{ $item->status_pengurus }}</td>
                  @endif

                  <td>
                    <div class="action-button btn-group text-center">
                      <button type="button" class="btn btn-info round dropdown-toggle" data-toggle="dropdown">
                        <i class="la la-gear"></i>
                      </button>
                      <div class="dropdown-menu" x-placement="bottom-start">
                        <button class="dropdown-item tombolDetailAjuanPendanaan" value="{{ $item->id }}">
                          <i class="ft-info"></i> Detail
                        </button>

                          @if ($item->status_hr == 'Menunggu Persetujuan HR')
                            <button class="dropdown-item tombolUploadBuktihr" value="{{ $item->id }}">
                              <i class="fa fa-file-signature"></i> Upload Bukti HR
                            </button>
                          @else
                            <button class="dropdown-item" disabled>
                              <i class="fa fa-file-signature"></i> Upload Bukti HR
                            </button>
                          @endif

                          @if ($item->status_hr == 'Menunggu Persetujuan HR')
                            <button class="dropdown-item tombolBatal" value="{{ $item->id }}">
                              <i class="fa fa-ban"></i> Batal
                            </button>
                          @else
                            <button class="dropdown-item" disabled>
                              <i class="la la-trash"></i> Hapus
                            </button>
                          @endif

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

{{-- Modal Detail User --}}
<div class="modal-detail modal fade" id="detailAjuanPendanaan">
  <div class="modal-dialog modal-lg">
    <div class="modal-detail-content modal-content">

      <!-- Modal Header -->
      <div class="modal-detail-header modal-header">
        <h4 class="modal-title text-white">Detail Pengajuan Pendanaan : <b id="detail_id_pembelian"></b> </h4>
        <button type="button" class="close text-black" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-detail-body modal-body">
        <i class="fa fa-info modal-detail-icon"></i><br><br>
        <p class="modal-detail-title">Data Pendanaan :</p><br><br>

        <div class="container">
          <div class="row">

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

              </div>
            </div>

            <div class="col-md-6">
              <div class="container modal-detail-data">

                <div class="row">
                  <div class="col-md-5 col-3 ">
                    <p> <i class="fa fa-calendar"></i> Tanggal Pengajuan</p>
                  </div>
                  <div class="col-md-1 col-1">
                    <p>:</p>
                  </div>
                  <div class="col-md-5">
                    <p id="detail_tanggal_pengajuan"></p>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-5 col-3 ">
                    <p> <i class="fa fa-clipboard-check"></i> Status Toko</p>
                  </div>
                  <div class="col-md-1 col-1">
                    <p>:</p>
                  </div>
                  <div class="col-md-5">
                    <p id="detail_status_toko"></p>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-5 col-3 ">
                    <p> <i class="fa fa-info"></i> Keterangan Toko</p>
                  </div>
                  <div class="col-md-1 col-1">
                    <p>:</p>
                  </div>
                  <div class="col-md-5">
                    <p id="detail_catatan_toko"></p>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-5 col-3 ">
                    <p> <i class="fa fa-clipboard-check"></i> Status  Persetujuan HR</p>
                  </div>
                  <div class="col-md-1 col-1">
                    <p>:</p>
                  </div>
                  <div class="col-md-5">
                    <p id="detail_status_hr"></p>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-5 col-3 ">
                    <p> <i class="fa fa-clipboard-check"></i> Status Pengurus Koperasi</p>
                  </div>
                  <div class="col-md-1 col-1">
                    <p>:</p>
                  </div>
                  <div class="col-md-5">
                    <p id="detail_status_pengurus"></p>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-5 col-3 ">
                    <p> <i class="fa fa-info"></i> Keterangan Pengurus Koperasi</p>
                  </div>
                  <div class="col-md-1 col-1">
                    <p>:</p>
                  </div>
                  <div class="col-md-5">
                    <p id="detail_catatan_pengurus"></p>
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

{{-- Modal Upload Bukti HR --}}

<div id="modalUploadBuktihr" class="modal fade">
  <div class="modal-create modal-dialog modal-lg">
    <div class="modal-content">
      <form action="{{ route('anggota.marketplace.pengajuanpendanaan.buktihr.upload') }}" method="POST" enctype="multipart/form-data">

        <!-- Modal Header -->
        <div class="modal-create-header modal-header bg-info">
          <h4 class="modal-title text-white"><i class="fa fa-file-signature"></i> Bukti HR</h4>
          <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="container">
            @csrf
            <input type="hidden" id="id_buktihr" name="id">

            {{-- <img src="" id="gambar_buktihr" alt="pics" class="img-fluid"> --}}

            <div class="form-group">
              <label>Bukti HR</label>
              <br>
              <input type="file" name="bukti_hr" class="form-control">
            </div>

            <div class="form-group">
              <li>Data yang Diupload harus dalam format jpg,png,jpeg</li>
              <li>Data Tidak Lebih dari 300kb </li>
            </div>

          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-create-footer modal-footer">
          <button type="submit" class="btn btn-info round">Upload <i class="fa fa-upload"></i> </button>
        </div>

      </form>
    </div>
  </div>
</div>
{{-- End Modal --}}

{{-- Modal Pembatalan Pendanaan --}}
<div class="modal-delete modal fade" id="delete">
  <div class="modal-dialog modal-sm">
    <div class="modal-delete-content modal-content">
      <form action="{{ route('anggota.marketplace.pengajuanpendanaan.destroy') }}" method="POST">
        @csrf
        <!-- Modal Header -->
        <div class="modal-delete-header modal-header">
          <h4 class="modal-title text-white">Peringatan !!!</h4>
          <button type="button" class="close text-black" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-delete-body modal-body">
          <div class="container">
            <i class="fa fa-ban modal-delete-icon"></i><br><br>
            <p class="modal-delete-title">Pembatalan Pengajuan</p>
            <p>Apakah anda yakin ingin membatalkan pengajuan ini?</p>
            <p>Anda hanya dapat membatalkan pengajuan yang masih menunggu persetujuan dari HR</p>
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

    $(".tombolDetailAjuanPendanaan").on("click", function(){
      var id = $(this).val();
      $.ajax({
        method: "POST",
        url : "{{ route('anggota.marketplace.pengajuanpendanaan.detail') }}",
        data: {
          _token: token,
          id: id
        }
      }).done(function (response) {
        $("#id_Pendanaan").text(response.id);
        $("#detail_tanggal_pengajuan").text(response.created_at);
        $("#detail_status_toko").text(response.status_rekanan);
        $("#detail_catatan_toko").text(response.catatan_rekanan);
        $("#detail_status_hr").text(response.status_hr);
        $("#detail_status_pengurus").text(response.status_pengurus);
        $("#detail_catatan_pengurus").text(response.catatan_pengurus);
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

    $(".tombolUploadBuktihr").on("click", function(){
      var id = $(this).val();
      $.ajax({
        method: "POST",
        url: "{{ route('anggota.marketplace.pengajuanpendanaan.buktihr') }}",
        data: {
          _token: token,
          id: id,
        }
      }).done(function(response){
        $("#id_buktihr").val(response.id);
        // $("#gambar_buktihr").attr("src", bukti_hr);
        $("#modalUploadBuktihr").modal();
      });
    });

    $(".tombolBatal").on("click", function(){
      var id = $(this).val();
      $("#deleteId").val(id);
      $("#delete").modal();
    });

  </script>

@endsection
