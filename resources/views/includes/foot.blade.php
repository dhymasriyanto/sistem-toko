<script src="{{url('/appstack/js/app.js')}}"></script>
@if(Request::url() == url('/'))
    <script>
        $(function () {
            // Line chart
            new Chart(document.getElementById("chartjs-line"), {
                type: "line",
                data: {
                    labels: ["Minggu ke-1", "Minggu ke-2", "Minggu ke-3", "Minggu ke-4"],
                    datasets: [{
                        label: "Pemasukkan (Rp)",
                        fill: true,
                        backgroundColor: "transparent",
                        borderColor: window.theme.primary,
                        data: [3000000, 2000000, 4000000, 2000000]
                    }, {
                        label: "Pengeluaran",
                        fill: true,
                        backgroundColor: "transparent",
                        borderColor: window.theme.tertiary,
                        borderDash: [4, 4],
                        data: [5000000, 2000000, 5000000, 2000000]
                    }]
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
                            ticks: {
                                stepSize: 1000000
                            },
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
@endif

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
                "zeroRecords": "Tidak menemukan apapaun",
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

        var table = $('#example').DataTable();
        // var table2 = $('#example2').DataTable({
            // "oLanguage": {"sZeroRecords": "", "sEmptyTable": ""}
        // });
        $('#example tbody').on('click', 'a', function () {
            var data = table.row($(this).parents('tr')).data();
            // table2.row.add(data).draw();
            // $('table#example2 tbody').append('');
            $('table#example2 tbody ').append(
                '<tr> ' +
                '<td hidden>' +
                '<input hidden size="4" name ="id[]" id="id' + data[0] + '" type="text" value="'+data[0]+'"  />' +
                '</td>' +
                '<td>' + data[1] + '</td>' +
                '<td>' + data[2] + '</td>' +
                '<td>' +
                '<input size="4" name ="jumlah[]" id="jumlah' + data[0] + '" type="text" value="1"  />' +
                '</td>' +
                '<td>' + data[4] + '</td>' +
                '<td>' + data[5] + '</td>' +
                '<td>' + data[6] + '</td>' +
                // '<td><a href="#"><i class="align-middle" data-feather="times"></i></a></td>' +
                '</tr>'
            );
            // table.row.remove();
            table
                .row($(this).parents('tr'))
                .remove()
                .draw();

            // table2.row().remove().draw( false );


            // $('table#example2 tbody ').append('<td>' + data[1]+ '</td>');
            // $('table#example2 tbody ').append('<td>' + data[3]+ '</td>');
            // $('table#example2 tbody ').append('<td>' + data[4]+ '</td></tr>');
            // $('table#example2 tbody').append('');

        });

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

