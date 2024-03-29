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

                                    <form class="validation-form" method="post" action="/out-transactions">
                                        {{--                            @method('put')--}}
                                        @csrf
                                        <div class="form-group">
                                            <label for="id_barang">Nama Barang</label>
                                            <select class="form-control select2" id="id_barang" name="id_barang"
                                                    required>
                                                <option value="{{null}}">Pilih barang</option>
                                                {{--                                                @foreach($stuffs as $stuff)--}}
                                                {{--                                                    <option value="{{$stuff->id}}">{{$stuff->nama_barang}} - Stok--}}
                                                {{--                                                        : {{$stuff->jumlah_stok}}--}}
                                                {{--                                                    </option>--}}
                                                {{--                                                @endforeach--}}

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
                                                $bbb = substr($aaa, 41);
                                                $stock_data = json_decode($bbb, true);
                                                //                                        dd($cart_data);
                                                foreach($stock_data as $keys => $values)
                                                {?>

                                                <option value="{{$values["item_id"]}}">
                                                    {{$values["item_name"]}}
                                                    : {{$values["item_stock"]}} - @money($values["item_price"])
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

                                        <button type="submit" class="btn btn-primary">Masukkan ke keranjang</button>

                                    </form>
                                </div>

                            </div>
                        </div>
                        <div class="col-12 col-xl-8">
                            {{--                            <form method="post" action="/out-transactions">--}}
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
                                    <form action="/out-transactions" method="post" class="d-inline">
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
                                        $bb = substr($aa, 41);
                                        $cart_data = json_decode($bb, true);
                                        //                                        dd($cart_data);
                                        foreach($cart_data as $keys => $values)
                                        {
                                        //                                            dd($keys->item_name);
                                        ?>
                                        <input hidden name="jumlah[]" value="{{$values["item_quantity"]}}">
                                        <input hidden name="id_barang[]" value="{{$values["item_id"]}}">
                                        <?php
                                        }
                                        if (isset($_COOKIE["shopping_cart"]) && $test != "[]"){
                                        ?>
                                        <button class=" my-3 fa-pull-right btn btn-danger"><i class="align-middle"
                                                                                              data-feather="trash"></i><span
                                                class="align-middle ml-2">Hapus semua</span></button>
                                        <?php

}

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
                                        //                                        dd($test);
                                        if(isset($_COOKIE["shopping_cart"]) && $test != "[]")
                                        {
                                        $total = 0;
                                        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                                        $aa = Crypt::decryptString($cookie_data);
                                        $bb = substr($aa, 41);
                                        $cart_data = json_decode($bb, true);
                                        foreach($cart_data as $keys => $values)
                                        {
                                        ?>
                                        <tr>
                                            <td>{{$values["item_name"]}}</td>
                                            <td>{{$values["item_category"]}}</td>
                                            <td>{{$values["item_stock"]}}</td>
                                            <td>{{$values["item_quantity"]}}</td>
                                            <td>{{$values["item_unit"]}}</td>
                                            <td>@money($values["item_price"])</td>
                                            <td>@money($values["item_quantity"] * $values["item_price"])</td>
                                            <td>
                                                <form action="/out-transactions/{{$values["item_id"]}}" method="post"
                                                      class="d-inline">
                                                    @method('delete')
                                                    @csrf

                                                    <input hidden name="jumlah[]" value="{{$values["item_quantity"]}}">
                                                    <input hidden name="id_barang[]" value="{{$values["item_id"]}}">
                                                    <button class=" btn btn-link"><i style="color: red"
                                                                                     class="align-middle"
                                                                                     data-feather="delete"></i></button>
                                                </form>
                                            {{--                                                <a href=""><span class="text-danger"></span></a></td>--}}
                                        </tr>
                                        <?php
                                        $total = $total + ($values["item_quantity"] * $values["item_price"]);
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
                                    <?php if (isset($_COOKIE["shopping_cart"]) && $test != "[]"){
                                    ?>
                                    <a class="btn btn-primary fa-pull-right" data-toggle="modal" data-target="#belanja"
                                       href="">
                                        <i class="align-middle" data-feather="shopping-cart"></i>
                                        <span class="align-middle ml-2">Belanja</span> </a>

                                    <a class="mr-4 btn btn-danger fa-pull-right" data-toggle="modal"
                                       data-target="#hutang" href="">
                                        <i class="align-middle" data-feather="dollar-sign"></i>
                                        <span class="align-middle ml-2">Hutang</span></a>
                                    <?php }?>
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
                <form class="form-uang" method="post" action="/histories">
                    {{--                    @method('put')--}}
                    <?php
                    $nomer = rand(1000, 9999);
                    $mytime = Carbon\Carbon::now();
                    $tanggal = $mytime->toDateString();
                    $waktu = date_format($mytime, 'YmdH');
                    //                    dd($waktu);
                    ?>
                    @csrf
                    <div class="modal-body m-3">,
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
                                       name="uang" value="{{ old('uang') }}" required
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
                                <input readonly id="kembalian" type="number"
                                       class="form-control  @error('uang') is-invalid @enderror"
                                       name="kembalian" placeholder="Kembalian">

                            </div>

                        </div>
                        <span>Pastikan anda tidak lupa menerima uang pembayaran</span>
                        <?php
                        if (isset($_COOKIE["shopping_cart"]) && $test != "[]"){

                        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                        $aa = Crypt::decryptString($cookie_data);
                        $bb = substr($aa, 41);
                        $cart_data = json_decode($bb, true);

                        foreach($cart_data as $keys => $values){
                        ?>

                        <input hidden id="id{{$values["item_id"]}}" type="text" name="id[]" value="{{$values["item_id"]}}">
                        <input hidden id="jml{{$values["item_id"]}}" type="text" name="jml[]"
                               value="{{$values["item_quantity"]}}">
                        <input hidden id="subtotal{{$values["item_id"]}}" type="text" name="subtotal[]"
                               value="{{$values["item_quantity"]*$values["item_price"]}}">
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
                        <button type="submit" class="btn btn-danger">Bayar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="hutang" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span><i class="mr-2 align-middle" data-feather="info"></i></span><span
                            class="align-middle">Transaksi Hutang</span></h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-utang" class="form-uang" method="post" action="/debt-histories">
                    {{--                    @method('put')--}}
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
                               value="HTG{{Auth::user()->id}}{{$waktu}}{{$nomer}}">
                        <input hidden id="tanggal" type="text" name="tanggal" value="{{$tanggal}}">
                        <div class="form-group">
                            <label for="nama_penghutang">Nama Penghutang</label>
                            <input id="nama_penghutang" type="text"
                                   class="form-control @error('nama_penghutang') is-invalid @enderror"
                                   name="nama_penghutang" value="{{ old('nama_penghutang') }}" required
                                   autocomplete="nama_penghutang" autofocus placeholder="Masukkan nama penghutang">

                            @error('nama_penghutang')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nomer_ktp">Nomer KTP</label>
                            <input id="nomer_ktp" type="number" maxlength="16"
                                   class="form-control @error('nomer_ktp') is-invalid @enderror"
                                   name="nomer_ktp" value="{{ old('nomer_ktp') }}" required autocomplete="nomer_ktp"
                                   autofocus placeholder="Masukkan nomer KTP penghutang">

                            @error('nomer_ktp')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nomer_hp">Nomer HP</label>
                            <input id="nomer_hp" type="number" maxlength="12"
                                   class="form-control @error('nomer_hp') is-invalid @enderror"
                                   name="nomer_hp" value="{{ old('nomer_hp') }}" required autocomplete="nomer_hp"
                                   autofocus placeholder="Masukkan nomer HP penghutang">

                            @error('nomer_hp')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror"
                                      name="alamat" value="{{ old('alamat') }}" required autocomplete="alamat" autofocus
                                      placeholder="Masukkan alamat penghutang"></textarea>

                            @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="datetimepicker-input">Tenggat Hutang</label>
                            <div class="input-group date" id="datetimepicker-date" data-target-input="nearest">
                                <input name="tenggat" type="text" class="form-control datetimepicker-input"
                                       data-target="#datetimepicker-date" placeholder="Pilih tenggat hutang">
                                <div class="input-group-append" data-target="#datetimepicker-date"
                                     data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dp">Jumlah uang muka</label>
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
                                <input readonly id="sisa" type="number"
                                       class="form-control  @error('dp') is-invalid @enderror"
                                       name="sisa" placeholder="Sisa hutang">

                            </div>

                        </div>

                        <span>Pastikan anda tidak lupa memasukkan data personal penghutang sebelum mengkonfirmasi</span>
                        <?php
                        if (isset($_COOKIE["shopping_cart"]) && $test != "[]"){

                        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                        $aa = Crypt::decryptString($cookie_data);
                        $bb = substr($aa, 41);
                        $cart_data = json_decode($bb, true);

                        foreach($cart_data as $keys => $values){
                        ?>

                        <input hidden id="id{{$values["item_id"]}}" type="text" name="id[]" value="{{$values["item_id"]}}">
                        <input hidden id="jml{{$values["item_id"]}}" type="text" name="jml[]"
                               value="{{$values["item_quantity"]}}">
                        <input hidden id="subtotal{{$values["item_id"]}}" type="text" name="subtotal[]"
                               value="{{$values["item_quantity"]*$values["item_price"]}}">
                        <input hidden id="total2" type="text" name="total" value="{{$total}}">

                        <?php
                        }
                        }

                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-danger">Lakukan Hutang</button>
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
            var txtFirstNumberValue2 = document.getElementById('dp').value;
            var txtSecondNumberValue2 = document.getElementById('total2').value;
            var result2 = parseInt(txtSecondNumberValue2)-parseInt(txtFirstNumberValue2);
            if (!isNaN(result2)) {
                document.getElementById('sisa').value = result2;
            }
            var a =document.getElementById('sisa').value;
            if(a<0){
                document.getElementById('sisa').value = 0;

            }

        }


    </script>
    <script>
        $(function () {
            // $(".form-uang").validate({
            //     focusInvalid: false,
            //     rules: {
            //         "kembalian": {
            //             required: true,
            //             number: true,
            //             lessThanEquals:0
            //         }
            //     }
            // });
                // Select2

                // Daterangepicker
                // $("input[name=\"daterange\"]").daterangepicker({
                //     opens: "left"
                // });
                // $("input[name=\"datetimes\"]").daterangepicker({
                //     timePicker: true,
                //     opens: "left",
                //     startDate: moment().startOf("hour"),
                //     endDate: moment().startOf("hour").add(32, "hour"),
                //     locale: {
                //         format: "M/DD hh:mm A"
                //     }
                // });
                // $("input[name=\"datesingle\"]").daterangepicker({
                //     singleDatePicker: true,
                //     showDropdowns: true
                // });
                // // Datetimepicker
                // $('#datetimepicker-minimum').datetimepicker();
                // $('#datetimepicker-view-mode').datetimepicker({
                //     viewMode: 'years'
                // });
                // $('#datetimepicker-time').datetimepicker({
                //     format: 'LT'
                // });
                $('#datetimepicker-date').datetimepicker({
                format: 'L'
            });
            // var start = moment().subtract(29, "days");
            // var end = moment();
            //
            // function cb(start, end) {
            //     $("#reportrange span").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
            // }
            //
            // $("#reportrange").daterangepicker({
            //     startDate: start,
            //     endDate: end,
            //     ranges: {
            //         "Today": [moment(), moment()],
            //         "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
            //         "Last 7 Days": [moment().subtract(6, "days"), moment()],
            //         "Last 30 Days": [moment().subtract(29, "days"), moment()],
            //         "This Month": [moment().startOf("month"), moment().endOf("month")],
            //         "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
            //     }
            // }, cb);
            // cb(start, end);
        })
            ;
    </script>

@endsection
