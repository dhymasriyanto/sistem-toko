<?php

namespace App\Http\Controllers;

use App\Stuff;
use App\OutTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stuffs = DB::table('stuffs')
            ->join('units', 'stuffs.id_satuan', 'units.id')
            ->join('categories', 'stuffs.id_kategori', 'categories.id')
            ->where('stuffs.id', $request->id_barang)
            ->get();

        foreach ($stuffs as $stuff) {
            $nama_barang = $stuff->nama_barang;
            $harga_barang = $stuff->harga;
            $satuan = $stuff->nama_satuan;
            $kategori = $stuff->nama_kategori;
            $stok = $stuff->jumlah_stok;
        }
        $value = $request->cookie('shopping_cart');
        if (isset($value)) {
            $cookie_data = stripslashes($_COOKIE['shopping_cart']);
            $aa = Crypt::decryptString($cookie_data);
            $cart_data = json_decode($aa, true);
        } else {
            $cart_data = array();
        }

        $item_id_list = array_column($cart_data, 'item_id');

                $a=$stuff->jumlah_stok-$request->jumlah;
        if (in_array($request->id_barang, $item_id_list)) {
            foreach ($cart_data as $keys => $values) {
                dd($a);
                if ($a==0){
                    return redirect('/out-transactions')->with('error', 'gagal');
                }else if ($cart_data[$keys]["item_id"] == $request->id_barang) {
                    $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $request->jumlah;
                }
            }
        } else {
            $item_array = array(
                'item_id' => $request->id_barang,
                'item_name' => $nama_barang,
                'item_price' => $harga_barang,
                'item_quantity' => $request->jumlah,
                'item_unit' => $satuan,
                'item_category' => $kategori,
                'item_stock' => $stok
            );
            $cart_data[] = $item_array;
        }

        $item_data = json_encode($cart_data);

        return redirect('/out-transactions')->withCookie('shopping_cart', $item_data, time() + (86400 * 30), '/out-transactions')->with('status', 'berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\OutTransaction $outTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(OutTransaction $outTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\OutTransaction $outTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(OutTransaction $outTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\OutTransaction $outTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OutTransaction $outTransaction)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\OutTransaction $outTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(OutTransaction $outTransaction)
    {
        //
    }
}
