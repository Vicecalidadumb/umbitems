<?php

function print_y($array) {
    return '<pre>' . print_r($array, true) . '</pre>';
}

function get_array_states($type = 0) {
    if ($type == 0)
        $states = array(
            1 => 'Activo',
            0 => 'Inactivo',
        );
    elseif ($type == 1)
        $states = array(
            1 => 'SI',
            0 => 'NO',
        );
    return $states;
}

function get_dropdown($array_objects, $value, $name) {
    $array_return = array();
    foreach ($array_objects as $array) {
        $array_return[$array->$value] = $array->$name;
    }
    return $array_return;
}

function get_dropdown_select($array_objects, $value, $name, $select_value, $select_name = 'Seleccionar...') {
    $array_return = array($select_value => $select_name);
    foreach ($array_objects as $array) {
        $array_return[$array->$value] = $array->$name;
    }
    return $array_return;
}

function get_array_rubrics() {
    $array = array(
        'RESOLUTIVO' => 'RESOLUTIVO',
        'AUTONOMO' => 'AUTONOMO',
        'ESTRATEGICO' => 'ESTRATEGICO'
    );
    return $array;
}

function get_array_levelsquestions() {
    $array = array(
        'ASISTENCIAL' => 'ASISTENCIAL',
        'TECNICO' => 'TECNICO',
        'UNIVERSITARIO' => 'UNIVERSITARIO',
        'ESPECIALIZADO' => 'ESPECIALIZADO'
    );
    return $array;
}

function get_level_initials($level) {
    switch ($level) {
        case 'ASISTENCIAL': return 'A';
            break;
        case 'TECNICO': return 'T';
            break;
        case 'UNIVERSITARIO': return 'U';
            break;
        case 'ESPECIALIZADO': return 'E';
            break;
    }
}

function get_itemlevel_color($level) {
    switch ($level) {
        case '0': return 'warning';
            break; //EN CONSTRUCCION
        case '1': return 'enseleccion';
            break; //EN SELECCION
        case '2': return 'danger';
            break; //EN VALIDACION
        case '3': return 'enestilo';
            break; //EN CORRECCION DE ESTILO
        case '4': return 'info';
            break; //EN DIAGRAMACION
        case '5': return 'susses';
            break; //DIAGRAMADA
    }
}

function get_itemlevel_text($question) {
    switch ($question->PREGUNTA_ETAPA) {
        case '0': return 'En Construccion';
            break;
        case '1': return 'En Seleccion';
            break;
        case '2':
            switch ($question->PREGUNTA_VALIDA_2) {
                case 2: return '<span style="color:yellow" class="glyphicon glyphicon-warning-sign"></span> Validada con errores';
                    break;
                default: return 'En Validacion';
            }
            break;
        case '3': return 'En Corr. de Estilo';
            break;
        case '4': return 'En Diagramacion';
            break;
        case '5': return 'Diagramada';
            break;
    }
}

function get_array_item_types() {
    $array = array(
        'SMUR' => 'SMUR'
    );
    return $array;
}

function get_array_difficulty_level() {
    $array = array(
        '1' => 'BAJO',
        '2' => 'MEDIO',
        '3' => 'ALTO'
    );
    return $array;
}

function get_difficulty_level($id) {
    switch ($id) {
        case 1:return "BAJO";
            break;
        case 2:return "MEDIO";
            break;
        case 3:return "ALTO";
            break;
    }
}

function get_array_number_questions() {
    $array = array(
        '' => '--Selecciona la Respuesta Correcta--',
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4'
    );
    return $array;
}

function encrypt_id($id) {
    return base64_encode(rand(111111, 999999) . $id . rand(11111, 99999));
}

function deencrypt_id($id) {
    $id = base64_decode($id);
    $id = substr($id, 6, strlen($id));
    $id = substr($id, 0, strlen($id) - 5);
    return $id;
}

function get_component_name($sigla) {
    $CI = & get_instance();
    $CI->load->model('component_model');
    $component = $CI->component_model->get_components_value($sigla);
    return $component[0]->COMPONENTE_NOMBRE;
}

function get_validation_id($id_user, $PREGUNTA_ID) {
    $CI = & get_instance();
    $CI->load->model('validation_model');
    $validation = $CI->validation_model->get_validation($PREGUNTA_ID, $id_user);
    if (count($validation) > 0) {
        return 1;
    } else {
        return 0;
    }
}

function get_modify_item($PREGUNTA_ID) {
    $CI = & get_instance();
    $CI->load->model('question_model');
    $validation = $CI->question_model->get_modify_item($PREGUNTA_ID, $CI->session->userdata("KEY_AES"));
    return $validation;
}

function get_nameuser_id($USUARIO_ID) {
    $CI = & get_instance();
    $CI->load->model('question_model');
    $validation = $CI->question_model->get_nameuser_id($USUARIO_ID);
    $nombre = '';
    if (count($validation) > 0) {
        $nombre = $validation[0]->NOMBRE;
    }
    return $nombre;
}

function get_modify_resp($RESPUESTA_ID) {
    $CI = & get_instance();
    $CI->load->model('question_model');
    $validation = $CI->question_model->get_modify_resp($RESPUESTA_ID, $CI->session->userdata("KEY_AES"));
    return $validation;
}

function get_niveldificultadname($value) {
    switch ($value) {
        case 1: return 'Bajo';
            break;
        case 2: return 'Medio';
            break;
        case 3: return 'Alto';
            break;
        default: return 'Nivel';
            break;
    }
}

