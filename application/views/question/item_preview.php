<?php
$validate_modify_item = get_modify_item($question[0]->PREGUNTA_ID);
$user = $this->session->userdata('ID_TIPO_USU');
if ($user != 3)
    $colu = 6;
else
    $colu = 12;
?>
<?php if (!empty($question[0]->PREGUNTA_VALIDA_2_TEXT1)) { ?>
    <div class="well" style="background-color: rgb(250, 243, 243) !important;border: 1px solid red !important;">
        <ul>
            <li>
                <strong>Observaciones en Suficiencia:</strong>
            </li>
            <li>
                <?php echo $question[0]->PREGUNTA_VALIDA_2_TEXT1; ?>
            </li>
            <li>
                <strong>Observaciones en Ubicacion:</strong>
            </li>
            <li>
                <?php echo $question[0]->PREGUNTA_VALIDA_2_TEXT2; ?>
            </li>         
        </ul>    
    </div>
<?php } ?>
<?php if (!empty($question[0]->PREGUNTA_VALIDA_2_TEXT1)) { ?>
    <div class="well" style="background-color: #d9edf7 !important;border: 1px solid #0000FF !important;">
        <ul>
            <li>
                <strong>Observaciones</strong>
            </li>
            <li>
                <?php echo $question[0]->PREGUNTA_SELEC_1_TEXT2; ?>
            </li>     
        </ul>    
    </div>
<?php } ?>

