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
                        <table class="col-md-4">
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
                                <tr>
                                    <td width="50%">Tenggat</td>
                                    <td width="5%">:</td>
                                    <td style="color: red">
                                        <?php
                                        $now = time();
                                        ?>

                                        @if(round((strtotime($debtHistory->tenggat_hutang)-$now)/(60 * 60 * 24))<=0)
                                            HARI INI!!
                                        @else
                                            {{round((strtotime($debtHistory->tenggat_hutang)-$now)/(60 * 60 * 24))}}
                                            hari lagi
                                        @endif
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
                            <td class="text-center">Total Hutang</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <span style="color: red">

                                @foreach($debtHistories as $debtHistory)
                                        @money($debtHistory->total)
                                    @endforeach

                                </span>
                            </td>

                        </tr>
                        <tr>
                            <td>Telah dibayar</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="color: mediumseagreen">
                                @foreach($debtHistories as $debtHistory)
                                    @money($debtHistory->telah_bayar)
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>Sisa Hutang</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="color: red">
                                @foreach($debtHistories as $history)
                                    @money($debtHistory->sisa)
                                @endforeach
                                <input hidden value="{{$debtHistory->sisa}}" id="sisaa">
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    <br>

                    <a class="mr-4 btn btn-success fa-pull-right" data-toggle="modal"
                       data-target="#hutang" href="">
                        <i class="align-middle" data-feather="dollar-sign"></i>
                        <span class="align-middle ml-2">Bayar Hutang</span></a>

                    <a class="mr-4 btn btn-danger fa-pull-right" href="/debt-histories">
                        <i class="align-middle"></i>
                        <span class="align-middle ml-2">Kembali</span></a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="hutang" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span><i class="mr-2 align-middle" data-feather="info"></i></span><span
                            class="align-middle">Bayar Hutang</span></h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-utang" class="form-uang" method="post" action="/debt-histories/{{$debtHistory->id}}">
                    @method('put')
                    @csrf

                    <?php
                    $mytime = Carbon\Carbon::now();
                    $tanggal = $mytime->toDateString();
                    $waktu = date_format($mytime, 'YmdH');
                    ?>
                    <div class="modal-body m-3">
                        <input hidden id="id" type="text" name="id" value="{{$debtHistory->id}}">

                        <input hidden id="tanggal" type="text" name="tanggal" value="{{$tanggal}}">

                        <div class="form-group">
                            <label for="dp">Jumlah uang pembayaran</label>
                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input onkeyup="sum();" id="dp" type="number"
                                       class="form-control @error('dp') is-invalid @enderror"
                                       name="dp" value="{{ old('dp') }}" required
                                       autocomplete="uang" autofocus placeholder="Masukkan jumlah uang muka">
                                @error('dp')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="sisa">Sisa hutang</label>
                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input value="{{$debtHistory->sisa}}" readonly id="sisa" type="number"
                                       class="form-control  @error('dp') is-invalid @enderror"
                                       name="sisa" placeholder="Sisa hutang">

                            </div>

                        </div>

                        <div class="form-group">
                            <label for="kembalian">Kembalian (jika ada)</label>
                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input value="0" readonly id="kembalian" type="number"
                                       class="form-control  @error('dp') is-invalid @enderror"
                                       name="kembalian" placeholder="Kembalian">

                            </div>

                        </div>

                        <span>Pastikan jumlah uang sudah benar</span>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-success">Lakukan Pembayaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')


    <script !src="">
        function sum() {

            var txtFirstNumberValue2 = document.getElementById('dp').value;
            var txtSecondNumberValue2 = document.getElementById('sisaa').value;
            var result2 = parseInt(txtSecondNumberValue2) - parseInt(txtFirstNumberValue2);
            if (!isNaN(result2)) {
                document.getElementById('sisa').value = result2;
            }
            // var a =document.getElementById('sisa').value;

            if (result2 <= 0) {
                document.getElementById('sisa').value = 0;
                document.getElementById('kembalian').value = Math.abs(result2);

            }


        }
    </script>
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
