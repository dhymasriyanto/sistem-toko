<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/profiles/' . Auth::user()->id);
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
     * @param \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function show(User $profile)
    {
        if (Auth::user()->id == $profile->id) {
            return view('profiles.show', compact('profile'));
        } else {
            return redirect('/profiles');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(User $profile)
    {
        if (Auth::user()->id == $profile->id) {
            return view('profiles.edit', compact('profile'));
        } else {
            return redirect('/profiles/'.Auth::user()->id.'/edit');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $profile)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'level_akses' => 'required',
//            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        User::where('id', $profile->id)
            ->update([
                'name' => $request['name'],
//            'email' => $data['email'],
                'username' => $request['username'],
                'level_akses' => $request['level_akses'],
//                'password' => Hash::make($request['password']),
            ]);
        return redirect('/profiles/' . Auth::user()->id)->with('status', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}