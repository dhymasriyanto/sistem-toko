@extends('layouts.app')

@section('title', 'Profil')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-5">
                <h1 class="h3 mb-3">
                    Profil Anda
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
                                    <a href="/profiles/{{$profile->id}}/edit" class="btn btn-primary m-4">Ubah Profil</a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="/profiles/{{$profile->id}}">
                                        @method('put')
                                        @csrf

                                        <div class="form-group">
                                            <label for="name"><strong>Nama</strong></label> <br>
                                            <label for="">{{$profile->name}}</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="username"><strong>Username</strong></label> <br>
                                            <label for="">{{$profile->username}}</label>
                                        </div>

                                        <div class="form-group">
                                            <label for="level_akses"><strong>Level Akses</strong></label> <br>
                                            <label for="">{{$profile->level_akses}}</label>
                                        </div>


                                    </form>

                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
@endsection
