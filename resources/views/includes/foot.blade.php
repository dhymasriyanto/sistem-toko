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
    });
</script>
