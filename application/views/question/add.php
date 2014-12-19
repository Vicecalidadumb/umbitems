<!--ARCHIVOS PARA EDITOR DE TEXTO-->
<link rel="stylesheet" href="<?php echo base_url('dist/css/font-awesome.min.css'); ?>" />
<script type="text/javascript" src="<?php echo base_url('dist/js/summernote.js?v=' . date("d-h")); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('dist/js/script_summernote.js?v=' . date("d-h")); ?>"></script>
<link href="<?php echo base_url('dist/css/summernote.css?v=' . date("d-h")); ?>" rel="stylesheet">

<div class="jumbotron" style="border: 1px solid yellow !important;">
    <div style="text-align: center">
        <?php echo $this->session->userdata('HEADER_3'); ?> 
    </div>
    <h2>Construcci&oacute;n de &Iacute;tems</h2>
    <?php echo $this->session->userdata('HEADER_2'); ?>
</div>


<div class="page-header">
    <h1 style="color:#2aabd2">Agregar Item</h1>
    <h4 style="color:#2aabd2">
        Componente : <strong><?php echo $component[0]->COMPONENTE_NOMBRE; ?></strong>
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
            Si se requiere utilizar imagenes, por favor cargar archivos inferiores a <strong>50KB</strong>.
        </li>
        <li>
            Si desea, puede utilizar el boton
            <button type="button" class="btn btn-default btn-sm btn-small"><i class="fa fa-arrows-alt icon-fullscreen"></i></button>
            para ampliar el campo de edici&oacute;n.
        </li>  
    </ul>    
</div>


<?php echo form_open('question/insert', 'id="question_insert" class="form-signin" role="form" method="POST"'); ?>
<?php echo form_hidden('COMPONENTE_ID', $id_component); ?>

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

        <div class="form-group">
            <label for="exampleInputEmail1">Nivel de la Pregunta:</label>
            <?php echo form_dropdown('PREGUNTA_NIVELPREGUNTA', get_array_levelsquestions(), '', 'class="form-control"'); ?>
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
                    }
                });
    });
</script>