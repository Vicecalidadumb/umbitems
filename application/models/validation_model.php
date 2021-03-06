<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Validation_model extends CI_Model {

    public function update_question_validate() {
        $post = $this->input->post();
        switch ($post['PREGUNTA_VALIDA_2']) {
            case 1:
                $data = array(
                    'PREGUNTA_VALIDA_2' => 1,
                    'PREGUNTA_ETAPA' => 2,
                    'PREGUNTA_VALIDA_2_FECHA' => date("Y-m-d H:i:s")
                );
                break;
            case 2:
                $data = array(
                    'PREGUNTA_VALIDA_2' => 1,
                    'PREGUNTA_VALIDA_2_FECHA' => '0000-00-00 00:00:00'
                );
                break;
        }
        $this->db->set('PREGUNTA_VALIDA_2_TEXT1','concat(PREGUNTA_VALIDA_2_TEXT1,'."'".$post['PREGUNTA_VALIDA_2_TEXT1']."<br>".date('d/m/Y H:i:s')."<br>"."')",false);
        $this->db->set('PREGUNTA_VALIDA_2_TEXT2','concat(PREGUNTA_VALIDA_2_TEXT2,'."'".$post['PREGUNTA_VALIDA_2_TEXT2']."<br>".date('d/m/Y H:i:s')."<br>"."')",false);
        
        $this->db->where('PREGUNTA_ID', $post['PREGUNTA_ID']);
        $TT=$this->db->update("preguntas", $data);
//        echo $this->db->last_query();
        return $TT;
    }

    public function insert($data) {

        $this->db->query("DELETE FROM {$this->db->dbprefix('evaluacion')} WHERE "
                . "PREGUNTA_ID = '{$data['PREGUNTA_ID']}' AND "
                . "TIPOEVALUACION_ID = '{$data['TIPOEVALUACION_ID']}' AND "
                . "EVALUACION_ID_USUARIOCREADOR = '{$data['EVALUACION_ID_USUARIOCREADOR']}'");

        $SQL_string = "INSERT INTO {$this->db->dbprefix('evaluacion')}
                      (
                       EVALUACION_OBSERVACION,
                       EVALUACION_FECHA,
                       EVALUACION_PUNTUACION,
                       EVALUACION_ID_USUARIOCREADOR,
                       PREGUNTA_ID, 
                       TIPOEVALUACION_ID
                       )
                      VALUES 
                       (
                       '" . addslashes($data['EVALUACION_OBSERVACION']) . "',
                       '{$data['EVALUACION_FECHA']}',
                       '{$data['EVALUACION_PUNTUACION']}',
                       '{$data['EVALUACION_ID_USUARIOCREADOR']}',
                       '{$data['PREGUNTA_ID']}',
                       '{$data['TIPOEVALUACION_ID']}'
                       )
                       ";
        return $this->db->query($SQL_string);
    }

    public function get_validation($id_question, $id_user) {
        $SQL_string = "SELECT * FROM {$this->db->dbprefix('evaluacion')} WHERE "
                . "PREGUNTA_ID = '{$id_question}' AND "
                . "EVALUACION_ID_USUARIOCREADOR = '{$id_user}' ";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_validation_view($id_question) {
        $SQL_string = "SELECT * FROM "
                . "{$this->db->dbprefix('evaluacion')} e, {$this->db->dbprefix('usuarios')} u "
                . "WHERE  u.USUARIO_ID = e.EVALUACION_ID_USUARIOCREADOR"
                . " AND PREGUNTA_ID = '{$id_question}' ORDER BY TIPOEVALUACION_ID";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function update_question($data, $KEY_AES) {

        //echo '<pre>' . print_r($data['question'], true) . '</pre>';
        $SQL_string = "UPDATE {$this->db->dbprefix('preguntas')} SET
                       PREGUNTA_TEMA = '" . addslashes($data['PREGUNTA_TEMA']) . "',
                       PREGUNTA_NIVELRUBRICA = '{$data['PREGUNTA_NIVELRUBRICA']}',
                       PREGUNTA_TIPOITEM = '{$data['PREGUNTA_TIPOITEM']}',
                       PREGUNTA_NIVELDIFICULTAD = '{$data['PREGUNTA_NIVELDIFICULTAD']}',
                       PREGUNTA_ENUNCIADO = AES_ENCRYPT('" . addslashes($data['PREGUNTA_ENUNCIADO']) . "','{$KEY_AES}'),
                       PREGUNTA_OBSERVACIONES = AES_ENCRYPT('" . addslashes($data['PREGUNTA_OBSERVACIONES']) . "','{$KEY_AES}')
                       WHERE
                       PREGUNTA_ID = {$data['PREGUNTA_ID']}
                       ";
        //echo '<textarea>'.$SQL_string.'</textarea>';
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

}
