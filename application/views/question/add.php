<?php if ($this->session->flashdata('message')) { ?>
    <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php } ?>

<div class="jumbotron">
    <div style="text-align: center">
        <?php echo $this->session->userdata('HEADER_3'); ?> 
    </div>
    <h2>Construcci&oacute;n de &Iacute;tems</h2>
    <?php echo $this->session->userdata('HEADER_2'); ?>
</div>

<div class="page-header">
    <h1 style="color:#2aabd2">Agregar Item</h1>
    <h4 style="color:#2aabd2">
        Componente Actual: <strong><?php echo $component[0]->COMPONENTE_NOMBRE; ?></strong>
    </h4>
    <h4 style="color:#2aabd2">
        Items Construidos a la fecha de este componente: <strong><?php echo $component[0]->TOTAL_ITEMS; ?></strong>
    </h4>
    <h4 style="color:red">
        Item Actual: <strong><?php echo $component[0]->TOTAL_ITEMS + 1; ?></strong>
    </h4>     
</div>
<div class="well">
    <ul>
        <li>
            <strong>TENGA EN CUENTA:</strong>
        </li>
        <li>
            Si se requiere utilizar imagenes, por favor cargar archivos inferiores a 50KB.
        </li>
        <li>
            Si desea, puede utilizar el boton
            <button type="button" class="btn btn-default btn-sm btn-small"><i class="fa fa-arrows-alt icon-fullscreen"></i></button>
            para ampliar el campo de edicion.
        </li>   
    </ul>    
</div>


<?php echo form_open('question/insert', 'id="question_insert" class="form-signin" role="form" method="POST"'); ?>

<?php echo form_hidden('COMPONENTE_ID', $id_component); ?>
<?php echo form_hidden('USUARIO_ID', $id_user); ?>

<div class="row">
    <div class="col-md-6">

        <div class="form-group">
            <label for="exampleInputEmail1">Persona a Cargo</label>
            <span style="color: red"><?php echo $user[0]->USUARIO_NOMBRES . ' ' . $user[0]->USUARIO_APELLIDOS; ?></span>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese el Tema </label>
            <?php echo form_input('PREGUNTA_TEMA', '', 'id="PREGUNTA_TEMA" placeholder="Ingrese el Tema" class="form-control"') ?>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Tipo de Item</label>
            <?php echo form_dropdown('PREGUNTA_TIPOITEM', get_array_item_types(), '', 'class="form-control"'); ?>
        </div>

    </div>
    <div class="col-md-6">

        <div class="form-group">
            <label for="exampleInputEmail1">Componente</label>
            <span style="color: red"><?php echo $component[0]->COMPONENTE_NOMBRE; ?></span>
        </div>  

        <div class="form-group">
            <label for="exampleInputEmail1">Nivel de Rubrica</label>
            <?php echo form_dropdown('PREGUNTA_NIVELRUBRICA', get_array_rubrics(), '', 'class="form-control"'); ?>
        </div>  

        <div class="form-group">
            <label for="exampleInputEmail1">Nivel de Dificultad</label>
            <?php echo form_dropdown('PREGUNTA_NIVELDIFICULTAD', get_array_difficulty_level(), '', 'class="form-control"'); ?>
        </div>        

    </div>

</div>

<div class="row">

    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Contexto</label>
            <?php echo form_textarea('PREGUNTA_CONTEXTO', '', 'id="PREGUNTA_CONTEXTO"'); ?>
        </div>
    </div>    

    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Enunciado</label>
            <?php echo form_textarea('PREGUNTA_ENUNCIADO', '', 'id="PREGUNTA_ENUNCIADO"'); ?>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Respuesta Correcta </label>
            <?php echo form_dropdown('PREGUNTA_IDRESPUESTA', get_array_number_questions(), '', 'id="PREGUNTA_IDRESPUESTA" class="form-control"'); ?>
        </div>
    </div>    

</div>

