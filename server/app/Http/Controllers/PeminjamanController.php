<?php

namespace App\Http\Controllers;

use App\Peminjaman;
use App\User;
use Storage;
use File;
use Auth;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPeminjaman()
    {
        $data['peminjaman'] = Peminjaman::with('user')->where('jenis_angunan', 'tanpa angunan')->where('user_id', Auth::user()->id )->get();
        $data['users'] = User::get();
        return view('pages.anggota.peminjaman.TanpaAngunan.index', $data);
    }
    public function indexSertifikat()
    { 
        $data['peminjaman'] = Peminjaman::with('user')->where('jenis_angunan', 'angunan sertifikat')->where('user_id', Auth::user()->id)->get();
        $data['users'] = User::get();
        return view('pages.anggota.peminjaman.AngunanSertifikat.index', $data);
    }
    public function indexBpkb()
    { 
        $data['peminjaman'] = Peminjaman::with('user')->where('jenis_angunan', 'angunan Bpkb')->where('user_id', Auth::user()->id)->get();
        $data['users'] = User::get();
        return view('pages.anggota.peminjaman.AngunanBpkb.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detailPeminjaman(Request $request)
    {
        $peminjaman = Peminjaman::with('user')->where('id', $request['id'])->first();
        return $peminjaman;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     */
    public function storeTanpa(Request $request)
    {
        Peminjaman::create([
            'user_id'       => $request ['user_id'], 
            'no_pinjaman'   => '0',
            'jenis_angunan' => 'Tanpa Angunan',
            'no_jaminan'    => 'tidak ada',
            'atas_nama'     => 'tidak ada',
            'type'          => 'tidak ada',
            'warna'         => 'tidak ada',
            'no_polisi'     => 'tidak ada',
            'no_rangka'     => 'tidak ada',
            'no_mesin'      => 'tidak ada',
            'jumlah'        => $request ['jumlah'],
            'terbilang'     => $request ['terbilang'],
            'status'        => 'Menunggu Konfirmasi',
            'bayar_awal'    => $request ['bayar_awal'],
            'surat_kuasa'   => 'null',
            'jangka_waktu'  => $request ['jangka_waktu'],
            'cara_pembayaran'=>$request ['cara_pembayaran'],
            'periode_awal'  => $request  ['periode_awal'],
            'periode_akhir' => $request  ['periode_akhir'],
        ]);
        return redirect()->back()->with('OK', 'Berhasil Mengirim Data.');
    }
    public function storeTanpaB(Request $request)
    {
        Peminjaman::create([
            'user_id'       => $request ['user_id'], 
            'no_pinjaman'   => '0',
            'jenis_angunan' => 'Angunan BPKB',
            'no_jaminan'    => 'tidak ada',
            'atas_nama'     => $request ['atas_nama'],
            'type'          => $request ['type'],
            'warna'         => $request ['warna'],
            'no_polisi'     => $request ['no_polisi'],
            'no_rangka'     => $request ['no_rangka'],
            'no_mesin'      => $request ['no_mesin'],
            'jumlah'        => $request ['jumlah'],
            'terbilang'     => $request ['terbilang'],
            'status'        => 'Menunggu Konfirmasi',
            'bayar_awal'    => $request ['bayar_awal'],
            'surat_kuasa'   => 'null',
            'jangka_waktu'  => $request ['jangka_waktu'],
            'cara_pembayaran'=>$request ['cara_pembayaran'],
            'periode_awal'  =>$request  ['periode_awal'],
            'periode_akhir' =>$request  ['periode_akhir'],
        ]);
        return redirect()->back()->with('OK', 'Berhasil Mengirim Pengajuan.');
    }
    public function storeTanpaS(Request $request)
    {
        Peminjaman::create([
            'user_id'       => $request ['user_id'], 
            'no_pinjaman'   => '0',
            'jenis_angunan' => 'Angunan Sertifikat',
            'no_jaminan'    => $request ['no_jaminan'],
            'atas_nama'     => $request ['atas_nama'],
            'type'          => 'tidak ada',
            'warna'         => 'tidak ada',
            'no_polisi'     => 'tidak ada',
            'no_rangka'     => 'tidak ada',
            'no_mesin'      => 'tidak ada',
            'jumlah'        => $request ['jumlah'],
            'terbilang'     => $request ['terbilang'],
            'status'        => 'Menunggu Konfirmasi',
            'bayar_awal'    => $request ['bayar_awal'],
            'surat_kuasa'   => 'null',
            'jangka_waktu'  => $request ['jangka_waktu'],
            'cara_pembayaran'=>$request ['cara_pembayaran'],
            'periode_awal'  =>$request  ['periode_awal'],
            'periode_akhir' =>$request  ['periode_akhir'],
        ]);
        return redirect()->back()->with('OK', 'Berhasil Mengirim Pengajuan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function show(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function regPeminjaman(Request $request)
    {
      $peminjaman = Peminjaman::find($request['id']);
      return $peminjaman;
    }
  
    public function uploadPeminjaman(Request $request)
    { 
        $peminjaman = Peminjaman::find($request['id']);

        if ($request->hasFile('surat_kuasa')) {
        $path = $request->file('surat_kuasa')->store('/public/surat_kuasa'); // with /public on path
        $filename = $request->file('surat_kuasa')->hashName(); // remove the /public on path
        $validPath = '/storage/surat_kuasa/' . $filename;
     }
      $peminjaman->update([
        'surat_kuasa'    => $validPath,
      ]);
      return redirect()->back()->with('OK', 'Berhasil mengirim data.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function Anggota_index_Log_AjuanPeminjaman()
  {
    $data['peminjaman'] = Peminjaman::with('user')->where('user_id', Auth::user()->id)->get();
    return view('pages.anggota.peminjaman.log.index', $data);
  }
    public function destroy(Peminjaman $peminjaman)
    {
        //
    }
}
