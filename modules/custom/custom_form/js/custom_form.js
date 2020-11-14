(function ($) {
    $(document).ready(function () {
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