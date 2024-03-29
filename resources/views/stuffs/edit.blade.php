@extends('layouts.app')

@section('title' , 'Ubah Data Barang')

@section('content')

    <div class="container-fluid p-10">
        <div class="row">
            <div class="col-5">
                <h1 class="h3 mb-3">
                    Ubah Data Barang
                </h1>
                <div class="card">
                    <div class="card-body">

                        <form class="validation-form" method="post" action="/stuffs/{{$stuff->id}}">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <label for="nama_barang">Nama Barang</label>
                                <input id="nama_barang" type="text" class="form-control @error('nama_barang') is-invalid @enderror"
                                       name="nama_barang" value="{{ $stuff->nama_barang }}" required autocomplete="nama_barang" autofocus placeholder="Masukkan nama barang">

                                @error('nama_barang')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="id_kategori">Kategori</label>
                                <select class="form-control select2" id="id_kategori" name="id_kategori" required>
                                    <option value="{{null}}" >Pilih kategori barang</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{$stuff->id_kategori == $category->id ? 'selected' : ''}}>{{$category->nama_kategori}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="id_satuan">Satuan</label>
                                <select class="form-control select2" id="id_satuan" name="id_satuan" required>
                                    <option value="{{null}}" >Pilih satuan barang</option>
                                @foreach($units as $unit)
                                        <option value="{{$unit->id}}" {{$stuff->id_satuan == $unit->id ? 'selected' : ''}}>{{$unit->nama_satuan}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="harga">Harga per Satuan</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                <input id="harga" type="number"
                                       class="form-control @error('harga') is-invalid @enderror" name="harga" placeholder="Masukkan harga per satuan"
                                       required autocomplete="harga"  value="{{$stuff->harga }}">
                                @error('harga')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_stok">Jumlah Stok</label>
                                <input id="jumlah_stok" type="number" class="form-control  @error('jumlah_stok') is-invalid @enderror" placeholder="Masukkan jumlah stok"
                                       name="jumlah_stok" required autocomplete="jumlah_stok"  value="{{ $stuff->jumlah_stok }}">
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
