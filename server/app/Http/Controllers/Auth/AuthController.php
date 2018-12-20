<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;

class AuthController extends Controller
{
  public function index()
  {
    if (Auth::user()) {
      Auth::logout();
    }
    return view('auth.login');
  }

  public function login(Request $request)
  {
    $checkedUsername = User::where('username', $request['username'])->first();
    if ($checkedUsername != null) {
      $validUser = Auth::attempt(['username'=>$request->username, 'password'=>$request->password]);
      if ($validUser) {
        return redirect('roleCheck');
      } else {
        return redirect()->back()->with('ERR', 'password salah.');
      }
    }else {
        return redirect()->back()->with('ERR', 'username tidak ditemukan.');
    }
  }

  public function roleCheck()
  {
      switch (Auth::user()->hak_akses) {
        case 'pelaksana':
        return redirect('/pelaksana/users/pegawai');
        break;

        case 'pengurus':
        return redirect('/pengurus/marketplace/ajuanpendanaan');
        break;

        case 'anggota':
        return redirect('/anggota/marketplace/ajuanpendanaan');
        break;

        case 'rekanan':
        return redirect('rekanan/barang');
        break;

        default:
        return redirect('login');
        break;

      }
  }

  public function logout(Request $request)
  {
    Auth::logout();
    return redirect('/');
  }

}
