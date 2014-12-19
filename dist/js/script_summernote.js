//SCRIPT EDITOR DE TEXTO
$(document).ready(function() {
    $('#PREGUNTA_ENUNCIADO,#PREGUNTA_CONTEXTO').summernote({
        height: 150,
        toolbar: [
            //['style', ['style']], // no style button
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['insert', ['picture', 'link', 'video', 'codeview']], // no insert buttons
            ['fullscreen', ['fullscreen']],
            ['table', ['table']], // no table button
//                ['help', ['help']] //no help button
        ]
    });

    $('.textarea_umb').summernote({
        height: 100,
        toolbar: [
            //['style', ['style']], // no style button
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['insert', ['picture', 'link', 'video', 'codeview']], // no insert buttons
            ['fullscreen', ['fullscreen']],
            ['table', ['table']], // no table button
//                ['help', ['help']] //no help button
        ]
    });

//PREGUNTAR SI DESEA CONFIRMAR LA SALIDA DEL FORMULARIO
    $(window).bind('beforeunload', function() {
        return 'Por favor guarde los datos antes de continuar, de lo contrario perdera los cambios.';
    });
    $('.form-signin').submit(function() {
        $(window).unbind('beforeunload');
        return true;
    });
});



//VALIDAR QUE TENGA SESSION INICIADA ANTES DE ENVIAR EL FORMULARIO
var mensaje = '';
var link = '';
function validar_envio(id_form) {
    //alert("ok")
    $(".btn_umb").removeClass('btn-success');
    $(".btn_umb").removeClass('btn-danger');
    $(".btn_umb").addClass('btn-warning');
    $("#alert_umb").html('');
    $("#alert_umb").css('display', 'none');
    $(".btn_umb").html('Validando Envio de Datos.......Espere por favor...');

    $.ajax({
        data: "",
        type: "GET",
        dataType: "html",
        url: base_url_js + "question/validate_send_ajax",
        success: function(data) {
            if (data == 'validation_ok') {
                $(".btn_umb").removeClass('btn-warning');
                $(".btn_umb").removeClass('btn-danger');
                $(".btn_umb").addClass('btn-success');
                $(".btn_umb").html('Guardar');
                $("#alert_umb").html('');
                $("#alert_umb").css('display', 'none');
                $("#" + id_form).submit();
            } else {
                $(".btn_umb").removeClass('btn-warning');
                $(".btn_umb").removeClass('btn-success');
                $(".btn_umb").addClass('btn-danger');
                $(".btn_umb").html('Intentar Guardar Nuevamente');

                mensaje = '<strong>IMPORTANTE: </strong>Ha ocurrido un error con la sesion, ';
                mensaje = mensaje + 'por favor inicie sesion en una ';
                link = base_url_js + "login";
                mensaje = mensaje + '<a href="' + link + '" target="_blank">Nueva Ventana</a>';
                mensaje = mensaje + ' e intente enviar de nuevo el Item desde esta ventana.';

                $("#alert_umb").html(mensaje);
                $("#alert_umb").css('display', '');
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            $(".btn_umb").removeClass('btn-warning');
            $(".btn_umb").removeClass('btn-success');
            $(".btn_umb").addClass('btn-danger');
            $(".btn_umb").html('Intentar Guardar Nuevamente');

            mensaje = '<strong>IMPORTANTE: </strong>Ha ocurrido un error con la conexion al servidor de Aplicativo, ';
            mensaje = mensaje + 'por favor verifique su conexion a la red, inicie sesion en una ';
            link = base_url_js + "login";
            mensaje = mensaje + '<a href="' + link + '" target="_blank">Nueva Ventana</a>';
            mensaje = mensaje + ' e intente enviar de nuevo el Item desde esta ventana.';

            $("#alert_umb").html(mensaje);
            $("#alert_umb").css('display', '');
        },
        async: true
    });
}


