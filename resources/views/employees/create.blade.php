@extends('layouts.app')

@section('title' , 'Tambah Data Karyawan')

@section('content')

    <div class="container-fluid p-10">
        <div class="row">
            <div class="col-5">
                <h1 class="h3 mb-3">
                    Tambah Data Karyawan
                </h1>
                <div class="card">
                    <div class="card-body">

                        <form method="post" action="/employees">
                            @csrf
                            <div class="form-group">
                                <label for="nama_depan">Nama Depan</label>
                                <input type="text" class="form-control @error ('nama_depan')  is-invalid @enderror" id="nama_depan" placeholder="Nama Depan" name="nama_depan" value="{{old('nama_depan')}}">
                                @error('nama_depan')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama_belakang">Nama Belakang</label>
                                <input type="text" class="form-control @error ('nama_belakang')  is-invalid @enderror" id="nama_belakang" placeholder="Nama Belakang" name="nama_belakang" value="{{old('nama_belakang')}}">
                                @error('nama_belakang')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control @error ('tanggal_lahir')  is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{old('tanggal_lahir')}}">
                                @error('tanggal_lahir')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" class="form-control @error ('tempat_lahir')  is-invalid @enderror" id="tempat_lahir" placeholder="Tempat Lahir" name="tempat_lahir" value="{{old('tempat_lahir')}}">
                                @error('tempat_lahir')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nomer_hp">Nomer HP</label>
                                <input type="text" class="form-control @error ('nomer_hp')  is-invalid @enderror" id="nomer_hp" placeholder="Nomer HP" name="nomer_hp" value="{{old('nomer_hp')}}">
                                @error('nomer_hp')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="/employees" class="btn btn-danger">Batal</a>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
