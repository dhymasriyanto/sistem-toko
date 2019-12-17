<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DebtHistory extends Model
{
    //
    protected $table = 'debt_transactions';
    protected $fillable = ['id_karyawan', 'no_faktur', 'tanggal_transaksi','tenggat_hutang','total','id_penghutang'];

}
