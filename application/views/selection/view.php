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

<h4 style="color:red">TOTAL ITEMS SELECCIONADOS: <?php echo count($questions_selections); ?></h4>


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
                <th>Dificultad</th>
                <th>Enunciado</th>


                <th style="text-align: center;">Validaci&oacute;n Total</th>

                <th style="text-align: center;">Opciones</th>
                <th style="text-align: center;">v/b Validadores</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $count = 1;
            foreach ($questions as $question) {
                //echo '<pre>' . print_r($question, true) . '</pre>';
                ?>
                <tr>
                    <td style="font-size: 11px !important;"><?php echo $count; ?></td>
                    <td style="font-size: 11px !important;color: blue !important;"><?php echo 'PN317' . $question->COMPONENTE_SIGLA . '' . $question->PREGUNTA_ID; ?></td>
                    <td style="font-size: 11px !important;"><?php echo $question->PERSONA_CARGO; ?></td>
                    <td style="font-size: 11px !important;"><?php echo $question->COMPONENTE_NOMBRE; ?></td>
                    <td style="font-size: 11px !important;"><?php echo $question->PREGUNTA_TEMA; ?></td>
                    <td style="font-size: 11px !important;"><?php echo $question->PREGUNTA_NIVELRUBRICA; ?></td>
                    <td style="font-size: 11px !important;"><?php echo $question->PREGUNTA_NIVELPREGUNTA; ?></td>
                    <td style="font-size: 11px !important;"><?php echo get_difficulty_level($question->PREGUNTA_NIVELDIFICULTAD); ?></td>
                    <td style="font-size: 11px !important;"><?php echo substr(strip_tags($question->PREGUNTA_ENUNCIADO), 0, 150) . '...'; ?></td>

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
                                            $title_modify = (count($validate_modify_item) > 0) ? 'Ver Pregunta Modificada' : 'ALERTA: PREGUNTA SIN MODIFICAR!!!';
                                            $color_modify = (count($validate_modify_item) > 0) ? 'info' : 'success';
                                            $date_modify = (count($validate_modify_item) > 0) ? $validate_modify_item[0]->PREGUNTA_MODIFICACION_FECHA : '';
                                            $idcreador_modify = (count($validate_modify_item) > 0) ? $validate_modify_item[0]->PREGUNTA_MODIFICACION_IDUSUARIOCREADOR : '';
                                            ?>
                                            <a target="popup" onClick="window.open(this.href, this.target, 'width=800,height=800');
                                                    return false;" href="<?php echo base_url("selection/view_question_mod/" . encrypt_id($question->PREGUNTA_ID)); ?>">
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
                                            $title_modify = (count($validate_modify_item) > 0) ? 'Ver Pregunta Modificada' : 'ALERTA: PREGUNTA SIN MODIFICAR!!!';
                                            $color_modify = (count($validate_modify_item) > 0) ? 'info' : 'success';
                                            $date_modify = (count($validate_modify_item) > 0) ? $validate_modify_item[0]->PREGUNTA_MODIFICACION_FECHA : '';
                                            $idcreador_modify = (count($validate_modify_item) > 0) ? $validate_modify_item[0]->PREGUNTA_MODIFICACION_IDUSUARIOCREADOR : '';
                                            ?>
                                            <a target="popup" onClick="window.open(this.href, this.target, 'width=800,height=800');
                                                    return false;" href="<?php echo base_url("selection/view_question_mod/" . encrypt_id($question->PREGUNTA_ID)); ?>">
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
                                        ?>
                                        <!--                                        <a target="popup" onClick="window.open(this.href, this.target, 'width=800,height=800');
                                                                                                            return false;" href="<?php echo base_url("selection/view_question/" . encrypt_id($question->PREGUNTA_ID)); ?>">
                                                                                    <button type="button" class="btn btn-warning btn-sm">
                                                                                        <span class="glyphicon glyphicon-edit"></span> Ver Pregunta Original
                                                                                    </button>
                                                                                </a>                                            -->
                                        <?php
                                        if (1 == 1) {
                                            $validate_modify_item = get_modify_item($question->PREGUNTA_ID);
                                            $title_modify = (count($validate_modify_item) > 0) ? 'Ver Pregunta Modificada' : 'Ver Pregutna ORIGINAL';
                                            $color_modify = (count($validate_modify_item) > 0) ? 'info' : 'success';
                                            $date_modify = (count($validate_modify_item) > 0) ? $validate_modify_item[0]->PREGUNTA_MODIFICACION_FECHA : '';
                                            $idcreador_modify = (count($validate_modify_item) > 0) ? $validate_modify_item[0]->PREGUNTA_MODIFICACION_IDUSUARIOCREADOR : '';
                                            ?>
                                            <a target="popup" onClick="window.open(this.href, this.target, 'width=800,height=800');
                                                    return false;" href="<?php echo base_url("selection/view_question_mod/" . encrypt_id($question->PREGUNTA_ID)); ?>">
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
                                }
                                if ($validation_total == 0) {
                                    ?>
                                    <a target="popup" onClick="window.open(this.href, this.target, 'width=800,height=800');
                                            return false;" href="<?php echo base_url("selection/view_question/" . encrypt_id($question->PREGUNTA_ID)); ?>">
                                        <button type="button" class="btn btn-warning btn-sm">
                                            <span class="glyphicon glyphicon-edit"></span> Ver Pregunta Original
                                        </button>
                                    </a>                                            
                                    <?php
                                }
                                ?>

                            </div>
                        <?php } ?>
                    </td>  

                    <td style="text-align: center;">
                        <?php //if ($validation_total != 0) {  ?>
                        <a href="<?php echo base_url("selection/select/" . $question->PREGUNTA_SELECCIONADA . '/' . encrypt_id($question->PREGUNTA_ID) . '/' . encrypt_id($question->COMPONENTE_ID)); ?>">
                            <button type="button" class="btn btn-<?php echo ($question->PREGUNTA_SELECCIONADA == 0) ? 'success' : 'danger' ?> btn-sm">
                                <span class="glyphicon glyphicon-<?php echo ($question->PREGUNTA_SELECCIONADA == 0) ? 'ok' : 'remove' ?>"></span>
                                <?php echo ($question->PREGUNTA_SELECCIONADA == 0) ? 'Seleccionar Item' : 'Desseleccionar' ?>
                            </button>  
                        </a>
                        <?php if ($this->session->userdata('USUARIO_ID') == 62 && $question->PREGUNTA_SELECCIONADA == 1) { ?>
                            <a href="<?php echo base_url("selection/diagra/" . $question->PREGUNTA_DIAGRAMADA . '/' . encrypt_id($question->PREGUNTA_ID) . '/' . encrypt_id($question->COMPONENTE_ID)); ?>">
                                <button style="margin-top: 8px !important;" type="button" class="btn btn-<?php echo ($question->PREGUNTA_DIAGRAMADA == 0) ? 'primary' : 'info' ?> btn-sm">
                                    <span class="glyphicon glyphicon-<?php echo ($question->PREGUNTA_DIAGRAMADA == 0) ? 'picture' : 'trash' ?>"></span>
                                    <?php echo ($question->PREGUNTA_DIAGRAMADA == 0) ? 'Diagramar Item' : 'Desseleccionar Diagra' ?>
                                </button>  
                            </a>
                            <?php
                        }
                        /* } else {
                          echo "No se pueden Seleccionar Items no Validados!";
                          } */
                        ?>
                    </td>

                    <td style="text-align: center;">
                        <?php //if ($validation_total != 0) { ?>
                            <?php
                            //if ($question->PREGUNTA_SELECCIONADA == 1) {
                                if ($question->PREGUNTA_VALIDA1_OK == 1) {
                                    echo '<span class="label label-success"><span class="glyphicon glyphicon-star"></span> SIN-SEM OK</span><br>';
                                }
                                if ($question->PREGUNTA_VALIDA2_OK == 1) {
                                    echo '<span class="label label-primary"><span class="glyphicon glyphicon-star"></span> SUF-UBI-REL OK</span>';
                                }
                            //}
                        /*} else {
                            echo "--";
                        }*/
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