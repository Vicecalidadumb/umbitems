<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Question_model extends CI_Model {

    public function get_questions($id_component, $id_user, $KEY_AES, $GROUPBY, $level, $ID_TIPO_USU) {
        $WHERE = '';
        if ($id_component == "ALL") {
            $WHERE.= '';
        } else {
            $WHERE.= " AND p.COMPONENTE_ID = '$id_component' ";
        }
        if ($id_user != 'ALL' && $ID_TIPO_USU == '1') {
            $WHERE.= " AND p.USUARIO_ID = '$id_user' ";
        }
        if ($GROUPBY == 1) {
            $WHERE.= 'GROUP BY p.PREGUNTA_ID';
        }

        $SQL_string = "SELECT
                        p.*,r.*,u.*,c.*,
                        AES_DECRYPT(p.PREGUNTA_ENUNCIADO,'{$KEY_AES}') PREGUNTA_ENUNCIADO,
                        AES_DECRYPT(p.PREGUNTA_CONTEXTO,'{$KEY_AES}') PREGUNTA_CONTEXTO,
                        AES_DECRYPT(p.PREGUNTA_IDRESPUESTA,'{$KEY_AES}') PREGUNTA_IDRESPUESTA,
                        AES_DECRYPT(p.PREGUNTA_OBSERVACIONES,'{$KEY_AES}') PREGUNTA_OBSERVACIONES,
                        AES_DECRYPT(r.RESPUESTA_ENUNCIADO,'{$KEY_AES}') RESPUESTA_ENUNCIADO,
                        AES_DECRYPT(r.RESPUESTA_JUSTIFICACION,'{$KEY_AES}') RESPUESTA_JUSTIFICACION
                      FROM
                            {$this->db->dbprefix('preguntas')} p,
                            {$this->db->dbprefix('respuestas')} r,
                            {$this->db->dbprefix('usuarios')} u,
                            {$this->db->dbprefix('componentes')} c
                      WHERE
                            p.PREGUNTA_ID = r.PREGUNTA_ID
                            AND
                            u.USUARIO_ID = p.USUARIO_ID
                            AND
                            c.COMPONENTE_ID = p.COMPONENTE_ID
                            AND PREGUNTA_ESTADO = '1'
                            AND PREGUNTA_NIVELPREGUNTA = '$level'
                            $WHERE
                            ORDER BY PREGUNTA_FECHADECREACION DESC
                            ";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_questions_report3($id_component, $id_user, $KEY_AES, $GROUPBY) {
        $CI = & get_instance();
        $WHERE = '';
        if ($id_component == "ALL") {
            $WHERE.= '';
        } else {
            $WHERE.= " AND p.COMPONENTE_ID = '$id_component' ";
        }
        if ($id_user != 'ALL') {
            $WHERE.= " AND p.USUARIO_ID = '$id_user' ";
        }
        if ($GROUPBY == 1) {
            $WHERE.= 'GROUP BY p.PREGUNTA_ID';
        }

        $SQL_string = "SELECT
                        p.PREGUNTA_ID,
                        
                        p.PREGUNTA_NIVELRUBRICA,
                        p.PREGUNTA_NIVELPREGUNTA,
                        
                        p.PREGUNTA_NIVELDIFICULTAD,
                        
                        p.PREGUNTA_ESTADO,
                        p.PREGUNTA_ETAPA,
                        p.PREGUNTA_FECHADECREACION,
                        
                       
                        p.USUARIO_ID,
                        u.USUARIO_NOMBRES,
                        p.PREGUNTA_SELECCIONADA,
                        p.PREGUNTA_DIAGRAMADA,
                        p.PREGUNTA_VALIDA1_OK,
                        p.PREGUNTA_VALIDA2_OK,
                        
                        
                                                
                        CONCAT(u.USUARIO_NOMBRES,' ',u.USUARIO_APELLIDOS) AS PERSONA_CARGO,
                        c.COMPONENTE_NOMBRE,
                        c.COMPONENTE_SIGLA,
                        
                        (
                        SELECT ROUND(AVG(EVALUACION_PUNTUACION),1) AS V1
                        FROM {$this->db->dbprefix('evaluacion')} e
                        WHERE e.PREGUNTA_ID = p.PREGUNTA_ID AND e.TIPOEVALUACION_ID=1
                        ) AS V1,
                        
                        (
                        SELECT ROUND(AVG(EVALUACION_PUNTUACION),1) AS V2
                        FROM {$this->db->dbprefix('evaluacion')} e
                        WHERE e.PREGUNTA_ID = p.PREGUNTA_ID AND e.TIPOEVALUACION_ID=2
                        ) AS V2,
                        
                        (
                        SELECT ROUND(AVG(EVALUACION_PUNTUACION),1) AS V3
                        FROM {$this->db->dbprefix('evaluacion')} e
                        WHERE e.PREGUNTA_ID = p.PREGUNTA_ID AND e.TIPOEVALUACION_ID=3
                        ) AS V3,
                        
                        (
                        SELECT ROUND(AVG(EVALUACION_PUNTUACION),1) AS V4
                        FROM {$this->db->dbprefix('evaluacion')} e
                        WHERE e.PREGUNTA_ID = p.PREGUNTA_ID AND e.TIPOEVALUACION_ID=4
                        ) AS V4,
                        
                        (
                        SELECT ROUND(AVG(EVALUACION_PUNTUACION),1) AS V5
                        FROM {$this->db->dbprefix('evaluacion')} e
                        WHERE e.PREGUNTA_ID = p.PREGUNTA_ID AND e.TIPOEVALUACION_ID=5
                        ) AS V5

                      FROM 
                            {$this->db->dbprefix('preguntas')} p,
                           
                            {$this->db->dbprefix('usuarios')} u,
                            {$this->db->dbprefix('componentes')} c
                      WHERE 
                            
                            u.USUARIO_ID = p.USUARIO_ID
                            AND
                            c.COMPONENTE_ID = p.COMPONENTE_ID
                            
                            $WHERE
                            
                            AND
                            (c.COMPONENTE_ID != 107 && c.COMPONENTE_ID != 109)

                            ORDER BY PREGUNTA_FECHADECREACION DESC
                            ";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_questions_select($id_component, $id_user, $KEY_AES, $GROUPBY) {
        $CI = & get_instance();
        $WHERE = '';
        if ($id_component == "ALL") {
            $WHERE.= '';
        } else {
            $WHERE.= " AND p.COMPONENTE_ID = '$id_component' ";
        }
        if ($id_user != 'ALL') {
            $WHERE.= " AND p.USUARIO_ID = '$id_user' ";
        }
        if ($GROUPBY == 1) {
            $WHERE.= 'GROUP BY p.PREGUNTA_ID';
        }

        $SQL_string = "SELECT 
                        p.*,r.*,u.*,c.*,
                        AES_DECRYPT(p.PREGUNTA_ENUNCIADO,'{$KEY_AES}') PREGUNTA_ENUNCIADO,
                        AES_DECRYPT(p.PREGUNTA_CONTEXTO,'{$KEY_AES}') PREGUNTA_CONTEXTO,
                        AES_DECRYPT(p.PREGUNTA_IDRESPUESTA,'{$KEY_AES}') PREGUNTA_IDRESPUESTA,
                        AES_DECRYPT(p.PREGUNTA_OBSERVACIONES,'{$KEY_AES}') PREGUNTA_OBSERVACIONES,
                        AES_DECRYPT(r.RESPUESTA_ENUNCIADO,'{$KEY_AES}') RESPUESTA_ENUNCIADO,
                        AES_DECRYPT(r.RESPUESTA_JUSTIFICACION,'{$KEY_AES}') RESPUESTA_JUSTIFICACION
                      FROM 
                            {$this->db->dbprefix('preguntas')} p,
                            {$this->db->dbprefix('respuestas')} r,
                            {$this->db->dbprefix('usuarios')} u,
                            {$this->db->dbprefix('componentes')} c
                      WHERE 
                            p.PREGUNTA_ID = r.PREGUNTA_ID
                            AND
                            u.USUARIO_ID = p.USUARIO_ID
                            AND
                            c.COMPONENTE_ID = p.COMPONENTE_ID
                            AND PREGUNTA_ESTADO = '1' AND PREGUNTA_SELECCIONADA = '1'
                            
                            $WHERE
                            ORDER BY PREGUNTA_FECHADECREACION DESC
                            ";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_question_preview($PREGUNTA_ID, $KEY_AES) {
        $CI = & get_instance();
        $SQL_string = "SELECT
                        p.*,r.*,u.*,c.*,
                        AES_DECRYPT(p.PREGUNTA_ENUNCIADO,'{$KEY_AES}') PREGUNTA_ENUNCIADO,
                        AES_DECRYPT(p.PREGUNTA_CONTEXTO,'{$KEY_AES}') PREGUNTA_CONTEXTO,
                        AES_DECRYPT(p.PREGUNTA_IDRESPUESTA,'{$KEY_AES}') PREGUNTA_IDRESPUESTA,
                        AES_DECRYPT(p.PREGUNTA_OBSERVACIONES,'{$KEY_AES}') PREGUNTA_OBSERVACIONES,
                        AES_DECRYPT(r.RESPUESTA_ENUNCIADO,'{$KEY_AES}') RESPUESTA_ENUNCIADO,
                        AES_DECRYPT(r.RESPUESTA_JUSTIFICACION,'{$KEY_AES}') RESPUESTA_JUSTIFICACION
                      FROM
                            {$this->db->dbprefix('preguntas')} p,
                            {$this->db->dbprefix('respuestas')} r,
                            {$this->db->dbprefix('usuarios')} u,
                            {$this->db->dbprefix('componentes')} c
                      WHERE 
                            p.PREGUNTA_ID = r.PREGUNTA_ID
                            AND
                            p.PREGUNTA_ID = '$PREGUNTA_ID'
                            AND
                            u.USUARIO_ID = p.USUARIO_ID
                            AND
                            c.COMPONENTE_ID = p.COMPONENTE_ID
                            AND PREGUNTA_ESTADO = '1'
                            ";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_question($id_question, $KEY_AES, $USUARIO_ID) {
        $tipo = $this->session->userdata('ID_TIPO_USU');
        $this->db->select("p.*,r.*,u.*,c.*,
                        CONCAT(u.USUARIO_NOMBRES,' ',u.USUARIO_APELLIDOS) PERSONA_CARGO,
                        AES_DECRYPT(p.PREGUNTA_ENUNCIADO,'{$KEY_AES}') PREGUNTA_ENUNCIADO,
                        AES_DECRYPT(p.PREGUNTA_CONTEXTO,'{$KEY_AES}') PREGUNTA_CONTEXTO,
                        AES_DECRYPT(p.PREGUNTA_IDRESPUESTA,'{$KEY_AES}') PREGUNTA_IDRESPUESTA,
                        AES_DECRYPT(p.PREGUNTA_OBSERVACIONES,'{$KEY_AES}') PREGUNTA_OBSERVACIONES,
                        AES_DECRYPT(r.RESPUESTA_ENUNCIADO,'{$KEY_AES}') RESPUESTA_ENUNCIADO,
                        AES_DECRYPT(r.RESPUESTA_JUSTIFICACION,'{$KEY_AES}') RESPUESTA_JUSTIFICACION", false);
        $this->db->where('p.PREGUNTA_ID', 'r.PREGUNTA_ID', false);
        $this->db->where('p.PREGUNTA_ID', $id_question, false);
        $this->db->where('u.USUARIO_ID', 'p.USUARIO_ID', false);
        $this->db->where('c.COMPONENTE_ID', ' p.COMPONENTE_ID', false);
        $this->db->where('PREGUNTA_ESTADO', 1, false);
        if ($tipo != 3 && $tipo != 4)
            $this->db->where('p.USUARIO_ID', $USUARIO_ID, false);
        $this->db->from('preguntas p,respuestas r,usuarios u,componentes c');
        $datos = $this->db->get();
        //echo $SQL_string;
        return $datos->result();
    }

    public function insert_question($data, $KEY_AES) {
        $CI = & get_instance();
        $PREGUNTA_ID = 0;

        $SQL_string = "INSERT INTO {$this->db->dbprefix('preguntas')}
                      (
                       PREGUNTA_TEMA,
                       PREGUNTA_NIVELRUBRICA,
                       PREGUNTA_NIVELPREGUNTA,
                       PREGUNTA_TIPOITEM,
                       PREGUNTA_NIVELDIFICULTAD,
                       PREGUNTA_ENUNCIADO,
                       PREGUNTA_CONTEXTO,
                       PREGUNTA_OBSERVACIONES,
                       PREGUNTA_ESTADO,
                       PREGUNTA_ETAPA,
                       PREGUNTA_FECHADECREACION,
                       COMPONENTE_ID,
                       USUARIO_ID
                       )
                      VALUES 
                       (
                       '" . addslashes($data['PREGUNTA_TEMA']) . "',
                       '{$data['PREGUNTA_NIVELRUBRICA']}',
                       '{$data['PREGUNTA_NIVELPREGUNTA']}',    
                       '{$data['PREGUNTA_TIPOITEM']}',
                       '{$data['PREGUNTA_NIVELDIFICULTAD']}',
                       AES_ENCRYPT('" . addslashes($data['PREGUNTA_ENUNCIADO']) . "','{$KEY_AES}'),
                       AES_ENCRYPT('" . addslashes($data['PREGUNTA_CONTEXTO']) . "','{$KEY_AES}'),    
                       AES_ENCRYPT('" . addslashes($data['PREGUNTA_OBSERVACIONES']) . "','{$KEY_AES}'),
                       '1',
                       '{$data['PREGUNTA_ETAPA']}',
                       '{$data['PREGUNTA_FECHADECREACION']}',
                       '{$data['COMPONENTE_ID']}',
                       '{$data['USUARIO_ID']}'
                       )
                       ";
        $return = $this->db->query($SQL_string);
        $PREGUNTA_ID = $this->db->insert_id();

        if ($PREGUNTA_ID != 0) {
            for ($a = 1; $a <= 4; $a++) {
                $SQL_string_respuestas = "INSERT INTO {$this->db->dbprefix('respuestas')}
                          (
                           RESPUESTA_ENUNCIADO,
                           RESPUESTA_JUSTIFICACION,
                           RESPUESTA_ESTADO,
                           USUARIO_ID,
                           PREGUNTA_ID
                           )
                          VALUES 
                           (
                           AES_ENCRYPT('" . addslashes($data['RESPUESTA_ENUNCIADO_' . $a]) . "','{$KEY_AES}'),
                           AES_ENCRYPT('" . addslashes($data['RESPUESTA_JUSTIFICACION_' . $a]) . "','{$KEY_AES}'),
                           '1',
                           '{$data['USUARIO_ID']}',
                           '{$PREGUNTA_ID}'
                           )
                           ";
                $this->db->query($SQL_string_respuestas);
                if ($data['PREGUNTA_IDRESPUESTA'] == $a) {
                    $RESPUESTA_ID = $this->db->insert_id();
                    $this->db->query("UPDATE {$this->db->dbprefix('preguntas')} "
                            . " SET PREGUNTA_IDRESPUESTA = AES_ENCRYPT('{$RESPUESTA_ID}','{$KEY_AES}')  "
                            . " WHERE PREGUNTA_ID=$PREGUNTA_ID");
                }
            }
        }

        return $PREGUNTA_ID;
    }

    public function update_question_diagra($data) {
        //echo '<pre>' . print_r($data['question'], true) . '</pre>';
        $SQL_string = "UPDATE {$this->db->dbprefix('preguntas')} SET
                       PREGUNTA_DIAGRAMADA = '{$data['PREGUNTA_DIAGRAMADA']}',
                       PREGUNTA_DIAGRAMADA_FECHA = '{$data['PREGUNTA_DIAGRAMADA_FECHA']}' 
                       WHERE
                       PREGUNTA_ID = {$data['PREGUNTA_ID']}
                       ";
        $return = $SQL_string_query = $this->db->query($SQL_string);

        return $return;
    }

    public function update_question_valida1($data) {
        //echo '<pre>' . print_r($data['question'], true) . '</pre>';
        $SQL_string = "UPDATE {$this->db->dbprefix('preguntas')} SET
                       PREGUNTA_VALIDA1_OK = '{$data['PREGUNTA_VALIDA1_OK']}',
                       PREGUNTA_VALIDA1_OK_FECHA = '{$data['PREGUNTA_VALIDA1_OK_FECHA']}' 
                       WHERE
                       PREGUNTA_ID = {$data['PREGUNTA_ID']}
                       ";
        $return = $SQL_string_query = $this->db->query($SQL_string);

        return $return;
    }

    public function update_question_valida2($data) {
        //echo '<pre>' . print_r($data['question'], true) . '</pre>';
        $SQL_string = "UPDATE {$this->db->dbprefix('preguntas')} SET
                       PREGUNTA_VALIDA2_OK = '{$data['PREGUNTA_VALIDA2_OK']}',
                       PREGUNTA_VALIDA2_OK_FECHA = '{$data['PREGUNTA_VALIDA2_OK_FECHA']}' 
                       WHERE
                       PREGUNTA_ID = {$data['PREGUNTA_ID']}
                       ";
        $return = $SQL_string_query = $this->db->query($SQL_string);

        return $return;
    }

    public function update_question_rubrica($PREGUNTA_NIVELRUBRICA, $PREGUNTA_ID) {
        $SQL_string = "UPDATE {$this->db->dbprefix('preguntas')} SET
                       PREGUNTA_NIVELRUBRICA = '{$PREGUNTA_NIVELRUBRICA}'
                       WHERE
                       PREGUNTA_ID = {$PREGUNTA_ID}
                       ";
        //echo '<textarea>'.$SQL_string.'</textarea>';
        $SQL_string_query = $this->db->query($SQL_string);
    }

    public function update_question_tema($PREGUNTA_TEMA, $PREGUNTA_ID) {
        $SQL_string = "UPDATE {$this->db->dbprefix('preguntas')} SET
                       PREGUNTA_TEMA = '{$PREGUNTA_TEMA}'
                       WHERE
                       PREGUNTA_ID = {$PREGUNTA_ID}
                       ";
        //echo '<textarea>'.$SQL_string.'</textarea>';
        $SQL_string_query = $this->db->query($SQL_string);
    }

    public function update_question_dificultad($PREGUNTA_NIVELDIFICULTAD, $PREGUNTA_ID) {
        $SQL_string = "UPDATE {$this->db->dbprefix('preguntas')} SET
                       PREGUNTA_NIVELDIFICULTAD = '{$PREGUNTA_NIVELDIFICULTAD}'
                       WHERE
                       PREGUNTA_ID = {$PREGUNTA_ID}
                       ";
        //echo '<textarea>'.$SQL_string.'</textarea>';
        $SQL_string_query = $this->db->query($SQL_string);
    }

    public function update_question_nivelpregunta($PREGUNTA_NIVELPREGUNTA, $PREGUNTA_ID) {
        $SQL_string = "UPDATE {$this->db->dbprefix('preguntas')} SET
                       PREGUNTA_NIVELPREGUNTA = '{$PREGUNTA_NIVELPREGUNTA}'
                       WHERE
                       PREGUNTA_ID = {$PREGUNTA_ID}
                       ";
        //echo '<textarea>'.$SQL_string.'</textarea>';
        $SQL_string_query = $this->db->query($SQL_string);
    }

    public function update_question($data, $KEY_AES) {

        $SQL_string = "UPDATE {$this->db->dbprefix('preguntas')} SET
                       PREGUNTA_TEMA = '" . addslashes($data['PREGUNTA_TEMA']) . "',
                       PREGUNTA_NIVELRUBRICA = '{$data['PREGUNTA_NIVELRUBRICA']}',
                       PREGUNTA_NIVELPREGUNTA = '{$data['PREGUNTA_NIVELPREGUNTA']}',
                       PREGUNTA_TIPOITEM = '{$data['PREGUNTA_TIPOITEM']}',
                       PREGUNTA_ETAPA = '{$data['PREGUNTA_ETAPA']}',
                       PREGUNTA_VALIDA_2 = '0',
                       PREGUNTA_NIVELDIFICULTAD = '{$data['PREGUNTA_NIVELDIFICULTAD']}',
                       PREGUNTA_ENUNCIADO = AES_ENCRYPT('" . addslashes($data['PREGUNTA_ENUNCIADO']) . "','{$KEY_AES}'),
                       PREGUNTA_CONTEXTO = AES_ENCRYPT('" . addslashes($data['PREGUNTA_CONTEXTO']) . "','{$KEY_AES}'),    
                       PREGUNTA_OBSERVACIONES = AES_ENCRYPT('" . addslashes($data['PREGUNTA_OBSERVACIONES']) . "','{$KEY_AES}')
                       WHERE
                       PREGUNTA_ID = {$data['PREGUNTA_ID']}
                       ";
        $return = $SQL_string_query = $this->db->query($SQL_string);

        for ($a = 1; $a <= 4; $a++) {
            $RESPUESTA_ID = $data['question'][$a - 1]->RESPUESTA_ID;

            $SQL_string_respuestas = "UPDATE {$this->db->dbprefix('respuestas')} SET
                       RESPUESTA_ENUNCIADO = AES_ENCRYPT('" . addslashes($data['RESPUESTA_ENUNCIADO_' . $a]) . "','{$KEY_AES}'),
                       RESPUESTA_JUSTIFICACION = AES_ENCRYPT('" . addslashes($data['RESPUESTA_JUSTIFICACION_' . $a]) . "','{$KEY_AES}')
                       WHERE
                       RESPUESTA_ID = {$RESPUESTA_ID}
                       ";
            $this->db->query($SQL_string_respuestas);

            if ($data['PREGUNTA_IDRESPUESTA'] == $a) {
                $RESPUESTA_ID = $RESPUESTA_ID;
                $this->db->query("UPDATE {$this->db->dbprefix('preguntas')} "
                        . " SET PREGUNTA_IDRESPUESTA = AES_ENCRYPT('{$RESPUESTA_ID}','{$KEY_AES}')  "
                        . " WHERE PREGUNTA_ID={$data['PREGUNTA_ID']}");
            }
        }
        return $return;
    }

    public function update_question_modify($data, $KEY_AES) {

        $this->db->query("DELETE FROM {$this->db->dbprefix('pregunta_modificacion')} WHERE PREGUNTA_ID='{$data['PREGUNTA_ID']}' ");

        //echo '<pre>' . print_r($data['question'], true) . '</pre>';
        $SQL_string = "INSERT INTO {$this->db->dbprefix('pregunta_modificacion')}
                      (
                       PREGUNTA_MODIFICACION_ENUNCIADO,
                       PREGUNTA_MODIFICACION_CONTEXTO,
                       PREGUNTA_MODIFICACION_OBSERVACIONES,
                       PREGUNTA_MODIFICACION_FECHA,
                       PREGUNTA_MODIFICACION_IDUSUARIOCREADOR,
                       PREGUNTA_ID
                       )
                      VALUES
                       (
                       AES_ENCRYPT('" . addslashes($data['PREGUNTA_MODIFICACION_ENUNCIADO']) . "','{$KEY_AES}'),
                       AES_ENCRYPT('" . addslashes($data['PREGUNTA_MODIFICACION_CONTEXTO']) . "','{$KEY_AES}'),    
                       AES_ENCRYPT('" . addslashes($data['PREGUNTA_MODIFICACION_OBSERVACIONES']) . "','{$KEY_AES}'),
                       '{$data['PREGUNTA_MODIFICACION_FECHA']}',
                       '{$data['PREGUNTA_MODIFICACION_IDUSUARIOCREADOR']}',
                       '{$data['PREGUNTA_ID']}'    
                       )
                       ";
        $return = $this->db->query($SQL_string);
        //echo '<textarea>'.$SQL_string.'</textarea>';

        for ($a = 1; $a <= 4; $a++) {
            $RESPUESTA_ID = $data['question'][$a - 1]->RESPUESTA_ID;

            $this->db->query("DELETE FROM {$this->db->dbprefix('respuesta_modificacion')} WHERE RESPUESTA_ID='{$RESPUESTA_ID}' ");

            $SQL_string_respuestas = "INSERT INTO {$this->db->dbprefix('respuesta_modificacion')}
                          (
                           RESPUESTA_MODIFICACION_ENUNCIADO,
                           RESPUESTA_MODIFICACION_JUSTIFICACION,
                           RESPUESTA_MODIFICACION_FECHA,
                           RESPUESTA_MODIFICACION_IDUSUARIOCREADOR,
                           RESPUESTA_ID
                           )
                          VALUES 
                           (
                           AES_ENCRYPT('" . addslashes($data['RESPUESTA_ENUNCIADO_' . $a]) . "','{$KEY_AES}'),
                           AES_ENCRYPT('" . addslashes($data['RESPUESTA_JUSTIFICACION_' . $a]) . "','{$KEY_AES}'),
                           '{$data['PREGUNTA_MODIFICACION_FECHA']}',    
                           '{$data['PREGUNTA_MODIFICACION_IDUSUARIOCREADOR']}',
                           '{$RESPUESTA_ID}'
                           )
                           ";
            $this->db->query($SQL_string_respuestas);
        }
        return $return;
    }

    public function get_modify_item($PREGUNTA_ID, $KEY_AES) {
        $SQL_string = "SELECT "
                . " AES_DECRYPT(PREGUNTA_MODIFICACION_ENUNCIADO,'{$KEY_AES}') PREGUNTA_MODIFICACION_ENUNCIADO,"
                . " AES_DECRYPT(PREGUNTA_MODIFICACION_CONTEXTO,'{$KEY_AES}') PREGUNTA_MODIFICACION_CONTEXTO,"
                . " AES_DECRYPT(PREGUNTA_MODIFICACION_OBSERVACIONES,'{$KEY_AES}') PREGUNTA_MODIFICACION_OBSERVACIONES,"
                . " PREGUNTA_MODIFICACION_FECHA,PREGUNTA_MODIFICACION_IDUSUARIOCREADOR "
                . " FROM {$this->db->dbprefix('pregunta_modificacion')} WHERE "
                . "PREGUNTA_ID = '{$PREGUNTA_ID}'  ";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_nameuser_id($USUARIO_ID) {
        $SQL_string = "SELECT CONCAT(USUARIO_NOMBRES,' ',USUARIO_APELLIDOS) NOMBRE"
                . " FROM {$this->db->dbprefix('usuarios')} WHERE "
                . "USUARIO_ID = '{$USUARIO_ID}'  ";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_modify_resp($RESPUESTA_ID, $KEY_AES) {
        $SQL_string = "SELECT "
                . " AES_DECRYPT(RESPUESTA_MODIFICACION_ENUNCIADO,'{$KEY_AES}') RESPUESTA_MODIFICACION_ENUNCIADO,"
                . " AES_DECRYPT(RESPUESTA_MODIFICACION_JUSTIFICACION,'{$KEY_AES}') RESPUESTA_MODIFICACION_JUSTIFICACION,"
                . " RESPUESTA_MODIFICACION_FECHA "
                . " FROM {$this->db->dbprefix('respuesta_modificacion')} WHERE "
                . "RESPUESTA_ID = '{$RESPUESTA_ID}'  ";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

}
