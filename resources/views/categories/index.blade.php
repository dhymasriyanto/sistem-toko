@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12 col-lg-12">
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
                    Daftar Kategori
                </h1>
                <div class="card">
                    <div class="card-body">
                        <a href="/categories/create" class="btn btn-primary my-3">Tambah</a>
                        <table class="table table-responsive table_id display">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Kategori</th>
                                <th scope="col" width="60%">Deskripsi</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{--@dd($categories)--}}
                            @foreach($categories as $category)
                                <tr>
                                    <td scope="row">{{$loop->iteration}}</td>
                                    <td>{{$category->nama_kategori}}</td>
                                    <td>{{$category->deskripsi}}</td>
                                    <td>
                                        <a href="{{url('categories/'.$category->id.'/edit')}}"><span
                                                class="btn btn-primary">Edit</span></a>
                                        <form action="/categories/{{$category->id}}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
