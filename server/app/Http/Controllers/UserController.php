<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

  //Pegawai
  public function Pelaksana_index_pegawai()
  {
    $data['users'] = user::where('hak_akses', '!=' , 'rekanan')->where('hak_akses', '!=' , 'anggota')->get();
    return view('pages.pelaksana.users.pegawai.index', $data);
  }

  public function Pelaksana_store_pegawai(Request $request)
  {
    $email = User::where('email', $request['email'])->first();
    if ($email != null) {
      return redirect()->back()->with('ERR', 'Email telah digunakan.');
    }

    $username = User::where('username', $request['username'])->first();
    if ($username != null) {
      return redirect()->back()->with('ERR', 'Username telah digunakan.');
    }

    User::create([
      'username' => $request['username'],
      'nama_lengkap' => $request['nama_lengkap'],
      'alamat' => $request['alamat'],
      'tanggal_lahir' => $request['tanggal_lahir'],
      'no_telp' => $request['no_telp'],
      'email' => $request['email'],
      'hak_akses' => $request['hak_akses'],
      'password' => bcrypt($request['password']),
    ]);

    return redirect()->back()->with('OK', 'Berhasil menambah data.');
  }

  //Anggota

  public function Pelaksana_index_Anggota()
  {
    $data['users'] = user::where('hak_akses', 'anggota')->get();
    return view('pages.pelaksana.users.anggota.index', $data);
  }

  public function Pelaksana_store_Anggota(Request $request)
  {
    $email = User::where('email', $request['email'])->first();
    if ($email != null) {
      return redirect()->back()->with('ERR', 'Email telah digunakan.');
    }

    $username = User::where('username', $request['username'])->first();
    if ($username != null) {
      return redirect()->back()->with('ERR', 'Username telah digunakan.');
    }

    User::create([
    'username' => $request['username'],
    'nama_lengkap' => $request['nama_lengkap'],
    'tanggal_lahir' => $request['tanggal_lahir'],
    'no_pegawai' => $request['no_pegawai'],
    'no_anggota' => $request['no_anggota'],
    'alamat' => $request['alamat'],
    'no_telp' => $request['no_telp'],
    'email' => $request['email'],
    'hak_akses' => $request['hak_akses'],
    'password' => bcrypt($request['password']),
    ]);
    return redirect()->back()->with('OK', 'Berhasil menambah data.');
  }

  //Rekanan

  public function Pelaksana_index_rekanan()
  {
    $data['users'] = user::where('hak_akses', 'rekanan')->get();
    return view('pages.pelaksana.users.rekanan.index', $data);
  }

  public function Pelaksana_store_rekanan(Request $request)
  {
    $email = User::where('email', $request['email'])->first();
    if ($email != null) {
      return redirect()->back()->with('ERR', 'Email telah digunakan.');
    }
    $username = User::where('username', $request['username'])->first();
    if ($username != null) {
      return redirect()->back()->with('ERR', 'Username telah digunakan.');
    }
    User::create([
      'username' => $request['username'],
      'nama_lengkap' => $request['nama_lengkap'],
      'jenis_toko' => $request['jenis_toko'],
      'alamat' => $request['alamat'],
      'no_telp' => $request['no_telp'],
      'email' => $request['email'],
      'hak_akses' => $request['hak_akses'],
      'password' => bcrypt($request['password']),
    ]);
    return redirect()->back()->with('OK', 'Berhasil menambah data.');
  }


  public function detail(Request $request)
  {
    $users = User::find($request['id']);
    return $users;
  }

  public function destroy(Request $request)
  {
    $user = User::find($request['id']);
    $user->delete();
    return redirect()->back()->with('OK', 'Berhasil menghapus data.');
  }

}
