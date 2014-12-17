<div class="container">

    <?php
    $questions = array_reverse($questions);
echo '<pre>'.print_r($questions,true).'</pre>';
//echo date("Y-m-d H:i:s");
    ?>

    <?php if (count($questions) > 0) { ?>

        <?php
        $count = 1;
        foreach ($questions as $question) {
            ?>
            <div class="row">
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Persona a Cargo</label>
                        <span style="color: red"><?php echo $question[0]->PERSONA_CARGO; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Ingrese el Tema </label>
                        <?php echo form_input('PREGUNTA_TEMA', $question[0]->PREGUNTA_TEMA, 'id="PREGUNTA_TEMA" placeholder="Ingrese el Tema" class="form-control"') ?>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Tipo de Item</label>
                        <?php echo form_dropdown('PREGUNTA_TIPOITEM', get_array_item_types(), '', 'class="form-control"'); ?>
                    </div>

                </div>
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Componente</label>
                        <span style="color: red"><?php echo $question[0]->COMPONENTE_NOMBRE; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Nivel de Rubrica</label>
                        <?php echo form_dropdown('PREGUNTA_NIVELRUBRICA', get_array_rubrics(), $question[0]->PREGUNTA_NIVELRUBRICA, 'class="form-control"'); ?>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Nivel de Dificultad</label>
                        <?php echo form_dropdown('PREGUNTA_NIVELDIFICULTAD', get_array_difficulty_level(), $question[0]->PREGUNTA_NIVELDIFICULTAD, 'class="form-control"'); ?>
                    </div>

                </div>

            </div>

            <tr>
                <td style="font-size: 11px !important;"><?php echo $count; ?></td>
                <td style="font-size: 11px !important;color: blue !important;">
                    <?php echo 'PN317' . $question->COMPONENTE_SIGLA . '' . $question->PREGUNTA_ID; ?>

                    <?php echo ($question->PREGUNTA_SELECCIONADA == 1) ? '<span class="label label-warning">Seleccionada</span>' : ''; ?>

                </td>
                <td style="font-size: 11px !important;"><strong><?php echo $question->PREGUNTA_FECHADECREACION; ?></strong></td>
                <td style="font-size: 9px !important;"><?php echo $question->PERSONA_CARGO; ?></td>
                <td style="font-size: 9px !important;"><?php echo $question->COMPONENTE_NOMBRE; ?></td>
                <td style="font-size: 9px !important;"><?php echo $question->PREGUNTA_TEMA; ?></td>
                <td style="font-size: 9px !important;"><?php echo $question->PREGUNTA_NIVELRUBRICA; ?></td>
                <td style="font-size: 9px !important;"><?php echo $question->PREGUNTA_NIVELPREGUNTA; ?></td>
                <td style="font-size: 9px !important;"><?php echo get_difficulty_level($question->PREGUNTA_NIVELDIFICULTAD); ?></td>
                <td style="font-size: 8px !important;"><?php echo substr(strip_tags($question->PREGUNTA_ENUNCIADO), 0, 150) . '...'; ?></td>
                <td style="text-align: center;">
                    <?php if ($question->PREGUNTA_ETAPA == 0) { ?>
                        <a href="<?php echo base_url("question/edit/" . encrypt_id($question->PREGUNTA_ID)); ?>">
                            <button type="button" class="btn btn-info btn-sm">
                                <span class="glyphicon glyphicon-edit"></span> Editar
                            </button>
                        </a>
                    <?php } else { ?>
                        <div style="text-align: center;color: #00CC00;font-size: 10px;">
                            <a href="<?php echo base_url("question/preview/" . encrypt_id($question->PREGUNTA_ID)); ?>">
                                <button type="button" class="btn btn-success btn-sm">
                                    <span class="glyphicon glyphicon-zoom-in"></span> EN VALIDACI&Oacute;N
                                </button>
                            </a>                                
                            <br>
                            <span style="font-size: 9px; color: red;">
                                F. Terminada: <?php echo $question->PREGUNTA_FECHADECREACION; ?>
                            </span>
                        </div>
                    <?php } ?>
                </td>
                <td style="text-align: center;">
                    <?php $validation_total = 0; ?>
                    <?php if ($question->PREGUNTA_ETAPA == 0) { ?>
                        <div style="text-align: center;color: #FF0000">EN ETAPA DE CONSTRUCCI&Oacute;N</div>
                    <?php } else { ?>
                        <div style="text-align: center;color: #0044cc">
                            <?php
                            $validation_total = get_avg_validation($question->V1, $question->V2, $question->V3, $question->V4, $question->V5);

                            switch ($validation_total) {
                                case 0: echo $validation_total . '<br><span style="color:#0044cc">SIN EVALUAR</span>';
                                    break;
                                case $validation_total <= 1.99 :
                                    echo $validation_total . '<br><span style="color:#FF0000">SE DESCARTA</span>';
                                    if (know_permission_role('VMO', 'permission_view') == 1) {
                                        $validate_modify_item = get_modify_item($question->PREGUNTA_ID);
                                        //echo count($validate_modify_item);
                                        $title_modify = (count($validate_modify_item) > 0) ? 'Pregunta Modificada' : 'Modificar Pregunta Ahora';
                                        $color_modify = (count($validate_modify_item) > 0) ? 'info' : 'success';
                                        $date_modify = (count($validate_modify_item) > 0) ? $validate_modify_item[0]->PREGUNTA_MODIFICACION_FECHA : '';
                                        $idcreador_modify = (count($validate_modify_item) > 0) ? $validate_modify_item[0]->PREGUNTA_MODIFICACION_IDUSUARIOCREADOR : '';
                                        ?>
                                        <a href="<?php echo base_url("question/edit_question/" . encrypt_id($question->PREGUNTA_ID)); ?>">
                                            <button type="button" class="btn btn-<?php echo $color_modify; ?> btn-sm">
                                                <span class="glyphicon glyphicon-edit"></span> <?php echo $title_modify; ?>
                                            </button>
                                        </a>
                                        <span style="font-size: 9px; color: red;"><br>
                                            F. Modificada: <?php echo $date_modify; ?><br>
                                            Por: <?php echo get_nameuser_id($idcreador_modify); ?>
                                        </span>                                
                                        <?php
                                    }
                                    break;
                                case $validation_total >= 2.0 && $validation_total <= 3.99:
                                    echo $validation_total . '<br><span style="color:#FFCC33">SE MODIFICA</span>';
                                    if (know_permission_role('VMO', 'permission_view') == 1) {
                                        $validate_modify_item = get_modify_item($question->PREGUNTA_ID);
                                        //echo count($validate_modify_item);
                                        $title_modify = (count($validate_modify_item) > 0) ? 'Pregunta Modificada' : 'Modificar Pregunta Ahora';
                                        $color_modify = (count($validate_modify_item) > 0) ? 'info' : 'success';
                                        $date_modify = (count($validate_modify_item) > 0) ? $validate_modify_item[0]->PREGUNTA_MODIFICACION_FECHA : '';
                                        $idcreador_modify = (count($validate_modify_item) > 0) ? $validate_modify_item[0]->PREGUNTA_MODIFICACION_IDUSUARIOCREADOR : '';
                                        ?>
                                        <a href="<?php echo base_url("question/edit_question/" . encrypt_id($question->PREGUNTA_ID)); ?>">
                                            <button type="button" class="btn btn-<?php echo $color_modify; ?> btn-sm">
                                                <span class="glyphicon glyphicon-edit"></span> <?php echo $title_modify; ?>
                                            </button>
                                        </a> 
                                        <span style="font-size: 9px; color: red;"><br>
                                            F. Modificada: <?php echo $date_modify; ?><br>
                                            Por: <?php echo get_nameuser_id($idcreador_modify); ?>
                                        </span>                                
                                    <?php } ?>
                                    <?php
                                    break;
                                case $validation_total >= 4.0:
                                    echo $validation_total . '<br><span style="color:#00CC00">SE CONSERVA</span>';
                                    //if (know_permission_role('VMO', 'permission_view') == 1) {
                                    if (1 == 1) {
                                        $validate_modify_item = get_modify_item($question->PREGUNTA_ID);
                                        $title_modify = (count($validate_modify_item) > 0) ? 'Pregunta Modificada' : 'Modificar Pregunta Ahora';
                                        $color_modify = (count($validate_modify_item) > 0) ? 'info' : 'success';
                                        $date_modify = (count($validate_modify_item) > 0) ? $validate_modify_item[0]->PREGUNTA_MODIFICACION_FECHA : '';
                                        $idcreador_modify = (count($validate_modify_item) > 0) ? $validate_modify_item[0]->PREGUNTA_MODIFICACION_IDUSUARIOCREADOR : '';
                                        ?>
                                        <a href="<?php echo base_url("question/edit_question/" . encrypt_id($question->PREGUNTA_ID)); ?>">
                                            <button type="button" class="btn btn-<?php echo $color_modify; ?> btn-sm">
                                                <span class="glyphicon glyphicon-edit"></span> <?php echo $title_modify; ?>
                                            </button>
                                        </a>
                                        <span style="font-size: 9px; color: red;"><br>
                                            F. Modificada: <?php echo $date_modify; ?><br>
                                            Por: <?php echo get_nameuser_id($idcreador_modify); ?>
                                        </span>                                
                                    <?php } ?>  
                                    <?php
                                    break;
                            }
                            ?>
                        </div>
                    <?php } ?>
                </td>
                <td style="text-align: center;">
                    <?php if ($question->PREGUNTA_ETAPA != 0) { ?>
                        <?php if (get_avg_validation($question->V1, $question->V2, $question->V3, $question->V4, $question->V5) > 0) { ?>
                            <a target="popup" onClick="window.open(this.href, this.target, 'width=800,height=800');
                                                        return false;" href="<?php echo base_url("question/view_validation/" . encrypt_id($question->PREGUNTA_ID)); ?>">
                                <button type="button" class="btn btn-primary btn-sm">
                                    <span class="glyphicon glyphicon-zoom-in"></span>Ver Validacion
                                </button>  
                            </a>
                        <?php } ?>
                    <?php } ?>
                </td>

                <td style="text-align: center;">
                    <?php if ($validation_total != 0) { ?>
                        <?php
                        //if ($this->session->userdata('USUARIO_ID') == 62 && $question->PREGUNTA_SELECCIONADA == 1) {
                        if ($question->PREGUNTA_VALIDA1_OK == 1) {
                            echo '<span class="label label-success"><span class="glyphicon glyphicon-star"></span> SIN-SEM OK</span><br>';
                        }
                        if ($question->PREGUNTA_VALIDA2_OK == 1) {
                            echo '<span class="label label-primary"><span class="glyphicon glyphicon-star"></span> SUF-UBI-REL OK</span>';
                        }
                        //}
                    } else {
                        echo "--";
                    }
                    ?>
                </td>                    
            </tr>            
            <?php
            $count++;
        }
        ?>
    </tbody>
    </table>
<?php } else { ?>

    <div class="alert alert-warning">
        No se encontraron registros
    </div>

<?php } ?>

</div>    