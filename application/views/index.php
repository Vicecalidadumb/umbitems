
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

