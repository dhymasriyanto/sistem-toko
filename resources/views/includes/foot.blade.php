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
    // $(document).ready(function () {
    //     $('.select2').select2();
    // });
    $(".select2").each(function () {
        $(this)
            .wrap("<div class=\"position-relative\"></div>")
            .select2({
                placeholder: "Pilih",
                dropdownParent: $(this).parent()
            });
    })
</script>
{{--@if(isset($histories) || isset($debtHistories))--}}
{{--    <script !src="">--}}
{{--        $(document).ready(function () {--}}
{{--            $('.example').DataTable({--}}
{{--                dom: 'Bfrtip',--}}
{{--                buttons: [--}}
{{--                    {--}}
{{--                        extend: 'print',--}}
{{--                        text: '<i class="fa fa-print"></i> Cetak struk',--}}

{{--                        @if(isset($histories))--}}
{{--                            @foreach($histories as $history)--}}

{{--                        messageTop: '<table >\n' +--}}
{{--                            '                        @foreach($histories as $history)\n' +--}}
{{--                            '                            <thead>\n' +--}}
{{--                            '                            <tr>\n' +--}}
{{--                            '                                <td width="50%">No. faktur</td>\n' +--}}
{{--                            '                                <td width="5%">:</td>\n' +--}}
{{--                            '                                <td>\n' +--}}
{{--                            '                                    {{$history->no_faktur}}\n' +--}}
{{--                            '                                </td>\n' +--}}
{{--                            '                            </tr>\n' +--}}
{{--                            '                            <tr>\n' +--}}
{{--                            '                                <td width="50%">Kasir</td>\n' +--}}
{{--                            '                                <td width="5%">:</td>\n' +--}}
{{--                            '                                <td>\n' +--}}
{{--                            '                                    {{$history->name}}\n' +--}}
{{--                            '                                </td>\n' +--}}
{{--                            '                            </tr>\n' +--}}
{{--                            '                            <tr>\n' +--}}
{{--                            '                                <td width="50%">Tanggal</td>\n' +--}}
{{--                            '                                <td width="5%">:</td>\n' +--}}
{{--                            '                                <td>\n' +--}}
{{--                            '                                    {{$history->tanggal_transaksi}}\n' +--}}
{{--                            '                                </td>\n' +--}}
{{--                            '                            </tr>\n' +--}}
{{--                            '                            </thead>\n' +--}}
{{--                            '\n' +--}}
{{--                            '                        @endforeach\n' +--}}
{{--                            '                    </table>',--}}
{{--                        @endforeach--}}
{{--                        @elseif(isset($debtHistories))--}}
{{--                        @foreach($debtHistories as $debtHistori)--}}
{{--                            messageTop: '<table class="col-md-4">\n' +--}}
{{--                            '                            @foreach($debtHistories as $debtHistory)\n' +--}}
{{--                            '                                <tr>\n' +--}}
{{--                            '                                    <td width="50%">No. faktur</td>\n' +--}}
{{--                            '                                    <td width="5%">:</td>\n' +--}}
{{--                            '                                    <td>\n' +--}}
{{--                            '                                        {{$debtHistory->no_faktur}}\n' +--}}
{{--                            '                                    </td>\n' +--}}
{{--                            '                                </tr>\n' +--}}
{{--                            '                                <tr>\n' +--}}
{{--                            '                                    <td width="50%">Kasir</td>\n' +--}}
{{--                            '                                    <td width="5%">:</td>\n' +--}}
{{--                            '                                    <td>\n' +--}}
{{--                            '                                        {{$debtHistory->name}}\n' +--}}
{{--                            '                                    </td>\n' +--}}
{{--                            '                                </tr>\n' +--}}
{{--                            '                                <tr>\n' +--}}
{{--                            '                                    <td width="50%">Tanggal</td>\n' +--}}
{{--                            '                                    <td width="5%">:</td>\n' +--}}
{{--                            '                                    <td>\n' +--}}
{{--                            '                                        {{$debtHistory->tanggal_transaksi}}\n' +--}}
{{--                            '                                    </td>\n' +--}}
{{--                            '                                </tr>\n' +--}}
{{--                            '                            @endforeach\n' +--}}
{{--                            '                        </table>\n' +--}}
{{--                            '                        <table class="col-md-4">\n' +--}}
{{--                            '                            @foreach($debtHistories as $debtHistory)\n' +--}}
{{--                            '                                <tr>\n' +--}}
{{--                            '                                    <td width="50%">Nama Penghutang</td>\n' +--}}
{{--                            '                                    <td width="5%">:</td>\n' +--}}
{{--                            '                                    <td>\n' +--}}
{{--                            '                                        {{$debtHistory->nama_penghutang}}\n' +--}}
{{--                            '                                    </td>\n' +--}}
{{--                            '                                </tr>\n' +--}}
{{--                            '                                <tr>\n' +--}}
{{--                            '                                    <td width="50%">Tenggat Hutang</td>\n' +--}}
{{--                            '                                    <td width="5%">:</td>\n' +--}}
{{--                            '                                    <td>\n' +--}}
{{--                            '                                        {{$debtHistory->tenggat_hutang}}\n' +--}}
{{--                            '                                    </td>\n' +--}}
{{--                            '                                </tr>\n' +--}}
{{--                            '                                <tr>\n' +--}}
{{--                            '                                    <td width="50%">Alamat</td>\n' +--}}
{{--                            '                                    <td width="5%">:</td>\n' +--}}
{{--                            '                                    <td>\n' +--}}
{{--                            '                                        {{$debtHistory->alamat}}\n' +--}}
{{--                            '                                    </td>\n' +--}}
{{--                            '                                </tr>\n' +--}}
{{--                            '                            @endforeach\n' +--}}
{{--                            '                        </table>\n' +--}}
{{--                            '                        <table  class="col-md-4">\n' +--}}
{{--                            '                            @foreach($debtHistories as $debtHistory)\n' +--}}
{{--                            '                                <tr>\n' +--}}
{{--                            '                                    <td width="50%">Nomer KTP</td>\n' +--}}
{{--                            '                                    <td width="5%">:</td>\n' +--}}
{{--                            '                                    <td>\n' +--}}
{{--                            '                                        {{$debtHistory->nomer_ktp}}\n' +--}}
{{--                            '                                    </td>\n' +--}}
{{--                            '                                </tr>\n' +--}}
{{--                            '                                <tr>\n' +--}}
{{--                            '                                    <td width="50%">Nomer HP</td>\n' +--}}
{{--                            '                                    <td width="5%">:</td>\n' +--}}
{{--                            '                                    <td>\n' +--}}
{{--                            '                                        {{$debtHistory->nomer_hp}}\n' +--}}
{{--                            '                                    </td>\n' +--}}
{{--                            '                                </tr>\n' +--}}
{{--                            '\n' +--}}
{{--                            '                            @endforeach\n' +--}}
{{--                            '                        </table>'--}}
{{--                        @endforeach--}}
{{--                        @endif--}}
{{--                    }--}}
{{--                ],--}}
{{--                "bInfo": false--}}
{{--                , "bLengthChange": false--}}
{{--                , "bFilter": false--}}
{{--                , "bPaginate": false--}}
{{--                , "bSort": false--}}
{{--                , "oLanguage": {--}}
{{--                    "sZeroRecords": false--}}
{{--                    , "sEmptyTable": false--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}

{{--    </script>--}}
{{--@endif--}}
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


        // var datatablesButtons = $('#tabel_riwayat').DataTable({
        // responsive: true,
        // lengthChange: !1,
        // buttons: ["copy", "print"]
        // });
        // datatablesButtons.buttons().container().appendTo("#datatable_wrapper .col-md-6:eq(0)");

        //     // Datatables basic
        //     $("#datatables-basic").DataTable({
        //         responsive: true
        //     });
        // Datatables with Buttons


        //     // Datatables with Multiselect
        //     var datatablesMulti = $("#datatables-multi").DataTable({
        //         responsive: true,
        //         select: {
        //             style: "multi"
        //         }
        //     });

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

<script>
    $(function() {
        // Initialize validation
        $(".validation-form").validate({
            ignore: ".ignore, .select2-input",
            focusInvalid: false,
            rules: {

                "password": {
                    required: true,
                    minlength: 8,
                    maxlength: 20
                },
                "old_password": {
                    required: true,
                    minlength: 8,
                    maxlength: 20
                },
                "password_confirmation": {
                    required: true,
                    minlength: 8,
                    equalTo: "input[name=\"password\"]"
                },
                "harga": {
                    required: true,
                    minlength: 2,
                    number:true
                },
                "jumlah_stok": {
                    required: true,
                    number:true
                },

                "jumlah_barang": {
                    required: true,
                    number:true
                },
                "jumlah": {
                    required: true,
                    number:true
                },

            },
            // Errors
            errorPlacement: function errorPlacement(error, element) {
                var $parent = $(element).parents(".form-group");
                // Do not duplicate errors
                if ($parent.find(".jquery-validation-error").length) {
                    return;
                }
                $parent.append(
                    error.addClass("jquery-validation-error small form-text invalid-feedback")
                );
            },
            highlight: function(element) {
                var $el = $(element);
                var $parent = $el.parents(".form-group");
                $el.addClass("is-invalid");
                // Select2 and Tagsinput
                // if ($el.hasClass("select2-hidden-accessible") || $el.attr("data-role") === "tagsinput") {
                //     $el.parent().addClass("is-invalid");
                // }
            },
            unhighlight: function(element) {
                $(element).parents(".form-group").find(".is-invalid").removeClass("is-invalid");
            }
        });
    });

</script>
