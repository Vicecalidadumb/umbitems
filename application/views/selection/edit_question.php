<?php if ($this->session->flashdata('message')) { ?>
    <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php } ?>

<?php
$VERSION_HTML = "***************VERSION HTML PARA DIAGRAMAR***************<br><br><br>";
?>


<div class="jumbotron">
    <div style="text-align: center">
        <img src="<?php echo base_url('../images/banner1.png'); ?>" style="width: 180px;">
        <img src="<?php echo base_url('../images/marca-umb.png'); ?>" style="width: 280px;">  
    </div>
    <h2>Construcci&oacute;n de &Iacute;tems</h2>
    <?php echo $this->session->userdata('HEADER_2'); ?>
</div>

<div class="page-header">
    <h1 style="color:green">Item Modificado (Con Base en el Item Original)</h1>
    <h3 style="color:green">
        <?php
        $validate_modify_item = get_modify_item($question[0]->PREGUNTA_ID);
        if (count($validate_modify_item) > 0) {
            echo "Pregunta Modificada el dia: " . $validate_modify_item[0]->PREGUNTA_MODIFICACION_FECHA;
        } else {
            echo "Preguntas Sin Modificaciones";
        }
        ?>
    </h3>    
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
            Si desea puede utilizar el boton
            <button type="button" class="btn btn-default btn-sm btn-small"><i class="fa fa-arrows-alt icon-fullscreen"></i></button>
            para ampliar el campo de edicion.
        </li>  
    </ul>    
</div>

<?php //echo '<pre><textarea>' . print_r($question, true) . '</textarea></pre>'; ?>

<?php echo form_open('index.php/question/update_modify', 'id="question_update_modify" class="form-signin" role="form" method="POST"'); ?>

<?php echo form_hidden('PREGUNTA_ID', $id_question); ?>

<div class="row">
    <div class="col-md-6">

        <div class="form-group">
            <label for="exampleInputEmail1">Persona a Cargo</label>
            <span style="color: red"><?php echo $question[0]->PERSONA_CARGO; ?></span>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese el Tema </label>
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
            <label for="exampleInputEmail1">Grado Desarrollo de la Competencia</label>
            <?php echo form_dropdown('PREGUNTA_NIVELRUBRICA', get_array_rubrics(), $question[0]->PREGUNTA_NIVELRUBRICA, 'class="form-control" disabled'); ?>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Categoria del Cargo</label>
            <?php echo form_dropdown('PREGUNTA_NIVELDIFICULTAD', get_array_difficulty_level(), $question[0]->PREGUNTA_NIVELDIFICULTAD, 'class="form-control" disabled'); ?>
        </div>

    </div>

</div>

<div class="row">

    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Contexto </label>
            <?php
            $PREGUNTA_CONTEXTO = '';
            if (count($validate_modify_item) > 0) {
                $PREGUNTA_CONTEXTO = $validate_modify_item[0]->PREGUNTA_MODIFICACION_CONTEXTO;
            } else {
                $PREGUNTA_CONTEXTO = $question[0]->PREGUNTA_CONTEXTO;
            }

            echo form_textarea('PREGUNTA_CONTEXTO', $PREGUNTA_CONTEXTO, 'id="PREGUNTA_CONTEXTO"');
            ?>

            <?php
            $VERSION_HTML.='<strong>Contexto</strong><br>';
            $VERSION_HTML.=$PREGUNTA_CONTEXTO;
            $VERSION_HTML.='<br>';
            ?>            
        </div>
    </div>     

    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Enunciado </label>
            <?php
            $PREGUNTA_ENUNCIADO = '';
            if (count($validate_modify_item) > 0) {
                $PREGUNTA_ENUNCIADO = $validate_modify_item[0]->PREGUNTA_MODIFICACION_ENUNCIADO;
            } else {
                $PREGUNTA_ENUNCIADO = $question[0]->PREGUNTA_ENUNCIADO;
            }

            echo form_textarea('PREGUNTA_ENUNCIADO', $PREGUNTA_ENUNCIADO, 'id="PREGUNTA_ENUNCIADO"');
            ?>

            <?php
            $VERSION_HTML.='<strong>Enunciado</strong><br>';
            $VERSION_HTML.=$PREGUNTA_ENUNCIADO;
            $VERSION_HTML.='<br>';
            ?>            
        </div>
    </div>

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
            <?php echo form_dropdown('PREGUNTA_IDRESPUESTA', get_array_number_questions(), $PREGUNTA_IDRESPUESTA, 'id="PREGUNTA_IDRESPUESTA" class="form-control"'); ?>
        </div>
    </div>      

