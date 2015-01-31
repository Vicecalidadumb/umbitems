<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Agregar Usuario al Sistema</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open('index.php/user/insert', 'id="user_insert" class="form-signin" role="form" method="POST"'); ?>
                <?php echo form_hidden('url_adduser', $url_adduser); ?>
                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Nombres </label>
                            <?php echo form_input('USUARIO_NOMBRES', '', 'id="USUARIO_NOMBRES" placeholder="Nombres" class="form-control"') ?>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Tipo de Documento</label>
                            <?php echo form_dropdown('USUARIO_TIPODOCUMENTO', array("CC" => "CC"), '', 'class="form-control"'); ?>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Correo Electronico</label>
                            <?php echo form_input('USUARIO_CORREO', '', 'id="USUARIO_CORREO" placeholder="Correo" class="form-control"') ?>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Clave del Sistema</label>
                            <?php echo form_password('USUARIO_CLAVE', '', 'id="USUARIO_CLAVE" placeholder="Clave" class="form-control"') ?>
                        </div>         

                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Apellidos </label>
                            <?php echo form_input('USUARIO_APELLIDOS', '', 'id="USUARIO_APELLIDOS" placeholder="Apellidos" class="form-control"') ?>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Numero de Documento / Usuario del Sistema</label>
                            <?php echo form_input('USUARIO_NUMERODOCUMENTO', '', 'id="USUARIO_NUMERODOCUMENTO" placeholder="Numero de Documento / Usuario del Sistema" class="form-control"') ?>
                        </div>        

                        <div class="form-group">
                            <label for="exampleInputEmail1">Rol</label>
                            <?php
                            $roles = ($this->session->userdata('ID_TIPO_USU') == 5) ? array('2' => 'Constructor', '6' => 'Selector') : $roles;
                            ?>
                            <?php echo form_dropdown('ID_TIPO_USU', $roles, '', 'class="form-control"'); ?>
                        </div>        

                    </div>

                </div>

                <div class="row">
                    <button type="submit" class="btn btn-success">Guardar</button>

                </div>


                <?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
