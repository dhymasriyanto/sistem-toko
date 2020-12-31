<?php

namespace App\Http\Controllers;

use App\Category;
use App\Unit;
use Illuminate\Http\Request;

class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth','role:Pemilik Toko']);
    }
    public function index()
    {
        $units = Unit::all();
        return view('units.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('units.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_satuan'=>['required', 'string', 'max:255']
        ]);
        Unit::create(
            [
                'nama_satuan'=>$request['nama_satuan']
            ]
        );
        return redirect('/units')->with('status', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        return view('units.edit',compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        $unitname = $request->nama_satuan;
        $unitdata = $unit->nama_satuan;
        $checkunit = $unitname == $unitdata;
        if ($checkunit){
            $request->validate([
                'nama_satuan'=>['required','string', 'max:255']
            ]);

            Unit::where('id', $unit->id)
                ->update([
                    'nama_satuan' => $request['nama_satuan'],

                ]);
        }else{
            $request->validate([
                'nama_satuan'=>['required','string', 'max:255','unique:units']
            ]);

            Unit::where('id', $unit->id)
                ->update([
                    'nama_satuan' => $request['nama_satuan'],

                ]);
        }


        return redirect('/units')->with('status', 'Data berhasil diubah');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        $unit = Unit::destroy($unit->id);
        return redirect('/units')->with('status', 'Data berhasil dihapus');
    }
}