</div>

<div class="row">

    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Opcion de Respuesta 1 </label>
            <?php
            $validate_modify_resp = get_modify_resp($question[0]->RESPUESTA_ID);

            $RESPUESTA_ENUNCIADO_1 = '';
            if (count($validate_modify_resp) > 0) {
                $RESPUESTA_ENUNCIADO_1 = $validate_modify_resp[0]->RESPUESTA_MODIFICACION_ENUNCIADO;
            } else {
                $RESPUESTA_ENUNCIADO_1 = $question[0]->RESPUESTA_ENUNCIADO;
            }

            echo form_textarea('RESPUESTA_ENUNCIADO_1', $RESPUESTA_ENUNCIADO_1, 'id="RESPUESTA_ENUNCIADO_1" class="textarea_umb"');
            ?>

            <?php
            $VERSION_HTML.='<strong>Opcion de Respuesta 1</strong><br>';
            $VERSION_HTML.=$RESPUESTA_ENUNCIADO_1;
            $VERSION_HTML.='<br>';
            ?>             
        </div> 
    </div> 

    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Justificacion de la Respuesta 1 </label>
            <?php
            $validate_modify_resp = get_modify_resp($question[0]->RESPUESTA_ID);

            $RESPUESTA_JUSTIFICACION_1 = '';
            if (count($validate_modify_resp) > 0) {
                if ($validate_modify_resp[0]->RESPUESTA_MODIFICACION_JUSTIFICACION != '')
                    $RESPUESTA_JUSTIFICACION_1 = $validate_modify_resp[0]->RESPUESTA_MODIFICACION_JUSTIFICACION;
                else
                    $RESPUESTA_JUSTIFICACION_1 = $question[0]->RESPUESTA_JUSTIFICACION;
            }else {
                $RESPUESTA_JUSTIFICACION_1 = $question[0]->RESPUESTA_JUSTIFICACION;
            }

            echo form_textarea('RESPUESTA_JUSTIFICACION_1', $RESPUESTA_JUSTIFICACION_1, 'id="RESPUESTA_JUSTIFICACION_1" class="textarea_umb"');
            ?>
        </div> 
    </div>     


    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Opcion de Respuesta 2 </label>
            <?php
            $validate_modify_resp = get_modify_resp($question[1]->RESPUESTA_ID);

            $RESPUESTA_ENUNCIADO_2 = '';
            if (count($validate_modify_resp) > 0) {
                $RESPUESTA_ENUNCIADO_2 = $validate_modify_resp[0]->RESPUESTA_MODIFICACION_ENUNCIADO;
            } else {
                $RESPUESTA_ENUNCIADO_2 = $question[1]->RESPUESTA_ENUNCIADO;
            }

            echo form_textarea('RESPUESTA_ENUNCIADO_2', $RESPUESTA_ENUNCIADO_2, 'id="RESPUESTA_ENUNCIADO_2" class="textarea_umb"');
            ?>

            <?php
            $VERSION_HTML.='<strong>Opcion de Respuesta 2</strong><br>';
            $VERSION_HTML.=$RESPUESTA_ENUNCIADO_2;
            $VERSION_HTML.='<br>';
            ?>             
        </div> 
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Justificacion de la Respuesta 2 </label>
            <?php
            $validate_modify_resp = get_modify_resp($question[1]->RESPUESTA_ID);

            $RESPUESTA_JUSTIFICACION_2 = '';
            if (count($validate_modify_resp) > 0) {
                if ($validate_modify_resp[0]->RESPUESTA_MODIFICACION_JUSTIFICACION != '')
                    $RESPUESTA_JUSTIFICACION_2 = $validate_modify_resp[0]->RESPUESTA_MODIFICACION_JUSTIFICACION;
                else
                    $RESPUESTA_JUSTIFICACION_2 = $question[1]->RESPUESTA_JUSTIFICACION;
            }else {
                $RESPUESTA_JUSTIFICACION_2 = $question[1]->RESPUESTA_JUSTIFICACION;
            }

            echo form_textarea('RESPUESTA_JUSTIFICACION_2', $RESPUESTA_JUSTIFICACION_2, 'id="RESPUESTA_JUSTIFICACION_2" class="textarea_umb"');
            ?>
        </div> 
    </div>     


    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Opcion de Respuesta 3 </label>
            <?php
            $validate_modify_resp = get_modify_resp($question[2]->RESPUESTA_ID);

            $RESPUESTA_ENUNCIADO_3 = '';
            if (count($validate_modify_resp) > 0) {
                $RESPUESTA_ENUNCIADO_3 = $validate_modify_resp[0]->RESPUESTA_MODIFICACION_ENUNCIADO;
            } else {
                $RESPUESTA_ENUNCIADO_3 = $question[2]->RESPUESTA_ENUNCIADO;
            }

            echo form_textarea('RESPUESTA_ENUNCIADO_3', $RESPUESTA_ENUNCIADO_3, 'id="RESPUESTA_ENUNCIADO_3" class="textarea_umb"');
            ?>

            <?php
            $VERSION_HTML.='<strong>Opcion de Respuesta 3</strong><br>';
            $VERSION_HTML.=$RESPUESTA_ENUNCIADO_3;
            $VERSION_HTML.='<br>';
            ?>            
        </div> 
    </div> 
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Justificacion de la Respuesta 3 </label>
            <?php
            $validate_modify_resp = get_modify_resp($question[2]->RESPUESTA_ID);

            $RESPUESTA_JUSTIFICACION_3 = '';
            if (count($validate_modify_resp) > 0) {
                if ($RESPUESTA_JUSTIFICACION_3 = $validate_modify_resp[0]->RESPUESTA_MODIFICACION_JUSTIFICACION != '')
                    $RESPUESTA_JUSTIFICACION_3 = $validate_modify_resp[0]->RESPUESTA_MODIFICACION_JUSTIFICACION;
                else
                    $RESPUESTA_JUSTIFICACION_3 = $question[2]->RESPUESTA_JUSTIFICACION;
            }else {
                $RESPUESTA_JUSTIFICACION_3 = $question[2]->RESPUESTA_JUSTIFICACION;
            }

            echo form_textarea('RESPUESTA_JUSTIFICACION_3', $RESPUESTA_JUSTIFICACION_3, 'id="RESPUESTA_JUSTIFICACION_3" class="textarea_umb"');
            ?>
        </div> 
    </div>    

    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Opcion de Respuesta 4 </label>
            <?php
            $validate_modify_resp = get_modify_resp($question[3]->RESPUESTA_ID);

            $RESPUESTA_ENUNCIADO_4 = '';
            if (count($validate_modify_resp) > 0) {
                $RESPUESTA_ENUNCIADO_4 = $validate_modify_resp[0]->RESPUESTA_MODIFICACION_ENUNCIADO;
            } else {
                $RESPUESTA_ENUNCIADO_4 = $question[3]->RESPUESTA_ENUNCIADO;
            }

            echo form_textarea('RESPUESTA_ENUNCIADO_4', $RESPUESTA_ENUNCIADO_4, 'id="RESPUESTA_ENUNCIADO_4" class="textarea_umb"');
            ?>

            <?php
            $VERSION_HTML.='<strong>Opcion de Respuesta 4</strong><br>';
            $VERSION_HTML.=$RESPUESTA_ENUNCIADO_4;
            $VERSION_HTML.='<br>';
            ?>             
        </div> 
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Justificacion de la Respuesta 4 </label>
            <?php
            $validate_modify_resp = get_modify_resp($question[3]->RESPUESTA_ID);

            $RESPUESTA_JUSTIFICACION_4 = '';
            if (count($validate_modify_resp) > 0) {
                if ($validate_modify_resp[0]->RESPUESTA_MODIFICACION_JUSTIFICACION != '')
                    $RESPUESTA_JUSTIFICACION_4 = $validate_modify_resp[0]->RESPUESTA_MODIFICACION_JUSTIFICACION;
                else
                    $RESPUESTA_JUSTIFICACION_4 = $question[3]->RESPUESTA_JUSTIFICACION;
            }else {
                $RESPUESTA_JUSTIFICACION_4 = $question[3]->RESPUESTA_JUSTIFICACION;
            }

            echo form_textarea('RESPUESTA_JUSTIFICACION_4', $RESPUESTA_JUSTIFICACION_4, 'id="RESPUESTA_JUSTIFICACION_4" class="textarea_umb"');
            ?>
        </div> 
    </div>    

