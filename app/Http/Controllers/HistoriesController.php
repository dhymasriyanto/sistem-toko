<?php

namespace App\Http\Controllers;

use App\History;
use App\Stuff;
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
        $this->middleware(['auth','role:Karyawan']);
    }

    public function index()
    {
        $histories = DB::table('transactions')
            ->join('users', 'transactions.id_karyawan', '=', 'users.id')
            ->get(array(
                'transactions.id',
                'no_faktur',
                'tanggal_transaksi',
                'total',
                'name'
            ));
        $pengeluaran = DB::table('pengeluaran')
            ->join('users', 'pengeluaran.id_karyawan', '=', 'users.id')
            ->join('stuffs', 'pengeluaran.id_barang', '=', 'stuffs.id')
            ->join('categories', 'stuffs.id_kategori', '=', 'categories.id')
            ->join('units', 'stuffs.id_satuan', '=', 'units.id')
            ->get(array(
                'pengeluaran.id',
                'tanggal',
                'pengeluaran',
                'jumlah',
                'nama_barang',
                'harga',
                'name',
                'nama_satuan',
                'nama_kategori'
            ));
        return view('histories.index', compact('histories','pengeluaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(History $history)
    {
        return response(view('histories.edit'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

//        dd($request->kembalian);
        $request->validate([
            'id_karyawan' => ['required'],
            'id.*' => ['required'],
            'tanggal' => ['required'],
            'no_faktur' => ['required', 'unique:transactions'],
            'jml.*' => ['required', 'numeric'],
            'subtotal.*' => ['required', 'numeric'],
            'total' => ['required', 'numeric'],

        ]);
        History::create([
            'no_faktur' => $request['no_faktur'],
            'tanggal_transaksi' => $request['tanggal'],
            'total' => $request['total'],
            'id_karyawan' => $request['id_karyawan'],
            'uang' => $request['uang'],
            'kembalian' => $request['kembalian']
        ]);
        $no_fak = $request->no_faktur;
        $transaksi = DB::table('transactions')
            ->where('no_faktur', $no_fak)->get();
        foreach ($transaksi as $trans) {
            if ($trans->no_faktur == $no_fak) {
                $id_transaksi = $trans->id;
            }
        }
        $ids = $request->id;
        $subtotals = $request->subtotal;
        $jmls = $request->jml;

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
                'name',
                'uang',
                'kembalian'
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
        foreach ($hh as $h) {
//

            $id_barang = DB::table('stuffs')
                ->join('units', 'stuffs.id_satuan', 'units.id')
                ->join('categories', 'stuffs.id_kategori', 'categories.id')
                ->where('stuffs.id', $h->id_barang)
                ->get();


            foreach ($id_barang as $id) {
                $item_array = array(
                    'uang'=>$history->uang,
                    'kembalian'=>$history->kembalian,
                    'transaction_id' => $history->id,
                    'detail_id' => $h->id,
                    'item_id' => $h->id_barang,
                    'item_name' => $id->nama_barang,
                    'item_price' => $id->harga,
                    'item_quantity' => $h->jumlah_barang,
                    'item_unit' => $id->nama_satuan,
                    'item_category' => $id->nama_kategori,
                    'item_stock' => $id->jumlah_stok
                );
                $cart_data[] = $item_array;
            }

        }
        $stuffs = Stuff::all();
        foreach ($stuffs as $stuff) {
            $item_array = array(
                'transaction_id' => $history->id,
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
        $item_data = json_encode($cart_data);
        return redirect('/histories/create')->withCookie('stock_cart', $stock_item_data, time() + (86400 * 30), '/histories/create')->withCookie('shopping_cart', $item_data, time() + (86400 * 30), '/histories/create');

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
//        dd($request->id, $history);
        $request->validate([

            'id_karyawan' => ['required'],
            'id.*' => ['required'],
            'tanggal' => ['required'],
            'no_faktur' => ['required', 'unique:transactions'],
            'jml.*' => ['required', 'numeric'],
            'subtotal.*' => ['required', 'numeric'],
            'total' => ['required', 'numeric']

        ]);

        $ids = $request->id;
        $subtotals = $request->subtotal;
        $jmls = $request->jml;
        $transactions = $request->transaction_id;
        $details = $request->detail_id;
        $dt = DB::table('detail_transactions')->get();
        $idd = array();
        $k = 0;
        foreach ($dt as $d) {
            $idd[$k] = $d->id_barang;
            $detaill[$k] = $d->id;
            $trans[$k] = $d->id_transaksi;
            $jumlahh[$k] = $d->jumlah_barang;
            $k++;


        }
        for ($i = 0; $i < count($ids); $i++) {
            $id = $ids[$i];
            $subtotal = $subtotals[$i];
            $jml = $jmls[$i];
            $transaction = $transactions[$i];
            $detail = $details[$i];


            if ($i == 0) {
                DB::table('detail_transactions')->where('id_transaksi', $transaction)->delete();
            }
//
//

            DB::table('detail_transactions')->insert([
                'jumlah_barang' => $jml,
                'harga' => $subtotal,
                'id_barang' => $id,
                'id_transaksi' => $transaction
            ]);


            History::where('id', $transaction)->update([
                'id_karyawan' => $request['id_karyawan'],
                'total' => $request['total'],
                'uang'=> $request['uang'],
                'kembalian'=> $request['kembalian']
            ]);
        }


        return redirect('/histories/' . $transaction)->withCookie('shopping_cart', "[]", time() - 360, '/histories/create')->with('status', 'Transaksi berhasil');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\History $history
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request, Stuff $history)
    {
        $cookie_data2 = stripslashes($_COOKIE['stock_cart']);
        $aaa = Crypt::decryptString($cookie_data2);
        $stock_data = json_decode($aaa, true);
        foreach ($stock_data as $keys => $values) {
            if ($stock_data[$keys]["item_id"] == $request->id_barang) {

                $stock_data[$keys]['item_stock'] += $request->jumlah;
            } else {
                $jumlah = $request->jumlah;
                $id_barang = $request->id_barang;
                for ($i = 0; $i < count($id_barang); $i++) {
                    $id = $id_barang[$i];
                    $jml = $jumlah[$i];
                    if ($stock_data[$keys]["item_id"] == $id) {
                        $stock_data[$keys]['item_stock'] += $jml;
                    }
                }
            }
        }
        $item_stock_data = json_encode($stock_data);
        $request->id = $history->id;
        if (isset($request->id)) {
            $cookie_data = stripslashes($_COOKIE['shopping_cart']);
            $aa = Crypt::decryptString($cookie_data);
            $cart_data = json_decode($aa, true);

            foreach ($cart_data as $keys => $values) {
                if ($cart_data[$keys]['item_id'] == $request->id) {
                    unset($cart_data[$keys]);
                    $item_data = json_encode($cart_data);
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
                    return redirect('/histories/create')->withCookie('stock_cart', $item_stock_data, time() + (86400 * 30), '/histories/create')->withCookie('shopping_cart', $item_data, time() - 3600, '/histories/create')->with('status', 'Berhasil mengosongkan keranjang');
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
//        dd($request->transaction_id);
        $cookie_data2 = stripslashes($_COOKIE['stock_cart']);
        $aaa = Crypt::decryptString($cookie_data2);
        $stock_data = json_decode($aaa, true);
        foreach ($stock_data as $keys => $values) {
            if ($stock_data[$keys]["item_id"] == $request->id_barang) {
                $tmp = $stock_data[$keys]['item_stock'];
                $trans = $stock_data[$keys]['transaction_id'];
                $stock_data[$keys]['item_stock'] -= $request->jumlah;


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
        $detail_id_list = array_column($cart_data, 'detail_id');
        $transaction_id_list = array_column($cart_data, 'transaction_id');

        if ($request->jumlah > $tmp) {
            return redirect('/histories/create')->with('gagal', 'Permintaan melebihi jumlah stok gudang');
        } elseif ($request->jumlah == 0) {
            return redirect('/histories/create')->with('gagal', 'Permintaan tidak boleh kosong');
        }
        if ((in_array($request->id_barang, $item_id_list))) {
            foreach ($cart_data as $keys => $values) {
                if ($cart_data[$keys]["item_id"] == $request->id_barang) {
                    if (($cart_data[$keys]['item_stock'] <= 0)) {
                        return redirect('/histories/create')->with('gagal', 'Stok Habis');
                    } elseif (($cart_data[$keys]['item_stock'] < $request->jumlah)) {
                        return redirect('/histories/create')->with('gagal', 'Permintaan akan melebihi jumlah stok gudang');
                    } else {
                        $cart_data[$keys]['item_stock'] = $tmp - $request->jumlah;
                        $cart_data[$keys]['transaction_id'] = $trans;
                        $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $request->jumlah;

                    }

                }
            }
        } else {
            $item_array = array(
                'transaction_id' => $trans,
                'detail_id' => null,
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
        return redirect('/histories/create')->withCookie('stock_cart', $item_stock_data, time() + (86400 * 30), '/histories/create')->withCookie('shopping_cart', $item_data, time() + (86400 * 30), '/histories/create')->with('status', 'Berhasil masuk ke keranjang');
    }
}
