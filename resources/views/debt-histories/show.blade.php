@extends('layouts.app')

@section('title', 'Detail Hutang')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-5">
                <h1 class="h3 mb-3">
                    Detail Hutang
                </h1>

            </div>
        </div>

        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-body">
                    {{--                        @foreach($debtHistories as $debtHistory)--}}
                    {{--                            {{$debtHistory->name}}--}}
                    {{--                        @endforeach--}}
                    {{--                        @foreach($detailDebtHistories as $detail)--}}
                    {{--                            {{$detail->nama_barang}}--}}
                    {{--                        @endforeach--}}
                    <div class="row">
                        <table class="col-md-4">
                            @foreach($debtHistories as $debtHistory)
                                <tr>
                                    <td width="50%">No. faktur</td>
                                    <td width="5%">:</td>
                                    <td>
                                        {{$debtHistory->no_faktur}}
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%">Kasir</td>
                                    <td width="5%">:</td>
                                    <td>
                                        {{$debtHistory->name}}
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%">Tanggal</td>
                                    <td width="5%">:</td>
                                    <td>
                                        {{$debtHistory->tanggal_transaksi}}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <table class="col-md-4">
                            @foreach($debtHistories as $debtHistory)
                                <tr>
                                    <td width="50%">Nama Penghutang</td>
                                    <td width="5%">:</td>
                                    <td>
                                        {{$debtHistory->nama_penghutang}}
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%">Tenggat Hutang</td>
                                    <td width="5%">:</td>
                                    <td>
                                        {{$debtHistory->tenggat_hutang}}
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%">Alamat</td>
                                    <td width="5%">:</td>
                                    <td>
                                        {{$debtHistory->alamat}}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <table  class="col-md-4">
                            @foreach($debtHistories as $debtHistory)
                                <tr>
                                    <td width="50%">Nomer KTP</td>
                                    <td width="5%">:</td>
                                    <td>
                                        {{$debtHistory->nomer_ktp}}
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%">Nomer HP</td>
                                    <td width="5%">:</td>
                                    <td>
                                        {{$debtHistory->nomer_hp}}
                                    </td>
                                </tr>

                            @endforeach
                        </table>
                    </div>
                    <br>
                    <table class="example table">
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
                        {{--@dd($detailDebtHistories)--}}
                        @foreach($detailDebtHistories as $detailDebtHistory)
                            <tr>
                                <td scope="row">{{$loop->iteration}}</td>
                                <td>{{$detailDebtHistory->nama_barang}}</td>
                                <td>{{$detailDebtHistory->nama_kategori}}</td>
                                <td>{{$detailDebtHistory->jumlah_barang}}</td>
                                <td>{{$detailDebtHistory->nama_satuan}}</td>
                                <td>{{$detailDebtHistory->harga}}</td>
                                <td>@money($detailDebtHistory->total)</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="text-center">Total Bayar</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                @foreach($debtHistories as $debtHistory)
                                    @money($debtHistory->total)
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


                        messageTop: '<table class="col-md-4">\n' +
                            '                            @foreach($debtHistories as $debtHistory)\n' +
                            '                                <tr>\n' +
                            '                                    <td width="50%">No. faktur</td>\n' +
                            '                                    <td width="5%">:</td>\n' +
                            '                                    <td>\n' +
                            '                                        {{$debtHistory->no_faktur}}\n' +
                            '                                    </td>\n' +
                            '                                </tr>\n' +
                            '                                <tr>\n' +
                            '                                    <td width="50%">Kasir</td>\n' +
                            '                                    <td width="5%">:</td>\n' +
                            '                                    <td>\n' +
                            '                                        {{$debtHistory->name}}\n' +
                            '                                    </td>\n' +
                            '                                </tr>\n' +
                            '                                <tr>\n' +
                            '                                    <td width="50%">Tanggal</td>\n' +
                            '                                    <td width="5%">:</td>\n' +
                            '                                    <td>\n' +
                            '                                        {{$debtHistory->tanggal_transaksi}}\n' +
                            '                                    </td>\n' +
                            '                                </tr>\n' +
                            '                            @endforeach\n' +
                            '                        </table>\n' +
                            '                        <table class="col-md-4">\n' +
                            '                            @foreach($debtHistories as $debtHistory)\n' +
                            '                                <tr>\n' +
                            '                                    <td width="50%">Nama Penghutang</td>\n' +
                            '                                    <td width="5%">:</td>\n' +
                            '                                    <td>\n' +
                            '                                        {{$debtHistory->nama_penghutang}}\n' +
                            '                                    </td>\n' +
                            '                                </tr>\n' +
                            '                                <tr>\n' +
                            '                                    <td width="50%">Tenggat Hutang</td>\n' +
                            '                                    <td width="5%">:</td>\n' +
                            '                                    <td>\n' +
                            '                                        {{$debtHistory->tenggat_hutang}}\n' +
                            '                                    </td>\n' +
                            '                                </tr>\n' +
                            '                                <tr>\n' +
                            '                                    <td width="50%">Alamat</td>\n' +
                            '                                    <td width="5%">:</td>\n' +
                            '                                    <td>\n' +
                            '                                        {{$debtHistory->alamat}}\n' +
                            '                                    </td>\n' +
                            '                                </tr>\n' +
                            '                            @endforeach\n' +
                            '                        </table>\n' +
                            '                        <table  class="col-md-4">\n' +
                            '                            @foreach($debtHistories as $debtHistory)\n' +
                            '                                <tr>\n' +
                            '                                    <td width="50%">Nomer KTP</td>\n' +
                            '                                    <td width="5%">:</td>\n' +
                            '                                    <td>\n' +
                            '                                        {{$debtHistory->nomer_ktp}}\n' +
                            '                                    </td>\n' +
                            '                                </tr>\n' +
                            '                                <tr>\n' +
                            '                                    <td width="50%">Nomer HP</td>\n' +
                            '                                    <td width="5%">:</td>\n' +
                            '                                    <td>\n' +
                            '                                        {{$debtHistory->nomer_hp}}\n' +
                            '                                    </td>\n' +
                            '                                </tr>\n' +
                            '\n' +
                            '                            @endforeach\n' +
                            '                        </table>'
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