</div>

<div class="row">

    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Observaciones</label>
            <?php
            $PREGUNTA_OBSERVACIONES = '';
            if (count($validate_modify_item) > 0) {
                $PREGUNTA_OBSERVACIONES = $validate_modify_item[0]->PREGUNTA_MODIFICACION_OBSERVACIONES;
            } else {
                $PREGUNTA_OBSERVACIONES = $question[0]->PREGUNTA_OBSERVACIONES;
            }
            ?>
            <textarea name="PREGUNTA_OBSERVACIONES" class="form-control" rows="3"><?php echo $PREGUNTA_OBSERVACIONES; ?></textarea>
        </div>
    </div>

    <div class="col-md-6">
        &nbsp;
    </div>  

    <div class="col-md-12">
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            VERSION PARA DIAGRAMAR
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="panel-body">
                        <?php echo $VERSION_HTML; ?>
                    </div>
                </div>
            </div>
        </div>         
    </div>   






    <!--    <div class="col-md-12">
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>    -->

    <div class="col-md-12">
        <div class="form-group">
            <h1 style="color:green">Validaci&oacute;n de Item</h1>
        </div>
    </div>

</div>

<?php echo form_close(); ?>


<?php foreach ($validation as $valida) { ?>
    <blockquote style="background-color: #f5f5f5 !important">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1" style="text-align: center;width: 100%;">USUARIO QUE VALIDA</label>
                    <div style="text-align: center"><?php echo $valida->USUARIO_NOMBRES . ' ' . $valida->USUARIO_APELLIDOS; ?></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1" style="text-align: center;width: 100%;">TIPO DE EVALUACI&Oacute;N</label>
                    <div style="text-align: center"><?php echo get_validation_type($valida->TIPOEVALUACION_ID); ?></div>
                </div>
            </div>        
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1" style="text-align: center;width: 100%;">FECHA DE VALIDACI&Oacute;N</label>
                    <div style="text-align: center"><?php echo $valida->EVALUACION_FECHA; ?></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1" style="text-align: center;width: 100%;">PUNTAJE DE <?php echo get_validation_type($valida->TIPOEVALUACION_ID) ?></label>
                    <div style="text-align: center"><?php echo $valida->EVALUACION_PUNTUACION; ?></div>
                </div>
            </div>
            <div class="col-md-6">           
                <label for="exampleInputEmail1" style="text-align: center;width: 100%;">OBSERVACIONES DE <?php echo get_validation_type($valida->TIPOEVALUACION_ID) ?></label>
                <textarea name="VPE_OBS" class="form-control" rows="5"><?php echo $valida->EVALUACION_OBSERVACION; ?></textarea>            
            </div>
        </div>
    </blockquote>
<?php } ?>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <h1 style="color:green">Consolidado de la Validaci&oacute;n</h1>
        </div>
    </div>
    <div class="col-md-12">
        <table class="table table-striped">
            <tr>
                <td><strong>TIPO DE EVALUACI&Oacute;N</strong></td>
                <td><strong>PUNTAJE PROMEDIO</strong></td>
            </tr>
            <tr>
                <td>SUFICIENCIA</td>
                <td><?php echo $question[0]->V1; ?></td>
            </tr> 
            <tr>
                <td>UBICACION</td>
                <td><?php echo $question[0]->V2; ?></td>
            </tr> 
            <tr>
                <td>RELEVANCIA</td>
                <td><?php echo $question[0]->V3; ?></td>
            </tr> 
            <tr>
                <td>SINT&Aacute;CTICA</td>
                <td><?php echo $question[0]->V4; ?></td>
            </tr> 
            <tr>
                <td>SEM&Aacute;NTICA</td>
                <td><?php echo $question[0]->V5; ?></td>
            </tr>
            <tr>
                <td><strong>PROMEDIO</strong></td>
                <td><strong><?php echo $validation_total = get_avg_validation($question[0]->V1, $question[0]->V2, $question[0]->V3, $question[0]->V4, $question[0]->V5) ?></strong></td>
            </tr>
            <tr>
                <td><strong>CONCLUSI&Oacute;N</strong></td>
                <td>
                    <strong>
                        <?php
                        switch ($validation_total) {
                            case 0: echo '<span style="color:#0044cc">SIN EVALUAR</span>';
                                break;
                            case $validation_total <= 1.9 : echo '<span style="color:#FF0000">SE DESCARTA</span>';
                                break;
                            case $validation_total >= 2.0 && $validation_total <= 3.9:
                                echo '<span style="color:#FFCC33">SE MODIFICA</span>';
                                break;
                            case $validation_total >= 4.0: echo '<span style="color:#00CC00">SE CONSERVA</span>';
                                break;
                        }
                        ?>
                    </strong>
                </td>
            </tr>              
        </table>
    </div>
</div>

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
                //['style', ['style']], // no style button
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['picture']], // no insert buttons
                ['fullscreen', ['fullscreen']],
                ['table', ['table']], // no table button
                ['help', ['help']] //no help button
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
                ['insert', ['picture']], // no insert buttons
                ['fullscreen', ['fullscreen']],
                ['table', ['table']], // no table button
                ['help', ['help']] //no help button
            ]
        });
    });
</script>