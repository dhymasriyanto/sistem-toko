@extends('layouts.app')

@section('title' , 'Ubah Satuan')

@section('content')

    <div class="container-fluid p-10">
        <div class="row">
            <div class="col-5">
                <h1 class="h3 mb-3">
                    Ubah Satuan
                </h1>
                <div class="card">
                    <div class="card-body">

                        <form method="post" action="/units/{{$unit->id}}">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <label for="nama_satuan">Nama Kategori</label>
                                <input id="nama_satuan" type="text"
                                       class="form-control @error('nama_satuan') is-invalid @enderror"
                                       name="nama_satuan" value="{{ $unit->nama_satuan  }}" required
                                       autocomplete="nama_satuan" autofocus placeholder="Masukkan nama satuan">

                                @error('nama_satuan')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="/units" class="btn btn-danger">Batal</a>
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
