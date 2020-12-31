<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;

class GroupsController extends Controller
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
        $groups = Group::all();

        return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('groups.create');
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
            'nama_grup' => ['required', 'string', 'max:255', 'unique:groups'],
        ]);

        Group::create([
            'nama_grup' => $request['nama_grup'],
        ]);
        return redirect('/groups')->with('status', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        return view('groups.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $gname= $request->nama_grup;
        $gdata = $group->nama_grup;
        $checkg = $gname == $gdata;

        if ($checkg){
            $request->validate([
                'nama_grup' => ['required', 'string', 'max:255'],
            ]);
            Group::where('id', $group->id)
                ->update([
                    'nama_grup' => $request['nama_grup'],
                ]);
        }else{
            $request->validate([
                'nama_grup' => ['required', 'string', 'max:255', 'unique:groups']
            ]);
            Group::where('id', $group->id)
                ->update([
                    'nama_grup' => $request['nama_grup'],
                ]);
        }

        return redirect('/groups')->with('status', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Group::destroy($id);
        return redirect('/groups')->with('status', 'Data berhasil dihapus');
    }
}
