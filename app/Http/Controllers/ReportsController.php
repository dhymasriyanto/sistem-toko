<?php

namespace App\Http\Controllers;

use App\History;
use App\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
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
        $histories = History::all();
//        dd($history);

//        $histories = DB::table('transactions')
//            ->where(DB::raw('year(tanggal_transaksi)'),'2018')
//            ->groupBy(DB::raw('year(tanggal_transaksi)'))
//            ->get();

//        dd($histories);

//        foreach ($histories as $history)
//        {
////         dd($histories->tanggal_transaksi);
//        }

        $dataTahun = [];
        $dataBulan = [];

        foreach ($histories as $history) {
            $dataBulan[substr($history->tanggal_transaksi, 5, 2)][] = $history->tanggal_transaksi;
            $dataTahun[substr($history->tanggal_transaksi, 0, 4)][] = substr($history->tanggal_transaksi, 5, 2);
        }
//              foreach($dataTahun as $index => $histories){
//        }
//        dd($dataTahun, $dataBulan);
        return view('reports.index', compact('histories'),compact('dataTahun', 'dataBulan'));
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
     * @param \App\Report $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Report $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Report $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Report $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
