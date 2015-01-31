<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model {

    public function get_all_users($state = 1, $restric = 0) {
        $where = '';
        if ($this->session->userdata('ID_TIPO_USU') == 5 && $restric = 1) {
            $where.=' AND (u.ID_TIPO_USU=2 OR  u.ID_TIPO_USU=6) ';
        }
        $SQL_string = "SELECT *
                      FROM 
                        {$this->db->dbprefix('usuarios')} u,
                        {$this->db->dbprefix('tipos_usuario')} tu
                      WHERE 
                      u.ID_TIPO_USU = tu.ID_TIPO_USU
                      AND USUARIO_ESTADO=$state $where
                      ORDER BY tu.NOM_TIPO_USU";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_user($user_id) {
        $SQL_string = "SELECT *
                      FROM {$this->db->dbprefix('usuarios')} u
                      JOIN {$this->db->dbprefix('tipos_usuario')} r ON r.ID_TIPO_USU = u.ID_TIPO_USU
                      WHERE USUARIO_ID = '{$user_id}'";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_all_users_rol($state = 1) {

        $SQL_string = "SELECT u.*,t.*,USUARIO_ID,CONCAT(u.USUARIO_NOMBRES,' - ',t.NOM_TIPO_USU) AS USUARIO_NOMBRES
                      FROM 
                        {$this->db->dbprefix('usuarios')} u,
                        {$this->db->dbprefix('tipos_usuario')} t
                      WHERE 
                      u.USUARIO_ESTADO=$state 
                      AND t.ID_TIPO_USU = u.ID_TIPO_USU
                      ORDER BY NOM_TIPO_USU,USUARIO_NOMBRES";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_all_users_type($type_id = "nocons") {
        $wheretype = " AND u.ID_TIPO_USU = $type_id ";
        $where = '';
        if($type_id=='nocons'){
            $wheretype = '';
            $where.=' AND (u.ID_TIPO_USU=3 OR u.ID_TIPO_USU=4 OR u.ID_TIPO_USU=6 OR u.ID_TIPO_USU=7) ';
        }
        $SQL_string = "SELECT t.*,u.*, CONCAT(USUARIO_NOMBRES,' ',USUARIO_APELLIDOS) AS NOMBRES_C
                      FROM {$this->db->dbprefix('usuarios')} u,{$this->db->dbprefix('tipos_usuario')} t
                      WHERE USUARIO_ESTADO = '1' AND t.ID_TIPO_USU = u.ID_TIPO_USU $wheretype $where
                      ORDER BY NOM_TIPO_USU";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_user_id_user($id_user) {
        $SQL_string = "SELECT *
                      FROM {$this->db->dbprefix('usuarios')}
                      WHERE USUARIO_ID = $id_user AND USUARIO_ESTADO = '1'";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function insert_user($data) {
        $CI = & get_instance();

        $SQL_string = "INSERT INTO {$this->db->dbprefix('usuarios')}
                      (
                       USUARIO_NOMBRES,  
                       USUARIO_APELLIDOS,     
                       USUARIO_TIPODOCUMENTO,
                       USUARIO_NUMERODOCUMENTO,     
                       USUARIO_CORREO,     
                       USUARIO_CLAVE,
                       ID_TIPO_USU
                       )
                      VALUES 
                       (
                       '{$data['USUARIO_NOMBRES']}',"
                . "'{$data['USUARIO_APELLIDOS']}',"
                . "'{$data['USUARIO_TIPODOCUMENTO']}',"
                . "'{$data['USUARIO_NUMERODOCUMENTO']}',"
                . "'{$data['USUARIO_CORREO']}',"
                . "'{$data['USUARIO_CLAVE']}',"
                . "'{$data['ID_TIPO_USU']}'
                       )
                       ";
        return $this->db->query($SQL_string);
    }

    public function get_user_username($user_username) {
        $sql_string = "SELECT *
                      FROM {$this->db->dbprefix('usuarios')} u, {$this->db->dbprefix('tipos_usuario')} tu
                      WHERE u.ID_TIPO_USU = tu.ID_TIPO_USU AND USUARIO_NUMERODOCUMENTO = '{$user_username}'
                      AND USUARIO_ESTADO=1";

        $sql_query = $this->db->query($sql_string);
        return $sql_query->result();
    }

    public function get_all_roles() {
        $SQL_string = "SELECT *
                      FROM {$this->db->dbprefix('tipos_usuario')}
                      WHERE ACT_TIPO_USU=1";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function update_user($data) {
        $SQL_string = "UPDATE {$this->db->dbprefix('usuarios')} SET
                       USUARIO_NOMBRES = '{$data['USUARIO_NOMBRES']}', 
                       USUARIO_APELLIDOS = '{$data['USUARIO_APELLIDOS']}',
                       USUARIO_TIPODOCUMENTO = '{$data['USUARIO_TIPODOCUMENTO']}',
                       USUARIO_NUMERODOCUMENTO = '{$data['USUARIO_NUMERODOCUMENTO']}',    
                       USUARIO_CORREO = '{$data['USUARIO_CORREO']}',
                       ID_TIPO_USU = '{$data['ID_TIPO_USU']}'
                       WHERE
                       USUARIO_ID = {$data['USUARIO_ID']}
                       ";
        return $SQL_string_query = $this->db->query($SQL_string);
    }

    public function update_user_password($new_password, $user_id) {
        $SQL_string = "UPDATE {$this->db->dbprefix('usuarios')} SET
                       USUARIO_CLAVE='$new_password'
                       WHERE
                       USUARIO_ID='$user_id'
                       ";
        $SQL_string_query = $this->db->query($SQL_string);
    }

    public function insert_event($array) {
        $SQL_string = "INSERT INTO {$this->db->dbprefix('log')}
                      (
                       USUARIO_ID,
                       PREGUNTA_ID,
                       LOG_TIPO,
                       LOG_DESCRIPCION,
                       LOG_IDREFERENCIA
                       )
                      VALUES 
                       (
                       '{$array['USUARIO_ID']}',
                       '{$array['PREGUNTA_ID']}',
                       '{$array['LOG_TIPO']}',
                       '{$array['LOG_DESCRIPCION']}',
                       '{$array['LOG_IDREFERENCIA']}'
                       )
                       ";
        return $this->db->query($SQL_string);
    }

}
