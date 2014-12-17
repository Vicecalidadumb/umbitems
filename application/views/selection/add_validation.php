<?php if ($this->session->flashdata('message')) { ?>
    <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php } ?>


<div class="jumbotron">
    <div style="text-align: center">
        <img src="<?php echo base_url('../images/banner1.png'); ?>" style="width: 180px;">
        <img src="<?php echo base_url('../images/marca-umb.png'); ?>" style="width: 280px;">  
    </div>
    <h2>Validaci&oacute;n de &Iacute;tems</h2>
    <?php echo $this->session->userdata('HEADER_2'); ?>
</div>

<div class="page-header">
    <h1 style="color:green">Validar Item - Vista previa del Item</h1>
</div>


<?php //echo '<pre><textarea>' . print_r($validation, true) . '</textarea></pre>'; ?>

<?php echo form_open('validation/insert', 'id="validation_insert" class="form-signin" role="form" method="POST"'); ?>

<?php echo form_hidden('PREGUNTA_ID', $id_question); ?>
<?php echo form_hidden('EVALUACION_ID_USUARIOCREADOR', $id_user); ?>
<?php echo form_hidden('COMPONENTE_ID', $question[0]->COMPONENTE_ID); ?>

<div class="row">
    <div class="col-md-6">

        <div class="form-group">
            <label for="exampleInputEmail1">Persona a Cargo</label>
            <span style="color: red"><?php echo $question[0]->PERSONA_CARGO; ?></span>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Tema </label>
            <?php echo form_input('PREGUNTA_TEMA', $question[0]->PREGUNTA_TEMA, 'id="PREGUNTA_TEMA" placeholder="Ingrese el Tema" class="form-control" disabled') ?>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Tipo de Item</label>
            <?php echo form_dropdown('PREGUNTA_TIPOITEM', get_array_item_types(), '', 'class="form-control" disabled'); ?>
        </div>

    </div>
    <div class="col-md-6">

        <div class="form-group">
            <label for="exampleInputEmail1">Componente</label>
            <span style="color: red"><?php echo $question[0]->COMPONENTE_NOMBRE; ?></span>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Nivel de Rubrica</label>
            <?php echo form_dropdown('PREGUNTA_NIVELRUBRICA', get_array_rubrics(), $question[0]->PREGUNTA_NIVELRUBRICA, 'class="form-control" disabled'); ?>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Nivel de Dificultad</label>
            <?php echo form_dropdown('PREGUNTA_NIVELDIFICULTAD', get_array_difficulty_level(), $question[0]->PREGUNTA_NIVELDIFICULTAD, 'class="form-control" disabled'); ?>
        </div>

    </div>

</div>

<div class="row">

    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Contexto </label>
            <?php echo form_textarea('PREGUNTA_CONTEXTO', $question[0]->PREGUNTA_CONTEXTO, 'id="PREGUNTA_CONTEXTO"'); ?>
        </div>
    </div>    

    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Enunciado </label>
            <?php echo form_textarea('PREGUNTA_ENUNCIADO', $question[0]->PREGUNTA_ENUNCIADO, 'id="PREGUNTA_ENUNCIADO"'); ?>
        </div>
    </div>


    <?php if ($this->session->userdata('ID_TIPO_USU') == 4) { ?>
        <?php
        $count = 1;
        $PREGUNTA_IDRESPUESTA = 0;
        foreach ($question as $data) {
            if ($data->RESPUESTA_ID == $question[0]->PREGUNTA_IDRESPUESTA) {
                $PREGUNTA_IDRESPUESTA = $count;
            }
            $count++;
        }
        ?>
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Respuesta Correcta </label>
                <?php echo form_dropdown('PREGUNTA_IDRESPUESTA', get_array_number_questions(), $PREGUNTA_IDRESPUESTA, 'id="PREGUNTA_IDRESPUESTA" class="form-control" disabled'); ?>
            </div>
        </div>
    <?php } ?>

    <?php
    $count = 1;
    $PREGUNTA_IDRESPUESTA = 0;
    foreach ($question as $data) {
        if ($data->RESPUESTA_ID == $question[0]->PREGUNTA_IDRESPUESTA) {
            $PREGUNTA_IDRESPUESTA = $count;
        }
        $count++;
    }
    ?>   

</div>

