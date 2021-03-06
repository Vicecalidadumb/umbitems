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
        Editar Componente
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
            Agregar Usuario
        </button>
    </h1>
</div>

<?php
echo $dom_modal;
?>


<?php echo form_open('index.php/component/update', 'id="component_update" class="form-signin" role="form" method="POST"'); ?>

<?php echo form_hidden('COMPONENTE_ID', $component[0]->COMPONENTE_ID); ?>

<div class="row">
    <div class="col-md-6">

        <div class="form-group">
            <label for="exampleInputEmail1">Componente </label>
            <?php echo form_input('COMPONENTE_NOMBRE', $component[0]->COMPONENTE_NOMBRE, 'id="COMPONENTE_NOMBRE" placeholder="Nombre del Componente" class="form-control"') ?>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1">Sigla </label>
            <?php echo form_input('COMPONENTE_SIGLA', $component[0]->COMPONENTE_SIGLA, 'id="COMPONENTE_SIGLA" placeholder="Sigla del Componente" class="form-control"') ?>
        </div>      
    </div>    

    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1">No. de Items Asistencial</label>
            <?php echo form_input('COMPONENTE_PREGUNTAS_ASIS', $component[0]->COMPONENTE_PREGUNTAS_ASIS, 'id="COMPONENTE_PREGUNTAS_ASIS" placeholder="" class="form-control"') ?>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1">No. de Items T&eacute;cnico</label>
            <?php echo form_input('COMPONENTE_PREGUNTAS_TECN', $component[0]->COMPONENTE_PREGUNTAS_TECN, 'id="COMPONENTE_PREGUNTAS_TECN" placeholder="" class="form-control"') ?>
        </div>
    </div>  

    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1">No. de Items Universitario</label>
            <?php echo form_input('COMPONENTE_PREGUNTAS_UNIV', $component[0]->COMPONENTE_PREGUNTAS_UNIV, 'id="COMPONENTE_PREGUNTAS_UNIV" placeholder="" class="form-control"') ?>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1">No. de Items Prof Esp.</label>
            <?php echo form_input('COMPONENTE_PREGUNTAS_ESPE', $component[0]->COMPONENTE_PREGUNTAS_ESPE, 'id="COMPONENTE_PREGUNTAS_ESPE" placeholder="" class="form-control"') ?>
        </div>
    </div>    
</div>

<div class="row">
    <div class="col-md-12">
        <h3 style="color:#2aabd2">
            Usuarios Asignados
        </h3>
    </div>
    <div class="col-md-6 bs-example">
        <div class="form-group">
            <label for="exampleInputEmail1">Seleccione los Constructores</label>
        </div>  
        <?php
        $array_users = explode(',', $component[0]->ASIGNADOS);
        foreach ($users_c as $user_c) {
            ?>
            <div class="checkbox">
                <label>
                    <?php echo form_checkbox('USUARIO_IDs[]', $user_c->USUARIO_ID, (in_array($user_c->USUARIO_ID, $array_users)) ? true : false, 'id="' . $user_c->USUARIO_ID . '"'); ?>
                    <?php echo $user_c->USUARIO_NOMBRES . ' ' . $user_c->USUARIO_APELLIDOS; ?>
                    <?php echo ' - ROL:' . $user_c->NOM_TIPO_USU; ?>
                </label>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="col-md-6 bs-example">
        <div class="form-group">
            <label for="exampleInputEmail1">Seleccion del grupo de validacion</label>
        </div>  
        <?php
        foreach ($users_ad as $user_c) {
            ?>
            <div class="checkbox">
                <label>
                    <?php echo form_checkbox('USUARIO_IDs[]', $user_c->USUARIO_ID, (in_array($user_c->USUARIO_ID, $array_users)) ? true : false, ''); ?>
                    <?php echo $user_c->USUARIO_NOMBRES . ' ' . $user_c->USUARIO_APELLIDOS; ?>
                    <?php echo ' - ROL:' . $user_c->NOM_TIPO_USU; ?>
                </label>
            </div>
            <?php
        }
        ?>
    </div>    
</div>

<div class="row">
    <button type="submit" class="btn btn-success">Actualizar</button>

</div>

<?php echo form_close(); ?>

<br><br><br><br>


<script>
    $(document).ready(function() {
        $('#component_update').validate(
                {
                    rules: {
                        COMPONENTE_NOMBRE: {
                            minlength: 2,
                            required: true
                        },
                        COMPONENTE_PREGUNTAS: {
                            required: true
                        },
                        COMPONENTE_SIGLA: {
                            minlength: 2,
                            required: true
                        },
                        USUARIO_IDs: {
                            required: true
                        }
                    },
                    highlight: function(element) {
                        $(element).closest('.control-group').removeClass('success').addClass('error');
                    }/*,
                     success: function(element) {
                     element
                     .text('OK!').addClass('valid')
                     .closest('.control-group').removeClass('error').addClass('success');
                     }*/
                });
    });
</script>