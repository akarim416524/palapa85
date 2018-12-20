<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pendanaan extends Model
{
  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'anggota_id', 'pengurus_id','rekanan_id','nama_barang','jenis_barang','harga_barang', 'terbilang', 'tanggal_awal', 'tanggal_akhir', 'status_pengurus', 'status_rekanan', 'status_hr', 'catatan_pengurus', 'catatan_rekanan', 'cara_pembayaran', 'bukti_hr',
  ];

  /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
  protected $protected = [
    'password',
  ];

  public function user()
  {
    return $this->belongsTo('App\User', 'anggota_id');
  }

  public function pengurus()
  {
    return $this->belongsTo('App\User', 'pengurus_id');
  }

}