<div class="row">

    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Opcion de Respuesta 1 </label>
            <?php echo form_textarea('RESPUESTA_ENUNCIADO_1', '', 'id="RESPUESTA_ENUNCIADO_1" class="textarea_umb"'); ?>
        </div> 
    </div> 
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Justificacion de la Respuesta 1 </label>
            <?php echo form_textarea('RESPUESTA_JUSTIFICACION_1', '', 'id="RESPUESTA_JUSTIFICACION_1" class="textarea_umb"'); ?>
        </div> 
    </div> 

    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Opcion de Respuesta 2 </label>
            <?php echo form_textarea('RESPUESTA_ENUNCIADO_2', '', 'id="RESPUESTA_ENUNCIADO_2" class="textarea_umb"'); ?>
        </div> 
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Justificacion de la Respuesta 2 </label>
            <?php echo form_textarea('RESPUESTA_JUSTIFICACION_2', '', 'id="RESPUESTA_JUSTIFICACION_2" class="textarea_umb"'); ?>
        </div> 
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Opcion de Respuesta 3 </label>
            <?php echo form_textarea('RESPUESTA_ENUNCIADO_3', '', 'id="RESPUESTA_ENUNCIADO_3" class="textarea_umb"'); ?>
        </div> 
    </div> 
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Justificacion de la Respuesta 3 </label>
            <?php echo form_textarea('RESPUESTA_JUSTIFICACION_3', '', 'id="RESPUESTA_JUSTIFICACION_3" class="textarea_umb"'); ?>
        </div> 
    </div> 

    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Opcion de Respuesta 4 </label>
            <?php echo form_textarea('RESPUESTA_ENUNCIADO_4', '', 'id="RESPUESTA_ENUNCIADO_4" class="textarea_umb"'); ?>
        </div> 
    </div> 
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Justificacion de la Respuesta 4 </label>
            <?php echo form_textarea('RESPUESTA_JUSTIFICACION_4', '', 'id="RESPUESTA_JUSTIFICACION_4" class="textarea_umb"'); ?>
        </div>
    </div>     

</div>

<div class="row">

    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Observaciones</label>
            <textarea name="PREGUNTA_OBSERVACIONES" class="form-control" rows="3"></textarea>
        </div> 
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Pregunta lista para enviar a etapa de Validaci&oacute;n.</label>
            <?php echo form_dropdown('PREGUNTA_ETAPA', array(0 => "NO", 1 => "SI"), 0, 'id="PREGUNTA_IDRESPUESTA" class="form-control"'); ?>
        </div>
    </div>

    <?php if ($this->session->userdata('c_id') != 3) { ?>
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Nivel de la Pregunta:</label>
                <?php echo form_dropdown('PREGUNTA_NIVELPREGUNTA', get_array_levelsquestions(), '', 'class="form-control"'); ?>
            </div>  
        </div>
    <?php } ?>

    <div class="col-md-12">
        <button type="button" onclick="validar_envio('question_insert')" class="btn btn-success btn_umb">Guardar</button>
    </div> 
    <div class="col-md-12">
        <br>
        <div class="alert alert-danger" id="alert_umb" style='display: none'>

        </div>
    </div>

</div>

<?php echo form_close(); ?>

<br><br><br><br>


<script>
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
</script>


<!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />-->
<link rel="stylesheet" href="<?php echo base_url('../dist/css/font-awesome.min.css'); ?>" />


<script type="text/javascript" src="<?php echo base_url('../dist/js/summernote.js?v='.date("d-h")); ?>"></script>
<link href="<?php echo base_url('../dist/css/summernote.css?v='.date("d-h")); ?>" rel="stylesheet">


<script type="text/javascript">
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
                ['insert', ['picture','link','video','codeview']], // no insert buttons
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
                ['insert', ['picture','link','video','codeview']], // no insert buttons
                ['fullscreen', ['fullscreen']],
                ['table', ['table']], // no table button
//                ['help', ['help']] //no help button
            ]
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('#question_insert').validate(
                {
                    rules: {
                        PREGUNTA_TEMA: {
                            minlength: 2,
                            required: true
                        },
                        PREGUNTA_IDRESPUESTA: {
                            required: true
                        }
                    },
                    highlight: function(element) {
                        $(element).closest('.control-group').removeClass('success').addClass('error');
                    }/*,
                     success: function(element) {
                     element
                     .text('OK!').addClass('valid')
                     .closest('.control-group').removeClass('error').addClass('success');
                     }*/
                });
    });

</script>

<script type="text/javascript">
    $(window).bind('beforeunload', function() {
        return 'Por favor guarde los datos antes de continuar, de lo contrario perdera los cambios.';
    });

    $('#question_insert').submit(function() {
        $(window).unbind('beforeunload');
        return true;
    });
</script>