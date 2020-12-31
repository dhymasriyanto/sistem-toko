@extends('layouts.app')

@section('title' , 'Ubah Grup')

@section('content')

    <div class="container-fluid p-10">
        <div class="row">
            <div class="col-5">
                <h1 class="h3 mb-3">
                    Ubah Grup
                </h1>
                <div class="card">
                    <div class="card-body">

                        <form method="post" action="/groups/{{$group->id}}">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <label for="nama_grup">Nama Kategori</label>
                                <input id="nama_grup" type="text"
                                       class="form-control @error('nama_grup') is-invalid @enderror"
                                       name="nama_grup" value="{{ $group->nama_grup  }}" required
                                       autocomplete="nama_grup" autofocus placeholder="Masukkan nama grup">

                                @error('nama_grup')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

{{--                            <div class="form-group">--}}
{{--                                <label for="deskripsi">Deskripsi</label>--}}

{{--                                <input id="deskripsi" type="text"--}}
{{--                                       class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"--}}
{{--                                       placeholder="Masukkan deskripsi"--}}
{{--                                        autocomplete="deskripsi" value="{{ $category->deskripsi}}">--}}

{{--                                @error('deskripsi')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}


                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="/groups" class="btn btn-danger">Batal</a>
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
