<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pendanaan;
use App\Barang;
use Storage;
use File;
use Auth;

class PendanaanController extends Controller
{

  //Pengurus

  public function Pengurus_index_AjuanPendanaan()
  {
    $data['Pendanaans'] = Pendanaan::with('user')->where('status_rekanan', 'Diterima')->where('status_hr', 'Menunggu Persetujuan HR')->get();
    return view('pages.pengurus.marketplace.Pendanaan.index', $data);
  }

  public function Pengurus_index_Proses_AjuanPendanaan()
  {
    $data['ProsesPendanaans'] = Pendanaan::with('user')->where('status_rekanan', 'Diterima')->where('status_hr', 'Diterima')->where('status_pengurus', 'Sedang di Proses')->get();
    return view('pages.pengurus.marketplace.proses.index', $data);
  }

  public function pengurus_index_Log_AjuanPendanaan()
  {
    $data['Pendanaans'] = Pendanaan::with('user')->where('status_rekanan', 'Diterima')->where('status_hr', '!=', 'Menunggu Persetujuan HR')->get();
    return view('pages.pengurus.marketplace.log.index', $data);
  }

  public function Pengurus_form_KonfirmasiHR(Request $request)
  {
    $Pendanaan = Pendanaan::find($request['id']);
    return $Pendanaan;
  }

  public function Pengurus_KonfirmasiHR(Request $request)
  {
    $Pendanaan = Pendanaan::find($request['id']);

    $Pendanaan->update([
      'status_hr' => $request['status_hr'],
    ]);
    return redirect()->back()->with('OK', 'Konfirmasi Berhasil.');
  }

  public function Pengurus_form_KonfirmasiPengurus(Request $request)
  {
    $Pendanaan = Pendanaan::find($request['id']);
    return $Pendanaan;
  }

  public function Pengurus_KonfirmasiPengurus(Request $request)
  {
    $Pendanaan = Pendanaan::find($request['id']);

    $Pendanaan->update([
      'pengurus_id' => $request['id_pengurus'],
      'status_pengurus' => $request['status_pengurus'],
      'catatan_pengurus' => $request['catatan_pengurus'],
    ]);
    return redirect()->back()->with('OK', 'Konfirmasi Berhasil.');
  }

  public function Pengurus_detail_AjuanPendanaan(Request $request)
  {
    $Pendanaan = Pendanaan::with('user','pengurus')->find($request['id']);
    return $Pendanaan;
  }

  public function Pengurus_invoice_AjuanPendanaan(Request $request)
  {
    $Pendanaan = Pendanaan::with('user')->find($request['id']);
    return $Pendanaan;
  }


  //Anggota

  public function Anggota_index_rekanan(Request $request)
  {
    $data['rekanan'] = User::where('hak_akses', 'rekanan')->get();
    return view('pages.anggota.marketplace.toko.toko.index', $data);
  }

  public function Anggota_detail_rekanan(Request $request)
  {
    $users = User::find($request['id']);
    return $users;
  }

  public function Anggota_index_Barang($id)
  {
    $data['id_toko'] = $id;
    $data['barang'] = Barang::where('rekanan_id', $id)->get();
    return view('pages.anggota.marketplace.toko.barang.index', $data);
  }

  public function Anggota_detail_Barang(Request $request)
  {
    $barang = Barang::find($request['id']);
    return $barang;
  }

  public function Anggota_form_Pengajuanpendanaan(Request $request)
  {
    $barang = Barang::find($request['id']);
    return $barang;
  }

  public function Anggota_store_Pengajuanpendanaan(Request $request)
  {

    Pendanaan::create([
      'anggota_id' => $request['anggota_id'],
      'rekanan_id' => $request['rekanan_id'],
      'nama_barang' => $request['nama_barang'],
      'jenis_barang' => $request['jenis_barang'],
      'harga_barang' => $request['harga_barang'],
      'terbilang' => $request['terbilang'],
      'tanggal_awal' => $request['tanggal_awal'],
      'tanggal_akhir' => $request['tanggal_akhir'],
      'cara_pembayaran' => $request['cara_pembayaran'],
    ]);
    return redirect()->back()->with('OK', 'Berhasil Mengajukan Permintaan.');
  }

  public function Anggota_index_Pengajuanpendanaan()
  {
    $data['Pendanaans'] = Pendanaan::with('user')->where('anggota_id', Auth::user()->id )->where('status_rekanan', '!=', 'Ditolak')->where('status_hr', '!=', 'Ditolak')->where('status_pengurus', 'Sedang di Proses')->get();
    return view('pages.anggota.marketplace.pendanaan.pengajuan.index', $data);
  }


  public function Anggota_index_Log_AjuanPendanaan()
  {
    $data['Pendanaans'] = Pendanaan::with('user')->where('anggota_id', Auth::user()->id)->get();
    return view('pages.anggota.marketplace.pendanaan.log.index', $data);
  }

  public function Anggota_detail_Pengajuanpendanaan(Request $request)
  {
    $Pendanaan = Pendanaan::with('user')->find($request['id']);
    return $Pendanaan;
  }


  public function Anggota_Buktihr(Request $request)
  {
    $bukti = Pendanaan::find($request['id']);
    return $bukti;
  }

  public function Anggota_upload_Buktihr(Request $request)
  {

    $bukti = Pendanaan::find($request['id']);

    $this->validate($request,[
      'gambar_barang' => 'mimes:jpeg,jpg,png|max:500',
    ]);

    if ($request->hasFile('bukti_hr')) {
      $path = $request->file('bukti_hr')->store('/public/Bukti-HR'); // with /public on path
      $filename = $request->file('bukti_hr')->hashName(); // remove the /public on path
      $validPath = '/storage/Bukti-HR/' . $filename;
    }else {
      $validPath = $bukti->bukti_hr;
    }

    $bukti->update([
      'bukti_hr' => $validPath,
      ]);
      return redirect()->back()->with('OK', 'Berhasil mengedit data.');
  }

  public function Anggota_destroy_Pengajuanpendanaan(Request $request)
  {
    $Pendanaan = Pendanaan::find($request['id']);
    $Pendanaan->delete();
    return redirect()->back()->with('OK', 'Berhasil Membatalkan Pengajuan Pendanaan.');
  }


  //Rekanan

  public function Rekanan_index_AjuanPendanaan()
  {
    $data['Pendanaans'] = Pendanaan::with('user')->where('rekanan_id', Auth::user()->id)->where('status_rekanan', 'Menunggu Konfirmasi')->get();
    return view('pages.rekanan.marketplace.Pendanaan.index', $data);
  }

  public function Rekanan_FormKonfirmasi(Request $request)
  {
    $Pendanaan = Pendanaan::find($request['id']);
    return $Pendanaan;
  }

  public function Rekanan_Konfirmasi(Request $request)
  {
    $Pendanaan = Pendanaan::find($request['id']);

    $Pendanaan->update([
      'status_rekanan' => $request['status_rekanan'],
      'catatan_rekanan' => $request['catatan_rekanan'],
    ]);
    return redirect()->back()->with('OK', 'Konfirmasi Berhasil.');
  }

  public function Rekanan_detail_AjuanPendanaan(Request $request)
  {
    $Pendanaan = Pendanaan::with('user')->find($request['id']);
    return $Pendanaan;
  }

  public function Rekanan_index_Log_AjuanPendanaan()
  {
    $data['Pendanaans'] = Pendanaan::with('user')->where('rekanan_id', Auth::user()->id)->where('status_rekanan', '!=', 'Menunggu Konfirmasi')->get();
    return view('pages.rekanan.marketplace.log.index', $data);
  }

}
