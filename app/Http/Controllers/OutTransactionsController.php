<?php

namespace App\Http\Controllers;

use App\Stuff;
use App\OutTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;


class OutTransactionsController extends Controller
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

    public function index(OutTransaction $outTransaction)
    {

        return response(view('out-transactions.index'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        dd('wewe');

        $stuffs = Stuff::all();
        foreach ($stuffs as $stuff) {
            $item_array = array(
                'item_id' => $stuff->id,
                'item_name' => $stuff->nama_barang,
                'item_price' => $stuff->harga,
                'item_unit' => $stuff->nama_satuan,
                'item_category' => $stuff->nama_kategori,
                'item_stock' => $stuff->jumlah_stok
            );
            $stock_data[] = $item_array;
        }
        $stock_item_data = json_encode($stock_data);
        if (isset($_COOKIE['shopping_cart'])) {
            $cookie_data = stripslashes($_COOKIE['shopping_cart']);
            $aa = Crypt::decryptString($cookie_data);
            $cart_data = json_decode($aa, true);
            if ($cart_data != null) {
                foreach ($cart_data as $keys => $values) {
                    unset($cart_data[$keys]);
                    $item_data = json_encode($cart_data);
                }
                return redirect('/out-transactions')->withCookie('shopping_cart', $item_data, time() + (86400 * 30), '/out-transactions')->withCookie('stock_cart', $stock_item_data, time() + (86400 * 30), '/out-transactions');
            }

        }
        return redirect('/out-transactions')->withCookie('stock_cart', $stock_item_data, time() + (86400 * 30), '/out-transactions');


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cookie_data2 = stripslashes($_COOKIE['stock_cart']);
        $aaa = Crypt::decryptString($cookie_data2);
        $stock_data = json_decode($aaa, true);
//        $tmp=
//        dd($request->jumlah);
        foreach ($stock_data as $keys => $values) {
            if ($stock_data[$keys]["item_id"] == $request->id_barang) {
                $tmp = $stock_data[$keys]['item_stock'];
//dd($tmp);

//                dd($tmp);
                $stock_data[$keys]['item_stock'] -= $request->jumlah;
//                dd($stock_data[$keys]['item_stock']);


            }
        }


        $request->validate([
            'id_barang' => ['required'],
            'jumlah' => ['required', 'numeric']
        ]);
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
//        dd($request->id_barang);
//                $a=$stuff->jumlah_stok-$request->jumlah;
        if ($request->jumlah > $tmp) {
            return redirect('/out-transactions')->with('gagal', 'Permintaan melebihi jumlah stok gudang');
        } elseif ($request->jumlah == 0) {
            return redirect('/out-transactions')->with('gagal', 'Permintaan tidak boleh kosong');
        }
        if ((in_array($request->id_barang, $item_id_list))) {
            foreach ($cart_data as $keys => $values) {
//                dd($a);\
                if ($cart_data[$keys]["item_id"] == $request->id_barang) {
                    if (($cart_data[$keys]['item_stock'] <= 0)) {
                        return redirect('/out-transactions')->with('gagal', 'Stok Habis');
                    } elseif (($cart_data[$keys]['item_stock'] < $request->jumlah)) {
                        return redirect('/out-transactions')->with('gagal', 'Permintaan akan melebihi jumlah stok gudang');
                    } else {

                        $cart_data[$keys]['item_stock'] = $tmp - $request->jumlah;
                        $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $request->jumlah;
                    }

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
                'item_stock' => $tmp - $request->jumlah
            );
            $cart_data[] = $item_array;
        }

        $item_data = json_encode($cart_data);
        $item_stock_data = json_encode($stock_data);

//dd($item_data);
        return redirect('/out-transactions')->withCookie('stock_cart', $item_stock_data, time() + (86400 * 30), '/out-transactions')->withCookie('shopping_cart', $item_data, time() + (86400 * 30), '/out-transactions')->with('status', 'Berhasil masuk ke keranjang');
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
    public function destroy(Request $request, Stuff $outTransaction)
    {
        //
//dd($request->id_barang);
        $cookie_data2 = stripslashes($_COOKIE['stock_cart']);
        $aaa = Crypt::decryptString($cookie_data2);
        $stock_data = json_decode($aaa, true);
//        dd($stock_data);
        foreach ($stock_data as $keys => $values) {
            if ($stock_data[$keys]["item_id"] == $request->id_barang) {

                $stock_data[$keys]['item_stock'] += $request->jumlah;
//                dd($stock_data[$keys]['item_stock']);
            } else {
                $jumlah = $request->jumlah;
                $id_barang = $request->id_barang;
                for ($i = 0; $i < count($id_barang); $i++) {
                    $id = $id_barang[$i];
                    $jml = $jumlah[$i];

//            dump($id, $jml);
                    if ($stock_data[$keys]["item_id"] == $id) {
                        $stock_data[$keys]['item_stock'] += $jml;
                    }
                }
//                dump($stock_data[$keys]['item_stock']);
            }
        }
//        die;
//        dd($tmp);
        $item_stock_data = json_encode($stock_data);


//        dd($outTransaction->id);
        $request->id = $outTransaction->id;
//        dd(isset($request->id));
        if (isset($request->id)) {
            $cookie_data = stripslashes($_COOKIE['shopping_cart']);
            $aa = Crypt::decryptString($cookie_data);
            $cart_data = json_decode($aa, true);
            foreach ($cart_data as $keys => $values) {
                if ($cart_data[$keys]['item_id'] == $request->id) {
                    unset($cart_data[$keys]);
                    $item_data = json_encode($cart_data);
//                    dd($item_data);
//                setcookie("shopping_cart", $item_data, time() + (86400 * 30));
//                header("location:index.php?remove=1");
                }
            }
            return redirect('/out-transactions')->withCookie('stock_cart', $item_stock_data, time() + (86400 * 30), '/out-transactions')->withCookie('shopping_cart', $item_data, time() + (86400 * 30), '/out-transactions')->with('status', 'Berhasil dikeluarkan dari keranjang');
        } else {
            if (isset($_COOKIE['shopping_cart'])) {
                $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                $aa = Crypt::decryptString($cookie_data);
                $cart_data = json_decode($aa, true);
                if ($cart_data != null) {
                    foreach ($cart_data as $keys => $values) {
                        unset($cart_data[$keys]);
                        $item_data = json_encode($cart_data);
                    }
                    return redirect('/out-transactions')->withCookie('stock_cart', $item_stock_data, time() + (86400 * 30), '/out-transactions')->withCookie('shopping_cart', $item_data, time() - 3600, '/out-transactions')->with('status', 'Berhasil mengosongkan keranjang');
                } else {
                    return redirect('/out-transactions')->with('gagal', 'Keranjang kosong');

                }
            } else {
                return redirect('/out-transactions')->with('gagal', 'Keranjang kosong');

            }

//            dd($item_data);
        }
    }
}
