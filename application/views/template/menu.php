<style>
    /*ESTILO DINAMICO PARA TIPOS DE USUARIOS*/
    <?php
    switch ($this->session->userdata('ID_TIPO_USU')) {
        case 2:$color = '#fff600';
            break;
        case 3:$color = '#f000ff';
            break;
        case 4:$color = '#ff0000';
            break;
        case 5:$color = '#000000';
            break;
        case 6:$color = '#ff9c00';
            break;
        case 7:$color = '#18ff00';
            break;
        default:$color = '#ccc';
            break;
    }
    ?>
    .navbar{
        border-bottom: 2px solid <?php echo $color; ?> !important;
    }
</style>
<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Menu</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url("index.php//") ?>">Administraci&oacute;n de &Iacute;tems</a>
        </div>
        <div class="navbar-collapse collapse">

            <?php
            if ($this->session->userdata('ID_TIPO_USU') == 1 OR
                    $this->session->userdata('ID_TIPO_USU') == 2):
                ?>
                <!--MENU CONSTRUCTOR DE ITEMS-->
                <ul class="nav navbar-nav">
                    <li class="" class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Construcci&oacute;n de Items<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <?php if ($this->session->userdata('ID_TIPO_USU') == 1 OR $this->session->userdata('ID_TIPO_USU') == 2): ?>
                                <li><a href="<?php echo base_url("index.php/question/add") ?>">Agregar Item</a></li>
                            <?php endif; ?>
                            <li><a href="<?php echo base_url("index.php/question/view") ?>">Buscar Items</a></li>
                        </ul>
                    </li>
                </ul>
            <?php endif; ?>


            <?php
            if ($this->session->userdata('ID_TIPO_USU') == 1 OR
                    $this->session->userdata('ID_TIPO_USU') == 3 OR
                    $this->session->userdata('ID_TIPO_USU') == 4 OR
                    $this->session->userdata('ID_TIPO_USU') == 6 OR
                    $this->session->userdata('ID_TIPO_USU') == 7
            ):
                ?>
                <!--MENU CONSTRUCTOR DE ITEMS-->
                <ul class="nav navbar-nav">
                    <li class="" class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php echo $this->session->userdata('NOM_TIPO_USU') ?>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url("index.php/question/view") ?>">Buscar &Iacute;tems</a></li>
                        </ul>
                    </li>
                </ul>
            <?php endif; ?>

            <?php if ($this->session->userdata('ID_TIPO_USU') == 1 OR $this->session->userdata('ID_TIPO_USU') == 5): ?>
                <!--MENU CONSTRUCTOR DE ITEMS-->
                <ul class="nav navbar-nav">
                    <li class="" class="dropdown">
                        <a href="<?php echo base_url("index.php/component") ?>">Componentes</a>
<!--                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url("index.php/component") ?>">Ver Listado de Componentes</a></li>
                            <li><a href="<?php echo base_url("index.php/component/add") ?>">Agregar Componente</a></li>
                        </ul>-->
                    </li>
                </ul>
            <?php endif; ?>


            <?php if ($this->session->userdata('ID_TIPO_USU') == 1 OR $this->session->userdata('ID_TIPO_USU') == 5): ?>
                <!--MENU CONSTRUCTOR DE ITEMS-->
                <ul class="nav navbar-nav">
                    <li class="" class="dropdown">
                        
                        <a href="<?php echo base_url("index.php/user") ?>">Usuarios</a>
<!--                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url("index.php/user") ?>">Ver Listado de Usuarios</a></li>
                            <li><a href="<?php echo base_url("index.php/user/add") ?>">Agregar Usuario</a></li>
                        </ul>-->
                    </li>
                </ul>
            <?php endif; ?>

            <?php if ($this->session->userdata('ID_TIPO_USU') == 1): ?>
                <!--MENU CONSTRUCTOR DE ITEMS-->
                <ul class="nav navbar-nav">
                    <li class="" class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sistema<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url("index.php/config/roles") ?>">Administrar Roles</a></li>
                        </ul>
                    </li>
                </ul>
            <?php endif; ?>                





            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuario: <strong><?php echo $this->session->userdata('USUARIO_NOMBRES') . ' ' . $this->session->userdata('USUARIO_APELLIDOS'); ?></strong><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('index.php/login/logout'); ?>">Cerrar Sesion</a></li>
                    </ul>
                </li>
            </ul>            
        </div><!--/.nav-collapse -->
    </div>
</div>

<div class="container theme-showcase">