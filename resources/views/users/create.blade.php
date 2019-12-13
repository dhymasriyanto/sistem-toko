@extends('layouts.app')

@section('title' , 'Tambah Data Pengguna')

@section('content')

    <div class="container-fluid p-10">
        <div class="row">
            <div class="col-5">
                <h1 class="h3 mb-3">
                    Tambah Data Pengguna
                </h1>
                <div class="card">
                    <div class="card-body">

                        <form method="post" action="/users">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Masukkan nama pengguna">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="username" type="text"
                                       class="form-control @error('username') is-invalid @enderror" name="username"
                                       value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Masukkan username pengguna">

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="level_akses">Level Akses</label>
                                <select class="form-control" id="level_akses" name="level_akses" required>
                                    <option value="{{null}}" >Pilih level akses pengguna</option>
                                <?php
                                    $levelAkses = array("Pemilik Toko", "Karyawan");
                                    ?>
                                        @foreach($levelAkses as $level)
                                    <option value="{{$level}}">{{$level}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Masukkan password pengguna"
                                       required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password-confirm">Konfirmasi Password</label>
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi password pengguna">
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="/users" class="btn btn-danger">Batal</a>
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
