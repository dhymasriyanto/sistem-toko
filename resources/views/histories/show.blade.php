@extends('layouts.app')

@section('title', 'Detail Riwayat')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-5">
                <h1 class="h3 mb-3">
                    Detail Riwayat
                </h1>

            </div>
        </div>

        <div class="container-fluid p-0">
            <div class="card ">
                <div class="card-body">

                    <table >
                        @foreach($histories as $history)
                            <thead>
                            <tr>
                                <td width="50%">No. faktur</td>
                                <td width="5%">:</td>
                                <td>
                                    {{$history->no_faktur}}
                                </td>
                            </tr>
                            <tr>
                                <td width="50%">Kasir</td>
                                <td width="5%">:</td>
                                <td>
                                    {{$history->name}}
                                </td>
                            </tr>
                            <tr>
                                <td width="50%">Tanggal</td>
                                <td width="5%">:</td>
                                <td>
                                    {{$history->tanggal_transaksi}}
                                </td>
                            </tr>
                            </thead>

                        @endforeach
                    </table>
                    <br><br>
                    <table  class="table example">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Satuan</th>
                            <th scope="col">Harga per satuan</th>
                            <th scope="col">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--@dd($detailTransactions)--}}
                        @foreach($detailTransactions as $detailTransaction)
                            <tr>
                                <td scope="row">{{$loop->iteration}}</td>
                                <td>{{$detailTransaction->nama_barang}}</td>
                                <td>{{$detailTransaction->nama_kategori}}</td>
                                <td>{{$detailTransaction->jumlah_barang}}</td>
                                <td>{{$detailTransaction->nama_satuan}}</td>
                                <td>{{$detailTransaction->harga}}</td>
                                <td>@money($detailTransaction->total)</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>Total Bayar</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                @foreach($histories as $history)
                                    @money($history->total)
                                @endforeach
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script !src="">
        $(document).ready(function () {
            $('.example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> Cetak struk',

                            @foreach($histories as $history)

                        messageTop: '<table >\n' +
                            '                        @foreach($histories as $history)\n' +
                            '                            <thead>\n' +
                            '                            <tr>\n' +
                            '                                <td width="50%">No. faktur</td>\n' +
                            '                                <td width="5%">:</td>\n' +
                            '                                <td>\n' +
                            '                                    {{$history->no_faktur}}\n' +
                            '                                </td>\n' +
                            '                            </tr>\n' +
                            '                            <tr>\n' +
                            '                                <td width="50%">Kasir</td>\n' +
                            '                                <td width="5%">:</td>\n' +
                            '                                <td>\n' +
                            '                                    {{$history->name}}\n' +
                            '                                </td>\n' +
                            '                            </tr>\n' +
                            '                            <tr>\n' +
                            '                                <td width="50%">Tanggal</td>\n' +
                            '                                <td width="5%">:</td>\n' +
                            '                                <td>\n' +
                            '                                    {{$history->tanggal_transaksi}}\n' +
                            '                                </td>\n' +
                            '                            </tr>\n' +
                            '                            </thead>\n' +
                            '\n' +
                            '                        @endforeach\n' +
                            '                    </table>',
                        @endforeach

                    }
                ],
                "bInfo": false
                , "bLengthChange": false
                , "bFilter": false
                , "bPaginate": false
                , "bSort": false
                , "oLanguage": {
                    "sZeroRecords": false
                    , "sEmptyTable": false
                }
            });
        });

    </script>
    @endsection
