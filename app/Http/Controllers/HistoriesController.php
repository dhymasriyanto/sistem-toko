<?php

namespace App\Http\Controllers;

use App\History;
use App\Stuff;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
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
//        dd($stock_data);
        return response(view('histories.edit', compact('stock_data', 'stuffs')));
//        dd('wew');
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
            'no_faktur' => ['required', 'unique:transactions'],
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
        $ids = $request->id;
        $subtotals = $request->subtotal;
        $jmls = $request->jml;
//        dd($ids,$subtotals,$jmls);

        for ($i = 0; $i < count($ids); $i++) {
            $id = $ids[$i];
            $subtotal = $subtotals[$i];
            $jml = $jmls[$i];

//            dump($id, $subtotal, $jml);
            DB::table('detail_transactions')->insert([
                'jumlah_barang' => $jml,
                'harga' => $subtotal,
                'id_barang' => $id,
                'id_transaksi' => $id_transaksi
            ]);
            DB::table('stuffs')->where('id', $id)->decrement('jumlah_stok', $jml);
        }
//            dump($request[$keys]['id']);
//

//        dd('ab');
//        die;

        return redirect('/histories/' . $id_transaksi)->withCookie('shopping_cart', "[]", time() - 360, '/histories/create')->with('status', 'Transaksi berhasil');
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

        $hh = DB::table('detail_transactions')->where('id_transaksi', $history->id)->get();
//        dump($history->id);

//        $id_barang2 = DB::table('stuffs')
//            ->join('units', 'stuffs.id_satuan', 'units.id')
//            ->join('categories', 'stuffs.id_kategori', 'categories.id')
//            ->get();
//        dump($id_barang2);
        foreach ($hh as $h) {
//
            $id_barang = DB::table('stuffs')
                ->join('units', 'stuffs.id_satuan', 'units.id')
                ->join('categories', 'stuffs.id_kategori', 'categories.id')
                ->where('stuffs.id', $h->id_barang)
                ->get();


            foreach ($id_barang as $id) {
                $item_array = array(
                    'item_id' => $h->id_barang,
                    'item_name' => $id->nama_barang,
                    'item_price' => $h->harga,
                    'item_quantity' => $h->jumlah_barang,
                    'item_unit' => $id->nama_satuan,
                    'item_category' => $id->nama_kategori,
                    'item_stock' => $id->jumlah_stok
                );
//                dd($h->id_barang);
                $cart_data[] = $item_array;
            }

        }
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

//foreach ($stock_data as $stock =>  $values){
//    dump($stock_data[$stock]['item_id']);
//}
//die;
        $stock_item_data = json_encode($stock_data);
//dd($stock_data);
        $item_data = json_encode($cart_data);
//
//        dump($item_data,$history->id);
////////
////////        $cart_data[] = $item_array;
//        die;
//        $response = new \Illuminate\Http\Response(view('histories.edit', compact('stuffs')));
//         $response->withCookie('shopping_cart', $item_data, time() + (86400 * 30),'/histories/'.$history->id.'/edit');
//         return $response;
//        $cookie=Cookie::make('shopping_cart', $item_data, time() + (86400 * 30),'/histories/'.$history->id.'/edit');
//         cookie('shopping_cart', $item_data, time() + (86400 * 30),'/histories/'.$history->id.'/edit');
//        return response(view('histories.edit', compact('stuffs')))->cookie(Cookie::make('shopping_cart', $item_data, time() + (86400 * 30),'/histories/'.$history->id.'/edit'));
        return redirect('/histories/create')->withCookie('stock_cart', $stock_item_data, time() + (86400 * 30), '/histories/create')->withCookie('shopping_cart', $item_data, time() + (86400 * 30), '/histories/create');
