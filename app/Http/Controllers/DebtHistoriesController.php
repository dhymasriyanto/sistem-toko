<?php

namespace App\Http\Controllers;

use App\DebtHistory;
use App\History;
use App\Stuff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $this->middleware(['auth','role:Karyawan']);
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
        $date = date("Y-m-d", strtotime($request->tenggat));

        $request->validate([
            'id_karyawan' => ['required'],
            'id.*' => ['required'],
            'tanggal' => ['required'],
            'no_faktur' => ['required','unique:debt_transactions'],
            'jml.*' => ['required', 'numeric'],
            'subtotal.*' => ['required', 'numeric'],
            'total' => ['required', 'numeric'],
            'nama_penghutang' => ['required'],
            'nomer_ktp'=>['required','numeric','unique:debtors'],
            'nomer_hp'=>['required','numeric','unique:debtors'],
            'alamat'=>['required'],
            'tenggat'=>['required']
        ]);

        DB::table('debtors')->insert([
            'nama_penghutang'=>$request->nama_penghutang,
            'nomer_ktp'=>$request->nomer_ktp,
            'nomer_hp'=>$request->nomer_hp,
            'alamat'=>$request->alamat,
        ]);

        $penghutangs =DB::table('debtors')->where('nomer_ktp', $request->nomer_ktp)->get();

        foreach ($penghutangs as $penghutang){
            if ($request->nomer_ktp == $penghutang->nomer_ktp){
                $id_penghutang= $penghutang->id;
            }
        }
        $hutang=DebtHistory::create([
            'no_faktur' => $request->no_faktur,
            'tanggal_transaksi' => $request['tanggal'],
            'tenggat_hutang'=>$date,
            'total' => $request['total'],
            'id_karyawan' => $request['id_karyawan'],
            'id_penghutang'=>$id_penghutang,
            'telah_bayar'=>$request->dp,
            'sisa'=>$request->sisa
        ]);
        $no_fak = $request->no_faktur;
        $transaksi = DB::table('debt_transactions')
            ->where('no_faktur', $no_fak)->get();
        foreach ($transaksi as $trans) {
            if ($trans->no_faktur == $no_fak) {
                $id_transaksi = $trans->id;
            }
        }
        $ids=$request->id;
        $subtotals=$request->subtotal;
        $jmls = $request->jml;

        for ($i = 0; $i< count($ids);$i++) {
            $id = $ids[$i];
            $subtotal = $subtotals[$i];
            $jml = $jmls[$i];

            DB::table('detail_debt_transactions')->insert([
                'jumlah_barang' => $jml,
                'harga' => $subtotal,
                'id_barang' => $id,
                'id_transaksi_hutang' => $id_transaksi
            ]);
            DB::table('stuffs')->where('id', $id)->decrement('jumlah_stok', $jml);
        }
        return redirect('/debt-histories/'.$id_transaksi)->withCookie('shopping_cart',"[]",time()-360,'/out-transactions')->with('status', 'Transaksi berhasil');

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
                'alamat',
                'telah_bayar',
                'sisa'
            ));
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
        return view('debt-histories.show', compact('detailDebtHistories'),compact('debtHistories','debtHistory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DebtHistory  $debtHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(DebtHistory $debtHistory)
    {
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
//dd($debtHistory->kembalian);
        DebtHistory::where('id',$debtHistory->id)->update([
            'telah_bayar'=>$debtHistory->telah_bayar+$request->dp,
            'sisa'=>$request->sisa
        ]);

        if ($request->sisa == 0){
            $a=History::create([
                'no_faktur'=>$debtHistory->no_faktur,
                'tanggal_transaksi'=>$request->tanggal,
                'total'=>$debtHistory->total,
                'id_karyawan'=>$debtHistory->id_karyawan,
                'uang'=>$debtHistory->telah_bayar+$request->dp,
                'kembalian'=>$request->kembalian
            ]);
//            dd($a->id);
            $post = DB::table('detail_debt_transactions')->where('id_transaksi_hutang',$debtHistory->id)->get();

            foreach ($post as $data){
                DB::table('detail_transactions')->insert([
                    'jumlah_barang'=>$data->jumlah_barang,
                    'harga'=>$data->harga,
                    'id_transaksi'=>$a->id,
                    'id_barang'=>$data->id_barang

                ]);
                DB::table('detail_debt_transactions')->where('id_transaksi_hutang',$data->id)->delete();
            }
            // get all Post attributes
//            $data = $post->attributesToArray();

            // remove name and price attributes
//            $data = array_except($data, ['name', 'price']);
            // create new Order based on Post's data
//            $order = Order::create($data);
            DB::table('debtors')->where('id', $debtHistory->id_penghutang)->delete();
            DebtHistory::destroy($debtHistory->id);
            return redirect('/histories/')->withCookie('shopping_cart',"[]",time()-360,'/out-transactions')->with('status', 'Transaksi berhasil');

        }

        return redirect('/debt-histories/'.$debtHistory->id)->withCookie('shopping_cart',"[]",time()-360,'/out-transactions')->with('status', 'Transaksi berhasil');

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
