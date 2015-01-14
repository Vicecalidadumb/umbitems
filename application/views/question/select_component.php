<div class="jumbotron" style="border: 1px solid yellow !important;">
    <div style="text-align: center">
        <?php echo $this->session->userdata('HEADER_3'); ?>
    </div>
    <h2>Construcci&oacute;n de &Iacute;tems</h2>
    <?php echo $this->session->userdata('HEADER_2'); ?>
</div> 

<div class="page-header">
    <h1 style="color:#2aabd2">Agregar Item</h1>
</div>

<?php echo form_open('index.php/question/select_component/' . $id_user, 'class="form-signin" role="form" autocomplete="off" method="POST"'); ?>
<div class="form-group">
    <label for="exampleInputEmail1">Selecci&oacute;n del Componente:</label>
    <?php echo form_dropdown('COMPONENTE_ID', $components, '', 'class="form-control"'); ?>
</div>
<button type="submit" class="btn btn-primary">
    <span class="glyphicon glyphicon-plus"></span> 
    Seleccionar
</button>
<?php echo form_close(); ?> 
<br><br><br><br>