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
    <h1 style="color:#2aabd2">Agregar Item</h1>
</div>

<div class="alert alert-success">
    Por favor seleccionar un componente para agregar un item.
</div> 


<?php echo form_open('question/select_component/' . $id_user, 'class="form-signin" role="form" autocomplete="off" method="POST"'); ?>
<div class="form-group">
    <label for="exampleInputEmail1">Componentes Asociados al usuario <?php echo $user[0]->USUARIO_NOMBRES . ' ' . $user[0]->USUARIO_APELLIDOS; ?>:</label>
    <?php echo form_dropdown('COMPONENTE_ID', $components, '', 'class="form-control"'); ?>
</div>
<button type="submit" class="btn btn-primary">Seleccionar</button>
<?php echo form_close(); ?> 
<br><br><br><br>