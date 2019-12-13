@extends('layouts.app')

@section('title' , 'Ubah Kategori')

@section('content')

    <div class="container-fluid p-10">
        <div class="row">
            <div class="col-5">
                <h1 class="h3 mb-3">
                    Ubah Kategori
                </h1>
                <div class="card">
                    <div class="card-body">

                        <form method="post" action="/categories/{{$category->id}}">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <label for="nama_kategori">Nama Kategori</label>
                                <input id="nama_kategori" type="text"
                                       class="form-control @error('nama_kategori') is-invalid @enderror"
                                       name="nama_kategori" value="{{ $category->nama_kategori  }}" required
                                       autocomplete="nama_kategori" autofocus placeholder="Masukkan nama kategori">

                                @error('nama_kategori')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>

                                <input id="deskripsi" type="text"
                                       class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"
                                       placeholder="Masukkan deskripsi"
                                        autocomplete="deskripsi" value="{{ $category->deskripsi}}">

                                @error('deskripsi')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="/categories" class="btn btn-danger">Batal</a>
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
