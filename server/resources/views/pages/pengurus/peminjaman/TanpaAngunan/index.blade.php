@extends('layouts.master-layout')

@section('title', 'Data Semua Peminjaman')

@section('style')

  <link rel="stylesheet" href="/css/mymodal.css">
  <link rel="stylesheet" href="/css/style.css">

@endsection

@section('content-header')

  <div class="content-header-left col-md-6  breadcrumb-new">
    <h3 class="content-header-title mb-0 d-inline-block text-capitalize">Peminjaman</h3>
    <div class="row breadcrumbs-top d-inline-block">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            Peminjaman
          </li>
          <li class="breadcrumb-item active">
            Pengajuan Peminjaman
          </li>
        </ol>
      </div>
    </div>
  </div>
@endsection

@section('content')

  <div class="card">
    <div class="card-header">
      <h4 class="card-title" id="basic-layout-form">TABEL PEMINJAMAN</h4>
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
          <table class="table table-hover d-md-table w-100 table-responsive" id="peminjamanTable">
            <thead>
              <tr>
                <th>Nomor Pinjaman</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Jenis Angunan</th>
                <th>Lihat Surat</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($peminjaman as $item)
            @if ($item->status == 'Menunggu Konfirmasi')
                <tr>
                  <td>{{ $item->no_pinjaman }}</td>
                  <td>{{ $item->user->nama_lengkap }}</td>
                  <td>{{ $item->status }}</td>
                  <td>{{ $item->jenis_angunan }}</td>
                  <td>
                        <button class="btn btn-outline-blue btn-block tombolLihatSuratKuasa" value="{{ $item->surat_kuasa }}">
                        <i class="la la-search"></i> <span>Lihat</span>
                        </button>
                  <td>
                    <div class="btn-group text-center">
                      <button type="button" class="btn btn-info round dropdown-toggle" data-toggle="dropdown">
                        <i class="la la-gear"></i>
                      </button>
                      <div class="dropdown-menu" x-placement="bottom-start">
                        <button class="dropdown-item tombolDetailPeminjaman" value="{{ $item->id }}">
                          <i class="ft-info"></i> Detail peminjaman
                        </button>
                        <button class="dropdown-item tombolEditNomor" value="{{ $item->id }}">
                          <i class="la la-edit"></i> Berikan Nomor Surat Peminjaman
                        </button>
                        <button class="dropdown-item tombolEditStatus" value="{{ $item->id }}">
                          <i class="la la-edit"></i> Edit Status
                        </button>
                        <button class="dropdown-item tombolHapusPeminjaman" value="{{ $item->id }}">
                          <i class="la la-trash"></i> Hapus
                        </button>
                      </div>
                    </div>
                  </td>
                </tr>
                @endif
            @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
