@extends('layouts.app')

@section('title' , 'Transaksi Masuk')

@section('content')

    <div class="container-fluid p-10">
        <div class="row">
            <div class="col-5">

                <h1 class="h3 mb-3">
                    Transaksi Masuk
                </h1>
                <div class="card">
                    <div class="card-body">
                        <form class="validation-form" method="post" action="/in-transactions">
{{--                            @method('put')--}}
                            @csrf
                            <div class="form-group">
                                <label for="id_barang">Nama Barang</label>
                                <select class="form-control select2" id="id_barang" name="id_barang" required>
                                    <option value="{{null}}" >Pilih barang</option>
                                @foreach($stuffs as $stuff)
                                        <option value="{{$stuff->id}}">{{$stuff->nama_barang}} : {{$stuff->jumlah_stok}} - @money($stuff->harga)</option>
                                    @endforeach
                                </select>
                            </div>

                            <?php
                            $mytime = Carbon\Carbon::now();
                            $tanggal = $mytime->toDateString();
                            $waktu = date_format($mytime, 'YmdH');
                            ?>

                            <input hidden id="tanggal" type="text" name="tanggal" value="{{$tanggal}}">
                            <div class="form-group">
                                <label for="jumlah_barang">Jumlah barang</label>

                                <input id="jumlah_barang" type="number"
                                       class="form-control @error('jumlah_barang') is-invalid @enderror" name="jumlah_barang"
                                       placeholder="Masukkan jumlah barang masuk"
                                       required autocomplete="jumlah_barang" maxlength="22" value="{{ old('jumlah_barang') }}">

                                @error('jumlah_barang')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <input hidden type="text" name="id_karyawan"  value="{{Auth::user()->id}}">
                            <button type="submit" class="btn btn-primary">Simpan</button>

                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
