@extends('layouts.app')

@section('title', 'Transaksi Keluar')

@section('content')
    <div class="container-fluid p-0">


        <h1 class="h3 mb-3">
            Transaksi Keluar
        </h1>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-xl-6">

                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Daftar Barang</h5>
                                    <h6 class="card-subtitle text-muted">Berikut daftar barang yang tersedia di
                                        gudang.</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-responsive display table_id" id="example">
                                        <thead>
                                        <tr>
                                            <th> ID</th>
                                            <th style="width:40%;">Nama Barang</th>
                                            <th style="width:25%">Kategori</th>
                                            <th style="width:25%">Stok</th>
                                            <th style="width:25%">Satuan</th>
                                            <th class="d-none d-md-table-cell" style="width:25%">Harga</th>
                                            <th style="width:25%">Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($stuffs as $stuff)

                                            <tr>
                                                <td>{{$stuff->id}}</td>
                                                <td>{{$stuff->nama_barang}}</td>
                                                <td>{{$stuff->nama_kategori}}</td>
                                                <td>{{$stuff->jumlah_stok}}</td>
                                                <td>{{$stuff->nama_satuan}}</td>
                                                <td>@money($stuff->harga)</td>
                                                <td><a href="#"><i class="align-middle" data-feather="plus"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <div class="col-12 col-xl-6">
                            <form method="post" action="/out-transactions">
{{--                                @method('put')--}}
                                @csrf
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Keranjang Belanja</h5>
                                        <h6 class="card-subtitle text-muted">Berikut daftar barang pada keranjang
                                            belanja.</h6>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-responsive display " id="example2">
                                            <thead>
                                            <tr>
                                                <th hidden style="width:40%;">ID</th>
                                                <th style="width:40%;">Nama Barang</th>
                                                <th style="width:25%">Kategori</th>
                                                <th class="d-none d-md-table-cell" style="width:25%">Satuan</th>
                                                <th style="width:25%">Harga</th>
                                                <th style="width:25%">Jumlah</th>
                                                <th>Aksi</th>
                                                {{--                                            <th>Aksi</th>--}}
                                            </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
