{{--@extends('layouts.app')--}}

{{--@section('content')--}}


@section('title', 'Login')
<!doctype html>
<html lang="en">
<head>
    @include('includes.head')
</head>
<body>
<main class="main d-flex w-100">
    <div class="container d-flex flex-column">
        <div class="row h-100">
            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center mt-4">
                        <h1 class="h2">Selamat Datang di Sistem Toko Material</h1>
                        <p class="lead">
                            Masuk menggunakan akun anda
                        </p>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-4">
                                <div class="text-center">
                                    <img src="{{url('/appstack/img/brands/logo.png')}}" alt="Chris Wood"
                                         class="img-fluid rounded-circle"
                                         width="132" height="132"/>
                                </div>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label>Username</label>

                                        <input placeholder="Masukkan username anda" id="username" type="text"
                                               class="form-control form-control-lg @error('username') is-invalid @enderror"
                                               name="username" value="{{ old('username') }}" required autocomplete="username"
                                               autofocus>

                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input id="password" type="password" placeholder="Masukkan password anda"
                                               class="form-control form-control-lg @error('password') is-invalid @enderror"
                                               name="password"
                                               required autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    </div>
                                    <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Masuk') }}
                                        </button>

                                    {{--                                        @if (Route::has('password.request'))--}}
                                    {{--                                            <a class="btn btn-link" href="{{ route('password.request') }}">--}}
                                    {{--                                                {{ __('Forgot Your Password?') }}--}}
                                    {{--                                            </a>--}}
                                    {{--                                        @endif--}}
                                    {{--                                        <a href="dashboard-default.html" class="btn btn-lg btn-primary">Sign in</a>--}}
                                    <!-- <button type="submit" class="btn btn-lg btn-primary">Sign in</button> -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
@include('includes.foot')
</body>
</html>
