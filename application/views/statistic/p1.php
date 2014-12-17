<?php if ($this->session->flashdata('message')) { ?>
    <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php } ?>

<script src="<?php echo base_url("js/Highcharts-3.0.10/js/highcharts.js") ?>"></script>
<script src="<?php echo base_url("js/Highcharts-3.0.10/js/modules/data.js") ?>"></script>
<script src="<?php echo base_url("js/Highcharts-3.0.10/js/modules/exporting.js") ?>"></script>


<div class="page-header">
    <h2 style="color:#2aabd2">
        Estadisticas <?php echo $prueba[0]->EVALUACION_NOMBRE; ?>
    </h2>
</div>



<?php ////////////////////////INICIO GRAFICA 01 ?>
<script type="text/javascript">
    function graficar_v1(id_container, id_fuente, titulo, texto_vertical, tipo_grafica) {
        $('#' + id_container).highcharts({
            data: {
                table: document.getElementById(id_fuente)
            },
            chart: {
                type: tipo_grafica
            },
            title: {
                text: titulo
            },
            yAxis: {
                allowDecimals: false,
                title: {
                    text: texto_vertical
                }
            },
            tooltip: {
                formatter: function() {
                    return '<b>' + this.series.name + '</b><br/>' +
                            this.point.y + ' ' + this.point.name.toLowerCase();
                }
            },
            plotOptions: {
                series: {
                    borderWidth: 1,
                    dataLabels: {
                        enabled: true,
                        //format: '{point.y:.1f}'
                    }
                }
            },
        });
    }
</script>


<script type="text/javascript">
    $(document).ready(function() {
        graficar_v1('container', 'datatable', 'Usuarios Presentados', 'Usuarios', 'column');
    })
</script>


<h4 style="color:#2aabd2">
    Presentados por Ciudad
