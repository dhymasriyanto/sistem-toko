@extends('layouts.app')

@section('title', 'Transaksi Keluar')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">
            Edit Riwayat
        </h1>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-xl-4">

                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <span class="mr-4 ml-2"><i class="feather-lg text-danger"
                                                                   data-feather="folder"></i></span>
                                        <span><h5 class="card-title">Daftar Barang</h5>
                                        <h6 class="card-subtitle text-muted">Daftar barang pada gudang</h6>
                                        </span>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <form class="validation-form" method="post" action="/histories/create">
                                        {{--                            @method('put')--}}
                                        @csrf


                                        <div class="form-group">
                                            <label for="id_barang">Nama Barang</label>
                                            <select class="form-control select2" id="id_barang" name="id_barang"
                                                    required>
                                                <option value="{{null}}">Pilih barang</option>

                                                {{--                                                @foreach($stock_data as $stock)--}}
                                                {{--                                                    @dd($stock_data)--}}

                                                {{--                                                @foreach($stock_data as $stuff => $values)--}}
                                                {{--                                                    {{$a = $stuff->jumlah_stok}}--}}

                                                <?php

                                                use Illuminate\Support\Facades\Crypt;
                                                //                                        dd($_COOKIE['shopping_cart']!="");

                                                if (isset($_COOKIE['stock_cart'])) {
                                                    $test = Crypt::decryptString(stripslashes($_COOKIE['stock_cart']));

//                                            echo $test;
                                                }
                                                $total2 = 0;
                                                $cookie_data2 = stripslashes($_COOKIE['stock_cart']);
                                                $aaa = Crypt::decryptString($cookie_data2);
                                                $stock_data = json_decode($aaa);
                                                //                                        dd($cart_data);
                                                foreach($stock_data as $keys)
                                                {?>

                                                <option value="{{$keys->item_id}}">
                                                    {{$keys->item_name}} - Stok
                                                    : {{$keys->item_stock}}
                                                </option>

                                                {{--                                                    <option value="{{$stock_data[$stuff]['item_id']}}">--}}
                                                {{--                                                        {{$stock_data[$stuff]['item_name']}} - Stok--}}
                                                {{--                                                        : {{$stock_data[$stuff]['item_stock']}}--}}

                                                {{--                                                        @if($stuff->id==Session::get('id'))--}}
                                                {{--                                                            {{$a+=Session::get('jmlh')}}--}}
                                                {{--                                                        @else--}}
                                                {{--                                                            {{$a}}--}}
                                                {{--                                                        @endif--}}
                                                {{--                                                                                                            @endforeach--}}

                                                {{--                                                    </option>--}}
                                                {{--                                                @endforeach--}}
                                                <?php  }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="jumlah">Jumlah</label>

                                            <input id="jumlah" type="number"
                                                   class="form-control @error('jumlah') is-invalid @enderror"
                                                   name="jumlah"
                                                   placeholder="Masukkan jumlah barang masuk"
                                                   required autocomplete="jumlah" maxlength="22"
                                                   value="{{ old('jumlah') }}">

                                            @error('jumlah')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary">Masukkan keranjang</button>

                                    </form>
                                </div>

                            </div>
                        </div>
                        <div class="col-12 col-xl-8">
                            {{--                            <form method="post" action="/histories/create">--}}
                            {{--                                @method('put')--}}
                            {{--                                @csrf--}}
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <span class="mr-4 ml-2"><i class="feather-lg text-danger"
                                                                   data-feather="shopping-cart"></i></span>
                                        <span><h5 class="card-title">Keranjang Belanja</h5>
                                        <h6 class="card-subtitle text-muted">Berikut daftar barang pada keranjang
                                            belanja.</h6></span>
                                    </div>

                                </div>

                                <div class="card-body">
                                    <form action="/histories/create" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <?php if (isset($_COOKIE["shopping_cart"])){

                                        //                                        use Illuminate\Support\Facades\Crypt;
                                        //                                        dd($_COOKIE['shopping_cart']!="");
                                        if (isset($_COOKIE["shopping_cart"])) {
                                            $test = Crypt::decryptString(stripslashes($_COOKIE['shopping_cart']));
                                        }

                                        //                                                                                dd($test);
                                        $total = 0;
                                        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                                        $aa = Crypt::decryptString($cookie_data);
                                        $cart_data = json_decode($aa);
                                        //                                        dd($cart_data);
                                        foreach($cart_data as $keys)
                                        {
                                        //                                            dd($keys->item_name);
                                        ?>
                                        <input hidden name="jumlah[]" value="{{$keys->item_quantity}}">
                                        <input hidden name="id_barang[]" value="{{$keys->item_id}}">
                                        <?php
                                        }
                                        ?>

                                        <button class=" my-3 fa-pull-right btn btn-danger"><i class="align-middle"
                                                                                              data-feather="trash"></i><span
                                                class="align-middle ml-2">Hapus semua</span></button>
                                        <?php



                                        }?>
                                    </form>
                                    <table class="table table-responsive">
                                        <thead>
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Kategori</th>
                                            <th>Sisa Stok</th>
                                            <th>Jumlah</th>
                                            <th>Satuan</th>
                                            <th>Harga</th>
                                            <th>Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        <?php
                                        //                                        use Illuminate\Support\Facades\Crypt;
                                        //                                        dd($_COOKIE['shopping_cart']!="");
                                        if (isset($_COOKIE["shopping_cart"])) {
                                            $test = Crypt::decryptString(stripslashes($_COOKIE['shopping_cart']));
                                        }
                                        if(isset($_COOKIE["shopping_cart"]) && $test != "[]")
                                        {
                                        //                                                                                dd($test);
                                        $total = 0;
                                        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                                        $aa = Crypt::decryptString($cookie_data);
                                        $cart_data = json_decode($aa);
                                        //                                        dd($cart_data);
                                        foreach($cart_data as $keys)
                                        {
                                        //                                            dd($keys->item_name);
                                        ?>
                                        <tr>

                                            <td>{{$keys->item_name}}</td>
                                            <td>{{$keys->item_category}}</td>
                                            <td>{{$keys->item_stock}}</td>
                                            <td>{{$keys->item_quantity}}

                                            </td>
                                            <td>{{$keys->item_unit}}</td>
                                            <td>@money($keys->item_price)</td>
                                            <td>@money($keys->item_quantity * $keys->item_price)</td>
                                            <td>
                                                <form action="/histories/create/{{$keys->item_id}}" method="post"
                                                      class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    {{--                                                    <form action="/histories/create/{{$keys->item_id}}">--}}
                                                    {{--                                                        @csrf--}}

                                                    <input hidden name="jumlah[]" value="{{$keys->item_quantity}}">
                                                    <input hidden name="id_barang[]" value="{{$keys->item_id}}">
                                                    {{--                                                    </form>--}}

                                                    <button type="submit" class=" btn btn-link"><i style="color: red"
                                                                                                   class="align-middle"
                                                                                                   data-feather="delete"></i>
                                                    </button>
                                                </form>
                                            {{--                                                <a href=""><span class="text-danger"></span></a></td>--}}
                                        </tr>
                                        <?php
                                        $total = $total + ($keys->item_quantity * $keys->item_price);
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="6" class="text-center"><strong>Total</strong></td>
                                            <td colspan="1">@money($total)</td>
                                            <td></td>
                                        </tr>
                                        <?php
                                        }
                                        else {
                                            echo '<tr>
                                                  <td colspan="8" align="center">Tidak ada item di keranjang</td>
                                              </tr>';
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    <a class="btn btn-primary fa-pull-right" data-toggle="modal" data-target="#belanja"
                                       href="">
                                        <span class="align-middle ml-2">Simpan</span> </a>
                                    <a class="mr-4 btn btn-danger fa-pull-right" href="/histories">
                                        <i class="align-middle"></i>
                                        <span class="align-middle ml-2">Kembali</span></a>
                                </div>

                            </div>
                            {{--                                <button type="submit" class="btn btn-primary">Simpan</button>--}}
                            {{--                            </form>--}}
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="modal fade" id="belanja" tabindex="-1" role="dialog" aria-hidden="true">
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
                <form id="form-uang" method="post" action="/histories/create">
                    @method('put')
                    <?php
                    $nomer = rand(1000, 9999);
                    $mytime = Carbon\Carbon::now();
                    $tanggal = $mytime->toDateString();
                    $waktu = date_format($mytime, 'YmdH');
                    //                    dd($waktu);
                    ?>
                    @csrf
                    <div class="modal-body m-3">
                        <input hidden id="id_karyawan" type="text" name="id_karyawan" value="{{Auth::user()->id}}">
                        <input hidden id="no_faktur" type="text" name="no_faktur"
                               value="TRNS{{Auth::user()->id}}{{$waktu}}{{$nomer}}">
                        <input hidden id="tanggal" type="text" name="tanggal" value="{{$tanggal}}">
                        <div class="form-group">
                            <label for="uang">Jumlah uang pembayaran</label>
                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input onkeyup="sum();" id="uang" type="number"
                                       class="form-control @error('uang') is-invalid @enderror"
                                       name="uang" value="" required
                                       autocomplete="uang" autofocus placeholder="Masukkan jumlah uang pembayaran">
                                @error('uang')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="kembalian">Kembalian</label>
                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input value=""  readonly id="kembalian" type="number"
                                       class="form-control  @error('uang') is-invalid @enderror"
                                       name="kembalian" placeholder="Kembalian">

                            </div>

                        </div>
                        <span>Pastikan uang pembayaran dari riwayat data sebelumnya.</span><br>
                        <?php
                        if (isset($_COOKIE["shopping_cart"]) && $test != "[]"){

                        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                        $aa = Crypt::decryptString($cookie_data);
                        $cart_data = json_decode($aa);

                        foreach($cart_data as $keys){

                        ?>

                        <input hidden id="transaction_id{{$keys->item_id}}" type="text" name="transaction_id[]"
                               value="{{$keys->transaction_id}}">
                        <input hidden id="id{{$keys->item_id}}" type="text" name="id[]" value="{{$keys->item_id}}">
                        <input hidden id="detail_id{{$keys->detail_id}}" type="text" name="detail_id[]"
                               value="{{$keys->detail_id}}">
                        <input hidden id="jml{{$keys->item_id}}" type="text" name="jml[]"
                               value="{{$keys->item_quantity}}">
                        <input hidden id="subtotal{{$keys->item_id}}" type="text" name="subtotal[]"
                               value="{{$keys->item_quantity*$keys->item_price}}">
                        <input hidden id="total" type="text" name="total" value="{{$total}}">


                        <?php
                        }
                        }

                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-danger">Perbarui riwayat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>

        function sum() {
            var txtFirstNumberValue = document.getElementById('uang').value;
            var txtSecondNumberValue = document.getElementById('total').value;
            var result = parseInt(txtFirstNumberValue) - parseInt(txtSecondNumberValue);
            if (!isNaN(result)) {
                document.getElementById('kembalian').value = result;
            }

            if (!isNaN(result2)) {
                document.getElementById('sisa').value = result2;
            }
            var a =document.getElementById('sisa').value;
            if(a<0){
                document.getElementById('sisa').value = 0;

            }

        }


    </script>

@endsection
