<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cloud extends Model
{
    protected $table = 'storages';

    protected $fillable = [
        'user_id', 'item', 'item_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $protected = [
        'id',
    ];

    public function item()
      {
          return $this->belongsTo('App\User', 'user_id');
      }

}
