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
                                                @foreach($stuffs as $stuff)
                                                    <option value="{{$stuff->id}}">{{$stuff->nama_barang}} - Stok
                                                        : {{$stuff->jumlah_stok}}
                                                    </option>
                                                @endforeach
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
                                        ?>
                                        <button class=" my-3 fa-pull-right btn btn-danger"><i class="align-middle"
                                                                                              data-feather="trash"></i><span
                                                class="align-middle ml-2">Hapus semua</span></button>
                                        <?php } ?>
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
                                        use Illuminate\Support\Facades\Crypt;
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
                                        $cart_data = json_decode($aa);
                                        foreach($cart_data as $keys)
                                        {
                                        ?>
                                        <tr>
                                            <td>{{$keys->item_name}}</td>
                                            <td>{{$keys->item_category}}</td>
                                            <td>{{$keys->item_stock}}</td>
                                            <td>{{$keys->item_quantity}}</td>
                                            <td>{{$keys->item_unit}}</td>
                                            <td>@money($keys->item_price)</td>
                                            <td>@money($keys->item_quantity * $keys->item_price)</td>
                                            <td>
                                                <form action="/out-transactions/{{$keys->item_id}}" method="post"
                                                      class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class=" btn btn-link"><i style="color: red"
                                                                                     class="align-middle"
                                                                                     data-feather="delete"></i></button>
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
                <form method="post" action="/histories">
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
                               value="TRNS{{Auth::user()->id}}{{$waktu}}{{$nomer}}">
                        <input hidden id="tanggal" type="text" name="tanggal" value="{{$tanggal}}">

                        <span>Pastikan anda tidak lupa menerima uang pembayaran sebelum mengkonfirmasi</span>
                        <?php
                        if (isset($_COOKIE["shopping_cart"]) && $test != "[]"){

                        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                        $aa = Crypt::decryptString($cookie_data);
                        $cart_data = json_decode($aa);

                        foreach($cart_data as $keys){
                        ?>

                        <input hidden id="id{{$keys->item_id}}" type="text" name="id[]" value="{{$keys->item_id}}">
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
                <form method="post" action="/debt-histories">
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
                            <input id="nomer_ktp" type="text"
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
                            <input id="nomer_hp" type="text"
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


                        <span>Pastikan anda tidak lupa memasukkan data personal penghutang sebelum mengkonfirmasi</span>
                        <?php
                        if (isset($_COOKIE["shopping_cart"]) && $test != "[]"){

                        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                        $aa = Crypt::decryptString($cookie_data);
                        $cart_data = json_decode($aa);

                        foreach($cart_data as $keys){
                        ?>

                        <input hidden id="id{{$keys->item_id}}" type="text" name="id[]" value="{{$keys->item_id}}">
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
                        <button type="submit" class="btn btn-danger">Lakukan Hutang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
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
        });
    </script>

@endsection
