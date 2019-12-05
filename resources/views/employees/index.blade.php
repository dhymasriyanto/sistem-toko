@extends('layouts.app')

@section('title', 'Karyawan')

@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12 col-lg-12">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <div class="alert-message">
                            {{ session('status') }}

                        </div>
                    </div>
                @endif
                <h1 class="h3 mb-3">
                    Daftar Karyawan
                </h1>
                <div class="card">
                    <div class="card-body">
                        <a href="/employees/create" class="btn btn-primary my-3">Tambah</a>
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Depan</th>
                                <th scope="col">Nama Belakang</th>
                                <th scope="col">Tanggal Lahir</th>
                                <th scope="col">Tempat Lahir</th>
                                <th scope="col">Nomer HP</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$employee->nama_depan}}</td>
                                    <td>{{$employee->nama_belakang}}</td>
                                    <td>{{$employee->tempat_lahir}}</td>
                                    <td>{{$employee->tanggal_lahir}}</td>
                                    <td>{{$employee->nomer_hp}}</td>
                                    <td>
                                        <a href="{{url('employees/'.$employee->id.'/edit')}}"><span
                                                class="btn btn-primary">Edit</span></a>
                                        <form action="/employees/{{$employee->id}}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
