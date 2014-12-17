
<table>
    <tr>
        <td>
            <strong>Componente</strong>
        </td>
        <td>
            <strong>Sigla</strong>
        </td>
        <td>
            <strong>Constructores Asignados</strong>
        </td>        
        <td>
            <strong>Numero de Items</strong>
        </td>
        <td>
            <strong>Items Construidos</strong>
        </td>
        <td>
            <strong>Total Diagramados</strong>
        </td> 
        <td>
            <strong>Total Desechados a la Fecha</strong>
        </td>        
        <td>
            <strong>Total Validacion SUFICIENCIA</strong>
        </td>
        <td>
            <strong>Total Validacion UBICACION</strong>
        </td>
        <td>
            <strong>Total Validacion RELEVANCIA</strong>
        </td>
        <td>
            <strong>Total Validacion SINTACTICA</strong>
        </td>
        <td>
            <strong>Total Validacion SEMANTICA</strong>
        </td> 
      
    </tr>
    <?php
    $count = 1;
    foreach ($components as $component) {
        //echo $component->COMPONENTE_SIGLA.' - '.$component->COMPONENTE_NOMBRE.'<br>';
        ?>
        <tr>
            <td>
                </strong><?php echo $component->COMPONENTE_NOMBRE; ?>
            </td>	
            <td>
                <?php echo $component->COMPONENTE_SIGLA; ?>
            </td>
            <td>
                <?php echo str_replace(":", ":<br>", $component->ASIGNADOS_CONSTRUCCION); ?>
            </td>
            <td>
                <?php echo $component->COMPONENTE_PREGUNTAS; ?>
            </td>						
            <td>
                <?php echo $component->ITEMS; ?>
            </td>  
            <td>
                <?php echo $component->DIAGRA; ?>
            </td> 
            <td>
                <?php echo $component->ITEMS-$component->DIAGRA; ?>
            </td>             
            
            <td>
                <?php echo $component->TOTAL_SU; ?>
            </td> 
            <td>
                <?php echo $component->TOTAL_UB; ?>
            </td> 
            <td>
                <?php echo $component->TOTAL_RE; ?>
            </td> 
            <td>
                <?php echo $component->TOTAL_SI; ?>
            </td> 
            <td>
                <?php echo $component->TOTAL_SE; ?>
            </td>
            
        </tr>
        <?php
        $count++;
    }
    ?>
</table>

