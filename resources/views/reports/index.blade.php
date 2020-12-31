@extends('layouts.app')

@section('title', 'Laporan')

@section('content')

    <div class="col-12">
        <div class="col-12">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <h5 class="card-title">Grafik Laporan</h5>
                    <h6 class="card-subtitle text-muted">Berikut grafik laporan yang di data perbulan di tahun {{date("Y")}}</h6>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="chartjs-line"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            // Line chart
            var high=0;
            new Chart(document.getElementById("chartjs-line"), {
                type: "line",
                data: {
                    labels: [
                        @for($i=1; $i<=12;$i++)
                        @foreach($histories as $history =>$data)
                        @if($histories[$history]['tanggal']==$i)
                        @switch($i)
                            @case(1)
                            "Januari",
                        @break

                            @case(2)
                            "Februari",
                        @break

                            @case(3)
                            "Maret",

                        @break

                            @case(4)
                            "April",
                        @break

                            @case(5)
                            "Mei",
                        @break

                            @case(6)
                            "Juni",
                        @break

                            @case(7)
                            "Juli",
                        @break

                            @case(8)
                            "Agustus",
                        @break

                            @case(9)
                            "September",
                        @break

                            @case(10)
                            "Oktober",
                        @break

                            @case(11)
                            "November",
                        @break

                            @case(12)
                            "Desember",
                        @break
                        @endswitch

                        @endif
                        @endforeach
                        @endfor
                    ],
                    datasets: [{
                        label: "Pemasukkan (Rp)",
                        fill: true,
                        backgroundColor: "transparent",
                        borderColor: window.theme.primary,
                        data: [
                            @foreach($histories as $history =>$data)
                            {{$histories[$history]['total']}},
                            @endforeach
                        ]
                    }, {
                        label: "Pengeluaran (Rp)",
                        fill: true,
                        backgroundColor: "transparent",
                        borderColor: window.theme.tertiary,
                        borderDash: [4, 4],
                        data: [
                            @foreach($pengeluaran as $keluar)
                            {{$keluar->total}},
                            @endforeach
                        ]
                    },
                        {
                            label: "Hutang (Rp)",
                            fill: true,
                            backgroundColor: "transparent",
                            borderColor: window.theme.danger,
                            borderDash: [4, 4],
                            data: [
                                @foreach($utangs as $history =>$data)
                                {{$utangs[$history]['total']}},
                                @endforeach
                            ]
                        }
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    tooltips: {
                        intersect: false
                    },
                    hover: {
                        intersect: true
                    },
                    plugins: {
                        filler: {
                            propagate: false
                        }
                    },
                    scales: {
                        xAxes: [{
                            reverse: true,
                            gridLines: {
                                color: "rgba(0,0,0,0.05)"
                            }
                        }],
                        yAxes: [{
                            // ticks: {
                            //     // stepSize: 10000000
                            // },
                            display: true,
                            borderDash: [5, 5],
                            gridLines: {
                                color: "rgba(0,0,0,0)",
                                fontColor: "#fff"
                            }
                        }]
                    }
                }
            });
        });
    </script>
@endsection
