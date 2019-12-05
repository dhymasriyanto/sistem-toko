<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    protected $fillable = ['nama_depan','nama_belakang', 'tanggal_lahir', 'tempat_lahir', 'nomer_hp'];
}
