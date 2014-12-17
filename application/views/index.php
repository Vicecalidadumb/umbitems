<!-- Main jumbotron for a primary marketing message or call to action -->
<?php if ($this->session->flashdata('message')) { ?>
    <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php } ?>
<style>
    .progress {
        height: 7px;
    }
</style>


<?php
//echo print_y($this->session->userdata('rol_permissions'));
?>
<div class="jumbotron">
    <?php echo $this->session->userdata('HEADER_1'); ?>
</div>

<?php
//echo '<pre>' . print_r($components_array, true) . '</pre>';
if ($this->session->userdata('ID_TIPO_USU') != 3 && $this->session->userdata('ID_TIPO_USU') != 4 && $this->session->userdata('ID_TIPO_USU') != 6) {
    if (count($components_array) > 0) {
        ?>
        <h2>Mis Componentes</h2>
        <div class="row">
            <?php
            foreach ($components_array as $component) {
                ?>
                <div class="col-md-6">
                    <div class="alert alert-info" role="alert">
                        Componente: <strong style="font-size: 11px !important;"><?php echo $component->COMPONENTE_SIGLA . ' - ' . $component->COMPONENTE_NOMBRE; ?></strong>
                        <br>
                        Progreso Actual: <?php echo $component->TOTAL; ?> de <?php echo $component->COMPONENTE_PREGUNTAS; ?> Items.
                        <?php
                        $progress = round(($component->TOTAL > 0) ? ($component->TOTAL * 100) / $component->COMPONENTE_PREGUNTAS : 0);
                        ?>
                        <strong><?php echo $progress; ?>%</strong>
                        <br>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress; ?>%;">

                            </div>
                        </div>

                        <?php /* ///////////////////////////////////////////////////////////////////////// */ ?>
                        <?php if ($this->session->userdata('c_id') != 3) { ?>
                            Total Validados SIN: <?php echo $component->TOTAL_VALIDADO; ?> de <?php echo $component->COMPONENTE_PREGUNTAS; ?> Items.
                            <?php
                            $progress = round(($component->TOTAL_VALIDADO > 0) ? ($component->TOTAL_VALIDADO * 100) / $component->COMPONENTE_PREGUNTAS : 0);
                            ?>
                            <strong><?php echo $progress; ?>%</strong>
                            <br>
                            <div class="progress">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress; ?>%;">

                                </div>
                            </div> 

                            Total Validados SUF: <?php echo $component->TOTAL_VALIDADO2; ?> de <?php echo $component->COMPONENTE_PREGUNTAS; ?> Items.
                            <?php
                            $progress = round(($component->TOTAL_VALIDADO2 > 0) ? ($component->TOTAL_VALIDADO2 * 100) / $component->COMPONENTE_PREGUNTAS : 0);
                            ?>
                            <strong><?php echo $progress; ?>%</strong>
                            <br>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress; ?>%;">

                                </div>
                            </div>     

                            Total Seleccionados: <?php echo $component->TOTAL_SELECCIONADOS; ?> de <?php echo $component->COMPONENTE_PREGUNTAS; ?> Items.
                            <?php
                            $progress = round(($component->TOTAL_SELECCIONADOS > 0) ? ($component->TOTAL_SELECCIONADOS * 100) / $component->COMPONENTE_PREGUNTAS : 0);
                            ?>
                            <strong><?php echo $progress; ?>%</strong>
                            <br>
                            <div class="progress">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress; ?>%;">

                                </div>
                            </div>                         

                            <a href="<?php echo base_url("question/add/" . encrypt_id($this->session->userdata('USUARIO_ID')) . "/" . encrypt_id($component->COMPONENTE_ID)) ?>" class="alert-link" style="font-size: 11px !important;color:red">Construir Nuevo Item en <?php echo $component->COMPONENTE_SIGLA . ' - ' . $component->COMPONENTE_NOMBRE; ?></a>
                            <br>
                            <a href="<?php echo base_url("component/vb_constructor/" . $component->COMPONENTE_OKCONSTRUCTOR . '/' . encrypt_id($component->COMPONENTE_ID)); ?>">
                                <button style="margin-top: 8px !important;" type="button" class="btn btn-<?php echo ($component->COMPONENTE_OKCONSTRUCTOR == 0) ? 'primary' : 'danger' ?> btn-sm">
                                    <span class="glyphicon glyphicon-<?php echo ($component->COMPONENTE_OKCONSTRUCTOR == 0) ? 'ok' : 'remove' ?>"></span>
                                    <?php echo ($component->COMPONENTE_OKCONSTRUCTOR == 0) ? 'VoBo Componente Corregido al 100%' : 'Eliminar VoBo Componente Corregido al 100%' ?>
                                </button>  
                            </a>

                        <?php } else { ?>
                            <a href="<?php echo base_url("question/add/" . encrypt_id($this->session->userdata('USUARIO_ID')) . "/" . encrypt_id($component->COMPONENTE_ID)) ?>" class="alert-link" style="font-size: 11px !important;color:red">Construir Nuevo Item en <?php echo $component->COMPONENTE_SIGLA . ' - ' . $component->COMPONENTE_NOMBRE; ?></a>
                            <br>                        
                        <?php } ?>
                        <?php /* ///////////////////////////////////////////////////////////////////////// */ ?>
                    </div>        
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
} elseif ($this->session->userdata('ID_TIPO_USU') != 6) {
    if (count($components_array_2) > 0) {
        ?>
        <?php if ($this->session->userdata('c_id') != 3) { ?>
            <h2>Mis Componentes</h2>
            <div class="row">
                <?php
                foreach ($components_array_2 as $component) {
                    ?>
                    <div class="col-md-6">
                        <div class="alert alert-info" role="alert">

                            <strong style="font-size: 11px !important;"><?php echo $component->COMPONENTE_SIGLA . ' - ' . substr($component->COMPONENTE_NOMBRE, 0, 60) . '...'; ?></strong>
                            <br>
                            Progreso Actual: <?php echo $component->TOTAL; ?> de <?php echo $component->COMPONENTE_PREGUNTAS; ?> Items.
                            <?php
                            $progress = round(($component->TOTAL > 0) ? ($component->TOTAL * 100) / $component->COMPONENTE_PREGUNTAS : 0);
                            ?>
                            <strong><?php echo $progress; ?>%</strong>
                            <br>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress; ?>%;">

                                </div>
                            </div>



                            Total Validados SIN: <?php echo $component->TOTAL_VALIDADO; ?> de <?php echo $component->COMPONENTE_PREGUNTAS; ?> Items.
                            <?php
                            $progress = round(($component->TOTAL_VALIDADO > 0) ? ($component->TOTAL_VALIDADO * 100) / $component->COMPONENTE_PREGUNTAS : 0);
                            ?>
                            <strong><?php echo $progress; ?>%</strong>
                            <br>
                            <div class="progress">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress; ?>%;">

                                </div>
                            </div>

                            Con Visto Bueno SIN: <?php echo $component->VALIDA1; ?> de <?php echo $component->COMPONENTE_PREGUNTAS; ?> Items.
                            <?php
                            $progress = round(($component->VALIDA1 > 0) ? ($component->VALIDA1 * 100) / $component->COMPONENTE_PREGUNTAS : 0);
                            ?>
                            <strong><?php echo $progress; ?>%</strong>
                            <br>
                            <div class="progress">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress; ?>%;">

                                </div>
                            </div>                        

                            Total Validados SUF: <?php echo $component->TOTAL_VALIDADO2; ?> de <?php echo $component->COMPONENTE_PREGUNTAS; ?> Items.
                            <?php
                            $progress = round(($component->TOTAL_VALIDADO2 > 0) ? ($component->TOTAL_VALIDADO2 * 100) / $component->COMPONENTE_PREGUNTAS : 0);
                            ?>
                            <strong><?php echo $progress; ?>%</strong>
                            <br>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress; ?>%;">

                                </div>
                            </div>

                            Con Visto Bueno SUF: <?php echo $component->VALIDA2; ?> de <?php echo $component->COMPONENTE_PREGUNTAS; ?> Items.
                            <?php
                            $progress = round(($component->VALIDA2 > 0) ? ($component->VALIDA2 * 100) / $component->COMPONENTE_PREGUNTAS : 0);
                            ?>
                            <strong><?php echo $progress; ?>%</strong>
                            <br>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress; ?>%;">

                                </div>
                            </div>                         

                            Total Seleccionados: <?php echo $component->TOTAL_SELECCIONADOS; ?> de <?php echo $component->COMPONENTE_PREGUNTAS; ?> Items.
                            <?php
                            $progress = round(($component->TOTAL_SELECCIONADOS > 0) ? ($component->TOTAL_SELECCIONADOS * 100) / $component->COMPONENTE_PREGUNTAS : 0);
                            ?>
                            <strong><?php echo $progress; ?>%</strong>
                            <br>
                            <div class="progress">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress; ?>%;">

                                </div>
                            </div>                         

                            <a href="<?php echo base_url("validation/add/" . encrypt_id($this->session->userdata('USUARIO_ID')) . "/" . encrypt_id($component->COMPONENTE_ID)) ?>" class="alert-link" style="font-size: 11px !important;color:red">
                                Ver Listado
                            </a>

                            <br>
                            <div style="text-align: right">
                                <?php
                                if ($component->COMPONENTE_OKCONSTRUCTOR == 1) {
                                    ?>
                                    <span class="label label-success">
                                        Con VoBo del Constructor, 
                                        Fecha: <?php echo $component->COMPONENTE_OKCONSTRUCTOR_FECHA ?>, 
                                        <?php echo substr(get_nameuser_id($component->COMPONENTE_OKCONSTRUCTOR_ID), 0, 25) . '...'; ?>
                                    </span>
                                    <?php
                                } else {
                                    echo '<span class="label label-danger">Sin VoBo del Constructor</span> ';
                                }
                                ?>
                            </div>


                                <!--                        <a href="<?php echo base_url("component/vb_constructor/" . $component->COMPONENTE_OKCONSTRUCTOR . '/' . encrypt_id($component->COMPONENTE_ID)); ?>">
                                <button style="margin-top: 8px !important;" type="button" class="btn btn-<?php echo ($component->COMPONENTE_OKCONSTRUCTOR == 0) ? 'primary' : 'danger' ?> btn-sm">
                                <span class="glyphicon glyphicon-<?php echo ($component->COMPONENTE_OKCONSTRUCTOR == 0) ? 'ok' : 'remove' ?>"></span>
                            <?php echo ($component->COMPONENTE_OKCONSTRUCTOR == 0) ? 'VoBo Componente Corregido al 100%' : 'Eliminar VoBo Componente Corregido al 100%' ?>
                                </button>  
                                </a>                         -->

                        </div>        
                    </div>
                    <?php
                }
                ?>
            </div>
        <?php } ?>
        <?php
    }
}

//USUARIO DIAGRAMADOR


if ($this->session->userdata('ID_TIPO_USU') == 6) {

    if (count($components_array_3) > 0) {
        ?>
        <h2>Listado de Componentes</h2>
        <div class="row">
            <?php
            foreach ($components_array_3 as $component) {
                ?>
                <div class="col-md-6">
                    <div class="alert alert-info" role="alert">
                        <strong style="font-size: 11px !important;"><?php echo $component->COMPONENTE_SIGLA . ' - ' . substr($component->COMPONENTE_NOMBRE, 0, 60) . '...'; ?></strong>
                        <br>
                        Progreso Actual: <?php echo $component->TOTAL; ?> de <?php echo $component->COMPONENTE_PREGUNTAS; ?> Items.
                        <?php
                        $progress = round(($component->TOTAL > 0) ? ($component->TOTAL * 100) / $component->COMPONENTE_PREGUNTAS : 0);
                        ?>
                        <strong><?php echo $progress; ?>%</strong>
                        <br>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress; ?>%;">

                            </div>
                        </div>

                        <?php /* ///////////////////////////////////////////////////////////////////////// */ ?>
                        <?php if ($this->session->userdata('c_id') != 3) { ?>
                            Total Validados SIN: <?php echo $component->TOTAL_VALIDADO; ?> de <?php echo $component->COMPONENTE_PREGUNTAS; ?> Items.
                            <?php
                            $progress = round(($component->TOTAL_VALIDADO > 0) ? ($component->TOTAL_VALIDADO * 100) / $component->COMPONENTE_PREGUNTAS : 0);
                            ?>
                            <strong><?php echo $progress; ?>%</strong>
                            <br>
                            <div class="progress">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress; ?>%;">

                                </div>
                            </div>
                        <?PHP } ?>


                        Total Validados SUF: <?php echo $component->TOTAL_VALIDADO2; ?> de <?php echo $component->COMPONENTE_PREGUNTAS; ?> Items.
                        <?php
                        $progress = round(($component->TOTAL_VALIDADO2 > 0) ? ($component->TOTAL_VALIDADO2 * 100) / $component->COMPONENTE_PREGUNTAS : 0);
                        ?>
                        <strong><?php echo $progress; ?>%</strong>
                        <br>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress; ?>%;">

                            </div>
                        </div>

                        <?php /* ///////////////////////////////////////////////////////////////////////// */ ?>
                        <?php if ($this->session->userdata('c_id') != 3) { ?>
                            Total Seleccionados: <?php echo $component->TOTAL_SELECCIONADOS; ?> de <?php echo $component->COMPONENTE_PREGUNTAS; ?> Items.
                            <?php
                            $progress = round(($component->TOTAL_SELECCIONADOS > 0) ? ($component->TOTAL_SELECCIONADOS * 100) / $component->COMPONENTE_PREGUNTAS : 0);
                            ?>
                            <strong><?php echo $progress; ?>%</strong>
                            <br>
                            <div class="progress">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress; ?>%;">

                                </div>
                            </div>

                            Total Diagramados: <?php echo $component->PREGUNTA_DIAGRAMADA; ?> de <?php echo $component->COMPONENTE_PREGUNTAS; ?> Items.
                            <?php
                            $progress = round(($component->PREGUNTA_DIAGRAMADA > 0) ? ($component->PREGUNTA_DIAGRAMADA * 100) / $component->COMPONENTE_PREGUNTAS : 0);
                            ?>
                            <strong><?php echo $progress; ?>%</strong>
                            <br>
                            <div class="progress">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress; ?>%;">

                                </div>
                            </div>  
                        <?PHP } ?>

                        <a href="<?php echo base_url("selection/add/" . encrypt_id($this->session->userdata('USUARIO_ID')) . "/" . encrypt_id($component->COMPONENTE_ID)) ?>" class="alert-link" style="font-size: 11px !important;color:red">
                            Ver Listado
                        </a>
                    </div>        
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
}
?>