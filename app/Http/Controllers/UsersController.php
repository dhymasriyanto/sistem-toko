<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use App\User;
//use App\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
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
        $users = DB::table('users')
        // ->join('groups','users.id_grup','=','groups.id')
        ->get(
            array(
                'users.id',
                'name',
                'username',
                'level_akses',
                // 'nama_grup'
            )
        );

//        dd($users);
//        $users = User::all();
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
        // $groups = Group::all();
        // return view('users.create', compact('groups'));
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
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

//        $old = $request->old_password;
//        $oldest = Auth::user()->password;
//        $check = Hash::check($old, $oldest);
        $new = $request->password;
        $conf = $request->password_confirmation;
        $truth = $new == $conf;
        if ($truth) {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'unique:users'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                // 'id_grup' => 'required',
                'level_akses' => 'required',
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            User::create([
                'name' => $request['name'],
//            'email' => $data['email'],
                'username' => $request['username'],
                // 'id_grup' => $request['id_grup'],
                'level_akses' => $request['level_akses'],
                'password' => Hash::make($request['password']),
            ]);

        }else{
            return redirect('/users/')->with('gagal', 'Data gagal ditambah, konfirmasi password tidak sama');
        }

        return redirect('/users')->with('status', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
//        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $old = $request->old_password;
        $new = $request->password;
        $conf = $request->password_confirmation;
        $oldest = $user->password;
        $check = Hash::check($old, $oldest);
        $truth = $new == $conf;
//        dd($truth, $check, $oldest, $old, $new, $conf);
        if (isset($new)&& isset($old) && isset($conf)) {
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
                        'password' => ['required', 'string', 'min:8', 'confirmed']
                    ]);

                    User::where('id', $user->id)
                        ->update([
//                    'name' => $request['name'],
//            'email' => $data['email'],
//                    'username' => $request['username'],
//                    'level_akses' => $request['level_akses'],
                            'password' => Hash::make($request['password']),
                        ]);
                } else {
                    return redirect('/users/' . $user->id . '/edit')->with('gagal', 'Data gagal diubah, konfirmasi password tidak sama');
                }
            } else {
                return redirect('/users/' . $user->id . '/edit')->with('gagal', 'Data gagal diubah, pastikan anda ingat password lama anda');
            }
        }
        else if (isset($request->username)){

            $uname = $request->username;
            $udata = $user->username;
            $checkuname = $uname == $udata;
            if ($checkuname) {
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'username' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    // 'id_grup' => 'required',
                    'level_akses' => 'required',
//                'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]);

                User::where('id', $user->id)
                    ->update([
                        'name' => $request['name'],
//            'email' => $data['email'],
                        'username' => $request['username'],
                        // 'id_grup' => $request['id_grup'],
                        'level_akses' => $request['level_akses'],
//                    'password' => Hash::make($request['password']),
                    ]);
            } else {
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'username' => ['required', 'string', 'max:255', 'unique:users'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    // 'id_grup' => 'required',
                    'level_akses' => 'required',
//                'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]);

                User::where('id', $user->id)
                    ->update([
                        'name' => $request['name'],
//            'email' => $data['email'],
                        'username' => $request['username'],
                        // 'id_grup' => $request['id_grup'],
                        'level_akses' => $request['level_akses'],
//                    'password' => Hash::make($request['password']),
                    ]);
            }

        }else{
            return redirect('/users/' . $user->id . '/edit')->with('gagal', 'Data gagal diubah, password tidak boleh kosong');
        }
        return redirect('/users')->with('status', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/users')->with('status', 'Data berhasil dihapus');
    }
}