<div class="row">

    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Opcion de Respuesta 1 </label>
            <?php echo form_textarea('RESPUESTA_ENUNCIADO_1', $question[0]->RESPUESTA_ENUNCIADO, 'id="RESPUESTA_ENUNCIADO_1" class="textarea_umb"'); ?>
        </div> 
    </div> 
    
    <?php if ($this->session->userdata('ID_TIPO_USU') == 4) { ?>
    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;color:red;">Justificacion de la Respuesta 1 </label>
            <?php echo form_textarea('RESPUESTA_JUSTIFICACION_1', $question[0]->RESPUESTA_JUSTIFICACION, 'id="RESPUESTA_JUSTIFICACION_1" class="textarea_umb"'); ?>
        </div> 
    </div>     
    <?php } ?>
    
    <div class="col-md-12">
        <div class="form-group">

            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Opcion de Respuesta 2 </label>
            <?php echo form_textarea('RESPUESTA_ENUNCIADO_2', $question[1]->RESPUESTA_ENUNCIADO, 'id="RESPUESTA_ENUNCIADO_2" class="textarea_umb"'); ?>
        </div> 
    </div>
    
    <?php if ($this->session->userdata('ID_TIPO_USU') == 4) { ?>
    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;color:red;">Justificacion de la Respuesta 2 </label>
            <?php echo form_textarea('RESPUESTA_JUSTIFICACION_2', $question[1]->RESPUESTA_JUSTIFICACION, 'id="RESPUESTA_JUSTIFICACION_2" class="textarea_umb"'); ?>
        </div>
    </div>    
    <?php } ?>
    
    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Opcion de Respuesta 3 </label>
            <?php echo form_textarea('RESPUESTA_ENUNCIADO_3', $question[2]->RESPUESTA_ENUNCIADO, 'id="RESPUESTA_ENUNCIADO_3" class="textarea_umb"'); ?>
        </div> 
    </div> 
    
    <?php if ($this->session->userdata('ID_TIPO_USU') == 4) { ?>
    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;color:red;">Justificacion de la Respuesta 3 </label>
            <?php echo form_textarea('RESPUESTA_JUSTIFICACION_3', $question[2]->RESPUESTA_JUSTIFICACION, 'id="RESPUESTA_JUSTIFICACION_3" class="textarea_umb"'); ?>
        </div> 
    </div>     
    <?php } ?>
    
    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Opcion de Respuesta 4 </label>
            <?php echo form_textarea('RESPUESTA_ENUNCIADO_4', $question[3]->RESPUESTA_ENUNCIADO, 'id="RESPUESTA_ENUNCIADO_4" class="textarea_umb"'); ?>
        </div> 
    </div>   
    
    <?php if ($this->session->userdata('ID_TIPO_USU') == 4) { ?>
    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%; color:red;">Justificacion de la Respuesta 4 </label>
            <?php echo form_textarea('RESPUESTA_JUSTIFICACION_4', $question[3]->RESPUESTA_JUSTIFICACION, 'id="RESPUESTA_JUSTIFICACION_4" class="textarea_umb"'); ?>
        </div>
    </div>     
    <?php } ?>
    
</div>

<div class="row">

    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Observaciones</label>
            <textarea name="PREGUNTA_OBSERVACIONES" class="form-control" rows="3" disabled><?php echo $question[0]->PREGUNTA_OBSERVACIONES; ?></textarea>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <h1 style="color:green">Validar Item</h1>
            Por favor eval&uacute;e los siguientes &iacute;tems seg&uacute;n el nivel de: <?php echo permits_validation(); ?> seg&uacute;n la siguiente escala:
            <br>
            <ol>
                <li>
                    &Iacute;tem que obtiene puntaje entre <strong>0.0</strong> y <strong>1.9</strong> SE DESCARTA.
                </li>
                <li>
                    &Iacute;tem que obtiene puntaje entre <strong>2.0</strong> y <strong>3.9</strong> SE MODIFICA.
                </li>
                <li>
                    &Iacute;tem que obtiene puntaje entre <strong>4.0</strong> y <strong>5.0</strong> SE CONSERVA.
                </li>
            </ol>       

            <ul>
                <?php if (know_permission_role('VPE', 'permission_add')) { ?>
                    <li>
                        <strong>SUFICIENCIA: </strong>se refiere a si todas la informaci&oacute;n presentada en el enunciado 
                        es suficiente para cubrir la naturaleza emp&iacute;rica y te&oacute;rica del constr&uacute;cto a medir, 
                        y si todas las opciones de respuesta cuentan con los elementos para ser igualmente atractivas.
                    </li>
                <?php } ?>

                <?php if (know_permission_role('VCO', 'permission_add')) { ?>
                    <li>
                        <strong>UBICACION: </strong>
                        Se refiere a si la pregunta presentada se encuentra correctamente dispuesta en el tipo y 
                        nivel de competencia dispuesta por la rubrica.                        
                    </li>
                <?php } ?>

                <?php if (know_permission_role('VRE', 'permission_add')) { ?>
                    <li>
                        <strong>RELEVANCIA: </strong>El &iacute;tem es importante para predecir la ejecuci&oacute;n adecuada de la competencia.
                    </li>
                <?php } ?>

                <?php if (know_permission_role('VSI', 'permission_add')) { ?>
                    <li>
                        <strong>SINT&Aacute;CTICA: </strong>El &iacute;tem est&aacute; redactado con adecuada estructura gramatical.
                    </li>
                <?php } ?>

                <?php if (know_permission_role('VSE', 'permission_add')) { ?>
                    <li>
                        <strong>SEM&Aacute;NTICA: </strong>El &iacute;tem est&aacute; redactado en lenguaje adecuado para la poblaci&oacute;n evaluada.
                    </li>
                <?php } ?>    
            </ul>
        </div>
    </div>
