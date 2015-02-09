<script type="text/javascript" src="<?php echo base_url('dist/js/script_modal.js?v=' . date("d-h")); ?>"></script>

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
    <h3 style="color:#2aabd2">Listado de Items</h3>
</div>

</div>
<div class="container" style="width: 90% !important;">

    <?php if (count($questions) > 0) { ?>
        <em>
            <strong>Componente:</strong> <?php echo $questions[0]->COMPONENTE_SIGLA . ' - ' . $questions[0]->COMPONENTE_NOMBRE; ?>
            <br>
            <strong>Nivel de Pregunta :</strong> <?php echo $questions[0]->PREGUNTA_NIVELPREGUNTA; ?>
            <br>
            <strong>Total ítems Construidos :</strong> <?php echo count($questions); ?>
        </em>
        <br><br>

        <a href="<?php echo base_url('index.php/question/add/' . encrypt_id($questions[0]->COMPONENTE_ID)) ?>" class="btn btn-primary btn-sm">
            <span class="glyphicon glyphicon-plus"></span> 
            Agregar Nueva Pregunta en <?php echo $questions[0]->COMPONENTE_SIGLA . ' - ' . $questions[0]->COMPONENTE_NOMBRE; ?>
        </a>  
        <a href="<?php echo base_url('index.php/question/view'); ?>" class="btn btn-warning btn-sm">
            <span class="glyphicon glyphicon-arrow-left"></span> 
            Volver atr&aacute;s
        </a>          

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Cod</th>
                    <th>Fecha Creaci&oacute;n</th>
                    <th>Constructor</th>
                    <th>Nivel Rubrica</th>
                    <th>Dificultad</th>
                    <th style="text-align: center;">Opciones</th>
                    <th style="text-align: center;">Etapa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                $etapa_val = 0;
                $etapa_val2 = 0;
                $validada2 = 0;
                foreach ($questions as $question) {
                    ?>
                    <tr class="<?php echo get_itemlevel_color($question->PREGUNTA_ETAPA); ?>">
                        <td>
                            <strong>
                                <?php echo $question->COMPONENTE_SIGLA . '_' . get_level_initials($question->PREGUNTA_NIVELPREGUNTA) . '_' . $question->PREGUNTA_ID; ?>
                            </strong>
                        </td>
                        <td>
                            <?php echo $question->PREGUNTA_FECHADECREACION; ?>
                        </td>
                        <td>
                            <?php echo $question->USUARIO_NOMBRES . ' ' . $question->USUARIO_APELLIDOS; ?>
                        </td>
                        <td>
                            <?php echo $question->PREGUNTA_NIVELRUBRICA; ?>
                        </td>
                        <td>
                            <?php echo get_difficulty_level($question->PREGUNTA_NIVELDIFICULTAD); ?>
                        </td>
                        <td>
                            <?php
                            $etapa = $question->PREGUNTA_ETAPA;
//                            echo  "****".$this->session->userdata('ID_TIPO_USU');
                            switch ($etapa) {
                                case 0://EDITAR ITEM ORIGINAL (ESTADO 0 Y TIPO DE USUARIO 2 - CONSTRUCTOR)
                                    if ($this->session->userdata('ID_TIPO_USU') == 2) {
                                        ?>
                                        <a href="<?php echo base_url("index.php/question/edit/" . encrypt_id($question->PREGUNTA_ID)); ?>" class="btn btn-info btn-xs">
                                            <span class="glyphicon glyphicon-edit"></span> 
                                            Editar
                                        </a>
                                        <?php
                                    }
                                    break;
                                case 3:
                                    if ($this->session->userdata('ID_TIPO_USU') == 2 or $this->session->userdata('ID_TIPO_USU') == 3) {
                                        $validate_modify_item = get_modify_item($question->PREGUNTA_ID);
                                        ?>
                                        <a href="<?php echo base_url("index.php/question/edit_question/" . encrypt_id($question->PREGUNTA_ID)); ?>" class="btn btn-<?php echo (count($validate_modify_item) > 0) ? 'success' : 'info'; ?> btn-xs">
                                            <span class="glyphicon glyphicon-edit"></span> 
                                            <?php echo (count($validate_modify_item) > 0) ? 'Pregunta Modificada' : 'Modificar Pregunta'; ?>
                                        </a>
                                        <?php
                                    }
                                case 4:
                                    if ($this->session->userdata('ID_TIPO_USU') == 3 && $etapa != 2) {
                                        $validate_modify_item = get_modify_item($question->PREGUNTA_ID);
                                        ?>
                                        <a href="<?php echo base_url("index.php/selection/select/" . $question->PREGUNTA_VALIDA_CE . '/' . encrypt_id($question->PREGUNTA_ID) . '/' . encrypt_id($question->COMPONENTE_ID)) . '/' . encrypt_id($question->PREGUNTA_NIVELPREGUNTA) . '/' . 'PREGUNTA_VALIDA_CE/4'; ?>" class="btn btn-<?php echo ($question->PREGUNTA_VALIDA_CE == 0) ? 'success' : 'danger' ?> btn-xs">
                                            <span class="glyphicon glyphicon-edit"></span> 
                                            <?php echo ($question->PREGUNTA_VALIDA_CE == 0) ? 'Correccion de Estilo OK' : 'Sin Correccion de Estilo'; ?>
                                        </a>
                                        <?php
                                    }
                                case 5:
                                    if ($this->session->userdata('ID_TIPO_USU') == 7 && $etapa != 3 && $etapa != 2) {
                                        ?>
                                        <a href="<?php echo base_url("index.php/selection/select/" . $question->PREGUNTA_DIAGRAMADA . '/' . encrypt_id($question->PREGUNTA_ID) . '/' . encrypt_id($question->COMPONENTE_ID)) . '/' . encrypt_id($question->PREGUNTA_NIVELPREGUNTA) . '/' . 'PREGUNTA_DIAGRAMADA/5'; ?>" class="btn btn-<?php echo ($question->PREGUNTA_DIAGRAMADA == 0) ? 'success' : 'danger' ?> btn-xs">
                                            <span class="glyphicon glyphicon-edit"></span> 
                                            <?php echo ($question->PREGUNTA_DIAGRAMADA == 0) ? 'Diagramada' : 'Sin Diagramar'; ?>
                                        </a>
                                        <?php
                                    }
                                case 1:
                                    if ($this->session->userdata('ID_TIPO_USU') == 2 && $question->PREGUNTA_VALIDA_2 == 1 && $etapa == 1) {
                                        ?>
                                        <a href="<?php echo base_url("index.php/question/edit/" . encrypt_id($question->PREGUNTA_ID)); ?>" class="btn btn-info btn-xs">
                                            <span class="glyphicon glyphicon-edit"></span> 
                                            Editar
                                        </a>
                                        <?php
                                    }
                                case 2:
                                    //VALIDAR ITEM (ESTADO 2 Y TIPO DE USUARIO 4 - VALIDADOR)
                                    if ($this->session->userdata('ID_TIPO_USU') == 4 && $etapa == 1) {
                                        $validate_modify_item = get_modify_item($question->PREGUNTA_ID);
                                        ?>
                                        <a class="btn btn-success btn-xs" data-toggle="modal" data-target="#exampleModal2" data-preguntaid="<?php echo $question->PREGUNTA_ID; ?>" data-cod="<?php echo $question->COMPONENTE_SIGLA . '_' . get_level_initials($question->PREGUNTA_NIVELPREGUNTA) . '_' . $question->PREGUNTA_ID; ?>">
                                            <span class="glyphicon glyphicon-ok"></span>
                                            <?php echo (count($validate_modify_item) > 0) ? 'Validar Modificaci&oacute;n' : 'Validar'; ?>
                                        </a>
                                        <?php
                                    }
                                    //DEVOLVER EN CASO DE QUE SEA ERRONEO LA INFORMACION 
                                    if ($this->session->userdata('ID_TIPO_USU') == 4 && $etapa == 2) {
                                        $validate_modify_item = get_modify_item($question->PREGUNTA_ID);
                                        ?>
                                        <a href="<?php echo base_url("index.php/selection/devolver/" . $question->PREGUNTA_ID . "/" . $id_component2); ?>" class="btn btn-danger btn-xs">
                                            <span class="glyphicon glyphicon-remove"></span>
                                            Desseleccionar
                                        </a>
                                        <?php
                                    }

                                    //SELECCIONAR ITEM (ESTADO 1 O 2 Y TIPO DE USUARIO 6 - SELECCIONAROR)   
                                    if ($this->session->userdata('ID_TIPO_USU') == 6 && ($etapa == 3 || $etapa == 2)) {
                                        if ($question->PREGUNTA_SELECCIONADA == 0) {
                                            ?>
                            
                                            <a class="btn btn-success btn-xs" data-toggle="modal" data-target="#exampleModal3" 
                                               data-preguntaid="<?php echo $question->PREGUNTA_ID; ?>" 
                                               data-envio="<?php echo base_url("index.php/selection/select/" . $question->PREGUNTA_SELECCIONADA . '/' . encrypt_id($question->PREGUNTA_ID) . '/' . encrypt_id($question->COMPONENTE_ID)) . '/' . encrypt_id($question->PREGUNTA_NIVELPREGUNTA) . '/' . 'PREGUNTA_SELECCIONADA/3' ?>">
                                                <span class="glyphicon glyphicon-ok"></span>
                                                <?php echo 'Seleccionar Item'; ?>
                                            </a>
                                            <?php
                                        } else {
                                            ?>
                                            <a href="<?php echo base_url("index.php/selection/select/" . $question->PREGUNTA_SELECCIONADA . '/' . encrypt_id($question->PREGUNTA_ID) . '/' . encrypt_id($question->COMPONENTE_ID)) . '/' . encrypt_id($question->PREGUNTA_NIVELPREGUNTA) . '/' . 'PREGUNTA_SELECCIONADA/3'; ?>" class="btn btn-<?php echo ($question->PREGUNTA_SELECCIONADA == 0) ? 'success' : 'danger' ?> btn-xs">
                                                <span class="glyphicon glyphicon-<?php echo ($question->PREGUNTA_SELECCIONADA == 0) ? 'ok' : 'remove' ?>"></span>
                                                <?php echo ($question->PREGUNTA_SELECCIONADA == 0) ? 'Seleccionar Item' : 'Desseleccionar' ?>
                                            </a>
                                            <?php
                                        }
                                    }
                                    break;
                            }
                            ?>                          

                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal" data-cod="<?php echo $question->COMPONENTE_SIGLA . '_' . get_level_initials($question->PREGUNTA_NIVELPREGUNTA) . '_' . $question->PREGUNTA_ID; ?>" data-whatever="<?php echo $question->PREGUNTA_ID; ?>">
                                <span class="glyphicon glyphicon-zoom-in"></span> VP
                            </button>
                        </td>
                        <td>
                            <span class="label label-default" style="font-size: 11px;">
                                <?php echo get_itemlevel_text($question); ?>
                            </span>    
                        </td>                  
                    </tr>
                    <?php
                    $count++;
                    if (($question->PREGUNTA_ETAPA) > 0) {
                        $etapa_val++;
                    }
                    if (($question->PREGUNTA_ETAPA) == 1 && ($question->PREGUNTA_VALIDA_2) == 0) {
                        $etapa_val2++;
                    }
                    if (($question->PREGUNTA_ETAPA) == 1 && ($question->PREGUNTA_VALIDA_2) == 1)
                        $validada2++;
                }
//                $count = $count - 1;
//                echo "<br>".$etapa_val2."*".$validada2."*".$etapa_val."//".$count;
//                $resul =  $validada2;
//                $porce = ($resul / $count) * 100;


                $resul = $etapa_val + (-$etapa_val2);
                $porce = ($resul / $etapa_val) * 100;
                //echo $count."**".$resul;
                ?>
            </tbody>
            <p>
                <?php
                // echo $this->session->userdata('ID_TIPO_USU');
                if ($this->session->userdata('ID_TIPO_USU') == 4) {
                    ?>
                <div class="col-md-12">
                    <div class="col-md-4">
                        <div class="progress" style="width: 300px">
                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $porce; ?>%">
                                <span class="sr-only"><?php echo $porce; ?>% completado</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <span ><?php echo number_format($porce); ?>% completado</span>
                    </div>
                </div>
            <?php } ?>


        </table>
    <?php } else { ?>

        <div class="alert alert-warning">
            No se encontraron registros
            <br>
            <a href="<?php echo base_url('index.php/question/view'); ?>" class="btn btn-warning btn-sm">
                <span class="glyphicon glyphicon-arrow-left"></span> 
                Volver atr&aacute;s
            </a>            
        </div>

    <?php } ?>

