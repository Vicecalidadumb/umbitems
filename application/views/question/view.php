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

        <a href="<?php echo base_url('question/add/' . encrypt_id($questions[0]->COMPONENTE_ID)) ?>" class="btn btn-primary btn-sm">
            <span class="glyphicon glyphicon-plus"></span> 
            Agregar Nueva Pregunta en <?php echo $questions[0]->COMPONENTE_SIGLA . ' - ' . $questions[0]->COMPONENTE_NOMBRE; ?>
        </a>  
        <a href="<?php echo base_url('question/view'); ?>" class="btn btn-warning btn-sm">
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
                            <?php if ($question->PREGUNTA_ETAPA == 0) { ?>
                                <a href="<?php echo base_url("question/edit/" . encrypt_id($question->PREGUNTA_ID)); ?>">
                                    <button type="button" class="btn btn-info btn-xs">
                                        <span class="glyphicon glyphicon-edit"></span> Editar
                                    </button>
                                </a>
                            <?php } ?>
                            <?php if ($question->PREGUNTA_ETAPA == 1) { ?>
                                <a href="<?php echo base_url("selection/select/" . $question->PREGUNTA_SELECCIONADA . '/' . encrypt_id($question->PREGUNTA_ID) . '/' . encrypt_id($question->COMPONENTE_ID)); ?>">
                                    <button type="button" class="btn btn-<?php echo ($question->PREGUNTA_SELECCIONADA == 0) ? 'success' : 'danger' ?> btn-sm">
                                        <span class="glyphicon glyphicon-<?php echo ($question->PREGUNTA_SELECCIONADA == 0) ? 'ok' : 'remove' ?>"></span>
                                        <?php echo ($question->PREGUNTA_SELECCIONADA == 0) ? 'Seleccionar Item' : 'Desseleccionar' ?>
                                    </button>  
                                </a>
                            <?php } ?>                            
                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal" data-cod="<?php echo $question->COMPONENTE_SIGLA . '_' . get_level_initials($question->PREGUNTA_NIVELPREGUNTA) . '_' . $question->PREGUNTA_ID; ?>" data-whatever="<?php echo $question->PREGUNTA_ID; ?>">
                                <span class="glyphicon glyphicon-zoom-in"></span> VP
                            </button>
                        </td>
                        <td>
                            <span class="label label-default" style="font-size: 11px;">
                                <?php echo get_itemlevel_text($question->PREGUNTA_ETAPA); ?>
                            </span>    
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
            <br>
            <a href="<?php echo base_url('question/view'); ?>" class="btn btn-warning btn-sm">
                <span class="glyphicon glyphicon-arrow-left"></span> 
                Volver atr&aacute;s
            </a>            
        </div>

    <?php } ?>

</div>
<div class="container">




    <!--MODAL DINAMICO-->
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