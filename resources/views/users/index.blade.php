@extends('layouts.app')

@section('title', 'Pengguna')

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
                    Daftar Pengguna
                </h1>
                <div class="card">
                    <div class="card-body">
                        <a href="/users/create" class="btn btn-primary my-3">Tambah</a>
                        <table class="table table-responsive table_id display">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Username</th>
                                <th scope="col">Level Akses</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td scope="row">{{$loop->iteration}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->username}}</td>
                                    <td>
                                        @if($user->level_akses=='Pemilik Toko')
                                        <span class="badge badge-primary">{{$user->level_akses}}</span>
                                            @elseif($user->level_akses=='Karyawan')
                                        <span class="badge badge-warning">{{$user->level_akses}}</span>
                                            @endif
                                    </td>
                                    <td>
                                        <a href="{{url('users/'.$user->id.'/edit')}}"><span
                                                class="btn btn-primary">Edit</span></a>
                                        <form action="/users/{{$user->id}}" method="post" class="d-inline">
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
