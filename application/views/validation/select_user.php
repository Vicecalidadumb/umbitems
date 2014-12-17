<div class="jumbotron">
    <div style="text-align: center">
        <?php echo $this->session->userdata('HEADER_3'); ?>  
    </div>
    <h2>Validaci&oacute;n de &Iacute;tems</h2>
    <?php echo $this->session->userdata('HEADER_2'); ?>
</div>

<div class="alert alert-info">
    Por favor seleccionar un usuario para validar un item.
</div>        


<?php echo form_open('validation/select_user', 'class="form-signin" role="form" autocomplete="off" method="POST"'); ?>
<div class="form-group">
    <label for="exampleInputEmail1">Usuario Validador</label>
    <?php echo form_dropdown('USUARIO_ID', $users , '','class="form-control"'); ?>
</div>
<button type="submit" class="btn btn-primary">Seleccionar</button>
<?php echo form_close(); ?> 
<br><br><br><br>