<?php if ($this->session->flashdata('message')) { ?>
    <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php } ?>

<div class="jumbotron">
    <div style="text-align: center">
        <?php echo $this->session->userdata('HEADER_3'); ?>   
    </div>
    <h2>Validaci&oacute;n de &Iacute;tems</h2>
    <?php echo $this->session->userdata('HEADER_2'); ?>
</div>

</div>
<?php
//echo '<pre>'.print_r($questions,true).'</pre>';
?>
<?php if (count($questions) > 0) { ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Codigo</th>
                <th>Persona a Cargo</th>
                <th>Componente</th>
                <th>Tema</th>
                <th>Nivel Rubrica</th>
                <th>Nivel Pregunta</th>
    <!--                <th>Dificultad</th>-->
                <th>Enunciado</th>
                <th style="text-align: center;">Opciones</th>
                <th style="text-align: center; font-size: 11px !important;">SIN</th>
                <th style="text-align: center; font-size: 11px !important;">SEM</th>
                <th style="text-align: center; font-size: 11px !important;">SUF</th>
                <th style="text-align: center; font-size: 11px !important;">UBI</th>
                <th style="text-align: center; font-size: 11px !important;">REL</th>
                <th style="text-align: center;">Validaci&oacute;n Total</th>

                <th style="text-align: center;">Ver Validaci&oacute;n</th>

                <th style="text-align: center;">v/b Validador</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $count = 1;
            foreach ($questions as $question) {
                ?>
                <tr>
                    <td style="font-size: 11px !important;"><?php echo $count; ?></td>
                    <td style="font-size: 11px !important;color: blue !important;">
                        <?php echo 'PN317' . $question->COMPONENTE_SIGLA . '' . $question->PREGUNTA_ID; ?>
                        <?php echo ($question->PREGUNTA_SELECCIONADA == 1) ? '<span class="label label-warning">Seleccionada</span>' : ''; ?>
                    </td>
                    <td style="font-size: 9px !important;"><?php echo $question->PERSONA_CARGO; ?></td>
                    <td style="font-size: 9px !important;"><?php echo $question->COMPONENTE_NOMBRE; ?></td>
                    <td style="font-size: 9px !important;"><?php echo $question->PREGUNTA_TEMA; ?></td>
                    <td style="font-size: 9px !important;"><?php echo $question->PREGUNTA_NIVELRUBRICA; ?></td>
                    <td style="font-size: 9px !important;"><?php echo $question->PREGUNTA_NIVELPREGUNTA; ?></td>
        <!--                    <td style="font-size: 9px !important;"><?php echo get_difficulty_level($question->PREGUNTA_NIVELDIFICULTAD); ?></td>-->
                    <td style="font-size: 9px !important;"><?php echo substr(strip_tags($question->PREGUNTA_ENUNCIADO), 0, 150) . '...'; ?></td>
                    <td style="text-align: center; font-size: 11px !important;">

                        <?php
                        $color_button = (get_validation_id($id_user, $question->PREGUNTA_ID) == 1) ? 'info' : 'success';
                        $script_button = (get_validation_id($id_user, $question->PREGUNTA_ID) == 1) ? 'Validado' : 'Validar';
                        $icon_button = (get_validation_id($id_user, $question->PREGUNTA_ID) == 1) ? 'flag' : 'ok';
                        ?>


                        <?php if ($question->PREGUNTA_ETAPA == 0) { ?>
                            <div style="text-align: center;color: #FF0000">EN ETAPA DE CONSTRUCCI&Oacute;N</div>
                        <?php } else { ?>
                            <a href="<?php echo base_url("validation/add_validation/" . encrypt_id($question->PREGUNTA_ID) . '/' . encrypt_id($id_user) . '/' . encrypt_id($id_component)); ?>">
                                <button type="button" class="btn btn-<?php echo $color_button; ?> btn-sm">
                                    <span class="glyphicon glyphicon-<?php echo $icon_button; ?>"></span> <?php echo $script_button; ?>
                                </button>
                            </a>   
                            <br>
                            <span style="font-size: 9px; color: blue">
                                F. de Terminado: <?php echo $question->PREGUNTA_FECHADECREACION; ?>
                            </span>  
                        <?php } ?>
                    </td>
                    <td style="font-size: 11px !important;">
                        <?php if ($question->PREGUNTA_ETAPA == 0) { ?>
                            <div style="text-align: center;color: #FF0000">NULL</div>
                        <?php } else { ?>
                            <?php
                            $validation_total = get_avg_validation_SIN_SEM($question->V4, $question->V5);
                            //echo $validation_total
                            echo $question->V4;
                            ?>
                        <?php } ?>
                    </td>
                    <td style="font-size: 11px !important;">
                        <?php if ($question->PREGUNTA_ETAPA == 0) { ?>
                            <div style="text-align: center;color: #FF0000">NULL</div>
                        <?php } else { ?>
                            <?php
                            $validation_total = get_avg_validation_SIN_SEM($question->V4, $question->V5);
                            //echo $validation_total
                            echo $question->V5;
                            ?>
                        <?php } ?>
                    </td>                    
                    <td style="font-size: 11px !important;">
                        <?php if ($question->PREGUNTA_ETAPA == 0) { ?>
                            <div style="text-align: center;color: #FF0000">NULL</div>
                        <?php } else { ?>
                            <?php
                            $validation_total = get_avg_validation_SUF_UBI_REL($question->V1, $question->V2, $question->V3);
                            //echo $validation_total
                            echo $question->V1;
                            ?>
                        <?php } ?>
                    </td>
                    <td style="font-size: 11px !important;">
                        <?php if ($question->PREGUNTA_ETAPA == 0) { ?>
                            <div style="text-align: center;color: #FF0000">NULL</div>
                        <?php } else { ?>
                            <?php
                            $validation_total = get_avg_validation_SUF_UBI_REL($question->V1, $question->V2, $question->V3);
                            //echo $validation_total
                            echo $question->V2;
                            ?>
                        <?php } ?>
                    </td>
                    <td style="font-size: 11px !important;">
                        <?php if ($question->PREGUNTA_ETAPA == 0) { ?>
                            <div style="text-align: center;color: #FF0000">NULL</div>
                        <?php } else { ?>
                            <?php
                            $validation_total = get_avg_validation_SUF_UBI_REL($question->V1, $question->V2, $question->V3);
                            //echo $validation_total
                            echo $question->V3;
                            ?>
                        <?php } ?>
                    </td>                    
                    <td>
                        <?php $validation_total = 0; ?>
                        <?php if ($question->PREGUNTA_ETAPA == 0) { ?>
                            <div style="text-align: center;color: #FF0000">EN ETAPA DE CONSTRUCCI&Oacute;N</div>
                        <?php } else { ?>
                            <div style="text-align: center;color: #0044cc">

                                <?php
                                $validation_total = get_avg_validation($question->V1, $question->V2, $question->V3, $question->V4, $question->V5);

                                switch ($validation_total) {
                                    case 0:
                                        echo $validation_total . '<br><span style="color:#0044cc">SIN EVALUAR</span>';
                                        break;
                                    case $validation_total <= 1.99 :
                                        echo $validation_total . '<br><span style="color:#FF0000">SE DESCARTA</span>';
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
                                            <?php
                                        }
                                        break;
                                    case
                                    $validation_total >= 2.0 && $validation_total <= 3.99:
                                        echo $validation_total . '<br><span style="color:#FFCC33">SE MODIFICA</span>';
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
                                <a href="<?php echo base_url("question/view_validation/" . encrypt_id($question->PREGUNTA_ID)); ?>">
                                    <button type="button" class="btn btn-primary btn-sm">
                                        <span class="glyphicon glyphicon-zoom-in"></span>Ver Validacion
                                    </button>  
                                </a>
                            <?php } ?>
                        <?php } ?>
                    </td>

                    <td style="text-align: center;">
                        <?php if ($this->session->userdata('USUARIO_ID') == 57 || $this->session->userdata('USUARIO_ID') == 60 || $this->session->userdata('USUARIO_ID') == 39) { ?>
                            <?php if ($validation_total != 0) { ?>
                                <?php if ($this->session->userdata('ID_TIPO_USU') == 3) { ?>
                                    <a href="<?php echo base_url("selection/valida1/" . $question->PREGUNTA_VALIDA1_OK . '/' . encrypt_id($question->PREGUNTA_ID) . '/' . encrypt_id($question->COMPONENTE_ID)); ?>">
                                        <button title="Dar Visto Bueno para Diagramar" style="margin-top: 8px !important;" type="button" class="btn btn-<?php echo ($question->PREGUNTA_VALIDA1_OK == 0) ? 'success' : 'danger' ?> btn-sm">
                                            <span class="glyphicon glyphicon-<?php echo ($question->PREGUNTA_VALIDA1_OK == 0) ? 'ok' : 'remove' ?>"></span>
                                            <?php echo ($question->PREGUNTA_VALIDA1_OK == 0) ? 'SIM, SEM OK' : 'SIM, SEM NO' ?>
                                        </button>  
                                    </a>
                                    <?php
                                }
                                if ($this->session->userdata('ID_TIPO_USU') == 4) {
                                    ?>
                                    <a href="<?php echo base_url("selection/valida2/" . $question->PREGUNTA_VALIDA2_OK . '/' . encrypt_id($question->PREGUNTA_ID) . '/' . encrypt_id($question->COMPONENTE_ID)); ?>">
                                        <button title="Dar Visto Bueno para Diagramar" style="margin-top: 8px !important;" type="button" class="btn btn-<?php echo ($question->PREGUNTA_VALIDA2_OK == 0) ? 'success' : 'danger' ?> btn-sm">
                                            <span class="glyphicon glyphicon-<?php echo ($question->PREGUNTA_VALIDA2_OK == 0) ? 'ok' : 'remove' ?>"></span>
                                            <?php echo ($question->PREGUNTA_VALIDA2_OK == 0) ? 'PER, COH, REL OK' : 'PER, COH, REL NO' ?>
                                        </button>  
                                    </a>
                                    <?php
                                }
                            } else {
                                echo "--";
                            }
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

<div class="container">