<!-- Modal Detail -->
<div class="modal fade" id="detailPeminjaman">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header bg-info">
        <h4 class="text-white">Detail peminjaman</h4>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <div class="container">

        <div class="row">
            <div class="col-md-3 col-3">
              <p>Nama</p>
            </div>
            <div class="col-md-1 col-1">
              <p>:</p>
            </div>
            <div class="col-md-8">
              <p id="nama"></p>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3 col-3">
              <p>Alamat</p>
            </div>
            <div class="col-md-1 col-1">
              <p>:</p>
            </div>
            <div class="col-md-8">
              <p id="alamat"></p>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3 col-3">
              <p>No_Telp</p>
            </div>
            <div class="col-md-1 col-1">
              <p>:</p>
            </div>
            <div class="col-md-8">
              <p id="no_telp"></p>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3 col-3">
              <p>Jenis Angunan</p>
            </div>
            <div class="col-md-1 col-1">
              <p>:</p>
            </div>
            <div class="col-md-8">
              <p id="jenis_angunan"></p>
            </div>
          </div>

            <div class="row">
            <div class="col-md-3 col-3">
              <p>Jumlah Pinjaman</p>
            </div>
            <div class="col-md-1 col-1">
              <p>:</p>
            </div>
            <div class="col-md-8">
              <p id="jumlah"></p>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3 col-3">
              <p>No pinjaman</p>
            </div>
            <div class="col-md-1 col-1">
              <p>:</p>
            </div>
            <div class="col-md-8">
              <p id="no_pinjaman"></p>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3 col-3">
              <p>No BPKB / Sertifikat</p>
            </div>
            <div class="col-md-1 col-1">
              <p>:</p>
            </div>
            <div class="col-md-8">
              <p id="no_jaminan"></p>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3 col-3">
              <p>Terbilang</p>
            </div>
            <div class="col-md-1 col-1">
              <p>:</p>
            </div>
            <div class="col-md-8">
              <p id="terbilang"></p>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3 col-3">
              <p>Jangka Waktu</p>
            </div>
            <div class="col-md-1 col-1">
              <p>:</p>
            </div>
            <div class="col-md-8">
              <p id="jangka_waktu"></p>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3 col-3">
              <p>Periode Awal</p>
            </div>
            <div class="col-md-1 col-1">
              <p>:</p>
            </div>
            <div class="col-md-8">
              <p id="periode_awal"></p>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3 col-3">
              <p>Periode Akhir</p>
            </div>
            <div class="col-md-1 col-1">
              <p>:</p>
            </div>
            <div class="col-md-8">
              <p id="periode_akhir"></p>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3 col-3">
              <p>Cara Pembayaran</p>
            </div>
            <div class="col-md-1 col-1">
              <p>:</p>
            </div>
            <div class="col-md-8">
              <p id="cara_pembayaran"></p>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3 col-3">
              <p>Status</p>
            </div>
            <div class="col-md-1 col-1">
              <p>:</p>
            </div>
            <div class="col-md-8">
              <p id="status"></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Hapus -->
        <div class="modal fade" id="hapusPeminjaman">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <form action="{{Route('petugas.peminjaman.destroy')}}" method="POST">

                        @csrf
                        <!-- Modal Header -->
                        <div class="modal-header bg-cyan">
                            <h4 class="modal-title text-white">Apakah anda yakin ingin menghapus data ini ?</h4>
                            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="submit" name="id" id="deleteId" class="btn btn-cyan round">
                                <i class="la la-check"></i>
                            </button>
                            <button type="button" class="btn btn-cyan round" data-dismiss="modal">
                                <i class="la la-close"></i>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
         <!-- edit -->
      <div class="modal fade" id="editStatus">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ Route('petugas.peminjaman.updateStatus') }}" method="POST">

                        <!-- Modal Header -->
                        <div class="modal-header bg-cyan">
                            <h4 class="modal-title text-white">Edit Status</h4>
                            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="container">
                            @csrf
                                  <input type="hidden" name="id" id="editId">
                                  <div class="form-group">
                                    <label>STATUS</label>
                                    <select name="status" id="editStatus" class="form-control">
                                        <option value="ditolak">Ditolak</option>
                                        <option value="sudah dikonfirmasi">Sudah Dikonfirmasi</option>
                                    </select>
                                  </div>
                            </div>
                        </div>
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-cyan btn-glow">Update</button>
                                  </div>
                    </form>
                </div>
            </div>
        </div>
  <!-- edit nomor -->
  <div class="modal fade" id="editNomor">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ Route('petugas.peminjaman.updateNomor') }}" method="POST">

                        <!-- Modal Header -->
                        <div class="modal-header bg-cyan">
                            <h4 class="modal-title text-white">Beri Nomor Surat</h4>
                            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="container">
                            @csrf
                                  <input type="hidden" name="id" id="editnomorId">
                                  <div class="form-group">
                                     <input type="number" name="no_pinjaman" id="editNomor" required>
                                  </div>
                            </div>
                        </div>
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-cyan btn-glow">Update</button>
                                  </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- edit -->
  <div class="modal fade" id="editPeminjaman">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{('petugas.peminjaman.updatePeminjaman')}}" method="POST">

                        <!-- Modal Header -->
                        <div class="modal-header bg-cyan">
                            <h4 class="modal-title text-white">Edit Form</h4>
                            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="container">
                                  <input type="hidden" name="id" id="editId">
                                  <div class="form-group">
                                    <label>Jumlah Pinjaman</label>
                                    <input type="number" name="jumlah" id="editJumlah" class="form-control">
                                  </div>
                                  <div class="form-group">
                                    <label>Terbilang</label>
                                    <input type="text" name="terbilang" id="editTerbilang" class="form-control">
                                  </div>
                                  <div class="form-group">
                                    <label>Jangka Waktu</label>
                                    <input type="text" name="jangka_waktu" id="editJangka" class="form-control">
                                  </div>
                                  <div class="form-group">
                                    <label>Periode Awal Pembayaran</label>
                                    <input type="date" name="periode_awal" id="editAwal" class="form-control">
                                  </div>
                                  <div class="form-group">
                                    <label>Batas Akhir Pembayaran</label>
                                    <input type="date" name="periode_akhir" id="editAkhir" class="form-control">
                                  </div>
                                  <div class="form-group">
                                      <label>Cara Pembayaran : </label>
                                      <select class="form-control" name="cara_pembayaran" id="editCara" class="form-control">
                                        <option>Dipotongkan langsung dari gaji PIHAK PERTAMA melalui Bagian Personalia PT. PERTAMINA HULU MAHAKAM (“PHM”).</option>
                                        <option>Pembayaran secara manual transfer oleh PIHAK PERTAMA kepada PIHAK KEDUA ke rekening PIHAK KEDUA sebagai berikut :
                                        <p>Atas Nama   : <b>Koperasi Karyawan Total Palapa 85</b></p>
                                        <p>Bank             : </b> BNI 46</b></p>
                                        <p>No Rek         : <b>0082503587</b> </p>
                                        </option>
                                      </select>
                                  </div>
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-cyan btn-glow">Update</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    <!--endedit -->
<!-- Surat Kuasa -->
<div class="modal fade" id="lihatSuratKuasa">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header bg-blue">
                        <h4 class="text-white">Surat Kuasa HR</h4>
                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <img src="" name="surat_kuasa" id="lihatSurat" class="img-fluid" alt="Gambar tidak tersedia">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-blue round" data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
