(function ($) {
    $(document).ready(function () {
        $(".ocultar").hide();
        window.array_paises = [];
        $("#pais_prov li").each(function () {
            var pais_id = $(this).attr("attr-id");
            var pais_name = $(this).attr("attr-name");
            array_paises[pais_id] = pais_name;
        });

        var options_for_paises = '<option selected disabled>Seleccionar Pais</option>';
        array_paises.forEach(function (pais, key) {
            options_for_paises += '<option value="' + key + '">' + pais + '</option>';
        });
        $("#pais").html(options_for_paises);

        $('#pais').on('change', function () {
            var id_pais = $(this).val();
            $.get("/get_provincias_by_id_pais/" + id_pais, function (data, status) {
                var options_for_provincias = '<option selected disabled>Seleccione Provincia</option>';
                var string = data.data;
                string.forEach(function (value, key) {
                    options_for_provincias += '<option value="' + value.id + '">' + value.name + '</option>';
                });
                $("#provincia").html(options_for_provincias);
                $(".ocultar").show();
            });
        });
    });
})(jQuery);
