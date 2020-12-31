@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12 col-lg-12">


                <h1 class="h3 mb-3">
                    Riwayat Transaksi Keluar
                </h1>
                <div class="card">
                    <div class="card-body">
                        {{--                        <a href="/histories/create" class="btn btn-primary my-3" >Tambah</a>--}}

                        <table class="table table-responsive table_id display">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">No Faktur</th>
                                <th scope="col">Tanggal Transaksi</th>
                                <th scope="col">Karyawan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($histories as $history)
                                <tr>
                                    <td scope="row">{{$loop->iteration}}</td>
                                    <td>{{$history->no_faktur}}</td>
                                    <td>{{$history->tanggal_transaksi}}</td>
                                    <td>
                                        {{$history->name}}
                                    </td>
                                    <td>

                                        <a style="color: green" href="{{url('histories/'.$history->id)}}" title="Lihat riwayat">
                                            <span><i data-feather="clipboard"></i></span>
                                        </a>
                                        {{--                                        --}}
                                        {{--                                        <a  title="Edit riwayat" href="{{url('histories/'.$history->id.'/edit')}}"><span--}}
                                        {{--                                            ><i data-feather="edit"></i></span></a>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

                <h1 class="h3 mb-3">
                    Riwayat Transaksi Masuk
                </h1>
                <div class="card">
                    <div class="card-body">
                        {{--                        <a href="/histories/create" class="btn btn-primary my-3" >Tambah</a>--}}

                        <table class="table table-responsive table_id display">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tanggal Transaksi</th>
                                <th scope="col">Nama Karyawan</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Harga per Satuan</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pengeluaran as $keluar)
                                <tr>
                                    <td scope="row">{{$loop->iteration}}</td>
                                    <td>{{$keluar->tanggal}}</td>
                                    <td>{{$keluar->name}}</td>
                                    <td>{{$keluar->nama_barang}}</td>
                                    <td>{{$keluar->nama_kategori}}</td>
                                    <td>@money($keluar->harga)</td>
                                    <td>{{$keluar->jumlah}}</td>
                                    <td>{{$keluar->nama_satuan}}</td>
                                    <td>
                                        @money($keluar->pengeluaran)
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
