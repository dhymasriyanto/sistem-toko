<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stuff extends Model
{
    //
//    public function scopeMine($query){
//        return $query->select('stuffs.id', 'categories.nama_kategori', 'units.nama_satuan','stuffs.harga', 'stuffs.jumlah_stok')
//            ->from('stuffs','categories', 'units');
//    }
    protected $fillable = [
        'nama_barang', 'id_kategori', 'id_satuan', 'harga', 'jumlah_stok'
    ];
}
