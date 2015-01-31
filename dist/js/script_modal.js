//SCRIPT MODAL
$(document).ready(function() {
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever')
        var cod = button.data('cod')
        var item = '';
        $.ajax({
            data: "PREGUNTA_ID=" + recipient,
            type: "POST",
            dataType: "html",
            url: base_url_js + "question/item_preview",
            success: function(data) {
                item = data
            },
            error: function(xhr, ajaxOptions, thrownError) {
                item = 'ERROR AL CARGAR LA PREGUNTA, POR FAVOR INTENTE DE NUEVO O CONSULTE AL ADMIN.'
            },
            async: false
        });
        var modal = $(this)
        modal.find('.modal-title').text('Vista Previa del Item ' + cod)
        modal.find('.modal-body').html(item)
    })


    $('#exampleModal2').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) 
        var preguntaid = button.data('preguntaid') 
        var cod = button.data('cod')

        var modal = $(this)
        modal.find('.modal-title').text('Validar pregunta ' + cod)
        modal.find('#PREGUNTA_ID').val(preguntaid)
    })
    $('#exampleModal3').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) 
        var preguntaid = button.data('preguntaid') 
        var envio = button.data('envio')

        var modal = $(this)
        modal.find('.modal-title').text('Enviar pregunta ')
        modal.find('#PREGUNTA_ID').val(preguntaid)
        modal.find('#form_seleccion').attr('action',envio)
    })

});