<div class="">

    <div class="row">
        <div class="col-md-6">

            <div class="form-group">
                <label for="exampleInputEmail1">Persona a Cargo</label>
                <span style="color: red"><?php echo $question[0]->USUARIO_NOMBRES; ?></span>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Tema </label>
                <br>
                <?php echo $question[0]->PREGUNTA_TEMA ?>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Tipo de Item</label>
                <br>
                SMUR
            </div>

        </div>
        <div class="col-md-6">

            <div class="form-group">
                <label for="exampleInputEmail1">Componente</label>
                <span style="color: red"><?php echo $question[0]->COMPONENTE_NOMBRE; ?></span>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Grado Desarrollo de la Competencia</label>
                <br>
                <?php echo $question[0]->PREGUNTA_NIVELRUBRICA; ?>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Categoria del Cargo</label>
                <br>
                <?php echo $question[0]->PREGUNTA_NIVELDIFICULTAD; ?>
            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-md-12">
            <div class="form-group">
                <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Contexto </label>
                <br>
                <?php
                $PREGUNTA_CONTEXTO = '';
                if (count($validate_modify_item) > 0) {
                    $PREGUNTA_CONTEXTO = $validate_modify_item[0]->PREGUNTA_MODIFICACION_CONTEXTO;
                } else {
                    $PREGUNTA_CONTEXTO = $question[0]->PREGUNTA_CONTEXTO;
                }

                echo $PREGUNTA_CONTEXTO;
                ?>
            </div>
        </div>     

        <div class="col-md-12">
            <div class="form-group">
                <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Enunciado </label>
                <br>
                <?php
                $PREGUNTA_ENUNCIADO = '';
                if (count($validate_modify_item) > 0) {
                    $PREGUNTA_ENUNCIADO = $validate_modify_item[0]->PREGUNTA_MODIFICACION_ENUNCIADO;
                } else {
                    $PREGUNTA_ENUNCIADO = $question[0]->PREGUNTA_ENUNCIADO;
                }
                echo $PREGUNTA_ENUNCIADO
                //echo form_textarea('PREGUNTA_ENUNCIADO', $PREGUNTA_ENUNCIADO, 'id="PREGUNTA_ENUNCIADO"');
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
                <br>
                <h3><?php echo $PREGUNTA_IDRESPUESTA; ?></h3>
            </div>
            <br><br>
        </div>     

    </div>

    <div class="row">

        <div class="col-md-<?php echo $colu; ?>">
            <div class="form-group">
                <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Opcion de Respuesta 1 </label>
                <br>
                <?php
                $validate_modify_resp = get_modify_resp($question[0]->RESPUESTA_ID);

                $RESPUESTA_ENUNCIADO_1 = '';
                if (count($validate_modify_resp) > 0) {
                    $RESPUESTA_ENUNCIADO_1 = $validate_modify_resp[0]->RESPUESTA_MODIFICACION_ENUNCIADO;
                } else {
                    $RESPUESTA_ENUNCIADO_1 = $question[0]->RESPUESTA_ENUNCIADO;
                }
                echo $RESPUESTA_ENUNCIADO_1;
                //echo form_textarea('RESPUESTA_ENUNCIADO_1', $RESPUESTA_ENUNCIADO_1, 'id="RESPUESTA_ENUNCIADO_1" class="textarea_umb"');
                ?>
            </div> 
            <br><br>
        </div> 
        <?php
        if ($user != 3) {
            ?>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Justificacion de la Respuesta 1 </label>
                    <br>
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
                    echo $RESPUESTA_JUSTIFICACION_1;
                    //echo form_textarea('RESPUESTA_JUSTIFICACION_1', $RESPUESTA_JUSTIFICACION_1, 'id="RESPUESTA_JUSTIFICACION_1" class="textarea_umb"');
                    ?>
                </div> 
                <br><br>
            </div>     

            <?php
        }
        ?>
    </div>    
    <div class="row">    
        <div class="col-md-<?php echo $colu; ?>">
            <div class="form-group">
                <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Opcion de Respuesta 2 </label>
                <br>
                <?php
                $validate_modify_resp = get_modify_resp($question[1]->RESPUESTA_ID);

                $RESPUESTA_ENUNCIADO_2 = '';
                if (count($validate_modify_resp) > 0) {
                    $RESPUESTA_ENUNCIADO_2 = $validate_modify_resp[0]->RESPUESTA_MODIFICACION_ENUNCIADO;
                } else {
                    $RESPUESTA_ENUNCIADO_2 = $question[1]->RESPUESTA_ENUNCIADO;
                }
                echo $RESPUESTA_ENUNCIADO_2;
                //echo form_textarea('RESPUESTA_ENUNCIADO_2', $RESPUESTA_ENUNCIADO_2, 'id="RESPUESTA_ENUNCIADO_2" class="textarea_umb"');
                ?>
            </div> 
            <br><br>
        </div>
        <?php
        if ($user != 3) {
            ?>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Justificacion de la Respuesta 2 </label>
                    <br>
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
                    echo $RESPUESTA_JUSTIFICACION_2;
                    //echo form_textarea('RESPUESTA_JUSTIFICACION_2', $RESPUESTA_JUSTIFICACION_2, 'id="RESPUESTA_JUSTIFICACION_2" class="textarea_umb"');
                    ?>
                </div> 
                <br><br>
            </div>     
            <?php
        }
        ?>
    </div>    
    <div class="row"> 
        <div class="col-md-<?php echo $colu; ?>">
            <div class="form-group">
                <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Opcion de Respuesta 3 </label>
                <br>
                <?php
                $validate_modify_resp = get_modify_resp($question[2]->RESPUESTA_ID);

                $RESPUESTA_ENUNCIADO_3 = '';
                if (count($validate_modify_resp) > 0) {
                    $RESPUESTA_ENUNCIADO_3 = $validate_modify_resp[0]->RESPUESTA_MODIFICACION_ENUNCIADO;
                } else {
                    $RESPUESTA_ENUNCIADO_3 = $question[2]->RESPUESTA_ENUNCIADO;
                }
                echo $RESPUESTA_ENUNCIADO_3;
                //echo form_textarea('RESPUESTA_ENUNCIADO_3', $RESPUESTA_ENUNCIADO_3, 'id="RESPUESTA_ENUNCIADO_3" class="textarea_umb"');
                ?>
            </div> 
            <br><br>
        </div>
        <?php
        if ($user != 3) {
            ?>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Justificacion de la Respuesta 3 </label>
                    <br>
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
                    echo $RESPUESTA_JUSTIFICACION_3;
                    //echo form_textarea('RESPUESTA_JUSTIFICACION_3', $RESPUESTA_JUSTIFICACION_3, 'id="RESPUESTA_JUSTIFICACION_3" class="textarea_umb"');
                    ?>
                </div> 
                <br><br>
            </div>    
            <?php
        }
        ?>
    </div>    
    <div class="row"> 
        <div class="col-md-<?php echo $colu; ?>">
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
                echo $RESPUESTA_ENUNCIADO_4;
                //echo form_textarea('RESPUESTA_ENUNCIADO_4', $RESPUESTA_ENUNCIADO_4, 'id="RESPUESTA_ENUNCIADO_4" class="textarea_umb"');
                ?>
            </div> 
            <br><br>
        </div>
        <?php
        if ($user != 3) {
            ?>
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
                    echo $RESPUESTA_JUSTIFICACION_4;
                    //echo form_textarea('RESPUESTA_JUSTIFICACION_4', $RESPUESTA_JUSTIFICACION_4, 'id="RESPUESTA_JUSTIFICACION_4" class="textarea_umb"');
                    ?>
                </div> 
                <br><br>
            </div>    
            <?php
        }
        ?>
    </div>

</div>