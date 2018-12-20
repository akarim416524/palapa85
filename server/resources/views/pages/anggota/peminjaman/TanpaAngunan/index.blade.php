@extends('layouts.master-layout')

@section('title', 'Pinjaman Tanpa Angunan')

@section('style')

  <link rel="stylesheet" href="/css/mymodal.css">
  <link rel="stylesheet" href="/css/style.css">

@endsection

@section('content-header')

  <div class="content-header-left col-md-6  breadcrumb-new">
    <h3 class="content-header-title mb-0 d-inline-block text-capitalize">Tanpa Angunan</h3>
    <div class="row breadcrumbs-top d-inline-block">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            Peminjaman
          </li>
          <li class="breadcrumb-item active">
            Tanpa Angunan
          </li>
        </ol>
      </div>
    </div>
  </div>

  <div class="content-header-right col-md-6 breadcrumb-new text-right">
    <button type="button" name="button" class="btn btn-info round btn-glow" id="tombolAjuanPeminjaman">
      <i class="fa fa-cart-plus"></i> Ajukan Peminjaman
    </button>
    
    <a href="{{ asset('/storage/surat/surat.docx') }}" download>
      <button type="button" name="button" class="btn btn-info round btn-glow"><i class="fa fa-file-signature"></i> Unduh Surat Persetujuan HR</button>
    </a>
  </div>

@endsection

