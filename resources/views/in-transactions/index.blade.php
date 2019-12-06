@extends('layouts.app')

@section('title' , 'Transaksi Masuk')

@section('content')

    <div class="container-fluid p-10">
        <div class="row">
            <div class="col-5">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <div class="alert-message">
                            {{ session('status') }}

                        </div>
                    </div>
                @endif
                <h1 class="h3 mb-3">
                    Transaksi Masuk
                </h1>
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="/in-transactions">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <label for="id_barang">Nama Barang</label>
                                <select class="form-control select2" id="id_barang" name="id_barang">
                                    @foreach($stuffs as $stuff)
                                        <option value="{{$stuff->id}}">{{$stuff->nama_barang}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jumlah_barang">Jumlah barang</label>

                                <input id="jumlah_barang" type="text"
                                       class="form-control @error('jumlah_barang') is-invalid @enderror" name="jumlah_barang"
                                       placeholder="Masukkan jumlah barang masuk"
                                       required autocomplete="jumlah_barang" maxlength="22" value="{{ old('jumlah_barang') }}">

                                @error('jumlah_barang')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <button type="submit" class="btn btn-primary">Simpan</button>

                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
