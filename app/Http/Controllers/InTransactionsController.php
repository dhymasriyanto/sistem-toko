<?php

namespace App\Http\Controllers;

use App\Stuff;
use App\InTransaction;
use Illuminate\Http\Request;

class InTransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stuffs = Stuff::all();
        return view('in-transactions.index', compact('stuffs'));
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
     * @param \App\InTransaction $inTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(InTransaction $inTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\InTransaction $inTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(InTransaction $inTransaction)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\InTransaction $inTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stuff $stuff)
    {
        $request->validate([
            'id_barang' => 'required',
            'jumlah_barang' => 'required'
        ]);
        $value = $request['jumlah_barang'];
        $id = $request['id_barang'];
//        dd($value, $id);

        Stuff::where('id', $id)
            ->increment(
                'jumlah_stok', $value
            );

        return redirect('/in-transactions')->with('status', 'Transaksi berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\InTransaction $inTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(InTransaction $inTransaction)
    {
        //
    }
}
