<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Storage;
use File;

class ProfileController extends Controller
{
  public function index()
  {
    $data['profile'] = Auth::user();
    return view('pages.profile.index', $data);
  }

  public function edit(Request $request)
  {
    $user = User::find($request['id']);
    return $user;
  }

  public function update(Request $request)
  {
    $user = User::find($request['id']);
    $username = User::where('username', $request['username'])->first();
    $email = User::where('email', $request['email'])->first();

    if ($username != null) {
      if ($username->id != $user->id) {
        return redirect()->back()->with('ERR', 'Username telah digunakan.');
      }
    }

    if ($email != null) {
      if ($email->id != $user->id) {
        return redirect()->back()->with('ERR', 'Email telah digunakan.');
      }
    }

    $this->validate($request,[
      'gambar_barang' => 'mimes:jpeg,jpg,png|max:500',
    ]);

    if ($request->hasFile('gambar_user')) {
      $path = $request->file('gambar_user')->store('/public/profile-pictures'); // with /public on path
      $filename = $request->file('gambar_user')->hashName(); // remove the /public on path
      $validPath = '/storage/profile-pictures/' . $filename;
    }else {
      $validPath = $user->gambar_user;
    }

    $user->update([
      'username' => $request['username'],
      'nama_lengkap' => $request['nama_lengkap'],
      'tanggal_lahir' => $request['tanggal_lahir'],
      'no_pegawai' => $request['no_pegawai'],
      'no_anggota' => $request['no_anggota'],
      'alamat' => $request['alamat'],
      'no_telp' => $request['no_telp'],
      'email' => $request['email'],
      'gambar_user' => $validPath,
      ]);
      return redirect()->back()->with('OK', 'Berhasil mengedit data.');
    }

    public function changepassword(Request $request)
    {
      $profile = Auth::user();
      $profile->update([
      'password' => bcrypt($request['password']),
      ]);
      return redirect()->back()->with('OK', 'Berhasil Mengubah Password.');
    }
  }
