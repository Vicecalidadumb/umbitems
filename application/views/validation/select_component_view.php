<div class="jumbotron">
    <div style="text-align: center">
        <?php echo $this->session->userdata('HEADER_3'); ?>  
    </div>
    <h2>Construcci&oacute;n de &Iacute;tems</h2>
    <?php echo $this->session->userdata('HEADER_2'); ?>
</div>

<div class="alert alert-success">
    Por favor seleccionar un componente para buscar los items.
</div>        

<?php
//AGREGAR OPCION DE BUSQUEDA "TODOS"
$components['ALL'] = "TODOS";
?>

<?php echo form_open('index.php/question/select_component_view/' . $id_user, 'class="form-signin" role="form" autocomplete="off" method="POST"'); ?>
<div class="form-group">
    <label for="exampleInputEmail1">Componentes del usuario <?php echo $user[0]->USUARIO_NOMBRES . ' ' . $user[0]->USUARIO_APELLIDOS; ?>:</label>
    <?php echo form_dropdown('COMPONENTE_ID', $components, '', 'class="form-control"'); ?>
</div>
<button type="submit" class="btn btn-success">Seleccionar</button>
<?php echo form_close(); ?> 
<br><br><br><br>