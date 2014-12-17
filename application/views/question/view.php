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



<?php
//echo '<pre>'.print_r($questions,true).'</pre>';
//echo date("Y-m-d H:i:s");
?>

<?php
$array_color_1 = array('success', 'warning', 'danger');
$array_color_2 = array('#5cb85c', '#f0ad4e', '#d9534f');
?>

<!-- Button trigger modal -->
<?php if (count($component) > 0): ?>
    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal_1">
        <span class="glyphicon glyphicon-stats"></span> Estadistica
    </button>
<?php endif; ?>

</div>

<?php if (count($questions) > 0) { ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Codigo</th>
                <th>Fecha</th>
                <th>Persona a Cargo</th>
                <th>Componente</th>
                <th>Tema</th>
                <th>Nivel Rubrica</th>
                <th>Nivel Pregunta</th>
                <th>Dificultad</th>
                <th>Enunciado</th>
                <th style="text-align: center;">Opciones</th>
                <th style="text-align: center;">Validaci&oacute;n</th>
                <th style="text-align: center;"></th>
                <th style="text-align: center;">v/b Validadores</th>
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
                        <?php $validation_total=0; ?>
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
                                if($question->PREGUNTA_VALIDA1_OK == 1){
                                    echo '<span class="label label-success"><span class="glyphicon glyphicon-star"></span> SIN-SEM OK</span><br>';
                                }
                                if($question->PREGUNTA_VALIDA2_OK == 1){
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

<?php if (count($component) > 0): ?>
    <!-- Modal -->
    <div class="modal fade" id="myModal_1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">
                        Detalles del Componente <?php echo $component[0]->COMPONENTE_NOMBRE; ?>
                    </h4>
                </div>
                <div class="modal-body">
                    <h4>Items Construidos</h4>
                    <?php
                    if ($component[0]->COMPONENTE_PREGUNTAS > 0) {
                        $porcen = ($component[0]->ITEMS * 100) / $component[0]->COMPONENTE_PREGUNTAS;
                        echo round($porcen) . '% |  ' . $component[0]->ITEMS . ' de ' . $component[0]->COMPONENTE_PREGUNTAS . ' Items';
                    }
                    ?>
                    <div class="progress progress-striped active">
                        <div class="progress-bar"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round($porcen); ?>%">
                            <span class="sr-only"></span>
                        </div>
                    </div>

                    <h4>Nivel de Rubrica Construido</h4>
                    <?php
                    if ($component[0]->NIVELRUBRICAS != '') {
                        $total_NIVELRUBRICAS = explode(',', $component[0]->NIVELRUBRICAS);
                        $total_NIVELRUBRICAS_unique = array_count_values($total_NIVELRUBRICAS);
                        $a = 0;
                        foreach ($total_NIVELRUBRICAS_unique as $key => $value) {
                            $porcen = ($value * 100) / count($total_NIVELRUBRICAS);
                            $porcen = round($porcen);
                            echo '<span style="font-size: 11px;color: ' . $array_color_2[$a] . '">' . $key . ': ' . $value . ' Items(' . $porcen . '%)</span>, ';
                            $a++;
                        }
                        ?>
                        <div class="progress progress-striped active">
                            <?php
                            $b = 0;
                            foreach ($total_NIVELRUBRICAS_unique as $key => $value) {
                                $porcen = ($value * 100) / count($total_NIVELRUBRICAS);
                                $porcen = round($porcen - 0.1, 0, PHP_ROUND_HALF_DOWN);
                                ?>
                                <div class="progress-bar progress-bar-<?php echo $array_color_1[$b]; ?>" style="width: <?php echo $porcen; ?>%">
                                    <span class="sr-only"></span>
                                </div> 
                                <?php
                                $b++;
                            }
                            ?>
                        </div>
                        <?php
                    } else {
                        echo "No se encontraron Items.";
                    }
                    ?>
                    <h4>Nivel de Dificultad Construido</h4>
                    <?php
                    if ($component[0]->NIVELDIFICULTAD != '') {
                        $total_NIVELDIFICULTAD = explode(',', $component[0]->NIVELDIFICULTAD);
                        $total_NIVELDIFICULTAD_unique = array_count_values($total_NIVELDIFICULTAD);
                        $a = 0;
                        foreach ($total_NIVELDIFICULTAD_unique as $key => $value) {
                            $porcen = ($value * 100) / count($total_NIVELDIFICULTAD);
                            $porcen = round($porcen);
                            echo '<span style="font-size: 11px;color: ' . $array_color_2[$a] . '">' . get_niveldificultadname($key) . ': ' . $value . ' Items(' . $porcen . '%)</span>, ';
                            $a++;
                        }
                        ?>
                        <div class="progress progress-striped active">
                            <?php
                            $b = 0;
                            foreach ($total_NIVELDIFICULTAD_unique as $key => $value) {
                                $porcen = ($value * 100) / count($total_NIVELDIFICULTAD);
                                $porcen = round($porcen - 0.1, 0, PHP_ROUND_HALF_DOWN);
                                ?>
                                <div class="progress-bar progress-bar-<?php echo $array_color_1[$b]; ?>" style="width: <?php echo $porcen; ?>%">
                                    <span class="sr-only"></span>
                                </div> 
                                <?php
                                $b++;
                            }
                            ?>
                        </div>                                   
                        <?php
                    } else {
                        echo "No se encontraron Items.";
                    }
                    ?>                                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

    <div class="container">