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
        Agregar Componente
    </h1>
</div>


<?php echo form_open('index.php/component/insert', 'id="component_insert" class="form-signin" role="form" method="POST"'); ?>

<div class="row">
    <div class="col-md-6">

        <div class="form-group">
            <label for="exampleInputEmail1">Componente </label>
            <?php echo form_input('COMPONENTE_NOMBRE', '', 'id="COMPONENTE_NOMBRE" placeholder="Nombre del Componente" class="form-control"') ?>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Numero de Items a Construir</label>
            <?php echo form_input('COMPONENTE_PREGUNTAS', '', 'id="COMPONENTE_PREGUNTAS" placeholder="Numero de Preguntas" class="form-control"') ?>
        </div>


    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1">Sigla </label>
            <?php echo form_input('COMPONENTE_SIGLA', '', 'id="COMPONENTE_SIGLA" placeholder="Sigla del Componente" class="form-control"') ?>
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
        foreach ($users_c as $user_c) {
            ?>
            <div class="checkbox">
                <label>
                    <?php echo form_checkbox('USUARIO_IDs[]', $user_c->USUARIO_ID, false, ''); ?>
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
                    <?php echo form_checkbox('USUARIO_IDs[]', $user_c->USUARIO_ID, false, ''); ?>
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
    <button type="submit" class="btn btn-success">Guardar</button>

</div>


<?php echo form_close(); ?>

<br><br><br><br>


<script>
    $(document).ready(function() {
    $('#component_insert').validate(
    {
    rules: {
    COMPONENTE_NOMBRE: {
    minlength: 2,
            required: true
    },
            COMPONENTE_PREGUNTAS: {
            required: true
            }
    USUARIO_IDs: {
    required: true
    }
    },
            highlight: function(element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
            }
    });
    });
</script>