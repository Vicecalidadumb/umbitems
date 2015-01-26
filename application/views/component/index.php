<?php
$array_color_1 = array('success', 'warning', 'danger');
$array_color_2 = array('#5cb85c', '#f0ad4e', '#d9534f');
?>

<?php if ($this->session->flashdata('message')) { ?>
    <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php } ?>

<div class="jumbotron">
    <div style="text-align: center">
        <?php echo $this->session->userdata('HEADER_3'); ?> 
    </div>
    <h2>Componentes</h2>
    <?php echo $this->session->userdata('HEADER_2'); ?>
</div>

<div class="page-header">
    <h1 style="color:#2aabd2">
        Listado de Componentes
        <a href="<?php echo base_url("index.php/component/add"); ?>">
            <button type="button" class="btn btn-primary btn-lg">Agregar Componente</button>
        </a>
<!--        <a href="<?php echo base_url("index.php/component/report2"); ?>" target="_blank">
            <button type="button" class="btn btn-success btn-lg">Descargar Reporte xls</button>
        </a>  
        <a href="<?php echo base_url("index.php/component/report3"); ?>" target="_blank">
            <button type="button" class="btn btn-warning btn-lg">Descargar Reporte Total de Items</button>
        </a>        -->
    </h1>
</div>

<?php
//echo '<pre>'.print_r($components,true).'</pre>';
?>
<table class="table table-striped">
    <tr>
        <td>
            <strong>Componente</strong>
        </td>
        <td>
            <strong>Sigla</strong>
        </td>
        <td>
            <strong>Constructor</strong>
        </td>       
        <td>
            <strong>Numero de Items</strong>
        </td>
        <td>
            <strong>Items Construidos</strong>
        </td>
        <td>
            <strong>Opciones</strong>
        </td>        
    </tr>
    <?php
    $count = 1;
    foreach ($components as $component) {
        ?>
        <tr>
            <td style="font-size: 11px !important;">
                </strong><?php echo $component->COMPONENTE_NOMBRE; ?>
            </td>	
            <td style="font-size: 11px !important;">
                <?php echo $component->COMPONENTE_SIGLA; ?>
            </td>
            <td style="font-size: 11px !important;">
                <?php echo str_replace(":", ":<br>", $component->ASIGNADOS); ?>
            </td>
            <td style="font-size: 11px !important;">
                <?php echo $component->COMPONENTE_PREGUNTAS; ?>
            </td>						
            <td style="font-size: 11px !important;">
                <?php
                if ($component->COMPONENTE_PREGUNTAS > 0) {
//                    $porcen = ($component->ITEMS * 100) / $component->COMPONENTE_PREGUNTAS;
//                    echo round($porcen) . '% |  ' . $component->ITEMS . ' de ' . $component->COMPONENTE_PREGUNTAS . ' Items';
                    echo $component->ITEMS;
                } else {
                    echo "Sin Items";
                }
                ?>
                <!--                <div class="progress progress-striped active">
                                    <div class="progress-bar"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round($porcen); ?>%">
                                        <span class="sr-only"></span>
                                    </div>
                                </div>-->
            </td>
            <td style="font-size: 11px !important;">
                <a href="<?php echo base_url("index.php/component/edit/" . encrypt_id($component->COMPONENTE_ID)); ?>">
                    <button type="button" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-edit"></span> Editar
                    </button>
                </a>  
            </td>             
        </tr>
        <?php
        $count++;
    }
    ?>
</table>

