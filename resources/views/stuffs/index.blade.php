@extends('layouts.app')

@section('title', 'Persediaan')

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
                    Daftar Barang
                </h1>
                <div class="card">
                    <div class="card-body">
                        <a href="/stuffs/create" class="btn btn-primary my-3">Tambah</a>
                        <table class="table table-responsiven table_id display">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Jumlah Stok</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Harga per Satuan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{--@dd($stuffs)--}}
                            @foreach($stuffs as $stuff)
                                <tr>
                                    <td scope="row">{{$loop->iteration}}</td>
                                    <td>{{$stuff->nama_barang}}</td>
                                    <td>{{$stuff->nama_kategori}}</td>
                                    <td>{{$stuff->jumlah_stok}}</td>
                                    <td>{{$stuff->nama_satuan}}</td>
                                    <td>@money($stuff->harga)</td>
                                    <td>
                                        <a href="{{url('stuffs/'.$stuff->id.'/edit')}}"><span
                                                class="btn btn-primary">Edit</span></a>
                                        <form action="/stuffs/{{$stuff->id}}" method="post" class="d-inline">
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
