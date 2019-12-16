<script src="{{url('/appstack/js/app.js')}}"></script>
{{--@if(Request::url() == url('reports'))--}}
{{--    <script>--}}
{{--        $(function () {--}}
{{--            // Line chart--}}
{{--            @foreach($histories as $history)--}}
{{--            new Chart(document.getElementById("chartjs-line"), {--}}
{{--                type: "line",--}}
{{--                data: {--}}
{{--                    labels: ["Minggu ke-1", "Minggu ke-2", "Minggu ke-3", "Minggu ke-4"],--}}
{{--                    datasets: [{--}}
{{--                        label: "Pemasukkan (Rp)",--}}
{{--                        fill: true,--}}
{{--                        backgroundColor: "transparent",--}}
{{--                        borderColor: window.theme.primary,--}}
{{--                        data: [{{$history->total}}, {{$history->total}}, {{$history->total}}, {{$history->total}}]--}}
{{--                    }, {--}}
{{--                        label: "Pengeluaran",--}}
{{--                        fill: true,--}}
{{--                        backgroundColor: "transparent",--}}
{{--                        borderColor: window.theme.tertiary,--}}
{{--                        borderDash: [4, 4],--}}
{{--                        data: [5000000, 2000000, 5000000, 2000000]--}}
{{--                    }]--}}
{{--                },--}}
{{--                options: {--}}
{{--                    maintainAspectRatio: false,--}}
{{--                    legend: {--}}
{{--                        display: false--}}
{{--                    },--}}
{{--                    tooltips: {--}}
{{--                        intersect: false--}}
{{--                    },--}}
{{--                    hover: {--}}
{{--                        intersect: true--}}
{{--                    },--}}
{{--                    plugins: {--}}
{{--                        filler: {--}}
{{--                            propagate: false--}}
{{--                        }--}}
{{--                    },--}}
{{--                    scales: {--}}
{{--                        xAxes: [{--}}
{{--                            reverse: true,--}}
{{--                            gridLines: {--}}
{{--                                color: "rgba(0,0,0,0.05)"--}}
{{--                            }--}}
{{--                        }],--}}
{{--                        yAxes: [{--}}
{{--                            ticks: {--}}
{{--                                stepSize: 1000000--}}
{{--                            },--}}
{{--                            display: true,--}}
{{--                            borderDash: [5, 5],--}}
{{--                            gridLines: {--}}
{{--                                color: "rgba(0,0,0,0)",--}}
{{--                                fontColor: "#fff"--}}
{{--                            }--}}
{{--                        }]--}}
{{--                    }--}}
{{--                }--}}
{{--            });--}}
{{--            @endforeach--}}
{{--        });--}}
{{--    </script>--}}
{{--@endif--}}

<script !src="">
    $(document).ready(function () {
        $('.select2').select2();
    });
</script>

<script !src="">
    $(document).ready(function () {
        $('.table_id').DataTable({
            "language": {
                "lengthMenu": "_MENU_ data per hal.",
                "zeroRecords": "Tidak menemukan apapun",
                "info": " _PAGE_ dari _PAGES_ hal.",
                "infoEmpty": "Data tidak tersedia",
                "infoFiltered": "(Hasil dari _MAX_ total data)",
                "paginate": {
                    "previous": "Sebelumnya",
                    "next": "Selanjutnya"
                },
                "search": "Cari"
            }
        });

        // var table = $('#example').DataTable();
        // var table2 = $('#example2').on("draw.dt", function () {
        //     $(this).find(".dataTables_empty").parents('tbody').empty();
        // }).DataTable({
        //     // "oLanguage": {"sZeroRecords": "", "sEmptyTable": ""}
        //     "bInfo": false
        //     , "bLengthChange": false
        //     , "bFilter": false
        //     , "bPaginate": false
        //     , "bSort": false
        //     , "oLanguage": {
        //         "sZeroRecords": false
        //         , "sEmptyTable": false
        //     }
        //
        // });
        // var data;
        // $('#example tbody').on('click', 'a', function () {
        //     data = table.row($(this).parents('tr')).data();
        //     table2.row.add([
        //         data[0],
        //         data[1],
        //         data[2],
        //         // '<td hidden>'+data[3]+'</td>',
        //         data[3],
        //         data[4],
        //         '<input size="4" name ="jumlah[]" id="jumlah' + data[0] + '" type="text" value="1"  />',
        //         '<label>coba</label>',
        //         data[5],
        //         // data[6]
        //     ]).draw(false);
        //     // $('table#example2 tbody').append('');
        //     // $('table#example2 tbody ').append(
        //     //     '<tr role="row"> ' +
        //     //     '<td hidden>' +
        //     //     '<input hidden size="4" name ="id[]" id="id' + data[0] + '" type="text" value="' + data[0] + '"  />' +
        //     //     '</td>' +
        //     //     '<td>' + data[1] + '</td>' +
        //     //     '<td>' + data[2] + '</td>' +
        //     //     '<td>' +
        //     //     '<input size="4" name ="jumlah[]" id="jumlah' + data[0] + '" type="text" value="1"  />' +
        //     //     '</td>' +
        //     //     '<td>' + data[4] + '</td>' +
        //     //     '<td>' + data[5] + '</td>' +
        //     //     // '<td>' + data[6] + '</td>' +
        //     //     '<td><a href="#">hapus</a></td>' +
        //     //     '</tr>'
        //     // );
        //     // table.row.remove();
        //     // table
        //     //     .row($(this).parents('tr'))
        //     //     .remove()
        //     //     .draw();
        //
        //
        //     table
        //         .row($(this).parents('tr'))
        //         .data([
        //             data[0],
        //             data[1],
        //             data[2],
        //             data[3],
        //             data[4],
        //             data[5],
        //             data[6]
        //         ])
        //         .draw();
        //     // table2.row().remove().draw( false );
        //
        //
        //     // $('table#example2 tbody ').append('<td>' + data[1]+ '</td>');
        //     // $('table#example2 tbody ').append('<td>' + data[3]+ '</td>');
        //     // $('table#example2 tbody ').append('<td>' + data[4]+ '</td></tr>');
        //     // $('table#example2 tbody').append('');

    //     });
    //     $('#example2 tbody').on('click', 'a', function () {
    //         data = table2.row($(this).parents('tr')).data();
    //         // table.row.add([
    //         //     data[0],
    //         //     data[1],
    //         //     data[2],
    //         //     data[3],
    //         //     data[4],
    //         //     // document.write(data[0]),
    //         //     // '<input size="4" name ="jumlah[]" id="jumlah' + data[0] + '" type="text" value="1"  />',
    //         //     data[6]
    //         // ]).draw(false);
    //
    //         // table
    //         //     .row($(this).parents('tr'))
    //         //     .data([
    //         //         data[0],
    //         //         data[1],
    //         //         data[2],
    //         //         --data[3],
    //         //         data[4],
    //         //         data[5],
    //         //         data[6]
    //         //     ])
    //         //     .draw();
    //
    //         // alert(data)
    //         // table.row.add(data).draw();
    //         // $('table#example2 tbody').append('');
    //
    //         // table.row.remove();
    //         table2
    //             .row($(this).parents('tr'))
    //             .remove()
    //             .draw();
    //     });
    });
</script>

<script>
    @if (session('status'))
    toastr.success("{{session('status')}}")
    @endif
    @if (session('gagal'))
    toastr.error("{{session('gagal')}}")
    @endif
</script>

