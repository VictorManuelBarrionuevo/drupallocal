(function ($) {
    $(document).ready(function () {

        window.array_paises = [];//array global de paises
        $("#pais_prov li").each(function () {
            var pais_id = $(this).attr("pais-id");//se le pasa el atributo attr al this(#pais_prov list) pais_id
            var pais_name = $(this).attr("pais-name");//lo mismo que arriba pero le pasamos pais-name
            array_paises[pais_id] = pais_name;//recorro el array paises con el key pais:id y el value pais name
        });

        window.options_for_paises = "<option selected disabled hidden style='display: none' value=''>--Seleccionar pais--</option>";
        array_paises.forEach(function (pais, key) {// una vez creado el array paises lo meto en un for each con key value
            options_for_paises += '<option value="' + key + '">' + pais + '</option>';//creo otro arrray global optionfor paies y concateno el key value(pais)
        });
        $('#pais').html(options_for_paises);
        
        $('#pais').on('change', function () {
            window.id_pais_seleccionado = $(this).val();
            window.array_provincias = [];
            $("#pais_prov li").each(function () {
                var pais_id = $(this).attr("pais-id");
                if(pais_id == id_pais_seleccionado){
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