<?php

namespace App\Http\Controllers;

use App\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
//        $histories = History::all();
//        dd($histories);
        $histories = DB::table('transactions')
        ->join('users', 'transactions.id_karyawan', '=', 'users.id')
        ->get(array(
            'transactions.id',
            'no_faktur',
            'tanggal_transaksi',
            'total',
            'name'
        ));
        return view('histories.index', compact('histories'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\History $history
     * @return \Illuminate\Http\Response
     */
    public function show(History $history)
    {
        $histories = DB::table('transactions')
            ->join('users', 'transactions.id_karyawan', '=', 'users.id')
            ->where('transactions.id','like',$history->id)
            ->get(array(
                'transactions.id',
                'no_faktur',
                'tanggal_transaksi',
                'total',
                'name'
            ));

        $detailTransactions = DB::table('detail_transactions')
            ->join('transactions', 'detail_transactions.id_transaksi', '=', 'transactions.id')
            ->join('stuffs', 'detail_transactions.id_barang', '=', 'stuffs.id')
            ->join('units','units.id','=','stuffs.id_satuan')
            ->join('categories','categories.id','=','stuffs.id_kategori')
            ->where('detail_transactions.id_transaksi','like',$history->id)
            ->get(array(
                'detail_transactions.id',
                'jumlah_barang',
                'detail_transactions.harga as total',
                'stuffs.harga as harga',
                'nama_satuan',
                'nama_kategori',
                'nama_barang'
            ));
//        dd($detailTransactions);

        return view('histories.show', compact('histories'), compact('detailTransactions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\History $history
     * @return \Illuminate\Http\Response
     */
    public function edit(History $history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\History $history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, History $history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\History $history
     * @return \Illuminate\Http\Response
     */
    public function destroy(History $history)
    {
        //
    }
}
