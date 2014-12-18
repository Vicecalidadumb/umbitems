<?php //echo '<pre>'.print_r($users,true).'<pre>'; ?>

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
        <a href="<?php echo base_url("user/add"); ?>">
            <button type="button" class="btn btn-primary btn-lg">Agregar Registro</button>
        </a>
    </h1>
</div>


<table class="table table-striped">
    <tr>
        <th>
            Rol
        </th>        
        <th>
            Nombres
        </th>
        <th>
            Apellidos
        </th>
        <th>
            Tipo de Documento
        </th>
        <th>
            Num. Documento / Usuario
        </th>  
        <th>
            Correo
        </th>            
        <th>
            Opciones
        </th>          
    </tr>

    <?php foreach ($users as $user) { ?>
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
                <a href="<?php echo base_url("user/edit/" . encrypt_id($user->USUARIO_ID)); ?>">
                    <button type="button" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-edit"></span> Editar
                    </button>
                </a>    
            </td>            
        </tr>  
    <?php } ?>

</table>