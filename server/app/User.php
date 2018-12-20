<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use Notifiable;

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'username', 'nama_lengkap', 'email', 'password', 'no_telp', 'alamat', 'hak_akses', 'tanggal_lahir', 'no_anggota', 'no_pegawai', 'jenis_toko', 'gambar_user',
  ];

  /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
  protected $guarded = [
    'id', 'password', 'remember_token',
  ];


  public function sendPasswordResetNotification($token)
  {
    $this->notify(new ResetPasswordNotification($token));
  }

  public function pendanaan()
  {
    return $this->HasMany('App\Pendanaan');
  }

  public function barang()
  {
    return $this->HasMany('App\Barang');
  }

}
