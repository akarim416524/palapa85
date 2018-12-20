@extends('layouts.master-layout')

@section('title', 'Palapa 85 - Cloud Storage')

@section('style')

  <link rel="stylesheet" href="/css/mymodal.css">

  <link rel="stylesheet" href="/css/style.css">

@endsection

@section('content-header')

  <div class="content-header-left col-md-6  breadcrumb-new">
    <h3 class="content-header-title mb-0 d-inline-block text-capitalize">Cloud</h3>
    <div class="row breadcrumbs-top d-inline-block">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            Home
          </li>
          <li class="breadcrumb-item active">
            Cloud Storage
          </li>
        </ol>
      </div>
    </div>
  </div>

  <div class="content-header-right col-md-6 breadcrumb-new text-right">
    <button type="button" name="button" class="btn btn-success round btn-glow" id="tombolUploadFile"><i class="fa fa-cloud-upload-alt"></i> Upload File</button>
  </div>

@endsection

@section('content')

  <div class="card">
    <div class="card-header">
      <h4 class="card-title" id="basic-layout-form">Tabel Users Anggota</h4>
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
          <table class="table table-hover d-md-table w-100 table-responsive" id="fileTable">
            <thead>
              <tr>
                <th><i class="fa fa-folder"></i> ID</th>
                <th><i class="fa fa-file"></i> File</th>
                <th><i class="fa fa-file-alt"></i> Nama File</th>
                <th><i class="fa fa-calendar"></i> Tanggal Di Upload</th>
                <th><i class="fa fa-cog"></i> Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($items as $item)
                <tr>
                  <td>{{ $item->id }}</td>
                  <td><img src="/images/blank-user.png" alt="filepic" class="file-pic"> </td>
                  <td>{{ $item->item_name }}</td>
                  <td>{{ strftime('%d %B %Y', strtotime($item->created_at)) }}</td>
                  <td>
                    <div class="action-button btn-group text-center">
                      <button type="button" class="btn btn-info round dropdown-toggle" data-toggle="dropdown">
                        <i class="la la-gear"></i>
                      </button>
                      <div class="dropdown-menu" x-placement="bottom-start">
                        <a href="{{ $item->item }}" download>
                          <button class="dropdown-item">
                            <i class="fa fa-cloud-download-alt"></i> Download File
                          </button>
                        </a>
                        <button class="dropdown-item tombolHapusFile" value="{{ $item->id }}">
                          <i class="fa fa-trash"></i> Hapus File
                        </button>

                        <button class="dropdown-item tombolBagiFile"  value="{{ $item->id }}">
                          <i class="fa fa-trash"></i> Bagi File
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

{{-- MODAL --}}

  {{-- Modal Upload File --}}
  <div id="modalUploadFile" class="modal-create modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="{{ route('cloud.upload') }}" method="POST" enctype="multipart/form-data">

          <!-- Modal Header -->
          <div class="modal-create-header modal-header bg-info">
            <h4 class="modal-title text-white">Upload File <i class="fa fa-cloud-upload-alt"></i> </h4>
            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-create-body modal-body">
            <div class="container">
              @csrf
              <div class="form-group">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                <div class="form-group">
                  <label class="label label-default"><i class="fa fa-file-alt"></i> Nama File</label>
                  <input minlength="3" type="text" class="form-control" name="item_name" required>
                </div>

                <div class="form-group">
                  <label><i class="fa fa-file"></i> File</label>
                  <br>
                  <input type="file" name="item" class="form-control" required>
                </div>

                <div class="form-group">
                  <li>Keterangan</li>
                  <li>Keterangan</li>
                  <li>Keterangan</li>
                </div>

              </div>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-create-footer modal-footer">
            <button type="submit" class="btn btn-success round">Upload <i class="fa fa-cloud-upload-alt"></i></button>
          </div>

        </form>
      </div>
    </div>
  </div>
  {{-- End Modal --}}

  {{-- Modal Hapus Barang --}}
  <div class="modal-delete modal fade" id="deleteFile">
    <div class="modal-dialog modal-sm">
      <div class="modal-delete-content modal-content">
        <form action="{{ route('cloud.destroy') }}" method="POST">
          @csrf
          <!-- Modal Header -->
          <div class="modal-delete-header modal-header">
            <h4 class="modal-title text-white">Peringatan !!!</h4>
            <button type="button" class="close text-black" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-delete-body modal-body">
            <div class="container">
              <i class="fa fa-trash-alt modal-delete-icon"></i><br><br>
              <p class="modal-delete-title">Hapus File</p>
              <p>Apakah anda yakin ingin menghapus File ini?</p>
              <p>File yang telah dihapus tidak dapat dikembalikan</p>
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
  <!-- modal bagi -->
  
  <div id="modalBagiFile" class="modal-create modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="{{ route('cloud.share') }}" method="POST" enctype="multipart/form-data">

          <!-- Modal Header -->
          <div class="modal-create-header modal-header bg-info">
            <h4 class="modal-title text-white">Bagi File <i class="fa fa-cloud-upload-alt"></i> </h4>
            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-create-body modal-body">
            <div class="container">
              @csrf
              <div class="form-group">
                <label>ID Orang Lain</label>
                  <select name="user_id" class="form-control" id="createBagiFile">
                    <option value="-">Silahkan Pilih</option>
                    @foreach ($users as $item)
                      <option value="{{ $item->id }}">{{ $item->nama_lengkap }}</option>        
                    @endforeach
                  </select>
              </div>

              <div class="form-group">
                <label class="label label-default"><i class="fa fa-file-alt"></i> Nama File</label>
                <input minlength="3" type="text" id="shareItemName"  class="form-control" readonly name="item_name" required>
              </div>
              <div class="form-group">
                <input type="hidden" name="item" id="shareItem" class="form-control" readonly required>
              </div>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-create-footer modal-footer">
            <div class="form-group">
              <button type="submit" class="btn btn-success round">Upload <i class="fa fa-cloud-upload-alt"></i></button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>

@endsection

@section('script')

  <script type="text/javascript">

    var token = $("meta[name=\"_token\"]").attr("content");

    $("#tombolUploadFile").on("click", function(){
      $("#modalUploadFile").modal();
    });
    var token = $("meta[name=\"_token\"]").attr("content");

    $(".tombolBagiFile").on("click", function(){
      var id = $(this).val();
      $.ajax({
        method: "POST",
        url: "{{ route('cloud.init') }}",
        data: {
          _token: token,
          id: id
        }
      }).done(function(response){
        $("#shareItemName").val(response.item_name);
        $("#shareItem").val(response.item);
        $("#modalBagiFile").modal();
      });
    });

    $(".tombolHapusFile").on("click", function(){
      var id = $(this).val();
      $("#deleteId").val(id);
      $("#deleteFile").modal();
    });

    $(document).ready( function () {
      $('#fileTable').DataTable();
    });

  </script>

@endsection
