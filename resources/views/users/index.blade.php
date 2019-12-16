@extends('layouts.app')

@section('title', 'Pengguna')

@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12 col-lg-12">

                <h1 class="h3 mb-3">
                    Daftar Pengguna
                </h1>
                <div class="card">
                    <div class="card-body">
                        <a href="/users/create" class="btn btn-primary my-3" ><span class="align-middle"><i data-feather="plus"></i></span><span class="ml-2 align-middle">Tambah</span></a>
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
                                        <a  title="Edit data" href="{{url('users/'.$user->id.'/edit')}}"><span
                                               ><i data-feather="edit"></i></span></a>

                                        <a style="color: red" data-toggle="modal" title="Hapus data" data-target="#sizedModalSm{{$user->id}}">
                                            <i data-feather="trash"></i>
                                        </a>
                                        {{--                                            <button type="button" class="btn btn-danger">Hapus</button>--}}
                                        <div class="modal fade" id="sizedModalSm{{$user->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Warning!</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body m-3">
                                                        <p class="mb-0">Yakin untuk menghapus {{$user->name}}?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                        <form action="/users/{{$user->id}}" method="post" class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="btn btn-danger">Yakin</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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
