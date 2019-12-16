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
        $request->validate([
            'id_karyawan' => ['required'],
            'id.*' => ['required'],
            'tanggal' => ['required'],
            'no_faktur' => ['required'],
            'jml.*' => ['required', 'numeric'],
            'subtotal.*' => ['required', 'numeric'],
            'total' => ['required', 'numeric']
        ]);
//        dd($request['tanggal']);

//        dd($request->id,$request->id_karyawan,$request->tanggal,$request->no_faktur,$request->jml,$request->subtotal,$request->total);

        History::create([
            'no_faktur' => $request['no_faktur'],
            'tanggal_transaksi' => $request['tanggal'],
            'total' => $request['total'],
            'id_karyawan' => $request['id_karyawan'],
        ]);
//dd($request['no_faktur']);
//        dd($request->no_faktur);
        $no_fak = $request->no_faktur;
        $transaksi = DB::table('transactions')
            ->where('no_faktur', $no_fak)->get();
//        dd($transaksi);
        foreach ($transaksi as $trans) {
//            dd($trans);
            if ($trans->no_faktur == $no_fak) {
                $id_transaksi = $trans->id;
//                dd($id_transaksi);
            }
//            dump($trans->no_faktur);
        }
//
//        die;
//        dd($id_transaksi, 'uwo');
        $ids=$request->id;
        $subtotals=$request->subtotal;
        $jmls = $request->jml;
//        dd($ids,$subtotals,$jmls);

        for ($i = 0; $i< count($ids);$i++){
            $id = $ids[$i];
            $subtotal = $subtotals[$i];
            $jml = $jmls[$i];

//            dump($id, $subtotal, $jml);
            DB::table('detail_transactions')->insert([
                'jumlah_barang' => $jml,
                'harga' => $subtotal,
                'id_barang' => $id,
                'id_transaksi'=> $id_transaksi
            ]);
            DB::table('stuffs')->where('id', $id)->decrement('jumlah_stok', $jml);
        }
//            dump($request[$keys]['id']);
//

//        dd('ab');
//        die;

        return redirect('/histories/'.$id_transaksi)->withCookie('shopping_cart',"[]",time()-360,'/out-transactions')->with('status', 'Transaksi berhasil');
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
            ->where('transactions.id', 'like', $history->id)
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
            ->join('units', 'units.id', '=', 'stuffs.id_satuan')
            ->join('categories', 'categories.id', '=', 'stuffs.id_kategori')
            ->where('detail_transactions.id_transaksi', 'like', $history->id)
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
