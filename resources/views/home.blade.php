@extends('layouts.app')

@section('title', 'Home')

@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                Selamat pagi, Admin!
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
            <div class="card-body">
                <div class="chart">
                    <canvas id="chartjs-line"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                Persediaan mau habis : PAKU
            </div>
        </div>
    </div>

@endsection
