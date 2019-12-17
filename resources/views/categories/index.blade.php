@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12 col-lg-12">

                <h1 class="h3 mb-3">
                    Daftar Kategori
                </h1>
                <div class="card">
                    <div class="card-body">
                        <a href="/categories/create" class="btn btn-primary my-3"><span class="align-middle"><i data-feather="plus"></i></span><span class="ml-2 align-middle">Tambah</span></a>
                        <table class="table table-responsive table_id display">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Kategori</th>
                                <th scope="col" width="60%">Deskripsi</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{--@dd($categories)--}}
                            @foreach($categories as $category)
                                <tr>
                                    <td scope="row">{{$loop->iteration}}</td>
                                    <td>{{$category->nama_kategori}}</td>
                                    <td>{{$category->deskripsi}}</td>
                                    <td>
                                        <a  title="Edit data" href="{{url('categories/'.$category->id.'/edit')}}"><span
                                               ><i data-feather="edit"></i></span></a>

                                        <a  title="Hapus data" style="color: red" data-toggle="modal" data-target="#sizedModalSm{{$category->id}}">
                                            <span><i data-feather="trash"></i></span>
                                        </a>
{{--                                            <button type="button" class="btn btn-danger">Hapus</button>--}}
                                        <div class="modal fade" id="sizedModalSm{{$category->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"><span><i class="mr-2 align-middle" data-feather="info"></i></span><span
                                                                class="align-middle">Pengingat</span></h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body m-3">
                                                        <p class="mb-0">Yakin untuk menghapus {{$category->nama_kategori}}?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                        <form action="/categories/{{$category->id}}" method="post" class="d-inline">
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

{{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sizedModalSm">--}}
{{--    Small--}}
{{--</button>--}}


