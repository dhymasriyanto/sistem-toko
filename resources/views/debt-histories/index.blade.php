@extends('layouts.app')

@section('title', 'Riwayat Hutang')

@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12 col-lg-12">

                <h1 class="h3 mb-3">
                    Riwayat Hutang
                </h1>
                <div class="card">
                    <div class="card-body">
                        {{--                        <a href="/debtHistories/create" class="btn btn-primary my-3" >Tambah</a>--}}

                        <table class="table table-responsive table_id display">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">No Faktur</th>
                                <th scope="col">Tanggal Transaksi</th>
                                <th scope="col">Karyawan</th>
                                <th scope="col">Penghutang</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($debtHistories as $debtHistory)
                                <tr>
                                    <td scope="row">{{$loop->iteration}}</td>
                                    <td>{{$debtHistory->no_faktur}}</td>
                                    <td>{{$debtHistory->tanggal_transaksi}}</td>
                                    <td>
                                        {{$debtHistory->name}}
                                    </td><td>
                                        {{$debtHistory->nama_penghutang}}
                                    </td>
                                    <td>

                                        <a style="color: green" href="{{url('debt-histories/'.$debtHistory->id)}}" title="Lihat riwayat">
                                            <span><i data-feather="clipboard"></i></span>
                                        </a>
                                        <a  title="Edit riwayat" href="{{url('debt-histories/'.$debtHistory->id.'/edit')}}"><span
                                            ><i data-feather="edit"></i></span></a>
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
