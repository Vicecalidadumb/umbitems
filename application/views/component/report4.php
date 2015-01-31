<table>
    <tr style="background:#CCC">
        <td>PREGUNTA_ID</td>
        <td>PREGUNTA_TEMA</td>
        <td>PREGUNTA_NIVELRUBRICA</td>
        <td>PREGUNTA_NIVELPREGUNTA</td>
        <td>PREGUNTA_TIPOITEM</td>
        <td>PREGUNTA_NIVELDIFICULTAD</td>
        <td>PREGUNTA_ETAPA</td>
        <td>PREGUNTA_VALIDA_2</td>
        <td>PREGUNTA_VALIDA_2_TEXT1</td>
        <td>PREGUNTA_VALIDA_2_TEXT2</td>
        <td>COMPONENTE_ID</td>
        <td>COMPONENTE_NOMBRE</td>
        <td>COMPONENTE_PREGUNTAS</td>
        <td>USUARIO_NOMBRES</td>
        <td>USUARIO_APELLIDOS</td>
        <td>USUARIO_NUMERODOCUMENTO</td>
        <td>USUARIO_CORREO</td>
    </tr>
    <?php
    $i=0;
    foreach ($components as $components2) {
        if(($i%2)==0){
            echo '<tr style="background: #d9edf7">';
        }else{
            echo '<tr>';
        }
        $i++;
        ?>
    
            <td><?php echo $components2->PREGUNTA_ID ?></td>
            <td><?php echo $components2->PREGUNTA_TEMA ?></td>
            <td><?php echo $components2->PREGUNTA_NIVELRUBRICA ?></td>
            <td><?php echo $components2->PREGUNTA_NIVELPREGUNTA ?></td>
            <td><?php echo $components2->PREGUNTA_TIPOITEM ?></td>
            <td><?php echo $components2->PREGUNTA_NIVELDIFICULTAD; ?></td>
            <td><?php
                switch ($components2->PREGUNTA_ETAPA) {
                    case '0': echo 'En Construccion';
                        break;
                    case '1':
                        switch ($components2->PREGUNTA_VALIDA_2) {
                            case 1: echo '<span style="color:yellow" class="glyphicon glyphicon-warning-sign"></span> Debe Corregirse';
                                break;
                            default: echo 'En Validacion';
                        }
                        break;
                    case '2': echo 'En Seleccion';
                        break;
                    case '3': echo 'En Corr. de Estilo';
                        break;
                    case '4': echo 'En Diagramacion';
                        break;
                    case '5': echo 'Diagramada';
                        break;
                }
                ?></td>
            <td><?php echo str_replace("<br>", " ", $components2->PREGUNTA_VALIDA_2_TEXT1) ?></td>
            <td><?php echo str_replace("<br>", " ", $components2->PREGUNTA_VALIDA_2_TEXT2) ?></td>
            <td><?php echo $components2->COMPONENTE_ID ?></td>
            <td><?php echo $components2->COMPONENTE_NOMBRE ?></td>
            <td><?php echo $components2->COMPONENTE_PREGUNTAS ?></td>
            <td><?php echo $components2->USUARIO_NOMBRES ?></td>
            <td><?php echo $components2->USUARIO_APELLIDOS ?></td>
            <td><?php echo $components2->USUARIO_NUMERODOCUMENTO ?></td>
            <td><?php echo $components2->USUARIO_CORREO ?></td>
        </tr>
        <?php
    }
    ?>
</table>