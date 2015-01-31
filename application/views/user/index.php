<?php //echo '<pre>'.print_r($users,true).'<pre>';                    ?>

<?php if ($this->session->flashdata('message')) { ?>
    <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php } ?>

<div class="jumbotron">
    <div style="text-align: center">
        <?php echo $this->session->userdata('HEADER_3'); ?> 
    </div>
    <h2>Usuarios del Sistema</h2>
    <?php echo $this->session->userdata('HEADER_2'); ?>
</div>

<div class="page-header">
    <h1 style="color:#2aabd2">
        Listado de Usuarios del Sistema
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
            Agregar Registro
        </button>
    </h1>
</div>

<!-- Button trigger modal -->
<?php
echo $dom_modal;
?>




<ul id="myTab" class="nav nav-tabs">
    <li class="active">
        <a href="#Constructores" data-toggle="tab">
            Constructores
        </a>
    </li>
    <li>
        <a href="#Validadores" data-toggle="tab">
            Validadores y Administrativos
        </a>
    </li>
</ul>

<div id="myTabContent" class="tab-content">
    <table class="table table-striped tab-pane fade in active" id="Constructores">
        <tr><th>Rol</th><th>Nombres</th><th>Apellidos</th><th>Tipo de Documento</th><th>Num. Documento / Usuario</th><th>Correo</th><th>Opciones</th></tr>
        <?php foreach ($users as $user) { ?>
            <?php
            if ($user->ID_TIPO_USU == 2) {
                ?>
                <tr>
                    <td>
                        <?php echo $user->NOM_TIPO_USU ?>
                    </td>
                    <td>
                        <?php echo $user->USUARIO_NOMBRES ?>
                    </td>
                    <td>
                        <?php echo $user->USUARIO_APELLIDOS ?>
                    </td>
                    <td>
                        <?php echo $user->USUARIO_TIPODOCUMENTO ?>
                    </td>
                    <td>
                        <?php echo $user->USUARIO_NUMERODOCUMENTO ?>
                    </td>
                    <td>
                        <?php echo $user->USUARIO_CORREO ?>
                    </td>
                    <td>
                        <a href="<?php echo base_url("index.php/user/edit/" . encrypt_id($user->USUARIO_ID)); ?>">
                            <button type="button" class="btn btn-info btn-sm">
                                <span class="glyphicon glyphicon-edit"></span> Editar
                            </button>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        <?php } ?>
    </table>
    <table class="table table-striped tab-pane fade in" id="Validadores">
        <tr><th>Rol</th><th>Nombres</th><th>Apellidos</th><th>Tipo de Documento</th><th>Num. Documento / Usuario</th><th>Correo</th><th>Opciones</th></tr>
        <?php foreach ($users as $user) { ?>
            <?php
            if ($user->ID_TIPO_USU != 2) {
                ?>
                <tr>
                    <td>
                        <?php echo $user->NOM_TIPO_USU ?>
                    </td>            
                    <td>
                        <?php echo $user->USUARIO_NOMBRES ?>
                    </td>
                    <td>
                        <?php echo $user->USUARIO_APELLIDOS ?>
                    </td>
                    <td>
                        <?php echo $user->USUARIO_TIPODOCUMENTO ?>
                    </td>
                    <td>
                        <?php echo $user->USUARIO_NUMERODOCUMENTO ?>
                    </td>  
                    <td>
                        <?php echo $user->USUARIO_CORREO ?>
                    </td>
                    <td>
                        <a href="<?php echo base_url("index.php/user/edit/" . encrypt_id($user->USUARIO_ID)); ?>">
                            <button type="button" class="btn btn-info btn-sm">
                                <span class="glyphicon glyphicon-edit"></span> Editar
                            </button>
                        </a>    
                    </td>            
                </tr>
            <?php } ?>
        <?php } ?>
    </table>
</div>        