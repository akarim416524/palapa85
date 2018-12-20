<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Barang;
use Storage;
use File;
use Auth;

class BarangController extends Controller
{
  public function index()
  {
    $data['barangs'] = Barang::where('rekanan_id', Auth::user()->id )->get();
    return view('pages.rekanan.barang.index', $data);
  }

  public function store(Request $request)
  {

    $this->validate($request,[
      'gambar_barang' => 'mimes:jpeg,jpg,png|max:500',
    ]);

    if ($request->hasFile('gambar_barang')) {
      $path = $request->file('gambar_barang')->store('/public/Gambar-Barang'); // with /public on path
      $filename = $request->file('gambar_barang')->hashName(); // remove the /public on path
      $validPath = '/storage/Gambar-Barang/' . $filename;
    }else {
      $validPath = null;
    }

    Barang::create([
      'rekanan_id' => $request['rekanan_id'],
      'nama_barang' => $request['nama_barang'],
      'jenis_barang' => $request['jenis_barang'],
      'harga_barang' => $request['harga_barang'],
      'detail_barang' => $request['detail_barang'],
      'status_barang' => $request['status_barang'],
      'gambar_barang' => $validPath,
    ]);
    return redirect()->back()->with('OK', 'Berhasil menambah data.');
  }

  public function edit(Request $request)
  {
    $barang = Barang::find($request['id']);
    return $barang;
  }

  public function update(Request $request)
  {
    $barang = Barang::find($request['id']);

    if ($request->hasFile('upload_gambar')) {
      $path = $request->file('upload_gambar')->store('/public/Gambar-Barang'); // with /public on path
      $filename = $request->file('upload_gambar')->hashName(); // remove the /public on path
      $validPath = '/storage/Gambar-Barang/' . $filename;
    }else {
      $validPath = $barang->gambar_barang;
    }

    $barang->update([
    'nama_barang' => $request['nama_barang'],
    'jenis_barang' => $request['jenis_barang'],
    'harga_barang' => $request['harga_barang'],
    'detail_barang' => $request['detail_barang'],
    'status_barang' => $request['status_barang'],
    'gambar_barang' => $validPath,
    ]);
    return redirect()->back()->with('OK', 'Berhasil Mengubah data.');
  }

  public function detail(Request $request)
  {
    $barang = Barang::find($request['id']);
    return $barang;
  }

  public function destroy(Request $request)
  {
    $barang = Barang::find($request['id']);
    $barang->delete();
    return redirect()->back()->with('OK', 'Berhasil menghapus data.');
  }
}
