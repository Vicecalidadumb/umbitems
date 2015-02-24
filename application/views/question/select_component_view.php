<div class="jumbotron">
    <div style="text-align: center">
        <?php echo $this->session->userdata('HEADER_3'); ?> 
    </div>
    <h2>Construcci&oacute;n de &Iacute;tems</h2>
    <?php echo $this->session->userdata('HEADER_2'); ?>
</div>

<div class="page-header">
    <h1 style="color:#2aabd2">Buscar Items</h1>
</div>

<?php if ($this->session->flashdata('message')) { ?>
    <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php } ?>

<?php echo form_open('index.php/question/select_component_view/', 'class="form-signin" role="form" autocomplete="off" method="POST"'); ?>
<?php
//$components[''] = "---SELECCIONE UN COMPONENTE---";
?>
<div class="form-group">
    <label for="exampleInputEmail1">Selecci&oacute;n del Componente:</label>

    <select name="COMPONENTE_ID" class="form-control" onchange="get_level(this.value)" >
        <option value="">SELECCIONE UN COMPONENTE</option>
        <?php
        foreach ($components as $value) {
            if(($value->CANTIDAD)==($value->NUMERO_PREGUNTAS)){
                $pintar="style='background:#47a447;color:#fff'";
            }else{
                $pintar="";
            }
            ?>
        <option <?php echo $pintar; ?> value="<?php echo $value->COMPONENTE_ID; ?>"><?php echo $value->COMPONENTE_NOMBRE; ?></option>
            <?php
        }
        ?>
    </select>




</div>

<div class="form-group">
    <label for="exampleInputEmail1">Nivel de Cargo:</label>
    <span id="level">
<?php echo form_dropdown('PREGUNTA_NIVELPREGUNTA', array('' => '---SELECCIONE UN COMPONENTE---'), '', 'class="form-control"'); ?>
    </span>
</div>

<button type="submit" class="btn btn-success">
    <span class="glyphicon glyphicon-ok"></span>
    Seleccionar
</button>

<?php echo form_close(); ?> 
<br><br><br><br>

<script>
    function get_level(select) {
        var url = base_url_js + "question/get_levelsquestions";
        $.post(url, {select: select})
        .done(function(msg) {
            $("#level").html(msg)
        }).fail(function(msg) {
            alert("Error al Cargar, por favor seleccione nuevamente.")
        });
        //        $.ajax({
        //            data: "select=" + select,
        //            type: "POST",
        //            dataType: "html",
        //            url: base_url_js + "question/get_levelsquestions",
        //            success: function(data) {
        //                $("#level").html(data)
        //            },
        //            error: function(xhr, ajaxOptions, thrownError) {
        //                alert("Error al Cargar, por favor seleccione nuevamente.")
        //            },
        //            async: true
        //        });
    }

</script>