@extends('layouts.app')

@section('title', 'Laporan')

@section('content')

    <div class="col-12">
        <div class="accordion" id="accordionExample">
            <div class="card">
                @foreach($dataTahun as $index => $histories)
                    <div class="card-header" id="heading{{$index}}">
                        <h5 class="card-title my-2">
                            <a href="#" data-toggle="collapse" data-target="#collapse{{$index}}"
                               aria-expanded="true" aria-controls="collapse{{$index}}" class="">
                                {{$index}}
                            </a>
                        </h5>
                    </div>
                    <div id="collapse{{$index}}" class="collapse" aria-labelledby="heading{{$index}}"
                         data-parent="#accordionExample" style="">
                        <div class="card-body">
                            <div class="card flex-fill w-100">
                                <div class="accordion" id="accordionExample2">
                                    {{--                                    @foreach($dataBulan as $index => $histories)--}}
                                    @foreach($histories as $history)
                                        <div class="card-header" id="headingg{{$index}}">
                                            <h5 class="card-title my-2">
                                                <a href="#" data-toggle="collapse"
                                                   data-target="#collapsee{{$index}}" aria-expanded="true"
                                                   aria-controls="collapsee{{$index}}" class="">
                                                    {{--                                                    {{$index}}--}}
                                                    {{date('F', mktime(0, 0, 0, $history, 10))}}
{{--                                                    {{$history}}--}}
                                                </a>
                                            </h5>
                                        </div>
                                    @endforeach
                                    {{--                                    @foreach($histories as $history)--}}

                                    <div id="collapsee{{$index}}" class="collapse"
                                         aria-labelledby="headingg{{$index}}"
                                         data-parent="#accordionExample2"
                                         style="">
                                        <div class="card-body">
                                            <div class="card flex-fill w-100">
                                                <div class="card-header">
                                                    <h5 class="card-title">Laporan Terkini</h5>
                                                    <h6 class="card-subtitle text-muted">Berikut laporan terkini
                                                        bulan kemarin.</h6>
                                                </div>

                                                <div class="card-body">
                                                    <div class="chart">
                                                        <canvas id="chartjs-line{{$index}}"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--                                    @endforeach--}}
                                    {{--                                    @endforeach--}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
