<script src="{{url('/appstack/js/app.js')}}"></script>

<script !src="">
    $(".select2").each(function () {
        $(this)
            .wrap("<div class=\"position-relative\"></div>")
            .select2({
                placeholder: "Pilih",
                dropdownParent: $(this).parent()
            });
    })
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
        $.validator.addMethod("greaterThan",
            function(value, element, params) {

                if (!/Invalid|NaN/.test(new Date(value))) {
                    return new Date(value) > new Date($(params).val());
                }

                return isNaN(value) && isNaN($(params).val())
                    || (Number(value) > Number($(params).val()));
            },'Tanggal harus lebih dari hari ini.');
        $.validator.addMethod('le', function(value, element, param) {
            return this.optional(element) || value >= +$(param).val();
        }, 'Uang masih kurang.');
        $.validator.addMethod('se', function(value, element, param) {
            return this.optional(element) || value >= 0;
        }, 'Angka tidak boleh minus.');
        $.validator.addMethod('ge', function(value, element, param) {
            return this.optional(element) || value <= +$(param).val();
        }, 'Uang berlebih. Anda yakin ini menghutang?');
        // Initialize validation
        $("form.form-uang").validate({
            focusInvalid: false,
            rules: {
                "uang": {
                    required: true,
                    number: true,
                    se:"",
                    le:'#total',
                },
            },
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



        $("form#form-utang").validate({
            focusInvalid: false,
            rules: {

                "dp": {
                    required: true,
                    number: true,
                    ge:'#total2',
                    se:""
                },
                "nama_penghutang": {
                    required: true
                },
                "nomer_ktp": {
                    required: true,
                    number:true,
                    maxlength: 16
                },
                "nomer_hp": {
                    required: true,
                    number:true,
                    maxlength: 12
                },
                "alamat": {
                    required: true
                },
                "tenggat": {
                    required: true,
                    greaterThan: "#tanggal"
                },

            },
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
                "nama_penghutang": {
                    required: true
                },
                "nomer_ktp": {
                    required: true,
                    number:true,
                    maxlength: 16
                },
                "nomer_hp": {
                    required: true,
                    number:true,
                    maxlength: 12
                },
                "alamat": {
                    required: true
                },
                "tenggat": {
                    required: true
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
