<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
//use App\Employee;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
//        return view('users.index', ['users'=>$users]);
//        boleh juga gini
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $users = new Employee();
//
//        $users->nama = $request->nama;
//        $users->tanggal_lahir = $request->tanggal_lahir;
//        $users->tempat_lahir = $request->tempat_lahir;
//        $users->jabatan = $request->jabatan;
//        $users->save();

//        Employee::create([
//            'nama'=>$request->nama,
//            'tanggal_lahir'=>$request->tanggal_lahir,
//            'tempat_lahir'=>$request->tempat_lahir,
//            'jabatan'=>$request->jabatan
//        ]);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'level_akses' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $request['name'],
//            'email' => $data['email'],
            'username' => $request['username'],
            'level_akses' => $request['level_akses'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect('/users')->with('status', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'level_akses' => 'required',
//            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        User::where('id', $user->id)
            ->update([
                'name' => $request['name'],
//            'email' => $data['email'],
                'username' => $request['username'],
                'level_akses' => $request['level_akses'],
//                'password' => Hash::make($request['password']),
            ]);
        return redirect('/users')->with('status', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/users')->with('status', 'Data berhasil dihapus');
    }
}
