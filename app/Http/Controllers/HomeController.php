<?php

namespace App\Http\Controllers;

use App\DebtHistory;
use App\History;
use App\Stuff;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        $hour = new DateTime();
        $timezone = date_default_timezone_set('Asia/Jakarta');
        $hour = date('H');
        $tahun = date("Y");

        $histories = History::groupBy(DB::raw('YEAR(tanggal_transaksi)'))
            ->selectRaw('sum(total) as total')
            ->where(DB::raw('YEAR(tanggal_transaksi)'), '=', $tahun)->get();
        $pengeluaran = DB::table('pengeluaran')->groupBy(DB::raw('YEAR(tanggal)'))
            ->selectRaw('sum(pengeluaran) as total')
            ->where(DB::raw('YEAR(tanggal)'), '=', $tahun)->get();


        $result = 0;
        if (isset($histories)) {
            foreach ($histories as $history => $data) {
                $result = $histories[$history]['total'];
            }
        }

        if (isset($pengeluaran)){
            foreach ($pengeluaran as $keluar) {
                $result -= $keluar->total;
            }
        }


    //    foreach ($histories as $history => $data) {
    //        foreach ($pengeluaran as $keluar) {
    //            $result = $histories[$history]['total'] - $keluar->total;
    //            break;
    //        }
    //    }
        $utang= null;

        $utangs = DebtHistory::groupBy(DB::raw('YEAR(tanggal_transaksi)'))
            ->selectRaw('sum(total) as total')
            ->where(DB::raw('YEAR(tanggal_transaksi)'), '=', $tahun)->get();

//        dd($utangs);
        foreach ($utangs as $history => $data) {
            $utang = $utangs[$history]['total'];
            break;
        }
        $pembelian = DB::table('pengeluaran');
        $penghutang = DB::table('debtors')->get();
        $karyawan = User::all()->where('username','<>' ,'admin');
        $penjualan = History::all();
        $stuff = Stuff::all();
        return view('home', compact('hour', 'timezone', 'stuff', 'result', 'utang', 'penjualan','pengeluaran','karyawan','penghutang'));
    }
}