function permits_validation() {
    $VPE = (know_permission_role('VPE', 'permission_add') == 1) ? 'SUFICIENCIA, ' : '';
    $VCO = (know_permission_role('VCO', 'permission_add') == 1) ? 'UBICACION, ' : '';
    $VRE = (know_permission_role('VRE', 'permission_add') == 1) ? 'RELEVANCIA, ' : '';
    $VSI = (know_permission_role('VSI', 'permission_add') == 1) ? 'SINT&Aacute;CTICA, ' : '';
    $VSE = (know_permission_role('VSE', 'permission_add') == 1) ? 'SEM&Aacute;NTICA, ' : '';
    return $VPE . $VCO . $VRE . $VSI . $VSE;
}

function get_validation_type($id) {

    switch ($id) {
        case '1': return "SUFICIENCIA";
            break;
        case '2': return "UBICACION";
            break;
        case '3': return "RELEVANCIA";
            break;
        case '4': return "SINT&Aacute;CTICA";
            break;
        case '5': return "SEM&Aacute;NTICA";
            break;
        default :return "N/A";
            break;
    }
}

function get_score() {
    $array_score = array('' => '-- SELECCIONA UN PUNTAJE --');
    for ($a = 0.0; $a <= 5.0; $a = $a + 0.1) {
        $array_score["$a"] = $a;
    }
    return $array_score;
}

function get_avg_validation($v1, $v2, $v3, $v4, $v5) {
    $dividir = 0;
    //VALIDAR DIVISION
    if ($v1) {
        $dividir++;
    }
    if ($v2) {
        $dividir++;
    }
    if ($v3) {
        $dividir++;
    }
    if ($v4) {
        $dividir++;
    }
    if ($v5) {
        $dividir++;
    }

    if ($dividir > 0) {

        $result = 0;
        $eva = '';
        //return "$v1+$v2+$v3+$v4+$v5 - ".($v1+$v2+$v3+$v4+$v5);
        $result = round(($v1 + $v2 + $v3 + $v4 + $v5) / $dividir, 2);
        return $result;
    } else {
        return 0;
    }
}

function get_avg_validation_SIN_SEM($v1, $v2) {
    $result = 0;
    $eva = '';
    //return "$v1+$v2+$v3+$v4+$v5 - ".($v1+$v2+$v3+$v4+$v5);
    $result = round(($v1 + $v2) / 2, 2);
    return $result;
}

function get_avg_validation_SUF_UBI_REL($v1, $v2, $v3) {
    $result = 0;
    $eva = '';
    //return "$v1+$v2+$v3+$v4+$v5 - ".($v1+$v2+$v3+$v4+$v5);
    $result = round(($v1 + $v2 + $v3) / 3, 2);
    return $result;
}

function standard_deviation($aValues) {
    $fMean = array_sum($aValues) / count($aValues);
    //print_r($fMean);
    $fVariance = 0.0;
    foreach ($aValues as $i) {
        $fVariance += pow($i - $fMean, 2);
    }
    $size = count($aValues) - 1;
    return (float) sqrt($fVariance) / sqrt($size);
}

function average($arr) {
    if (!count($arr))
        return 0;
    $sum = 0;
    for ($i = 0; $i < count($arr); $i++) {
        $sum += $arr[$i];
    }
    return $sum / count($arr);
}

function variance($arr) {
    if (!count($arr))
        return 0;
    $mean = average($arr);
    $sos = 0;    // Sum of squares
    for ($i = 0; $i < count($arr); $i++) {
        $sos += ($arr[$i] - $mean) * ($arr[$i] - $mean);
    }
    return $sos / (count($arr) - 1);
}

function configuracion($url) {
    $config = array();
    switch ($url) {
        case 'vice_admin_umb':
            $config['c_nombre'] = 'CONVOCATORIA No. 317 de 2013 PARQUES NACIONALES';
            $config['c_descripcion'] = 'CONVOCATORIA No. 317 de 2013 PARQUES NACIONALES';
            $config['c_imagen1'] = 'ima1_parques.png';
            $config['c_id'] = '1';
            break;
        case 'items_defensoria':
            $config['c_nombre'] = 'Convocatoria Defensor&iacute;a del Pueblo';
            $config['c_descripcion'] = 'Convocatoria Defensor&iacute;a del Pueblo';
            $config['c_imagen1'] = 'ima1_defensoria.png';
            $config['c_id'] = '2';
            break;
        case 'items_curaduria':
            $config['c_nombre'] = 'Convocatoria  Curaduria Soacha';
            $config['c_descripcion'] = 'Convocatoria  Curaduria Soacha';
            $config['c_imagen1'] = 'ima1_curaduria.png';
            $config['c_id'] = '2';
            break;
        case 'items':
            $config['c_nombre'] = 'Universidad Manuela Beltran';
            $config['c_descripcion'] = 'Universidad Manuela Beltran';
            $config['c_imagen1'] = 'ima1_umb.png';
            $config['c_id'] = '3';
            break;
    }

    $config['c_nombre'] = 'CONVOCATORIA No. 320 de 2014 - DPS';
    $config['c_descripcion'] = 'CONVOCATORIA No. 320 de 2014 - DPS';
    $config['c_imagen1'] = 'ima1.png';
    $config['c_id'] = '1';
    return $config;
}
