@extends('layouts.app')

@section('title', 'Ubah Profil')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-5">
                <h1 class="h3 mb-3">
                    Ubah Profil
                </h1>

            </div>
        </div>

        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{asset('/appstack/img/avatars/user.svg')}}" width="100" alt="">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="/profiles/{{$profile->id}}">
                                        @method('put')
                                        @csrf

                                        <div class="form-group">
                                            <label for="name">Nama</label>
                                            <input id="name" type="text"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   name="name" value="{{ $profile->name }}" required autocomplete="name"
                                                   autofocus placeholder="Masukkan nama pengguna">

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input id="username" type="text"
                                                   class="form-control @error('username') is-invalid @enderror"
                                                   name="username" placeholder="Masukkan username pengguna"
                                                   value="{{ $profile->username }}" required autocomplete="username"
                                                   autofocus>

                                            @error('username')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="level_akses">Level Akses</label>
                                            <select class="form-control" id="level_akses" name="level_akses" required>
                                                <option value="{{null}}">Pilih level akses pengguna</option>
                                                <?php
                                                $levelAkses = array("Pemilik Toko", "Karyawan");
                                                ?>
                                                @foreach($levelAkses as $v)
                                                    <option
                                                        value="{{$v}}" {{$v ==$profile->level_akses  ? 'selected' : ''}} >{{$v}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            {{--                                            <a href="">Ganti password?</a>--}}
                                            <a data-toggle="modal" data-target="#profilModal" href="">Ganti password?</a>

                                        </div>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="/profiles/{{$profile->id}}" class="btn btn-danger">Batal</a>
                                    </form>

                                </div>
                                {{--                                <a href="/profiles/{{$profile->id}}/edit" class="btn btn-primary m-4">Ubah Profil</a>--}}
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="profilModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span><i class="mr-2 align-middle" data-feather="info"></i></span><span
                            class="align-middle">Ganti Password</span></h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="validation-form" method="post" action="/profiles/{{$profile->id}}">
                    @method('put')
                    @csrf
                    <div class="modal-body m-3">
                        {{--                                                isi--}}
                        <div class="form-group">
                            <label for="old-password">Password Lama</label>
                            <input id="old-password" type="password"
                                   class="form-control @error('old-password') is-invalid @enderror"
                                   name="old_password" placeholder="Masukkan password lama"
                                   required autocomplete="old-password">

                            @error('old-password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="new-password">Password Baru</label>
                            <input id="new-password" type="password"
                                   class="form-control @error('new-password') is-invalid @enderror"
                                   name="password" placeholder="Masukkan password baru"
                                   required autocomplete="new-password">

                            @error('new-password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">Konfirmasi Password Baru</label>
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required
                                   autocomplete="new-password"
                                   placeholder="Konfirmasi password baru">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit"  class="btn btn-danger">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
