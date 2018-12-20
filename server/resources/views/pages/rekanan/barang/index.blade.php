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
            Rekanan
          </li>
          <li class="breadcrumb-item active">
            Barang
          </li>
        </ol>
      </div>
    </div>
  </div>

  <div class="content-header-right col-md-6 breadcrumb-new text-right">
    <button type="button" name="button" class="btn btn-success round btn-glow" id="tombolTambahBarang"><i class="fa fa-shopping-bag"></i> Tambah Barang</button>
  </div>

@endsection

@section('content')

  <div class="card">
    <div class="card-header">
      <h4 class="card-title" id="basic-layout-form">Tabel Barang</h4>
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
          <table class="table table-hover w-100 table-responsive" id="barangsTable">
            <thead>
              <tr>
                <th><i class="fa fa-id-card"></i> ID Barang</th>
                <th><i class="fa fa-image"></i> Gambar Barang</th>
                <th><i class="fa fa-shopping-bag"></i> Nama Barang</th>
                <th><i class="fa fa-dollar-sign"></i> Harga Barang</th>
                <th><i class="fa fa-shopping-basket"></i> Status Barang</th>
                <th><i class="fa fa-cog"></i> Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($barangs as $item)
                <tr>
                  <td>{{ $item->id }}</td>
                  <td><img src="{{ $item->gambar_barang ?? '/images/blank-item.jpg'}}" alt="pic" class="item-pic"></td>
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
                        <button class="dropdown-item tombolEditBarang" value="{{ $item->id }}">
                          <i class="fa fa-edit"></i> Edit
                        </button>
                        <button class="dropdown-item tombolDetailBarang" value="{{ $item->id }}">
                          <i class="ft-info"></i> Detail
                        </button>
                        <button class="dropdown-item tombolHapusBarang" value="{{ $item->id }}">
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

  {{-- Modal Tambah Barang --}}
  <div id="createBarang" class="modal-create modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="{{ route('rekanan.barang.store') }}" method="POST" enctype="multipart/form-data">

          <!-- Modal Header -->
          <div class="modal-create-header modal-header bg-info">
            <h4 class="modal-title text-white">Tambah Barang <i class="fa fa-shopping-bag"></i> </h4>
            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-create-body modal-body">
            <div class="container">
              @csrf
              <div class="form-group">
                <div class="form-group">

                  <input type="hidden" name="rekanan_id" value="{{ Auth::user()->id }}">

                  <label class="label label-default"><i class="fa fa-shopping-bag"></i> Nama Barang</label>
                  <input minlength="3" type="text" class="form-control" name="nama_barang" required>
                </div>

                <div class="form-group">
                  <label class="label label-default"><i class="fa fa-shopping-bag"></i> Jenis Barang</label>
                  <input type="text" class="form-control" name="jenis_barang" required>
                </div>

                <div class="form-group">
                  <label class="label label-default"><i class="fa fa-dollar-sign"></i> Harga Barang</label>
                  <input type="number" class="form-control" name="harga_barang" onkeydown="return ( event.ctrlKey || event.altKey
                  || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                  || (95<event.keyCode && event.keyCode<106)
                  || (event.keyCode==8) || (event.keyCode==9)
                  || (event.keyCode>34 && event.keyCode<40)
                  || (event.keyCode==46) )" required>
                </div>

                <div class="form-group">
                  <label class="label label-default"><i class="fa fa-info"></i> Detail Barang</label>
                  <textarea name="detail_barang" rows="4" cols="86"></textarea>
                </div>

                <div class="form-group">
                  <label><i class="fa fa-image"></i> Gambar Barang</label>
                  <br>
                  <input type="file" name="gambar_barang" class="form-control">
                </div>

                <input type="hidden" name="status_barang" value="tersedia">

              </div>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-create-footer modal-footer">
            <button type="submit" class="btn btn-success round">Tambah <i class="fa fa-plus"></i></button>
          </div>

        </form>
      </div>
    </div>
  </div>
  {{-- End Modal --}}

  {{-- Modal Edit Barang --}}

  <div class="modal-create modal fade" id="editBarang">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="{{ route('rekanan.barang.update') }}" method="POST" enctype="multipart/form-data">

          <!-- Modal Header -->
          <div class="modal-create-header modal-header bg-info">
            <h4 class="modal-title text-white">Edit Barang <i class="fa fa-edit"></i> </h4>
            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-create-body modal-body">
            <div class="container">
              @csrf

              <input type="hidden" name="id" id="id_edit_barang">

              <div class="form-group">
                <label><i class="fa fa-shopping-bag"></i> Nama Barang</label>
                <input type="text" name="nama_barang" id="edit_nama_barang" class="form-control">
              </div>

              <div class="form-group">
                <label><i class="fa fa-shopping-bag"></i> Jenis Barang</label>
                <input type="text" name="jenis_barang" id="edit_jenis_barang" class="form-control">
              </div>

              <div class="form-group">
                <label><i class="fa fa-dollar-sign"></i> Harga Barang</label>
                <input type="number" name="harga_barang" id="edit_harga_barang" class="form-control" onkeydown="return ( event.ctrlKey || event.altKey
                || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                || (95<event.keyCode && event.keyCode<106)
                || (event.keyCode==8) || (event.keyCode==9)
                || (event.keyCode>34 && event.keyCode<40)
                || (event.keyCode==46) )">
              </div>

              <div class="form-group">
                <label><i class="fa fa-info"></i> Detail Barang</label>
                <textarea name="detail_barang" id="edit_detail_barang" rows="4" cols="86"></textarea>
              </div>

              <label><i class="fa fa-shopping-basket"></i> Status Barang</label>
              <select name="status_barang" id="edit_status_barang" class="form-control">
                <option value="tersedia">Tersedia</option>
                <option value="habis">Habis</option>
              </select><br>

              <div class="form-group">
                <label><i class="fa fa-image"></i> Gambar Barang</label>
                <br>
                <input type="file" id="upload_gambar" name="upload_gambar" class="form-control">
              </div>

            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-create-footer modal-footer">
            <button type="submit" class="btn btn-success btn-glow">Update <i class="fa fa-edit"></i> </button>
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

  {{-- Modal Hapus Barang --}}
  <div class="modal-delete modal fade" id="delete">
    <div class="modal-dialog modal-sm">
      <div class="modal-delete-content modal-content">
        <form action="{{ route('rekanan.barang.destroy') }}" method="POST">
          @csrf
          <!-- Modal Header -->
          <div class="modal-delete-header modal-header">
            <h4 class="modal-title text-white">Peringatan !!!</h4>
            <button type="button" class="close text-black" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-delete-body modal-body">
            <div class="container">
              <i class="fa fa-trash-alt modal-delete-icon"></i><br><br>
              <p class="modal-delete-title">Hapus Barang</p>
              <p>Apakah anda yakin ingin menghapus Barang ini?</p>
              <p>Barang yang telah dihapus tidak dapat dikembalikan</p>
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

    $("#tombolTambahBarang").on("click", function(){
      $("#createBarang").modal();
    });

    $(".tombolEditBarang").on("click", function(){
      var id = $(this).val();
      $.ajax({
        method: "POST",
        url: "{{ route('rekanan.barang.edit') }}",
        data: {
          _token: token,
          id: id,
        }
      }).done(function (response) {
        $("#id_edit_barang").val(response.id);
        $("#edit_nama_barang").val(response.nama_barang);
        $("#edit_jenis_barang").val(response.jenis_barang);
        $("#edit_harga_barang").val(response.harga_barang);
        $("#edit_detail_barang").val(response.detail_barang);
        $("#edit_status_barang").val(response.status_barang);
        $("#editBarang").modal();
      });
    });

    $(".tombolDetailBarang").on("click", function(){
      var id = $(this).val();
      $.ajax({
        method: "POST",
        url : "{{ route('rekanan.barang.detail') }}",
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

    $(".tombolHapusBarang").on("click", function(){
      var id = $(this).val();
      $("#deleteId").val(id);
      $("#delete").modal();
    });

    $(document).ready( function () {
      $('#barangsTable').DataTable();
    });

  </script>

@endsection
