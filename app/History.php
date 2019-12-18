<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    //
    protected $table = 'transactions';
    protected $fillable = ['id_karyawan', 'no_faktur', 'tanggal_transaksi','total','uang','kembalian'];
}