</h4>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<table id="datatable" class="table table-striped" style="display:none">
    <thead>
        <tr>
            <th>Ciudad</th>
            <th>Inscritos</th>
            <th>Presentados</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($ciudades as $ciudad) {
            ?>
            <tr>
                <td><?php echo $ciudad->USUARIO_CIUDAD; ?></td>
                <td><?php echo $ciudad->TOTAL; ?></td>
                <td>
                    <?php
                    foreach ($ciudades_prueba as $ciudad_prueba) {
                        if ($ciudad_prueba->USUARIO_CIUDAD == $ciudad->USUARIO_CIUDAD) {
                            echo $ciudad_prueba->TOTAL;
                        }
                    }
                    ?>						
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
<?php ////////////////////////FIN GRAFICA 01 ?>










<?php
$count = 1;
foreach ($ciudades as $ciudad) {

    $programas = $this->statistic_model->get_all_programas($prueba[0]->EVALUACION_ID, $ciudad->USUARIO_CIUDAD);
    $programas_presentaron = $this->statistic_model->get_all_programas_porprueba($prueba[0]->EVALUACION_ID, $ciudad->USUARIO_CIUDAD);
    $data_prueba_ciudad = $this->statistic_model->get_all_dataprueba($prueba[0]->EVALUACION_ID, $ciudad->USUARIO_CIUDAD);
    ?>

    <?php ////////////////////////INICIO GRAFICAS 02  ?>
    <script type="text/javascript">
        $(document).ready(function() {
            graficar_v1('container_<?php echo $count; ?>', 'datatable_<?php echo $count; ?>', 'Usuarios Presentados por Programa en <?php echo $ciudad->USUARIO_CIUDAD ?>', 'Usuarios', 'column');
        })
    </script>
    <h4 style="color:#2aabd2">
        Presentados por Programa en <?php echo $ciudad->USUARIO_CIUDAD ?>
    </h4>
    <div id="container_<?php echo $count; ?>" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    <table id="datatable_<?php echo $count; ?>" class="table table-striped" style="display:none">
        <thead>
            <tr>
                <th>Programa</th>
                <th>Inscritos</th>
                <th>Presentados</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $Total_inscritos = 0;
            $Total_presentaron = 0;
            foreach ($programas as $programa) {
                ?>
                <tr>
                    <td><?php echo $programa->USUARIO_PROGRAMA; ?></td>
                    <td><?php echo $programa->TOTAL;
        $Total_inscritos+=$programa->TOTAL; ?></td>
                    <td>
                        <?php
                        foreach ($programas_presentaron as $programa_presentaron) {
                            if ($programa_presentaron->USUARIO_PROGRAMA == $programa->USUARIO_PROGRAMA) {
                                echo $programa_presentaron->TOTAL;
                                $Total_presentaron+=$programa_presentaron->TOTAL;
                            }
                        }
                        ?>						
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php ////////////////////////FIN GRAFICAS 02 ?>

    <?php ////////////////////////INICIO GRAFICAS 03 ?>
    <h4 style="color:#2aabd2">
        Puntajes en <?php echo $ciudad->USUARIO_CIUDAD ?>
    </h4>
    <?php
    $array_data = array();
    $array_data_standart = array();
    $media = 0;
    $moda_key = 0;
    $moda = 0;
    $minimo = 10;
    $maximo = 0;
    foreach ($data_prueba_ciudad as $dato) {
        @$array_data[$dato->TOTAL] ++;
        $media+=$dato->TOTAL;
        $array_data_standart[] = $dato->TOTAL;
        if ($dato->TOTAL < $minimo) {
            $minimo = $dato->TOTAL;
        }
        if ($dato->TOTAL > $maximo) {
            $maximo = $dato->TOTAL;
        }
    }
    $categories = '';
    $data_gr = '';
    foreach ($array_data as $key => $data) {
        $categories.="'$key',";
        $data_gr.="$data,";
        if ($data > $moda) {
            $moda_key = $key;
            $moda = $data;
        }
    }
    $categories = trim($categories, ',');
    $data_gr = trim($data_gr, ',');
    ?>
    <script type="text/javascript">
        $(function() {
            $('#container_p_<?php echo $count; ?>').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Puntajes en <?php echo $ciudad->USUARIO_CIUDAD ?>'
                },
                xAxis: {
                    categories: [
    <?php echo $categories; ?>
                    ]
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Usuarios'
                    }
                },
                tooltip: {
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                        name: 'Puntaje',
                        data: [<?php echo $data_gr; ?>]

                    }]
            });
        });
    </script>
    <div id="container_p_<?php echo $count; ?>" style="min-width: 500px; height: 400px; margin: 0 auto"></div>
    <table class="table table-striped" style="display:none">
        <thead>
            <tr>
                <th></th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Resutados Validos</td>
                <td><?php echo $Total_presentaron; ?></td>
            </tr>
            <tr>
                <td>Media</td>
                <td><?php echo round($media / $Total_presentaron, 4); ?></td>
            </tr>
            <tr>
                <td>Mediana</td>
                <td><?php echo round($media / $Total_presentaron, 1) . '000'; ?></td>
            </tr>
            <tr>
                <td>Moda</td>
                <td><?php echo $moda_key; ?></td>
            </tr>
            <tr>
                <td>Desviacion Tipica</td>
                <td><?php echo round(standard_deviation($array_data_standart), 4); ?></td>
            </tr>
            <tr>
                <td>Varianza</td>
                <td><?php echo round(variance($array_data_standart), 4); ?></td>
            </tr>
            <tr>
                <td>Rango</td>
                <td><?php echo round($maximo - $minimo, 4); ?></td>
            </tr>
            <tr>
                <td>Minimo</td>
                <td><?php echo $minimo; ?></td>
            </tr>
            <tr>
                <td>Maximo</td>
                <td><?php echo $maximo; ?></td>
            </tr>												
        </tbody>
    </table>
    <?php ////////////////////////FIN GRAFICAS 03 ?>

    <?php ////////////////////////INICIO GRAFICAS 04 ?>

    <?php
    $array_niveles = array();
    foreach ($programas as $programa) {
        $array_niveles[$programa->USUARIO_PROGRAMA]['Critico'] = 0;
        $array_niveles[$programa->USUARIO_PROGRAMA]['Bajo'] = 0;
        $array_niveles[$programa->USUARIO_PROGRAMA]['Medio'] = 0;
        $array_niveles[$programa->USUARIO_PROGRAMA]['Alto'] = 0;
        $array_niveles[$programa->USUARIO_PROGRAMA]['Superior'] = 0;
    }
    foreach ($data_prueba_ciudad as $data) {
        switch ($data->TOTAL) {
            case ($data->TOTAL < 4):
                $array_niveles[$data->USUARIO_PROGRAMA]['Critico'] ++;
                break;
            case ($data->TOTAL >= 4 && $data->TOTAL < 5):
                $array_niveles[$data->USUARIO_PROGRAMA]['Bajo'] ++;
                break;
            case ($data->TOTAL >= 5 && $data->TOTAL < 7):
                $array_niveles[$data->USUARIO_PROGRAMA]['Medio'] ++;
                break;
            case ($data->TOTAL >= 7 && $data->TOTAL < 8):
                $array_niveles[$data->USUARIO_PROGRAMA]['Alto'] ++;
                break;
            case ($data->TOTAL >= 8):
                $array_niveles[$data->USUARIO_PROGRAMA]['Superior'] ++;
                break;
        }
    }
    $count++;
    ?>
    <script type="text/javascript">
        $(document).ready(function() {
            graficar_v1('container_n_<?php echo $count; ?>', 'datatable_n_<?php echo $count; ?>', 'Estadistica por Niveles en <?php echo $ciudad->USUARIO_CIUDAD ?>', 'Total por Nivel', 'column');
        })
    </script>		

    <h4 style="color:#2aabd2">
        Estadistica por Niveles en <?php echo $ciudad->USUARIO_CIUDAD ?>
    </h4>
    <div id="container_n_<?php echo $count; ?>" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    <table id="datatable_n_<?php echo $count; ?>" class="table table-striped" style="display:none">
        <thead>
            <tr>
                <th>Programa</th>
                <th>Total Nivel Critico</th>
                <th>Total Nivel Bajo</th>
                <th>Total Nivel Medio</th>
                <th>Total Nivel Alto</th>
                <th>Total Nivel Superior</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($array_niveles as $key_n => $total_n) {
                ?>
                <tr>
                    <td><?php echo $key_n; ?></td>
                    <td><?php echo $total_n['Critico']; ?></td>
                    <td><?php echo $total_n['Bajo']; ?></td>
                    <td><?php echo $total_n['Medio']; ?></td>
                    <td><?php echo $total_n['Alto']; ?></td>
                    <td><?php echo $total_n['Superior']; ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>


    <?php ////////////////////////FIN GRAFICAS 04  ?>

    <?php ////////////////////////INICIO GRAFICAS 05 - PRESENTARON POR ESTRATO  ?>

    <?php
    $array_tipos = array('Diurna', 'Nocturna');
    foreach ($array_tipos as $tipo) {
        $data_prueba_estrato_tipo = $this->statistic_model->get_all_estrato($prueba[0]->EVALUACION_ID, $ciudad->USUARIO_CIUDAD, $tipo);
        //echo print_y($data_prueba_estrato_tipo);		
        ?>
        <script type="text/javascript">
            $(document).ready(function() {
                graficar_v1('container_e<?php echo $tipo; ?>_<?php echo $count; ?>', 'datatable_e<?php echo $tipo; ?>_<?php echo $count; ?>', 'Estadistica por Estrato en <?php echo $ciudad->USUARIO_CIUDAD ?>', 'Total por Estrato', 'column');
            })
        </script>
        <h4 style="color:#2aabd2">
            Presentaron por Estrato y <?php echo $tipo; ?> en <?php echo $ciudad->USUARIO_CIUDAD ?>
        </h4>
        <div id="container_e<?php echo $tipo; ?>_<?php echo $count; ?>" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        <table id="datatable_e<?php echo $tipo; ?>_<?php echo $count; ?>" class="table table-striped" style="">
            <thead>
                <tr>
                    <th>Estrato</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data_prueba_estrato_tipo as $estrato_tipo) {
                    ?>
                    <tr>
                        <td><?php echo $estrato_tipo->USUARIO_ESTRATO; ?></td>
                        <td><?php echo $estrato_tipo->TOTAL; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    }
    ?>

    <?php ////////////////////////FIN GRAFICAS 05  ?>

    <?php ////////////////////////INICIO GRAFICAS 06 - PRESENTARON POR GENERO  ?>

    <?php
    $array_tipos = array('Diurna', 'Nocturna');
    foreach ($array_tipos as $tipo) {
        $data_prueba_genero_tipo = $this->statistic_model->get_all_genero($prueba[0]->EVALUACION_ID, $ciudad->USUARIO_CIUDAD, $tipo);
        //echo print_y($data_prueba_genero_tipo);		
        ?>
        <script type="text/javascript">
            $(document).ready(function() {
                graficar_v1('container_g<?php echo $tipo; ?>_<?php echo $count; ?>', 'datatable_g<?php echo $tipo; ?>_<?php echo $count; ?>', 'Presentaron por Genero y <?php echo $tipo; ?> en <?php echo $ciudad->USUARIO_CIUDAD ?>', 'Total por Genero', 'column');
            })
        </script>
        <h4 style="color:#2aabd2">
            Presentaron por G&eacute;nero!!! y <?php echo $tipo; ?> en <?php echo $ciudad->USUARIO_CIUDAD ?>
        </h4>
        <div id="container_g<?php echo $tipo; ?>_<?php echo $count; ?>" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        <table id="datatable_g<?php echo $tipo; ?>_<?php echo $count; ?>" class="table table-striped" style="">
            <thead>
                <tr>
                    <th>Estrato</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data_prueba_genero_tipo as $genero_tipo) {
                    ?>
                    <tr>
                        <td><?php echo $genero_tipo->USUARIO_GENERO; ?></td>
                        <td><?php echo $genero_tipo->TOTAL; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>

        <?php
    }
    ?>

    <?php ////////////////////////FIN GRAFICAS 06  ?>	

    <?php ////////////////////////INICIO GRAFICAS 07 - PRESENTARON POR EDAD  ?>

    <?php
    $array_tipos = array('Diurna', 'Nocturna');
    foreach ($array_tipos as $tipo) {
        $data_prueba_edad_tipo = $this->statistic_model->get_all_edad($prueba[0]->EVALUACION_ID, $ciudad->USUARIO_CIUDAD, $tipo);
        //echo print_y($data_prueba_edad_tipo);	
        $array_edad = array();
        foreach ($data_prueba_edad_tipo as $edad_tipo) {
            @$array_edad[$edad_tipo->USUARIO_EDAD][$edad_tipo->USUARIO_GENERO] = $edad_tipo->TOTAL;
        }
        //echo print_y($array_edad);	
        ?>
        <script type="text/javascript">
            $(document).ready(function() {
                graficar_v1('container_ed<?php echo $tipo; ?>_<?php echo $count; ?>', 'datatable_ed<?php echo $tipo; ?>_<?php echo $count; ?>', 'Presentaron por Edad y <?php echo $tipo; ?> en <?php echo $ciudad->USUARIO_CIUDAD ?>', 'Total por Edad', 'column');
            })
        </script>
        <h4 style="color:#2aabd2">
            Presentaron por Edad y <?php echo $tipo; ?> en <?php echo $ciudad->USUARIO_CIUDAD ?>
        </h4>
        <div id="container_ed<?php echo $tipo; ?>_<?php echo $count; ?>" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        <table id="datatable_ed<?php echo $tipo; ?>_<?php echo $count; ?>" class="table table-striped" style="display:none">
            <thead>
                <tr>
                    <th>Edad</th>
                    <th>Total Femenino</th>
                    <th>Total Masculino</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($array_edad as $key => $edad) {
                    ?>
                    <tr>
                        <td>Edad: <?php echo $key; ?></td>
                        <td><?php echo (isset($edad['Femenino'])) ? $edad['Femenino'] : 0; ?></td>
                        <td><?php echo (isset($edad['Masculino'])) ? $edad['Masculino'] : 0; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    }
    ?>

    <?php ////////////////////////FIN GRAFICAS 07  ?>

    <?php ////////////////////////INICIO GRAFICAS 08 - PRESENTARON POR COLEGIO  ?>

    <?php
    $array_tipos = array('Diurna', 'Nocturna');
    foreach ($array_tipos as $tipo) {
        $data_prueba_colegio_tipo = $this->statistic_model->get_all_colegio($prueba[0]->EVALUACION_ID, $ciudad->USUARIO_CIUDAD, $tipo);
        //echo print_y($data_prueba_colegio_tipo);	
        $array_colegio = array();
        foreach ($data_prueba_colegio_tipo as $colegio_tipo) {
            @$array_colegio[$colegio_tipo->USUARIO_TIPOCOLEGIO][$colegio_tipo->USUARIO_GENERO] = $colegio_tipo->TOTAL;
        }
        //echo print_y($array_colegio);
        ?>
        <script type="text/javascript">
            $(document).ready(function() {
                graficar_v1('container_co<?php echo $tipo; ?>_<?php echo $count; ?>', 'datatable_co<?php echo $tipo; ?>_<?php echo $count; ?>', 'Presentaron por Edad y <?php echo $tipo; ?> en <?php echo $ciudad->USUARIO_CIUDAD ?>', 'Total por Edad', 'column');
            })
        </script>
        <h4 style="color:#2aabd2">
            Presentaron por Colegio y <?php echo $tipo; ?> en <?php echo $ciudad->USUARIO_CIUDAD ?>
        </h4>
        <div id="container_co<?php echo $tipo; ?>_<?php echo $count; ?>" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        <table id="datatable_co<?php echo $tipo; ?>_<?php echo $count; ?>" class="table table-striped" style="display:">
            <thead>
                <tr>
                    <th>Tipo de Colegio</th>
                    <th>Total Femenino</th>
                    <th>Total Masculino</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($array_colegio as $key => $colegio) {
                    ?>
                    <tr>
                        <td>Tipo de Colegio: <?php echo $key; ?></td>
                        <td><?php echo (isset($colegio['Femenino'])) ? $colegio['Femenino'] : 0; ?></td>
                        <td><?php echo (isset($colegio['Masculino'])) ? $colegio['Masculino'] : 0; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    }
    ?>

    <?php ////////////////////////FIN GRAFICAS 08  ?>	

    <?php ////////////////////////INICIO GRAFICAS 09 - PRESENTARON POR ESTADO CIVIL  ?>

    <?php
    $array_tipos = array('Diurna', 'Nocturna');
    foreach ($array_tipos as $tipo) {
        $data_prueba_estadocivil_tipo = $this->statistic_model->get_all_estadocivil($prueba[0]->EVALUACION_ID, $ciudad->USUARIO_CIUDAD, $tipo);
        //echo print_y($data_prueba_colegio_tipo);	
        $array_estadocivil = array();
        foreach ($data_prueba_estadocivil_tipo as $estadocivil_tipo) {
            @$array_estadocivil[$estadocivil_tipo->USUARIO_ESTADOCIVIL][$estadocivil_tipo->USUARIO_GENERO] = $estadocivil_tipo->TOTAL;
        }
        //echo print_y($array_estadocivil);
        ?>
        <script type="text/javascript">
            $(document).ready(function() {
                graficar_v1('container_ec<?php echo $tipo; ?>_<?php echo $count; ?>', 'datatable_ec<?php echo $tipo; ?>_<?php echo $count; ?>', 'Presentaron por Estado Civil y <?php echo $tipo; ?> en <?php echo $ciudad->USUARIO_CIUDAD ?>', 'Total por Estado Civil', 'column');
            })
        </script>
        <h4 style="color:#2aabd2">
            Presentaron por Estado Civil y <?php echo $tipo; ?> en <?php echo $ciudad->USUARIO_CIUDAD ?>
        </h4>
        <div id="container_ec<?php echo $tipo; ?>_<?php echo $count; ?>" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        <table id="datatable_ec<?php echo $tipo; ?>_<?php echo $count; ?>" class="table table-striped" style="display:">
            <thead>
                <tr>
                    <th>Estado Civil</th>
                    <th>Total Femenino</th>
                    <th>Total Masculino</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($array_estadocivil as $key => $estadocivil) {
                    ?>
                    <tr>
                        <td><?php echo $key; ?></td>
                        <td><?php echo (isset($estadocivil['Femenino'])) ? $estadocivil['Femenino'] : 0; ?></td>
                        <td><?php echo (isset($estadocivil['Masculino'])) ? $estadocivil['Masculino'] : 0; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>

        <?php
    }
    ?>

    <?php ////////////////////////FIN GRAFICAS 09  ?>		

    <?php
}
?>


