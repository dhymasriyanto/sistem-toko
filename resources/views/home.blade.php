@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    Selamat
                    @if($hour >= 6 && $hour <= 11)
                        {{"Pagi"}}
                        <div class="fa-pull-right">
                            <img width="50" src="{{asset('/appstack/img/photos/morning.png')}}" alt="">
                        </div>
                    @elseif($hour > 11 && $hour <= 14)
                        {{"Siang"}}
                        <div class="fa-pull-right">
                            <img width="50" src="{{asset('/appstack/img/photos/noon.png')}}" alt="">
                        </div>
                    @elseif($hour > 14 && $hour < 18)
                        {{"Sore"}}
                        <div class="fa-pull-right">
                            <img width="50" src="{{asset('/appstack/img/photos/afternoon.png')}}" alt="">
                        </div>
                    @elseif($hour >= 18 && $hour < 24)
                        {{"Malam"}}
                        <div class="fa-pull-right">
                            <img width="50" src="{{asset('/appstack/img/photos/evening.png')}}" alt="">
                        </div>
                    @else
                        {{"Begadang"}}
                        <div class="fa-pull-right">
                            <img width="50" src="{{asset('/appstack/img/photos/night.png')}}" alt="">
                        </div>
                    @endif, {{Auth::user()->name}}!


                </div>
            </div>
        </div>


        @if(Auth::user()->level_akses=="Pemilik Toko")

                <div class="col-12 col-sm-6 col-xl d-flex">
                    <div class="card flex-fill">
                        <div class="card-body py-4">
                            <div class="media">
                                <div class="d-inline-block mt-2 mr-3">
                                    <i class="feather-lg text-success" data-feather="activity"></i>
                                </div>
                                <div class="media-body">
                                    <h3 class="text-success mb-2">@if(isset($result)) @money($result) @else
                                            @money(0) @endif</h3>
                                    <div class="text-success mb-0">Keuntungan</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl d-flex">
                    <div class="card flex-fill">
                        <div class="card-body py-4">
                            <div class="media">
                                <div class="d-inline-block mt-2 mr-3">
                                    <i class="feather-lg text-danger" data-feather="dollar-sign"></i>
                                </div>
                                <div class="media-body">
                                    <h3 class="text-danger mb-2">@if(isset($utang)) @money($utang) @else
                                            @money(0) @endif</h3>
                                    <div class="text-danger mb-0">Total Hutang</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl d-flex">
                    <div class="card flex-fill">
                        <div class="card-body py-4">
                            <div class="media">
                                <div class="d-inline-block mt-2 mr-3">
                                    <i class="feather-lg text-warning" data-feather="arrow-up-circle"></i>
                                </div>
                                <div class="media-body">
                                    <h3 class="text-warning mb-2">{{count($penjualan)}}</h3>
                                    <div class="text-warning mb-0">Total Penjualan</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl d-flex">
                    <div class="card flex-fill">
                        <div class="card-body py-4">
                            <div class="media">
                                <div class="d-inline-block mt-2 mr-3">
                                    <i class="feather-lg text-dark" data-feather="arrow-down-circle"></i>
                                </div>
                                <div class="media-body">
                                    <h3 class="text-dark mb-2">{{count($pengeluaran)}}</h3>
                                    <div class="text-dark mb-0">Total Pembelian</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-12 col-sm-6 col-xl d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4">
                        <div class="media">
                            <div class="d-inline-block mt-2 mr-3">
                                <i class="feather-lg text-primary" data-feather="shopping-cart"></i>
                            </div>
                            <div class="media-body">
                                <h3 class="text-primary mb-2">{{count($stuff)}} Barang</h3>
                                <div class="text-primary mb-0">Jumlah Persediaan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4">
                        <div class="media">
                            <div class="d-inline-block mt-2 mr-3">
                                <i class="feather-lg text-info" data-feather="users"></i>
                            </div>
                            <div class="media-body">
                                <h3 class="text-info mb-2">{{count($karyawan)}} Orang</h3>
                                <div class="text-info mb-0">Jumlah Karyawan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4">
                        <div class="media">
                            <div class="d-inline-block mt-2 mr-3">
                                <i class="feather-lg text-secondary" data-feather="user-x"></i>
                            </div>
                            <div class="media-body">
                                <h3 class="text-secondary mb-2">{{count($penghutang)}} Orang</h3>
                                <div class="text-secondary mb-0">Jumlah Penghutang</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title">Laporan Terkini</h5>
                        <h6 class="card-subtitle text-muted">Berikut laporan terkini tahun ini.</h6>
                        <a class="fa-pull-right" href="/reports">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @endif
    </div>



@endsection
