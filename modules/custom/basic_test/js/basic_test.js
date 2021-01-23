(function ($) {
    $(document).ready(function () {

        $(".botones").click(function () {
            var allows = ["0","1","2","3","4","5","6","7","8","9","+","-"];
            var valor_previo = $("#visor").val();
            var valor_boton_presionado = $(this).val();
            
            var lastChar = valor_previo.substr(valor_previo.length - 1);
            if(lastChar == "+" || lastChar == "-"){
                if(valor_boton_presionado == lastChar){
                    return;
                }
            }
            


            if(allows.indexOf(valor_boton_presionado) > -1){
                var concatenacion = valor_previo + valor_boton_presionado;
                $("#visor").val(concatenacion);
            }
        });

        $(".limpiar").click(function () {
            $("#visor").val("");
        });

        $(".calcular").click(function () {
            var visor = $("#visor").val();
            var visor_split = visor.split("+");
            window.array_para_sumar = [];
            window.array_para_restar = [];

            visor_split.forEach(function (valor, indice, a) {
                var visor_split_negativo = valor.split("-");
                window.num_total = 0;
                if (visor_split_negativo.length > 1) {
                    visor_split_negativo.forEach(function (valor, i, array) {
                        if(i == 0){
                            array_para_sumar.push(array[i]);
                        } else {
                            array_para_restar.push(array[i]);
                        }
                    });
                } else {
                    array_para_sumar.push(a[indice]);
                }
            });

            window.total_suma = 0;
            window.total_resta = 0;

            array_para_sumar.forEach(function (v, i, array) {
                var num = parseFloat(v);
                total_suma = total_suma + num;
            });

            array_para_restar.forEach(function (v, i, array) {
                var num = parseFloat(v);
                total_resta = total_resta + num;
            });

            var result = total_suma - total_resta;
            $("#visor").val(result);
        });
        
        

        /*$("#cua_3").hide();

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

        });*/

    });
})(jQuery);