@section('content')
  <div class="card">
    <div class="card-header">
      <h4 class="card-title" id="basic-layout-form">TABEL RIWAYAT PEMINJAMAN</h4>
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
                <th>NO</th>
                <th>Nama Anggota</th>
                <th>Nomor Pinjaman</th>
                <th>Nominal</th>
                <th>Status</th>
                <th>Surat Pernyataan/Kuasa</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1; ?>
              @foreach ($peminjaman as $item)
                @if ($item->status == 'Menunggu Konfirmasi')
                  <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $item->user->nama_lengkap }}</td>
                    <td>{{ $item->no_pinjaman }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                      <div class="btn-group ">
                        @if ($item->status == 'Menunggu Konfirmasi')
                          <button type="button" name="button" class="btn btn-info round btn-glow" id="tombolUploadSurat" value="{{ $item->id }}" >
                            <i class="fa fa-file-signature"></i> Upload Surat HR
                          </button>
                        @else
                          <button class="dropdown-item" disabled>
                            <i class="fa fa-file-signature"></i> Upload Surat HR
                          </button>
                        @endif
                      </td>
                      <td>
                        <div class="btn-group text-center">
                          <button type="button" class="btn btn-info round dropdown-toggle" data-toggle="dropdown">
                            <i class="la la-gear"></i>
                          </button>
                          <div class="dropdown-menu" x-placement="bottom-start">
                            <button class="dropdown-item tombolDetailPeminjaman" value="{{ $item->id }}">
                              <i class="ft-info"></i> Detail peminjaman
                            </button>
                          </div>
                        </td>
                      </tr>
                    @endif
                    <?php $no++; ?>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      {{-- Modal Tambah Peminjaman --}}
      <div id="createPeminjaman" class="modal fade">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{Route ('pages.anggota.peminjaman.TanpaAngunan.store')}}" method="POST">

              <!-- Modal Header -->
              <div class="modal-header bg-info">
                <h4 class="modal-title text-white">Formulir Pengajuan</h4>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <div class="container">
                  @csrf
                  <p style="text-align:center; font-weight: bold;">Saya, {{ Auth::user()->nama_lengkap }}</p>
                  <div class="form-group">
                    <label class="label label-default">Nama Lengkap</label>
                    <input type="text" value= "{{ Auth::user()->nama_lengkap }}" class="form-control" name="nama_lengkap" readonly required>
                  </div>

                  <div class="form-group">
                    <label class="label label-default">ID anda</label>
                    <input type="text" value= "{{ Auth::user()->id }}" class="form-control" name="user_id" readonly required>
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
                    <label class="label label-default">No Pegawai</label>
                    <input type="text" value= "{{ Auth::user()->no_pegawai }}" class="form-control" name="no_anggota" readonly required>
                  </div>

                  <div class="form-group">
                    <label class="label label-default">No Telp</label>
                    <input type="text" value= "{{ Auth::user()->no_telp }}" class="form-control" readonly readonly name="no_telp">
                  </div>

                  <div class="form-group">
                    <label class="label label-default">Email</label>
                    <input type="email" value= "{{ Auth::user()->email }}" class="form-control" readonly name="email" required>
                  </div>

                  <div class="form-group">
                    <label class="label label-default">Alamat</label>
                    <input type="text" value= "{{ Auth::user()->alamat }}" class="form-control" readonly name="alamat">
                  </div><br>

                  <p style="text-align:center; font-weight: bold;">
                    Dengan ini mengajukan permohonan peminjaman (“PERMOHONAN”) kepada Koperasi Ketua “PALAPA ‘85” Balikpapan (“KOPERASI PALAPA ‘85”), dengan rincian sebagai berikut:
                  </p><br>

                  <div class="form-group">
                    <label class="label label-default">Jumlah uang yang dipinjam		:</label>
                    <input type="number" class="form-control" name="jumlah" placeholder="Rp.">
                  </div>

                  <div class="form-group">
                    <label class="label label-default">Terbilang</label>
                    <input type="text" class="form-control" name="terbilang" required>
                  </div>

                  <div class="form-group">
                    <label class="label label-default">Jangka waktu pembayaran		: </label>
                    <input type="number" class="form-control" name="jangka_waktu" placeholder="bulan" required>
                  </div>

                  <div class="form-group">
                    <label class="label label-default">Periode Awal Pembayaran  :</label>
                    <input type="date" class="form-control" name="periode_awal" required>
                    Sampai Dengan
                    <input type="date" class="form-control" name="periode_akhir" required>
                  </div>

                  <div class="form-group">
                    <label class="label label-default">Cara Pembayaran</label>
                    <textarea class="form-control" name="cara_pembayaran" rows="3" readonly>Dipotongkan langsung dari gaji PIHAK PERTAMA melalui Bagian Personalia PT. PERTAMINA HULU MAHAKAM (“PHM”). </textarea>
                  </div>

                  <div class="form-group">
                    <label class="label label-default">Pembayaran Tagihan Pertama</label>
                    <input type="number" class="form-control" name="bayar_awal" required>
                  </div>

                  <p style="text-align:center; font-weight: bold;">Saya bersedia untuk mematuhi semua ketentuan-ketentuan dan syarat-syarat PEMINJAMAN yang berlaku di KOPERASI PALAPA ’85.
                    Besar harapan saya agar dapat disetujuinya PERMOHONAN ini. Atas perhatiannya saya ucapkan terima kasih.
                  </p>

                </div>
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="submit" class="btn btn-info round">Submit</button>
              </div>

            </form>
          </div>
        </div>
      </div>
      {{-- End Modal --}}
      <!-- modal Upload -->
      <div id="UploadSurat" class="modal fade">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ Route ('anggota.peminjaman.uploadPeminjaman') }}" method="POST" enctype="multipart/form-data">

              <!-- Modal Header -->
              <div class="modal-header bg-info">
                <h4 class="modal-title text-white">Surat HR</h4>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <div class="container">
                  @csrf
                  <p style="text-align:center; font-weight: bold;">Saya, {{ Auth::user()->nama_lengkap }}</p>
                  <input type="hidden" name="id" id="editId">
                  <label>Surat Kuasa HR</label>
                  <br>
                  <input type="file" name="surat_kuasa" class="form-control" required>

                  <div class="modal-footer">
                    <button type="submit" class="btn btn-info round">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end upload -->

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
                  <p>Tanggal Pengajuan</p>
                </div>
                <div class="col-md-1 col-1">
                  <p>:</p>
                </div>
                <div class="col-md-8">
                  <p id="pengajuan"></p>
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

              <div class="row">
                <div class="col-md-3 col-3">
                  <p>Surat Kuasa</p>
                </div>
                <div class="col-md-1 col-1">
                  <p>:</p>
                </div>
                <div class="col-md-8">
                  <img src="" id="surat" class="img-fluid" style="height:100px;">
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
      <!-- detail -->
      {{-- End Modal --}}

    @endsection

    @section('script')
      <script type="text/javascript">

        var token = $("meta[name=\"_token\"]").attr("content");

        $("#tombolAjuanPeminjaman").on("click", function(){
          $("#createPeminjaman").modal();
        });

        $("#tombolUploadSurat").on("click", function(){
          var id = $(this).val();
          $.ajax({
            method: "POST",
            url: "{{ Route('anggota.peminjaman.regPeminjaman') }}",
            data: {
              _token: token,
              id: id,
            }
          }).done(function (response) {
            $("#editId").val(response.id);
            $("#UploadSurat").modal();
          });
        });

        $(".tombolDetailPeminjaman").on("click", function(){
          var id = $(this).val();
          $.ajax({
            method: "POST",
            url : "{{ route('anggota.peminjaman.detailPeminjaman') }}",
            data: {
              _token: token,
              id: id
            }
          }).done(function (response) {
            console.log(response);
            $("#nama").text(response.user.nama_lengkap);
            $("#alamat").text(response.user.alamat);
            $("#no_telp").text(response.user.no_telp);
            $("#jenis_angunan").text(response.jenis_angunan);
            $("#jumlah").text(response.jumlah);
            $("#pengajuan").text(response.created_at);
            $("#no_pinjaman").text(response.no_pinjaman);
            $("#terbilang").text(response.terbilang);
            $("#jangka_waktu").text(response.jangka_waktu);
            $("#periode_awal").text(response.periode_awal);
            $("#periode_akhir").text(response.periode_akhir);
            $("#cara_pembayaran").text(response.cara_pembayaran);
            $("#status").text(response.status);
            $("#surat").attr('src', response.surat_kuasa);
            $("#detailPeminjaman").modal();
          });
        });
        //edit

        $(document).ready( function () {
          $('#PeminjamanTable').DataTable();
        });
      </script>

    @endsection
