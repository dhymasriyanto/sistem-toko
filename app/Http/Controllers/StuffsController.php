<?php

namespace App\Http\Controllers;

use App\Category;
use App\Stuff;
use App\Unit;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        return view('stuffs.index', compact('stuffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::all();
        $units = Unit::all();
        return view('stuffs.create', compact('categories'), compact('units'));
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
            'nama_barang' => ['required', 'string', 'max:255'],
            'jumlah_stok' => ['required'],
            'harga' => ['required'],
            'id_kategori' => ['required'],
            'id_satuan' => 'required',
        ]);

        Stuff::create([
            'nama_barang' => $request['nama_barang'],
            'jumlah_stok' => $request['jumlah_stok'],
            'harga' => $request['harga'],
            'id_kategori' => $request['id_kategori'],
            'id_satuan' => $request['id_satuan'],
        ]);
        return redirect('/stuffs')->with('status', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Stuff $stuff
     * @return \Illuminate\Http\Response
     */
    public function show(Stuff $stuff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Stuff $stuff
     * @return \Illuminate\Http\Response
     */
    public function edit(Stuff $stuff)
    {
        $categories = Category::all();
        $units = Unit::all();
        return view('stuffs.edit', compact('stuff', 'categories', 'units'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Stuff $stuff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stuff $stuff)
    {
        $request->validate([
            'nama_barang' => ['required', 'string', 'max:255'],
            'jumlah_stok' => ['required'],
            'harga' => ['required'],
            'id_kategori' => ['required'],
            'id_satuan' => 'required',
        ]);

        Stuff::where('id', $stuff->id)
        ->update([
            'nama_barang' => $request['nama_barang'],
            'jumlah_stok' => $request['jumlah_stok'],
            'harga' => $request['harga'],
            'id_kategori' => $request['id_kategori'],
            'id_satuan' => $request['id_satuan'],
        ]);
        return redirect('/stuffs')->with('status', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Stuff $stuff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stuff $stuff)
    {
        Stuff::destroy($stuff->id);
        return redirect('/stuffs')->with('status', 'Data berhasil dihapus');
    }
}
