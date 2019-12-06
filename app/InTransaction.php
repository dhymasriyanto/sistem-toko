<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InTransaction extends Model
{
    protected $fillable = [
        'id_barang', 'jumlah_barang',
    ];
}
