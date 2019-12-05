<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;


class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
//        return view('employees.index', ['employees'=>$employees]);
//        boleh juga gini
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $employees = new Employee();
//
//        $employees->nama = $request->nama;
//        $employees->tanggal_lahir = $request->tanggal_lahir;
//        $employees->tempat_lahir = $request->tempat_lahir;
//        $employees->jabatan = $request->jabatan;
//        $employees->save();

//        Employee::create([
//            'nama'=>$request->nama,
//            'tanggal_lahir'=>$request->tanggal_lahir,
//            'tempat_lahir'=>$request->tempat_lahir,
//            'jabatan'=>$request->jabatan
//        ]);

        $request->validate([
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'tanggal_lahir' => 'required',
            'tempat_lahir' => 'required',
            'nomer_hp' => 'required',
        ]);

        Employee::create($request->all());
        return redirect('/employees')->with('status', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'nama_depan' => 'required',
            'nama_belakang',
            'tanggal_lahir' => 'required',
            'tempat_lahir' => 'required',
            'nomer_hp'
        ]);
        Employee::where('id', $employee->id)
            ->update([
                'nama_depan'=> $request->nama_depan,
                'nama_belakang'=> $request->nama_belakang,
                'tanggal_lahir' => $request->tanggal_lahir,
                'tempat_lahir' => $request->tempat_lahir,
                'nomer_hp' => $request->nomer_hp
            ]);
        return redirect('/employees')->with('status', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        Employee::destroy($employee->id);
        return redirect('/employees')->with('status', 'Data berhasil dihapus');
    }
}
