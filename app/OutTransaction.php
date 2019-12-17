<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutTransaction extends Model
{
    protected $fillable = ['id_barang', 'jumlah', 'nama_penghutang','nomor_ktp','nomor_hp','alamat','tenggat_hutang'];
}
