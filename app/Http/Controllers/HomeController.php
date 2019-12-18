<?php

namespace App\Http\Controllers;

use App\DebtHistory;
use App\History;
use App\Stuff;
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

        foreach ($pengeluaran as $keluar) {
            foreach ($histories as $history => $data) {
                $result = $histories[$history]['total'] - $keluar->total;
                break;
            }
        }


        $utangs = DebtHistory::groupBy(DB::raw('YEAR(tanggal_transaksi)'))
            ->selectRaw('sum(total) as total')
            ->where(DB::raw('YEAR(tanggal_transaksi)'), '=', $tahun)->get();

//        dd($utangs);
        foreach ($utangs as $history => $data) {
            $utang = $utangs[$history]['total'];
            break;
        }
        $penjualan = History::all();
        $stuff = Stuff::all();
        return view('home', compact('hour', 'timezone', 'stuff', 'result', 'utang', 'penjualan'));
    }
}
