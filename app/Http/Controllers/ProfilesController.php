<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilesController extends Controller
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
            return redirect('/profiles/' . Auth::user()->id . '/edit');
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
//        dd($profile->id);
        $old = $request->old_password;
        $new = $request->password;
        $conf = $request->password_confirmation;
        $oldest = Auth::user()->password;
        $check = Hash::check($old, $oldest);
        $truth = $new == $conf;
        $uname= $request->username;
        $user=Auth::user()->username;
        $ucheck = $uname == $user;
//        dd($truth, $check, $oldest, $old, $new, $conf);
        if (isset($new)) {
//            dd($new);

            if ($check) {
//                dd($check);
                if ($truth) {
//                    dd($truth, $check, $oldest, $old, $new, $conf);
//                    dd($truth);
                    $request->validate([
//                'name' => ['required', 'string', 'max:255'],
//                'username' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//                'level_akses' => 'required',
                        'password' => ['required', 'string', 'min:8', 'confirmed'],
//                        'old_password' => ['required', 'string', 'min:8', 'confirmed'],
//                        'password_confirmation' => ['required', 'string', 'min:8', 'confirmed'],
                    ]);

                    User::where('id', $profile->id)
                        ->update([
//                    'name' => $request['name'],
//            'email' => $data['email'],
//                    'username' => $request['username'],
//                    'level_akses' => $request['level_akses'],
                            'password' => Hash::make($request['password']),
                        ]);
                } else {
                    return redirect('/profiles/' . Auth::user()->id.'/edit')->with('gagal', 'Data gagal diubah, konfirmasi password tidak sama');

                }
            }else{
                return redirect('/profiles/' . Auth::user()->id.'/edit')->with('gagal', 'Data gagal diubah, pastikan anda ingat password lama anda');
            }

        } else {
            if ($ucheck){
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'username' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'level_akses' => 'required',
//                'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]);

                User::where('id', $profile->id)
                    ->update([
                        'name' => $request['name'],
//            'email' => $data['email'],
                        'username' => $request['username'],
                        'level_akses' => $request['level_akses'],
//                    'password' => Hash::make($request['password']),
                    ]);
            }else{
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'username' => ['required', 'string', 'max:255', 'unique:users'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'level_akses' => 'required',
//                'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]);

                User::where('id', $profile->id)
                    ->update([
                        'name' => $request['name'],
//            'email' => $data['email'],
                        'username' => $request['username'],
                        'level_akses' => $request['level_akses'],
//                    'password' => Hash::make($request['password']),
                    ]);
            }

        }


//        User::where('id', $profile->id)
//            ->update([
//                'name' => $request['name'],
////            'email' => $data['email'],
//                'username' => $request['username'],
//                'level_akses' => $request['level_akses'],
//                'password' => Hash::make($request['password']),
//            ]);
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
