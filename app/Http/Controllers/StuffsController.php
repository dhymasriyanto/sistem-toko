<?php

namespace App\Http\Controllers;

use App\Stuff;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StuffsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stuffs = DB::table('stuffs')
            ->join('categories','stuffs.id_kategori', '=', 'categories.id')
            ->join('units','stuffs.id_satuan','=','units.id')
            ->get(array(
                'stuffs.id',
                'nama_barang',
                'nama_kategori',
                'nama_satuan',
                'harga',
                'jumlah_stok'
            ));

        return view('stuffs.index', compact('stuffs'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stuff  $stuff
     * @return \Illuminate\Http\Response
     */
    public function show(Stuff $stuff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stuff  $stuff
     * @return \Illuminate\Http\Response
     */
    public function edit(Stuff $stuff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stuff  $stuff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stuff $stuff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stuff  $stuff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stuff $stuff)
    {
        //
    }
}
