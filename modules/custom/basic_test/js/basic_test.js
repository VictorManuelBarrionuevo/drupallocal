(function ($) {
    $(document).ready(function () {
        $("#cua_3").hide();

        $(".cuadrado_test_tamano").click(function () {
            var min = 50;
            var max = 500;
            var random = Math.floor(Math.random() * (max - min + 1)) + min;
            $(".cuadrado_test_tamano").css("width", random);
            $(".cuadrado_test_tamano").css("height", random);
        });

        $(".cuadrado_test_hover").mouseover(function(){
            var min = 0;
            var max = 600;
            var random = Math.floor(Math.random() * (max - min + 1)) + min;
            $(".cuadrado_test_hover").css("top", random);

            var min = 0;
            var max = 600;
            var random = Math.floor(Math.random() * (max - min + 1)) + min;
            $(".cuadrado_test_hover").css("left", random);

        });

    });
})(jQuery);