</div>
<div class="container">




    <!--MODAL DINAMICO - VISTA PREVIA-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">
                    </h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <!--MODAL - VALIDADOR-->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Validar</h4>
                </div>
                <form action="<?php echo base_url('index.php/validation/insert/' . encrypt_id($question->COMPONENTE_ID) . '/' . encrypt_id($question->PREGUNTA_NIVELPREGUNTA)); ?>" role="form" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="PREGUNTA_ID" id="PREGUNTA_ID">
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Estado:</label>
                            <?php echo form_dropdown('PREGUNTA_VALIDA_2', array(1 => 'VALIDACION OK', 2 => 'ERROR AL VALIDAR'), '', 'class="form-control"'); ?>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Suficiencia:</label>
                            <textarea name="PREGUNTA_VALIDA_2_TEXT1" class="form-control" id="PREGUNTA_VALIDA_2_TEXT1"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Ubicacion:</label>
                            <textarea name="PREGUNTA_VALIDA_2_TEXT2" class="form-control" id="PREGUNTA_VALIDA_2_TEXT2"></textarea>
                        </div>                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>    
    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Validar</h4>
                </div>
                <form id="form_seleccion" action="" role="form" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="PREGUNTA_ID" id="PREGUNTA_ID">
                        <div class="form-group">
                            <label for="message-text" class="control-label">Observaci&oacute;n:</label>
                            <textarea name="PREGUNTA_SELEC_1_TEXT2" class="form-control" id="PREGUNTA_SELEC_1_TEXT2"></textarea>
                            <input type="hidden" value="0" id="accion2" name="accion2">
                        </div>                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="submit" class="btn btn-danger" onclick="accion(1)">Devolver</button>
                    </div>
                </form>
            </div>
        </div>
    </div>    
    <script>
        function accion(dato){
            $('#accion2').val(dato);
        }
    </script>