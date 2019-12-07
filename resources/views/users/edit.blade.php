@extends('layouts.app')

@section('title', 'Ubah Data Pengguna')

@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-5">
                <h1 class="h3 mb-3">
                    Ubah Data Pengguna
                </h1>
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="/users/{{$user->id}}">
                            @method('put')
                            @csrf

                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ $user->name }}" required autocomplete="name" autofocus placeholder="Masukkan nama pengguna">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="username" type="text"
                                       class="form-control @error('username') is-invalid @enderror" name="username" placeholder="Masukkan username pengguna"
                                       value="{{ $user->username }}" required autocomplete="username" autofocus>

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="level_akses">Level Akses</label>
                                <select class="form-control" id="level_akses" name="level_akses">
                                    <option value="" ></option>
                                    <?php
                                    $levelAkses = array("Pemilik Toko", "Karyawan");
                                    ?>
                                    @foreach($levelAkses as $v)
                                        <option value="{{$v}}" {{$v ==$user->level_akses  ? 'selected' : ''}} >{{$v}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <a href="">Ganti password?</a>
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