<!-- endSurat -->
{{-- End Modal --}}

@endsection



@section('script')
  <script type="text/javascript">

    var token = $("meta[name=\"_token\"]").attr("content");

    $("#tombolAjuanPeminjaman").on("click", function(){
      $("#createPeminjaman").modal();
    });

    $(".tombolDetailPeminjaman").on("click", function(){
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
        $("#no_jaminan").text(response.no_jaminan);
        $("#terbilang").text(response.terbilang);
        $("#jangka_waktu").text(response.jangka_waktu);
        $("#periode_awal").text(response.periode_awal);
        $("#periode_akhir").text(response.periode_akhir);
        $("#cara_pembayaran").text(response.cara_pembayaran);
        $("#status").text(response.status);
        $("#detailPeminjaman").modal();
      });
    });
    //suratkuasa
    var token = $("meta[name=\"_token\"]").attr("content");
        $(".tombolLihatSuratKuasa").on("click", function(){
            var surat_kuasa = $(this).val();
            $("#lihatSurat").attr("src", surat_kuasa);
            $("#lihatSuratKuasa").modal();
        });
        //edit peminjaman
    $(".tombolEditPeminjaman").on("click", function(){
            var id = $(this).val();
            $.ajax({
                method: "POST",
                url: "{{Route('petugas.peminjaman.editPeminjaman')}}",
                data: {
                    _token: token,
                    id: id,
                }
            }).done(function (response) {
                $("#editId").val(id);
                $("#editJumlah").val(response.jumlah);
                $("#editTerbilang").val(response.terbilang);
                $("#editJangka").val(response.jangka_waktu);
                $("#editAwal").val(response.periode_awal);
                $("#editAkhir").val(response.periode_akhir);
                $("#editCara").val(response.cara_pembayaran);
                $("#editPeminjaman").modal();
            });
        });
    //edit
    $(".tombolEditStatus").on("click", function(){
            var id = $(this).val();
            $.ajax({
                method: "POST",
                url: "{{Route('petugas.peminjaman.editStatus')}}",
                data: {
                    _token: token,
                    id: id,
                }
            }).done(function (response) {
                $("#editId").val(id);
                $("#editStatus").val(response.status);
                $("#editStatus").modal();
            });
        });
        //edit Nomor
        $(".tombolEditNomor").on("click", function(){
            var id = $(this).val();
            $.ajax({
                method: "POST",
                url: "{{Route('petugas.peminjaman.editNomor')}}",
                data: {
                    _token: token,
                    id: id,
                }
            }).done(function (response) {
                $("#editnomorId").val(id);
                $("#editNomor").val(response.no_pinjaman);
                $("#editNomor").modal();
            });
        });
        //hapus
        $(".tombolHapusPeminjaman").on("click", function(){
            var id = $(this).val();
            $("#deleteId").val(id);
            $("#hapusPeminjaman").modal();
        });

    $(document).ready( function () {
      $('#PeminjamanTable').DataTable();
    });
  </script>

@endsection
