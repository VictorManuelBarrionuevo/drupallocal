(function ($) {
    $(document).ready(function () {

        window.array_paises = [];
        $("#pais_prov li").each(function () {
            var pais_id = $(this).attr("pais-id");
            var pais_name = $(this).attr("pais-name");
            array_paises[pais_id] = pais_name;
        });

        window.options_for_paises = '';
        array_paises.forEach(function(pais, key) {
            options_for_paises += '<option value="' + key + '">' + pais + '</option>';
        });

        $('#pais').html(options_for_paises);

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