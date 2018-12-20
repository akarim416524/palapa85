@extends('layouts.master-layout')

@section('title', 'Palapa 85 - Barang')

@section('style')

  <link rel="stylesheet" href="/css/mymodal.css">

  <link rel="stylesheet" href="/css/style.css">

@endsection

@section('content-header')

  <div class="content-header-left col-md-6  breadcrumb-new">
    <h3 class="content-header-title mb-0 d-inline-block text-capitalize">Barang</h3>
    <div class="row breadcrumbs-top d-inline-block">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            Marketplace
          </li>
          <li class="breadcrumb-item">
            Toko
          </li>
          <li class="breadcrumb-item active">
            Barang
          </li>
        </ol>
      </div>
    </div>
  </div>

  <div class="content-header-right col-md-6 breadcrumb-new text-right">
    <button type="button" name="button" class="btn btn-success round btn-glow" id="tombolAjuanPendanaan"><i class="fa fa-cart-plus"></i> Ajukan Permintaan</button>
  </div>

@endsection

@section('content')
  <div class="card">
    <div class="card-header">
      <h4 class="card-title" id="basic-layout-form">Barang/Jasa yang tersedia</h4>
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
          <table class="table table-hover w-100 table-responsive" id="BarangTable">
            <thead>
              <tr>
                <th><i class="fa fa-id-card"></i> ID Barang</th>
                <th><i class="fa fa-image"></i> Gambar Barang</th>
                <th><i class="fa fa-shopping-bag"></i> Nama Barang</th>
                <th><i class="fa fa-dollar-sign"></i> Harga Barang</th>
                <th><i class="fa fa-clipboard-check"></i> Status Barang</th>
                <th><i class="fa fa-cog"></i> Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($barang as $item)
                <tr>
                  <td>{{ $item->id }}</td>
                  <td><img src="{{ $item->gambar_barang ?? '/images/blank-item.jpg'}}" alt="pic" width="150px" height="120px"></td>
                  <td>{{ $item->nama_barang }}</td>
                  <td>Rp{{ number_format($item->harga_barang, 2, ',', '.') }}</td>
                  @if ($item->status_barang == 'tersedia')
                    <td class="status_barang_tersedia">{{ $item->status_barang }}</td>
                  @else
                    <td class="status_barang_habis">{{ $item->status_barang }}</td>
                  @endif
                  <td>
                    <div class="action-button btn-group text-center">
                      <button type="button" class="btn btn-info round dropdown-toggle" data-toggle="dropdown">
                        <i class="la la-gear"></i>
                      </button>
                      <div class="dropdown-menu" x-placement="bottom-start">
                        <button class="dropdown-item tombolDetailBarang" value="{{ $item->id }}">
                          <i class="ft-info"></i> Detail Barang
                        </button>
                        @if ($item->status_barang == 'tersedia')
                          <button class="dropdown-item tombolAjuanPendanaanOtomatis" value="{{ $item->id }}">
                            <i class="fa fa-cart-plus"></i> Beli Barang
                          </button>
                        @else
                          <button class="dropdown-item tombolAjuanPendanaanOtomatis" disabled>
                            <i class="fa fa-cart-plus"></i> Beli Barang
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

  {{-- Modal Ajuan Pendanaan --}}
  <div id="createPendanaan" class="modal-create modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="{{ route('anggota.marketplace.barang.store') }}" method="POST">

          <!-- Modal Header -->
          <div class="modal-create-header modal-header bg-info">
            <h4 class="modal-title text-white"> <i class="fa fa-cart-plus"></i> Ajukan Pendanaan</h4>
            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-create-body modal-body">
            <div class="container">
              @csrf
              <input type="hidden" name="anggota_id" value="{{ Auth::user()->id }}">

              <div class="form-group">
                <label class="label label-default">Nama</label>
                <input type="text" value= "{{ Auth::user()->nama_lengkap }}" class="form-control" name="nama_lengkap" readonly required>
              </div>

              <div class="form-group">
                <label class="label label-default">Tanggal Lahir</label>
                <input type="date" value= "{{ Auth::user()->tanggal_lahir }}" class="form-control" name="tanggal_lahir" readonly required>
              </div>

              <div class="form-group">
                <label class="label label-default">No Anggota</label>
                <input type="text" value= "{{ Auth::user()->no_anggota }}" class="form-control" name="no_anggota" readonly required>
              </div>

              <div class="form-group">
                <label class="label label-default">No Telp</label>
                <input type="text" value= "{{ Auth::user()->no_telp }}" class="form-control" readonly name="no_telp" required>
              </div>

              <div class="form-group">
                <label class="label label-default">Email</label>
                <input type="email" value= "{{ Auth::user()->email }}" class="form-control" readonly name="email" required>
              </div>

              <div class="form-group">
                <label class="label label-default">Alamat</label>
                <input type="text" value= "{{ Auth::user()->alamat }}" class="form-control" readonly name="alamat" required>
              </div><br>

              <p style="text-align:center; font-weight: bold;">(Untuk selanjutnya disebut sebagai “PEMOHON”)
                Dengan ini mengajukan permohonan Pendanaan barang/jasa (“PERMOHONAN”) kepada Koperasi Karyawan “PALAPA ‘85” Balikpapan (“KOPERASI PALAPA ‘85”), dengan rincian sebagai berikut:
              </p><br>

              <input type="hidden" name="rekanan_id" value="{{ $id_toko }}">

              <div class="form-group">
                <label class="label label-default">Nama Barang</label>
                <input type="text" class="form-control" name="nama_barang" required>
              </div>

              <div class="form-group">
                <label class="label label-default">Jenis Barang</label>
                <input type="text" class="form-control" name="jenis_barang" required>
              </div>

              <div class="form-group">
                <label class="label label-default">Harga Barang</label>
                <input type="number" class="form-control" name="harga_barang" required>
              </div>

              <div class="form-group">
                <label class="label label-default">Terbilang</label>
                <input type="text" class="form-control" name="terbilang" required>
              </div>

              <div class="form-group">
                <label class="label label-default">Jangka Waktu Pembayaran</label>
                <input type="date" class="form-control" name="tanggal_awal" required>
                Sampai Dengan
                <input type="date" class="form-control" name="tanggal_akhir" required>
              </div>

              <div class="form-group">
                <label class="label label-default">Cara Pembayaran</label>
                <input type="text" value="Dibayar lewat potongan payroll PT. PHM." class="form-control" name="cara_pembayaran" readonly>
              </div>

              <p style="text-align:center; font-weight: bold;">Saya bersedia untuk mematuhi semua ketentuan-ketentuan dan syarat-syarat JUAL BELI yang berlaku di KOPERASI PALAPA ’85.
                Besar harapan saya agar dapat disetujuinya PERMOHONAN ini. Atas perhatiannya saya ucapkan terima kasih.
              </p>

            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-create-footer modal-footer">
            <button type="submit" class="btn btn-info round">Ajukan <i class="fa fa-cart-plus"></i> </button>
          </div>

        </form>
      </div>
    </div>
  </div>
  {{-- End Modal --}}

  {{-- Modal Ajuan Pendanaan Otomatis --}}
  <div id="createPendanaanOtomatis" class="modal-create modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="{{ route('anggota.marketplace.barang.store') }}" method="POST">

          <!-- Modal Header -->
          <div class="modal-create-header modal-header bg-info">
            <h4 class="modal-title text-white"> <i class="fa fa-cart-plus"></i> Ajukan Pendanaan</h4>
            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-create-body modal-body">
            <div class="container">
              @csrf
              <input type="hidden" name="anggota_id" value="{{ Auth::user()->id }}">

              <div class="form-group">
                <label class="label label-default">Nama</label>
                <input type="text" value= "{{ Auth::user()->nama_lengkap }}" class="form-control" name="nama_lengkap" readonly required>
              </div>

              <div class="form-group">
                <label class="label label-default">Tanggal Lahir</label>
                <input type="date" value= "{{ Auth::user()->tanggal_lahir }}" class="form-control" name="tanggal_lahir" readonly required>
              </div>

              <div class="form-group">
                <label class="label label-default">No Anggota</label>
                <input type="text" value= "{{ Auth::user()->no_anggota }}" class="form-control" name="no_anggota" readonly required>
              </div>

              <div class="form-group">
                <label class="label label-default">No Telp</label>
                <input type="text" value= "{{ Auth::user()->no_telp }}" class="form-control" readonly name="no_telp" required>
              </div>

              <div class="form-group">
                <label class="label label-default">Email</label>
                <input type="email" value= "{{ Auth::user()->email }}" class="form-control" readonly name="email" required>
              </div>

              <div class="form-group">
                <label class="label label-default">Alamat</label>
                <input type="text" value= "{{ Auth::user()->alamat }}" class="form-control" readonly name="alamat" required>
              </div><br>

              <p style="text-align:center; font-weight: bold;">(Untuk selanjutnya disebut sebagai “PEMOHON”)
                Dengan ini mengajukan permohonan Pendanaan barang/jasa (“PERMOHONAN”) kepada Koperasi Karyawan “PALAPA ‘85” Balikpapan (“KOPERASI PALAPA ‘85”), dengan rincian sebagai berikut:
              </p><br>

              <input type="hidden" name="rekanan_id" value="{{ $id_toko }}">

              <div class="form-group">
                <label class="label label-default">Nama Barang</label>
                <input type="text" class="form-control" id="form_nama" name="nama_barang" value="" readonly required>
              </div>

              <div class="form-group">
                <label class="label label-default">Jenis Barang</label>
                <input type="text" class="form-control" id="form_jenis" name="jenis_barang" value="" readonly required>
              </div>

              <div class="form-group">
                <label class="label label-default">Harga Barang</label>
                <input type="number" class="form-control" id="form_harga" name="harga_barang" value="" readonly required>
              </div>

              <div class="form-group">
                <label class="label label-default">Terbilang</label>
                <input type="text" class="form-control" name="terbilang" required>
              </div>

              <div class="form-group">
                <label class="label label-default">Jangka Waktu Pembayaran</label>
                <input type="date" class="form-control" name="tanggal_awal" required>
                Sampai Dengan
                <input type="date" class="form-control" name="tanggal_akhir" required>
              </div>

              <div class="form-group">
                <label class="label label-default">Cara Pembayaran</label>
                <input type="text" value="Dibayar lewat potongan payroll PT. PHM." class="form-control" name="cara_pembayaran" readonly>
              </div>

              <p style="text-align:center; font-weight: bold;">Saya bersedia untuk mematuhi semua ketentuan-ketentuan dan syarat-syarat JUAL BELI yang berlaku di KOPERASI PALAPA ’85.
                Besar harapan saya agar dapat disetujuinya PERMOHONAN ini. Atas perhatiannya saya ucapkan terima kasih.
              </p>

            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-create-footer modal-footer">
            <button type="submit" class="btn btn-info round">Ajukan <i class="fa fa-cart-plus"></i> </button>
          </div>

        </form>
      </div>
    </div>
  </div>
  {{-- End Modal --}}

  {{-- Modal Detail Barang --}}
  <div class="modal-detail modal fade" id="detailBarang">
    <div class="modal-dialog modal-lg">
      <div class="modal-detail-content modal-content">

        <!-- Modal Header -->
        <div class="modal-detail-header modal-header">
          <h4 class="modal-title text-white">Detail Barang : <b id="detail_id_barang"></b> </h4>
          <button type="button" class="close text-black" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-detail-body modal-body">
          <i class="fa fa-info modal-detail-icon"></i><br><br>
          <p class="modal-detail-title">Data Barang Rekanan :</p><br><br>

          <div class="container">
            <div class="row">

              <div class="col-md-6">
                <img id="detail_foto_barang" src="" alt="barangpic" class="detail-barang-pic">
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
                      <p> <i class="fa fa-info"></i> Detail Barang</p>
                    </div>
                    <div class="col-md-1 col-1">
                      <p>:</p>
                    </div>
                    <div class="col-md-5">
                      <p id="detail_detail_barang"></p>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5 col-3 ">
                      <p> <i class="fa fa-shopping-basket"></i> Status Barang</p>
                    </div>
                    <div class="col-md-1 col-1">
                      <p>:</p>
                    </div>
                    <div class="col-md-5">
                      <p id="detail_status_barang"></p>
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

    $(".tombolAjuanPendanaanOtomatis").on("click", function(){
      var id = $(this).val();
      $.ajax({
        method: "POST",
        url: "{{ route('anggota.marketplace.barang.form') }}",
        data: {
          _token: token,
          id: id,
        }
      }).done(function(response){
        $("#form_nama").val(response.nama_barang);
        $("#form_jenis").val(response.jenis_barang);
        $("#form_harga").val(response.harga_barang);
        $("#createPendanaanOtomatis").modal();
      });
    });


    $(".tombolDetailBarang").on("click", function(){
      var id = $(this).val();
      $.ajax({
        method: "POST",
        url : "{{ route('anggota.marketplace.barang.detail') }}",
        data: {
          _token: token,
          id: id
        }
      }).done(function (response) {
        $("#detail_id_barang").text(response.id);
        $("#detail_foto_barang").attr("src", response.gambar_barang);
        $("#detail_nama_barang").text(response.nama_barang);
        $("#detail_jenis_barang").text(response.jenis_barang);
        $("#detail_harga_barang").text(response.harga_barang);
        $("#detail_detail_barang").text(response.detail_barang);
        $("#detail_status_barang").text(response.status_barang);
        $("#detailBarang").modal();
      });
    });

    $(document).ready( function () {
      $('#BarangTable').DataTable();
    });
  </script>

@endsection
