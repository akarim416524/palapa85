<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Peminjaman;
use App\User;
use Auth;
use Storage;
use File;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAdminT()
    { 
        $data['peminjaman'] = Peminjaman::with('User')->get();
        $data['users'] = User::all();
        return view('pages.pengurus.peminjaman.TanpaAngunan.index', $data);
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
     */
    public function store(Request $request)
    {
        //
    }
    public function editStatus(Request $request)
    {   
        $peminjaman = Peminjaman::find($request['id']);
        return $peminjaman;
    }
    public function updateStatus(Request $request)
   { 
    
    Peminjaman::find($request['id'])->update([
        'status' => $request['status'],
    ]);
    return redirect()->back()->with('OK', 'Berhasil mengedit data.');
   }
   public function editNomor(Request $request)
   {   
       $peminjaman = Peminjaman::find($request['id']);
       return $peminjaman;
   }
   public function updateNomor(Request $request)
  { 

   Peminjaman::find($request['id'])->update([
       'no_pinjaman' => $request['no_pinjaman'],
   ]);
   return redirect()->back()->with('OK', 'Berhasil mengedit data.');
  }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPeminjaman(Request $request)
  {
    $peminjaman = Peminjaman::find($request['id']);
    return $peminjaman;
  }

  public function updatePeminjaman(Request $request)
  { 
        
    if ($request->hasFile('surat_kuasa')) {
        $path = $request->file('surat_kuasa')->store('/public/surat_kuasa'); // with /public on path
        $filename = $request->file('surat_kuasa')->hashName(); // remove the /public on path
        $validPath = '/storage/surat_kuasa/' . $filename;
         }

    $peminjaman = Peminjaman::find($request['id']);
    $peminjaman->update([
        'no_pinjaman'   => $request ['no_pinjaman'],
        'jenis_angunan' => $request ['jenis_angunan'],
        'no_jaminan'    => $request ['no_jaminan'],
        'jumlah'        => $request ['jumlah'],
        'terbilang'     => $request ['terbilang'],
        'status'        => $request ['status'],
        'bayar_awal'    => $request ['bayar_awal'],
        'jangka_waktu'  => $request ['jangka_waktu'],
        'surat_kuasa'   => $validPath,
        'cara_pembayaran'=>$request ['cara_pembayaran'],
        'periode_awal'  => $request  ['periode_awal'],
        'periode_akhir' => $request  ['periode_akhir'],
    ]);
    return redirect()->back()->with('OK', 'Berhasil mengedit data.');
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Pengurus_index_Log_AjuanPeminjaman()
    {
      $data['peminjaman'] = Peminjaman::with('user')->get();
      return view('pages.pengurus.peminjaman.log.index', $data);
    }
    public function destroy(Request $request)
    {
        Peminjaman::find($request['id'])->delete();
        return redirect()->back()->with('OK', 'Berhasil menghapus data.');
    }
}
