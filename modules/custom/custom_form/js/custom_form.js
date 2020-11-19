(function ($) {
    $(document).ready(function () {

        window.array_paises = [];//array global de paises
        $("#pais_prov li").each(function () {
            var pais_id = $(this).attr("pais-id");//se le pasa el atributo attr al this(#pais_prov list) pais_id
            var pais_name = $(this).attr("pais-name");//lo mismo que arriba pero le pasamos pais-name
            array_paises[pais_id] = pais_name;//recorro el array paises con el key pais:id y el value pais name
        });

        window.options_for_paises = '';
        array_paises.forEach(function (pais, key) {// una vez creado el array paises lo meto en un for each con key value
            options_for_paises += '<option value="' + key + '">' + pais + '</option>';//creo otro arrray global optionfor paies y concateno el key value(pais)
        });

        $('#pais').html(options_for_paises);






        window.array_provincias = [];
        $("#pais_prov li").each(function () {
            var provincia_id = $(this).attr("provincia-id");
            var provincia_name = $(this).attr("provincia-name");
            array_provincias[provincia_id] = provincia_name;

        });



        window.options_for_provincias = '';
        array_provincias.forEach(function (provincia, key) {
            options_for_provincias += '<option value="' + key + '">' + provincia + '</option>';
        });
        
        
        $('#pais').on('change', function () {
            $('#provincia').html(options_for_provincias);
        });





        //$('#pais').on('change', function () {
        //var hello= 'hola'
        //$('#pais').on('change', function () {

        //   if ( array_paises.length< 2 ) {
        //      console.log(hello);
        //     }

        //  });





        //for(var i = 0; i < array_provincias; i++) {
        //   console.log(array_provincias);

        //$('#dropdown select').append('<option value='+i+'>'+array_provincias[provincia_name]+'</option>');
        //}

        //window.options_for_provincias = '';
        //array_provincias.forEach(function (provincia, key) {
        //     options_for_provincia += '<option value="' + key + '">' + provincia + '</option>';
        //});

        //$('#provincia').html(options_for_provincias);






        //traigo el id y con html le paso el resultado del array
        //tendria que traer el resultado de optionsfor paises y a eso relacionarle la provincia
        //que quiero hacer? quiero trer el provincia name de acuerdo al pais name, y ponerlo en un options for 
        //provincias;puedo usar elemento hijo?append
        //lo primero que tengo que hacer es vaciar a provincias

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