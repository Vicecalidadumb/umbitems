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

<?php echo form_open('index.php/question/view', 'class="form-signin" role="form" method="POST"'); ?>

<?php
$users['ALL'] ='Todos';

?>

<div class="row">
    <div class="col-md-6">

        <div class="form-group">
            <label for="exampleInputEmail1">Usuario Constructor</label>
            <?php echo form_dropdown('USUARIO_ID', $users, '', 'class="form-control"'); ?>
        </div>

    </div>
</div>

<?php echo form_close(); ?>