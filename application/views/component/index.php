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

        <td class="text-primary" style="background-color: #DDDBDB;"><strong>A</strong></td>
        <td class="text-primary" style="background-color: #DDDBDB;"><strong>CA</strong></td>

        <td class="text-success"><strong>T</strong></td>
        <td class="text-success"><strong>CT</strong></td>

        <td class="text-warning" style="background-color: #DDDBDB;"><strong>U</strong></td>
        <td class="text-warning" style="background-color: #DDDBDB;"><strong>CU</strong></td>

        <td class="text-danger"><strong>E</strong></td>
        <td class="text-danger"><strong>CE</strong></td>


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


            <td style="font-size: 11px !important;background-color: #DDDBDB;" class="text-primary">
                <?php echo $component->COMPONENTE_PREGUNTAS_ASIS; ?>
            </td>
            <td style="font-size: 11px !important;background-color: #DDDBDB;" class="text-primary">
                <?php
                echo ($component->ITEMS_ASIS > 0) ? $component->ITEMS_ASIS : "N/O";
                ?>
            </td>

            <td style="font-size: 11px !important;" class="text-success">
                <?php echo $component->COMPONENTE_PREGUNTAS_TECN; ?>
            </td>
            <td style="font-size: 11px !important;" class="text-success">
                <?php
                echo ($component->ITEMS_TECN > 0) ? $component->ITEMS_TECN : "N/O";
                ?>
            </td>

            <td style="font-size: 11px !important;background-color: #DDDBDB;" class="text-warning">
                <?php echo $component->COMPONENTE_PREGUNTAS_UNIV; ?>
            </td>
            <td style="font-size: 11px !important;background-color: #DDDBDB;" class="text-warning">
                <?php
                echo ($component->ITEMS_UNIV > 0) ? $component->ITEMS_UNIV : "N/O";
                ?>
            </td>

            <td style="font-size: 11px !important;" class="text-danger">
                <?php echo $component->COMPONENTE_PREGUNTAS_ESPE; ?>
            </td>
            <td style="font-size: 11px !important;" class="text-danger">
                <?php
                echo ($component->ITEMS_ESPE > 0) ? $component->ITEMS_ESPE : "N/O";
                ?>
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

