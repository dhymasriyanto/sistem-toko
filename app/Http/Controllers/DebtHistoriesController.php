<?php

namespace App\Http\Controllers;

use App\DebtHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DebtHistoriesController extends Controller
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
//        $debtHistory=DebtHistory::all();

//        dd($debtHistory);
        $debtHistories = DB::table('debt_transactions')
            ->join('users', 'debt_transactions.id_karyawan', '=', 'users.id')
            ->join('debtors', 'debt_transactions.id_penghutang', '=', 'debtors.id')
            ->get(array(
                'debt_transactions.id',
                'no_faktur',
                'tanggal_transaksi',
                'total',
                'name',
                'nama_penghutang'
            ));
        return view('debt-histories.index', compact('debtHistories'));

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DebtHistory  $debtHistory
     * @return \Illuminate\Http\Response
     */
    public function show(DebtHistory $debtHistory)
    {
        $debtHistories = DB::table('debt_transactions')
            ->join('users', 'debt_transactions.id_karyawan', '=', 'users.id')
            ->join('debtors', 'debt_transactions.id_penghutang', '=', 'debtors.id')
            ->where('debt_transactions.id','like',$debtHistory->id)
            ->get(array(
                'debt_transactions.id',
                'no_faktur',
                'tanggal_transaksi',
                'tenggat_hutang',
                'total',
                'name',
                'nama_penghutang',
                'nomer_hp',
                'nomer_ktp',
                'alamat'
            ));
//        dd($debtHistories);
        $detailDebtHistories = DB::table('detail_debt_transactions')
            ->join('debt_transactions', 'detail_debt_transactions.id_transaksi_hutang', '=', 'debt_transactions.id')
            ->join('stuffs', 'detail_debt_transactions.id_barang', '=', 'stuffs.id')
            ->join('categories','stuffs.id_kategori','=','categories.id')
            ->join('units','stuffs.id_satuan','=','units.id')
            ->where('detail_debt_transactions.id_transaksi_hutang', 'like', $debtHistory->id)
            ->get(array(
                'detail_debt_transactions.id',
                'nama_barang',
                'jumlah_barang',
                'detail_debt_transactions.harga as total',
                'stuffs.harga as harga',
                'nama_satuan',
                'nama_kategori'
            ));
//        dd($debtHistories,$detailDebtHistories);
        return view('debt-histories.show', compact('detailDebtHistories'),compact('debtHistories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DebtHistory  $debtHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(DebtHistory $debtHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DebtHistory  $debtHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DebtHistory $debtHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DebtHistory  $debtHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(DebtHistory $debtHistory)
    {
        //
    }
}
