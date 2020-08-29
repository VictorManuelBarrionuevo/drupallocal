function str_validate(keyCode) {
    var str = document.getElementById("input1").value;
    var last_char_str = str.substr(str.length - 1);
    if (isNaN(last_char_str)) {
        if (last_char_str !== '+' && last_char_str !== '-') {
            var new_str = str.slice(0, -1);
            document.getElementById("input1").value = new_str;
        }
    }
}

function calculate() {
    var str = document.getElementById("input1").value;
    var split_by_sum = str.split("+");
    window.ver = split_by_sum;
    window.acum_res = 0;
    window.acum_sum = 0;
    split_by_sum.forEach(function (numbers) {
        var ver = window.ver;
        var split_by_res = numbers.split("-");
        window.acum_sum = window.acum_sum + Number(split_by_res[0]);
        if (typeof split_by_res[1] !== 'undefined') {
            var positions = split_by_res.length;
            for (i = 1; i < positions; i++) {
                window.acum_res = window.acum_res - Number(split_by_res[i]);
            }
        }
    });
    //CALCULO FINAL 
    var result = window.acum_sum + window.acum_res;
    //MOSTRAR EL STRING CONCATENADO CON EL RESULTADO
    document.getElementById("input1").value = result;
}

function writeNumber(num) {
    var prev_num = document.getElementById("input1").value;
    var new_num = prev_num + num;
    document.getElementById("input1").value = new_num;
}

function clearNumbers() {
    var arr = document.getElementsByClassName("clear");
    document.querySelectorAll('.clear').forEach(function (inputs) {
        inputs.value = '';
    });
}



function cambiar_tamanio() {
    var elemento = document.getElementById('cuadrado1');

    var next_ancho = Math.floor(Math.random() * 100);
    var next_alto = Math.floor(Math.random() * 100);
    var current_ancho = elemento.offsetWidth;
    var current_alto = elemento.offsetHeight;

    if (next_ancho > current_ancho) {
        for (a = current_ancho; a < next_ancho; a++) {
            delay_width(a);
        }
    } else {
        for (a = current_ancho; a > next_ancho; a--) {
            delay_width(a);
        }
    }
    if (next_alto > current_alto) {
        for (a = current_alto; a < next_alto; a++) {
            delay_height(a);
        }
    } else {
        for (a = current_alto; a > next_alto; a--) {
            delay_height(a);
        }
    }
}

function delay_width(a) {
    var elemento = document.getElementById('cuadrado1');
    elemento.style.width = a + "px";
}
function delay_height(a) {
    var elemento = document.getElementById('cuadrado1');
    elemento.style.height = a + "px";
}

function move_this(x) {
    x.style.top = Math.floor(Math.random() * 100) + "%";
    x.style.left = Math.floor(Math.random() * 100) + "%";
}

function test_for() {
    for (i = 0; i < 10; i++) {
        var ver = i;
    }
}

(function ($) {
    $(document).ready(function () {

        $("#boton").click(function () {
            $("#cuadrado5").animate({
                left: '+=25px',
                height: '+=15px',
                width: '+=15px'
            });
        });

        $("#cuadrado4").hover(function () {
            console.log("hover");
            $("#cuadrado4").animate({ marginLeft: "200" });

        });

        $("#cuadrado4").mouseleave(function () {
        //test
            $("#cuadrado4").animate({ marginLeft: "0" });
        });

        $("#cuadrado5").hover(function () {
            var x = $("#cuadrado5").position();
            var nevapos = x.left + 20;
            nevapos = nevapos + 'px';
            $("#cuadrado5").css({ 'left': nevapos });
        });

        window.cuadrado6Width = $("#cuadrado6").width();
        $("#cuadrado6").mouseenter(function () {
            $(this).animate({
                width: "400"
            });
        }).mouseleave(function () {
            $(this).animate({
                width: cuadrado6Width
            });
        });

        $("#alternar").click(function () {
            $('.pos').each(function (index) {
                var self = this;
                setTimeout(function () {
                    //traer id de posicion actual
                    var id_pos = $(self).attr("id");
                    //traer texto de la posicion actual
                    var input_text = $(self).val();
                    //calcular la id de la siguiente posicion
                    var next_id = parseInt(id_pos) + 1;
                    //guardar en el siguiente elemento el texto
                    $('#' + next_id).val(input_text);
                    //borrar el texto del campo actual
                    $('#' + id_pos).val('');
                }, index * 1000);
            });
        });
    });
})(jQuery);