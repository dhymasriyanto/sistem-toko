<?php

namespace App\Http\Controllers;

use App\Stuff;
use App\OutTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OutTransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OutTransaction $outTransaction)
    {

        $stuffs = DB::table('stuffs')
            ->join('categories', 'stuffs.id_kategori', '=', 'categories.id')
            ->join('units', 'stuffs.id_satuan', '=', 'units.id')
            ->get(array(
                'stuffs.id',
                'nama_barang',
                'nama_kategori',
                'nama_satuan',
                'harga',
                'jumlah_stok'
            ));
        return view('out-transactions.index', compact('stuffs', 'outTransaction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request['id'];
        $jumlah = $request['jumlah'];

        $transaksi [] = array(
            'id'=>$id,
            'jumlah' => $jumlah
        );
        dd($transaksi);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OutTransaction  $outTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(OutTransaction $outTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OutTransaction  $outTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(OutTransaction $outTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OutTransaction  $outTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OutTransaction $outTransaction)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OutTransaction  $outTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(OutTransaction $outTransaction)
    {
        //
    }
}
