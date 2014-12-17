<div class="jumbotron">
    <div style="text-align: center">
        <img src="<?php echo base_url('../images/banner1.png'); ?>" style="width: 180px;">
        <img src="<?php echo base_url('../images/marca-umb.png'); ?>" style="width: 280px;">  
    </div>
    <h2>Construcci&oacute;n de &Iacute;tems</h2>
    <?php echo $this->session->userdata('HEADER_2'); ?>
</div>

<div class="alert alert-success">
    Por favor seleccionar un usuario para buscar sus items.
</div>        


<?php echo form_open('question/select_user_view', 'class="form-signin" role="form" autocomplete="off" method="POST"'); ?>
<div class="form-group">
    <label for="exampleInputEmail1">Usuario Constructor</label>
    <?php echo form_dropdown('USUARIO_ID', $users , '','class="form-control"'); ?>
</div>
<button type="submit" class="btn btn-success">Seleccionar</button>
<?php echo form_close(); ?> 
<br><br><br><br>