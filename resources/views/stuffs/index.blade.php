@extends('layouts.app')

@section('title', 'Persediaan')

@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12 col-lg-12">

                <h1 class="h3 mb-3">
                    Daftar Barang
                </h1>
                <div class="card">
                    <div class="card-body">
                        <a href="/stuffs/create" class="btn btn-primary my-3">Tambah</a>
                        <table class="table table-responsive table_id display">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Jumlah Stok</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Harga per Satuan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{--@dd($stuffs)--}}
                            @foreach($stuffs as $stuff)
                                <tr>
                                    <td scope="row">{{$loop->iteration}}</td>
                                    <td>{{$stuff->nama_barang}}</td>
                                    <td>{{$stuff->nama_kategori}}</td>
                                    <td>{{$stuff->jumlah_stok}}</td>
                                    <td>{{$stuff->nama_satuan}}</td>
                                    <td>@money($stuff->harga)</td>
                                    <td>
                                        <a  title="Edit data" href="{{url('stuffs/'.$stuff->id.'/edit')}}"><span
                                              ><i data-feather="edit"></i></span></a>

                                        <a  title="Hapus data" style="color: red" data-toggle="modal" data-target="#sizedModalSm{{$stuff->id}}">
                                            <i data-feather="trash"></i>
                                        </a>
                                        {{--                                            <button type="button" class="btn btn-danger">Hapus</button>--}}
                                        <div class="modal fade" id="sizedModalSm{{$stuff->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Warning!</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body m-3">
                                                        <p class="mb-0">Yakin untuk menghapus {{$stuff->nama_barang}}?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                        <form action="/stuffs/{{$stuff->id}}" method="post" class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="btn btn-danger">Yakin</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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
