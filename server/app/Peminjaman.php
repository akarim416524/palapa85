<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $guarded = [
        'id' 
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
