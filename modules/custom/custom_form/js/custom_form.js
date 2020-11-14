(function ($) {
    $(document).ready(function () {

        window.array_paises = [];//array global de paises
        $("#pais_prov li").each(function () {
            var pais_id = $(this).attr("pais-id");//se le pasa el atributo attr al this(#pais_prov list) pais_id
            var pais_name = $(this).attr("pais-name");//lo mismo que arriba pero le pasamos pais-name
            array_paises[pais_id] = pais_name;//recorro el array paises con el key pais:id y el value pais name
        });

        window.options_for_paises = '';
        array_paises.forEach(function(pais, key) {// una vez creado el array paises lo meto en un for each con key value
            options_for_paises += '<option value="' + key + '">' + pais + '</option>';//creo otro arrray global optionfor paies y concateno el key value(pais)
        });

        $('#pais').html(options_for_paises);//traigo el id y con html le paso el resultado del array
        //tendria que traer el resultado de optionsfor paises y a eso relacionarle la provincia

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