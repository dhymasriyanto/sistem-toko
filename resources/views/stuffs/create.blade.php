@extends('layouts.app')

@section('title' , 'Tambah Data Barang')

@section('content')

    <div class="container-fluid p-10">
        <div class="row">
            <div class="col-5">
                <h1 class="h3 mb-3">
                    Tambah Data Barang
                </h1>
                <div class="card">
                    <div class="card-body">

                        <form method="post" action="/stuffs" >
                            @csrf
                            <div class="form-group">
                                <label for="nama_barang">Nama Barang</label>
                                <input id="nama_barang" type="text" class="form-control @error('nama_barang') is-invalid @enderror"
                                       name="nama_barang" value="{{ old('nama_barang') }}" required autocomplete="nama_barang" autofocus placeholder="Masukkan nama barang">

                                @error('nama_barang')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="id_kategori">Kategori</label>
                                <select class="form-control select2" id="id_kategori" name="id_kategori">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->nama_kategori}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="id_satuan">Satuan</label>
                                <select class="form-control select2" id="id_satuan" name="id_satuan">

                                    @foreach($units as $unit)
                                        <option value="{{$unit->id}}">{{$unit->nama_satuan}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="harga">Harga per Satuan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input id="harga" type="text"
                                           class="form-control @error('harga') is-invalid @enderror" name="harga" placeholder="Masukkan harga per satuan"
                                           required autocomplete="harga" maxlength="22"  value="{{ old('harga') }}" >

                                </div>
                                @error('harga')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="jumlah_stok">Jumlah Stok</label>
                                <input id="jumlah_stok" type="text" class="form-control" placeholder="Masukkan jumlah stok"
                                       name="jumlah_stok" required autocomplete="jumlah_stok"  value="{{ old('jumlah_stok') }}">
                                @error('jumlah_stok')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="/stuffs" class="btn btn-danger">Batal</a>
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