//                  return view('histories.edit', compact('stuffs'))->withCookie('shopping_cart', $item_data, time() + (86400 * 30),'/histories/'.$history->id.'/edit');
//        return view('histories.edit',compact('stuffs'));

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

    public function destroy(Request $request, Stuff $history)
    {
//        dd($history->id);
        //
        $cookie_data2 = stripslashes($_COOKIE['stock_cart']);
        $aaa = Crypt::decryptString($cookie_data2);
        $stock_data = json_decode($aaa, true);
        foreach ($stock_data as $keys => $values) {
            if ($stock_data[$keys]["item_id"] == $request->id_barang) {

                $stock_data[$keys]['item_stock'] += $request->jumlah;
//                dd($stock_data[$keys]['item_stock']);
            }else{
                $stock_data[$keys]['item_stock'] += $request->jumlah;
//                dump($stock_data[$keys]['item_stock']);
            }
        }
//        die;
//        dd($tmp);
        $item_stock_data = json_encode($stock_data);
//dd($item_stock_data);
        $request->id = $history->id;
//        $jmlh=$history->jumlah_stok;
//        $id = $history->id;
//        dd(isset($request->id));
        //script baru dari sini
//        dd($history->nama_barang);
        $stock_data = array();
        if (isset($request->id)) {
//            dd($_COOKIE['shopping_cart']);
            $cookie_data = stripslashes($_COOKIE['shopping_cart']);
            $aa = Crypt::decryptString($cookie_data);
            $cart_data = json_decode($aa, true);

//            $item_array = array(
//                'item_id'=>$history->id,
//                'item_name' => $history->nama_barang,
//                'item_quantity' => $request->jumlah,
//                'item_stock' => $history->jumlah_stok
//            );
//            $stock_data[] = $item_array;
//            $stock_item_data = json_encode($stock_data);

//            dd($stock_item_data);
            foreach ($cart_data as $keys => $values) {
                if ($cart_data[$keys]['item_id'] == $request->id) {
//                    dd($request->jumlah_stok, $cart_data[$keys]['item_stock'] +$cart_data[$keys]['item_quantity']);
//                    $jmlh= $cart_data[$keys]['item_quantity'];
                    unset($cart_data[$keys]);
                    $item_data = json_encode($cart_data);
//                setcookie("shopping_cart", $item_data, time() + (86400 * 30));
//                header("location:index.php?remove=1");
//dd($jmlh );
//                    Stuff::where('id', $history->id)
//                        ->increment(
//                            'jumlah_stok', $jmlh
//                        );\

//                    dd($id);


//                    return redirect('/histories/create')->with(compact('jmlh','id'))->withCookie('shopping_cart', $item_data, time() + (86400 * 30), '/histories/create')->with('status', 'Berhasil dikeluarkan dari keranjang');
                }
            }

            return redirect('/histories/create')->withCookie('stock_cart', $item_stock_data, time() + (86400 * 30), '/histories/create')->with('status', 'Berhasil dikeluarkan dari keranjang')->withCookie('shopping_cart', $item_data, time() + (86400 * 30), '/histories/create')->with('status', 'Berhasil dikeluarkan dari keranjang');

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
//                    dd($item_stock_data);
                    return redirect('/histories/create')->withCookie('shopping_cart', $item_data, time() - 3600, '/histories/create')->with('status', 'Berhasil mengosongkan keranjang');
                } else {
                    return redirect('/histories/create')->with('gagal', 'Keranjang kosong');

                }
            } else {
                return redirect('/histories/create')->with('gagal', 'Keranjang kosong');

            }

        }
    }

    public function keranjang(Request $request)
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
//        dd($tmp);

        $request->validate([
            'id_barang' => ['required'],
            'jumlah' => ['required', 'numeric']
        ]);
        $stuffs = DB::table('stuffs')
            ->join('units', 'stuffs.id_satuan', 'units.id')
            ->join('categories', 'stuffs.id_kategori', 'categories.id')
            ->where('stuffs.id', $request->id_barang)
            ->get();

//        dd($stock_data[$keys]["item_id"] );
//
//        die;
        foreach ($stuffs as $stuff) {
            $nama_barang = $stuff->nama_barang;
            $harga_barang = $stuff->harga;
            $satuan = $stuff->nama_satuan;
            $kategori = $stuff->nama_kategori;
            $stok = $stuff->jumlah_stok;
        }
//dd($stok);
        $value = $request->cookie('shopping_cart');
        if (isset($value)) {
            $cookie_data = stripslashes($_COOKIE['shopping_cart']);
            $aa = Crypt::decryptString($cookie_data);
            $cart_data = json_decode($aa, true);

        } else {
            $cart_data = array();
        }
//        dd($stock_data);
//        dd($cart_data);
        $item_id_list2 = array_column($stock_data, 'item_id');
//        dd($request->id_barang);
//        if ((in_array($request->id_barang, $item_id_list2))) {
//            foreach ($stock_data as $keys => $values) {
//                $stock_data[$keys]['item_stock'];            }
//        }
        $item_id_list = array_column($cart_data, 'item_id');
//                $a=$stuff->jumlah_stok-$request->jumlah;
        if ($request->jumlah > $tmp) {
            return redirect('/histories/create')->with('gagal', 'Permintaan melebihi jumlah stok gudang');
        } elseif ($request->jumlah == 0) {
            return redirect('/histories/create')->with('gagal', 'Permintaan tidak boleh kosong');
        }
        if ((in_array($request->id_barang, $item_id_list))) {
//                        dd($tmp);
            foreach ($cart_data as $keys => $values) {
//                dd($a);\
                if ($cart_data[$keys]["item_id"] == $request->id_barang) {
                    if (($cart_data[$keys]['item_stock'] <= 0)) {
                        return redirect('/histories/create')->with('gagal', 'Stok Habis');
                    } elseif (($cart_data[$keys]['item_stock'] < $request->jumlah)) {
                        return redirect('/histories/create')->with('gagal', 'Permintaan akan melebihi jumlah stok gudang');
                    } else {
//                        dd($request->id_barang);
//                        dd($cart_data[$keys]['item_stock']);
//if ($tmp>)
                        $cart_data[$keys]['item_stock'] = $tmp - $request->jumlah;

                        $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $request->jumlah;

//                        dd($tmp);

//                        Stuff::where('id', $request->id_barang)
//                            ->decrement(
//                                'jumlah_stok', $request->jumlah
//                            );
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
//                dd($stock_data[$keys]['item_stock']);

        $item_data = json_encode($cart_data);
        $item_stock_data = json_encode($stock_data);
//dd($item_stock_data);
//dd($item_data);

//        dd($item_data);
        return redirect('/histories/create')->withCookie('stock_cart', $item_stock_data, time() + (86400 * 30), '/histories/create')->withCookie('shopping_cart', $item_data, time() + (86400 * 30), '/histories/create')->with('status', 'Berhasil masuk ke keranjang');
    }
}