</div>


<?php if (know_permission_role('VPE', 'permission_add')) { ?>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1" style="text-align: center;width: 100%;">PUNTAJE DE SUFICIENCIA</label>
                <?php echo form_dropdown('VPE', get_score(), $VPE, 'id="VPE" class="form-control"'); ?>
            </div>
        </div>
        <div class="col-md-6">           
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">OBSERVACIONES DE SUFICIENCIA</label>
            <textarea name="VPE_OBS" class="form-control" rows="5"><?php echo $VPE_OBS; ?></textarea>            
        </div>
    </div>
<?php } ?>

<?php if (know_permission_role('VCO', 'permission_add')) { ?>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1" style="text-align: center;width: 100%;">PUNTAJE DE UBICACION</label>
                <?php echo form_dropdown('VCO', get_score(), $VCO, 'id="VCO" class="form-control"'); ?>
            </div>
        </div>
        <div class="col-md-6">           
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">OBSERVACIONES DE UBICACION</label>
            <textarea name="VCO_OBS" class="form-control" rows="5"><?php echo $VCO_OBS; ?></textarea>            
        </div>
    </div>
<?php } ?>

<?php if (know_permission_role('VRE', 'permission_add')) { ?>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1" style="text-align: center;width: 100%;">PUNTAJE DE RELEVANCIA</label>
                <?php echo form_dropdown('VRE', get_score(), $VRE, 'id="VRE" class="form-control"'); ?>
            </div>
        </div>
        <div class="col-md-6">           
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">OBSERVACIONES DE RELEVANCIA</label>
            <textarea name="VRE_OBS" class="form-control" rows="5"><?php echo $VRE_OBS; ?></textarea>            
        </div>
    </div>  
<?php } ?>

<?php if (know_permission_role('VSI', 'permission_add')) { ?>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1" style="text-align: center;width: 100%;">PUNTAJE DE SINT&Aacute;CTICA</label>
                <?php echo form_dropdown('VSI', get_score(), $VSI, 'id="VSI" class="form-control"'); ?>
            </div>
        </div>
        <div class="col-md-6">           
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">OBSERVACIONES DE SINT&Aacute;CTICA</label>
            <textarea name="VSI_OBS" class="form-control" rows="5"><?php echo $VSI_OBS; ?></textarea>            
        </div>
    </div>   
<?php } ?>

<?php if (know_permission_role('VSE', 'permission_add')) { ?>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1" style="text-align: center;width: 100%;">PUNTAJE DE SEM&Aacute;NTICA</label>
                <?php echo form_dropdown('VSE', get_score(), $VSE, 'id="VSE" class="form-control"'); ?>
            </div>
        </div>
        <div class="col-md-6">           
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">OBSERVACIONES DE SEM&Aacute;NTICA</label>
            <textarea name="VSE_OBS" class="form-control" rows="5"><?php echo $VSE_OBS; ?></textarea>            
        </div>
    </div>  
<?php } ?>       



<div class="row">
    <button type="submit" class="btn btn-success">Guardar</button>
</div>

<?php echo form_close(); ?>

<br><br><br><br>

<!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />-->
<link rel="stylesheet" href="<?php echo base_url('../dist/css/font-awesome.min.css'); ?>" />
<script type="text/javascript" src="<?php echo base_url('../dist/js/summernote.js'); ?>"></script>
<link href="<?php echo base_url('../dist/css/summernote.css'); ?>" rel="stylesheet">
<script type="text/javascript">
    $(document).ready(function() {

        $('#PREGUNTA_ENUNCIADO,#PREGUNTA_CONTEXTO').summernote({
            height: 150,
            toolbar: [
                ['fullscreen', ['fullscreen']],
            ]
        });

        $('.textarea_umb').summernote({
            height: 100,
            toolbar: [
                ['fullscreen', ['fullscreen']],
            ]
        });
    });
</script>


<script>

    function prueba() {
        $(".note-editable").attr('contenteditable', 'false');
        $(".note-editable").css('cursor', 'not-allowed');
    }


    $(document).ready(function() {
        $('#validation_insert').validate(
                {
                    rules: {
                        VPE: {
                            required: true
                        },
                        VPE_OBS: {
                            required: true
                        },
                        VCO: {
                            required: true
                        },
                        VCO_OBS: {
                            required: true
                        },
                        VRE: {
                            required: true
                        },
                        VRE_OBS: {
                            required: true
                        },
                        VSI: {
                            required: true
                        },
                        VSI_OBS: {
                            required: true
                        },
                        VSE: {
                            required: true
                        },
                        VSE_OBS: {
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

        setTimeout("prueba()", 500)
    });
</script>