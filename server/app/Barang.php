<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
  protected $fillable = [
    'rekanan_id', 'nama_barang', 'jenis_barang', 'harga_barang', 'gambar_barang', 'detail_barang', 'status_barang'
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
    return $this->belongsTo('App\User');
  }
}
