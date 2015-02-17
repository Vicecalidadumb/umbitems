<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Selection_model extends CI_Model {

    public function update_question_select($state, $id_question, $COMPONENTE_ID, $PREGUNTA_NIVELPREGUNTA, $campodinamico, $etapa, $KEY_AES) {
        $id_question = deencrypt_id($id_question);
//        echo $id_question." id question<br> etapa ";
        $post = $this->input->post();

//        echo $etapa . "**" . $state . "**" . $post['accion2'];
//        die();

        if ($etapa == 4 && $state == 0 && $post['accion2'] == 0) {
            $SQL = "SELECT
umbitems_respuestas.RESPUESTA_ID,
AES_DECRYPT(PREGUNTA_IDRESPUESTA,'kjgw&&3%$&887Dvvc600') AS PREGUNTA_IDRESPUESTA,
AES_DECRYPT(RESPUESTA_ENUNCIADO,'kjgw&&3%$&887Dvvc600') AS RESPUESTA_ENUNCIADO,
AES_DECRYPT(RESPUESTA_JUSTIFICACION,'kjgw&&3%$&887Dvvc600') AS RESPUESTA_JUSTIFICACION,
AES_DECRYPT(RESPUESTA_MODIFICACION_ENUNCIADO,'kjgw&&3%$&887Dvvc600') AS RESPUESTA_MODIFICACION_ENUNCIADO,
AES_DECRYPT(RESPUESTA_MODIFICACION_JUSTIFICACION,'kjgw&&3%$&887Dvvc600') AS RESPUESTA_MODIFICACION_JUSTIFICACION
FROM
umbitems_preguntas
INNER JOIN umbitems_respuestas ON umbitems_preguntas.PREGUNTA_ID = umbitems_respuestas.PREGUNTA_ID
left JOIN umbitems_respuesta_modificacion ON umbitems_respuestas.RESPUESTA_ID = umbitems_respuesta_modificacion.RESPUESTA_ID
WHERE umbitems_preguntas.PREGUNTA_ID=" . $id_question;

            $ramdom = $this->db->query($SQL);
            $ramdom = $ramdom->result();
            $bara = array(0, 1, 2, 3);
            $bara[] = shuffle($bara);


            for ($i = 0; $i < count($bara) - 1; $i++) {

                if (($ramdom[0]->PREGUNTA_IDRESPUESTA) == ($ramdom[$bara[$i]]->RESPUESTA_ID)) {
                    $respuesta = $ramdom[$i]->RESPUESTA_ID;
                }
                $this->db->query("update umbitems_respuestas set "
                        . "RESPUESTA_ENUNCIADO=AES_ENCRYPT('" . addslashes($ramdom[$bara[$i]]->RESPUESTA_ENUNCIADO) . "','{$KEY_AES}'),"
                        . "RESPUESTA_JUSTIFICACION=AES_ENCRYPT('" . addslashes($ramdom[$bara[$i]]->RESPUESTA_JUSTIFICACION) . "','{$KEY_AES}')"
                        . " where RESPUESTA_ID=" . $ramdom[$i]->RESPUESTA_ID);

                if (!empty($ramdom[$bara[$i]]->RESPUESTA_MODIFICACION_ENUNCIADO)) {
                    $this->db->query("update umbitems_respuesta_modificacion set "
//                . "PREGUNTA_IDRESPUESTA=AES_ENCRYPT('" . addslashes($ramdom[$bara[$i]]->RESPUESTA_ID)."--".$ramdom[$i]->RESPUESTA_ID  . "','{$KEY_AES}'),"
                            . "RESPUESTA_MODIFICACION_ENUNCIADO=AES_ENCRYPT('" . addslashes($ramdom[$bara[$i]]->RESPUESTA_MODIFICACION_ENUNCIADO) . "','{$KEY_AES}'),"
                            . "RESPUESTA_MODIFICACION_JUSTIFICACION=AES_ENCRYPT('" . addslashes($ramdom[$bara[$i]]->RESPUESTA_MODIFICACION_JUSTIFICACION) . "','{$KEY_AES}')"
                            . " where RESPUESTA_ID=" . $ramdom[$i]->RESPUESTA_ID);
                }
            }
            $this->db->query("update umbitems_preguntas set PREGUNTA_IDRESPUESTA=AES_ENCRYPT('" . addslashes($respuesta) . "','{$KEY_AES}')  where PREGUNTA_ID=" . $id_question);
            $this->db->set('PREGUNTA_SELEC_1_TEXT2', 'concat(PREGUNTA_SELEC_1_TEXT2,' . "'" . $post['PREGUNTA_SELEC_1_TEXT2'] . "<br>" . date('d/m/Y H:i:s') . " En Corr. de Estilo <br>" . "')", false);
        } else if ($etapa == 3 && $post['accion2'] == 1) {
            $state = 0;
            $etapa = 1;
            $this->db->set('PREGUNTA_VALIDA_2', '1');
            $this->db->set('PREGUNTA_SELEC_1_TEXT2', 'concat(PREGUNTA_SELEC_1_TEXT2,' . "'" . $post['PREGUNTA_SELEC_1_TEXT2'] . "<br>" . date('d/m/Y H:i:s') . " En Seleccion <br>" . "')", false);
        } else if ($etapa == 4 && $post['accion2'] == 1) {
            $state = 0;
            $etapa = 1;
            $this->db->set('PREGUNTA_VALIDA_2', '0');
            $this->db->set('PREGUNTA_SELEC_1_TEXT2', 'concat(PREGUNTA_SELEC_1_TEXT2,' . "'" . $post['PREGUNTA_SELEC_1_TEXT2'] . "<br>" . date('d/m/Y H:i:s') . " En Corr. de Estilo <br>" . "')", false);
        }


        switch ($state) {
            case 0:
                $data = array(
                    $campodinamico => 1,
                    'PREGUNTA_ETAPA' => $etapa,
                    $campodinamico . '_FECHA' => date("Y-m-d H:i:s")
                );
                break;
            default:
                $data = array(
                    $campodinamico => 0,
                    'PREGUNTA_ETAPA' => $etapa - 1,
                    $campodinamico . '_FECHA' => '0000-00-00 00:00:00'
                );
                break;
        }
        $this->db->where('PREGUNTA_ID', $id_question);
        return $this->db->update('preguntas', $data);
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

    public function get_validation_v2($id_question) {
        $SQL_string = "SELECT * FROM {$this->db->dbprefix('evaluacion')} WHERE "
                . "PREGUNTA_ID = '{$id_question}' ";
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

    function devolver($id_pregunta) {
        $this->db->set('PREGUNTA_ETAPA', 1);
        $this->db->set('PREGUNTA_VALIDA_2', 0);
        $this->db->where('PREGUNTA_ID', $id_pregunta);
        $this->db->update('preguntas');
    }

}
