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
                @elseif($hour > 11 && $hour <= 14)
                   {{"Siang"}}
                @elseif($hour > 14 && $hour < 18)
                    {{"Sore"}}
                @elseif($hour >= 18 && $hour < 24)
                    {{"Malam"}}
                @else
                    {{"Begadang"}}
                @endif, {{Auth::user()->name}}!
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
                        <h3 class="mb-2">2.562</h3>
                        <div class="mb-0">Sales Today</div>
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
                        <i class="feather-lg text-warning" data-feather="activity"></i>
                    </div>
                    <div class="media-body">
                        <h3 class="mb-2">17.212</h3>
                        <div class="mb-0">Visitors Today</div>
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
                        <i class="feather-lg text-success" data-feather="dollar-sign"></i>
                    </div>
                    <div class="media-body">
                        <h3 class="mb-2">$ 24.300</h3>
                        <div class="mb-0">Total Earnings</div>
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
                        <i class="feather-lg text-danger" data-feather="shopping-bag"></i>
                    </div>
                    <div class="media-body">
                        <h3 class="mb-2">43</h3>
                        <div class="mb-0">Pending Orders</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                Tenggat hutang terdekat : ALEX
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card flex-fill w-100">
            <div class="card-header">
                <h5 class="card-title">Laporan Terkini</h5>
                <h6 class="card-subtitle text-muted">Berikut laporan terkini bulan kemarin.</h6>
            </div>
{{--            <div class="card-body">--}}
{{--                <div class="chart">--}}
{{--                    <canvas id="chartjs-line"></canvas>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                Persediaan mau habis : PAKU
            </div>
        </div>
    </div>
</div>


@endsection
