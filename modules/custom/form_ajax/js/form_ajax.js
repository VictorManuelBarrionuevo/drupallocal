(function ($) {
$(document).ready(function () {
    $("#formulario").bind("submit", function () { //la funcion blind es parecida al "on", le pega al boton submit y dispara una funcion
        var button_send = $("#button_send");
        $.ajax({
            type: $(this).attr("method"),//le pegamos al metodo  post
            url: $(this).attr("action"),//le pegamos a la accion, en este caso queda en el lugar
            data: $(this).serialize(),//no lo entendi mucho, ya lo entendi es para serializr la info
            beforeSend: function () {
                // btnEnviar.text("Enviando"); Para button 
                button_send.val("Sending"); // Para input de tipo button
                button_send.attr("disabled", "disabled");
            },
            complete: function (data) {
                //Se ejecuta al termino de la petición
                button_send.val("Send form");
                button_send.removeAttr("disabled");
            },
            success: function (data) {
                //Se ejecuta cuando termina la petición y esta ha sido correcta
                $(".answer").html(data);
                alert("Succes");

            },
            error: function (data) {
                //Se ejecuta si la peticón ha sido erronea
                alert("Error trying to submit the form");
            }
        });
        // Nos permite cancelar el envio del formulario, no entiendo porque
        return false;
    });
});
})(jQuery);
