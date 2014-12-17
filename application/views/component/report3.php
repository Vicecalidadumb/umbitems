<?php
//echo count($components);
//echo '<pre>' . print_r($components, true) . '</pre>';
?>










<table>
    <tr>
        <td>
            <strong>COMPONENTE - SIGLA</strong>
        </td>
        <td>
            <strong>Creador</strong>
        </td>         
        <td>
            <strong>IDPREGUNTA</strong>
        </td>
        <td>
            <strong>ESTADO EN SISTEMA</strong>
        </td>
        <td>
            <strong>SELECCIONADA PARA DIAGRAMAR</strong>
        </td>
        <td>
            <strong>DIAGRAMADOS</strong>
        </td>        
        <td>
            <strong>V1</strong>
        </td> 
        <td>
            <strong>V2</strong>
        </td>
        <td>
            <strong>V3</strong>
        </td>
        <td>
            <strong>V4</strong>
        </td>
        <td>
            <strong>V5</strong>
        </td>        
        <td>
            <strong>VALIDACION</strong>
        </td>        
    </tr>
    <?php
    $count = 1;
    foreach ($components as $component) {
        //echo $component->COMPONENTE_SIGLA.' - '.$component->COMPONENTE_NOMBRE.'<br>';
        ?>
        <tr>
            <td>
                </strong><?php echo $component->COMPONENTE_SIGLA.' | '.$component->COMPONENTE_NOMBRE ; ?>
            </td>  
            <td>
                <?php echo $component->USUARIO_NOMBRES; ?>
            </td>            
            <td>
                <?php echo 'PN317' . $component->COMPONENTE_SIGLA . '' . $component->PREGUNTA_ID; ?>
            </td>
            <td>
                <?php
                if ($component->PREGUNTA_ESTADO == 1) {
                    if ($component->PREGUNTA_ETAPA == 0) {
                        echo "Activa";
                    } else {
                        if ($component->PREGUNTA_SELECCIONADA == 1) {
                            echo "Activa";
                        } else {
                            if ($component->V1 != '' && $component->V2 != '' && $component->V3 != '' && $component->V4 != '' && $component->V5 != '') {
                                $validation_total = get_avg_validation($component->V1, $component->V2, $component->V3, $component->V4, $component->V5);
                                if($validation_total<= 1.99){
                                    echo "Desechada";
                                }else{
                                    echo "Activa";
                                }
                            } else {
                                echo "Activa";
                            }
                        }
                    }
                } else {
                    echo "Desechada";
                }
                ?>
            </td>
            <td>
                <?php 
                if($component->PREGUNTA_SELECCIONADA==1){
                    echo "SI";
                } 
                ?>
            </td> 
            <td>
                <?php 
                if($component->PREGUNTA_DIAGRAMADA==1){
                    echo "SI";
                } 
                ?>
            </td>            
            <td>
                <?php 
                 echo $component->V1;
                ?>
            </td>
            <td>
                <?php 
                 echo $component->V2;
                ?>
            </td>
            <td>
                <?php 
                 echo $component->V3;
                ?>
            </td>
            <td>
                <?php 
                 echo $component->V4;
                ?>
            </td>            
            <td>
                <?php 
                 echo $component->V5;
                ?>
            </td>            
            <td>
                <?php 
                 $validation_total = get_avg_validation($component->V1, $component->V2, $component->V3, $component->V4, $component->V5);
                 echo $validation_total;
                ?>
            </td>            
        </tr>
        <?php
        $count++;
    }
    ?>
</table>

