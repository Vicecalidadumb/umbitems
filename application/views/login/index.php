<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Pragma: no-cache");
        ?>        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="<?php echo base_url('images/favicon.png'); ?>">

        <title>Ingreso al Sistema</title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url('dist/css/bootstrap.css'); ?>" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="<?php echo base_url('dist/css/signin.css'); ?>" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            <?php echo form_open('login/verify', 'class="form-signin" role="form" autocomplete="off"'); ?>
            
<!--            <img src="<?php echo base_url('images/banner1.png'); ?>" style="width: 180px;">
            <img src="<?php echo base_url('images/marca-umb.png'); ?>" style="width: 280px;">-->
            <img src="<?php echo base_url('images/vice/'.$c_imagen1); ?>" style="width: 100%;">
            <h4><?php echo $c_nombre; ?></h4>
            <h2 class="form-signin-heading">Sistema de Administraci&oacute;n de &Iacute;tems</h2>
            
            <!--<h4>Sistema Integrado de Evaluación Institucional - UMB</h4>-->
            <h4 class="form-signin-heading">Ingreso al Sistema</h4>
            <?php echo form_input('username', '', 'class="form-control" placeholder="Usuario" required autofocus') ?>
            <?php echo form_password('password', '', 'class="form-control" placeholder="Contraseña" required') ?>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
            <?php echo form_close(); ?> 
            <?php if ($this->session->flashdata('message')) { ?>
                <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
                    <?php echo $this->session->flashdata('message'); ?>
                </div>
            <?php } ?>
        </div> <!-- /container -->
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <div id="footer">
            <div class="container">
                <p class="text-muted" style="text-align: center;">
                    Copyright © <?php echo date("Y"); ?> 
                    Universidad Manuela Beltr&aacute;n - Vicerrector&iacute;a de Calidad
                </p>
            </div>
        </div>
    </body>
</html>