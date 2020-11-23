(function ($) {
    $(document).ready(function () {
        //$("input").prop('required',true);
        $(".ocultar").hide();
        window.array_paises = [];
        $("#pais_prov li").each(function () {
            var pais_id = $(this).attr("pais-id");
            var pais_name = $(this).attr("pais-name");
            array_paises[pais_id] = pais_name;
        });

        window.options_for_paises = "<option selected disabled hidden style='display: none' value=''>--Seleccionar pais--</option>";
        array_paises.forEach(function (pais, key) {
            options_for_paises += '<option value="' + key + '">' + pais + '</option>';
        });
        $('#pais').html(options_for_paises);

        $('#pais').on('change', function () {
            window.id_pais_seleccionado = $(this).val();
            window.array_provincias = [];
            $("#pais_prov li").each(function () {
                var pais_id = $(this).attr("pais-id");
                if (pais_id == id_pais_seleccionado) {
                    var provincia_id = $(this).attr("provincia-id");
                    var provincia_name = $(this).attr("provincia-name");
                    array_provincias[provincia_id] = provincia_name;
                }
            });
            window.options_for_provincias = '';
            array_provincias.forEach(function (provincia, key) {
                options_for_provincias += '<option value="' + key + '">' + provincia + '</option>';
            });
            $('#provincia').html(options_for_provincias);
            $(".ocultar").show();
        });

        $("#especificar").hide();
        $('input[type=radio][name=gender]').change(function () {
            if (this.value == 'male') {
                $("#especificar").hide();
            }
            else if (this.value == 'female') {
                $("#especificar").hide();
            }
            else if (this.value == 'other') {
                $("#especificar").show();
            }
        });

    });
})(jQuery);